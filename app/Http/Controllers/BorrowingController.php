<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['member', 'user'])->latest()->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $members = Member::orderBy('name')->get();

        // Hanya buku yang stoknya masih tersedia yang bisa dipinjam
        $books = Book::with('category')
            ->where('stock', '>', 0)
            ->orderBy('title')
            ->get();

        return view('borrowings.create', compact('members', 'books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'member_id' => 'required|exists:members,id',
            'items'     => 'required|array',
            'items.*'   => 'nullable|integer|min:0',
        ], [
            'member_id.required' => 'Anggota wajib dipilih.',
            'member_id.exists'   => 'Anggota yang dipilih tidak ditemukan.',
            'items.required'     => 'Pilih minimal satu buku yang dipinjam.',
            'items.*.integer'    => 'Jumlah buku harus berupa bilangan bulat.',
            'items.*.min'        => 'Jumlah buku tidak boleh negatif.',
        ]);

        // Hanya buku dengan jumlah lebih dari 0 yang dianggap dipinjam
        $items = collect($request->input('items'))
            ->map(fn ($quantity) => (int) $quantity)
            ->filter(fn ($quantity) => $quantity > 0);

        if ($items->isEmpty()) {
            return back()
                ->withErrors(['items' => 'Pilih minimal satu buku dengan jumlah lebih dari 0.'])
                ->withInput();
        }

        DB::transaction(function () use ($request, $items) {
            // Kunci baris buku agar stok tidak berubah di tengah proses
            $books = Book::whereIn('id', $items->keys()->all())
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            // Aturan bisnis: stok harus mencukupi untuk setiap buku
            foreach ($items as $bookId => $quantity) {
                $book = $books->get($bookId);

                if (! $book) {
                    throw ValidationException::withMessages([
                        'items' => 'Ada buku yang tidak ditemukan.',
                    ]);
                }

                if ($book->stock < $quantity) {
                    throw ValidationException::withMessages([
                        'items' => "Stok buku \"{$book->title}\" tidak mencukupi. Tersedia {$book->stock}, diminta {$quantity}.",
                    ]);
                }
            }

            // Catat transaksi (petugas = pengguna yang sedang login)
            $borrowing = Borrowing::create([
                'user_id'        => auth()->id(),
                'member_id'      => $request->member_id,
                'borrowing_date' => now()->toDateString(),
                'due_date'       => now()->addDays(7)->toDateString(),
                'status'         => 'borrowed',
            ]);

            // Catat detail buku dan kurangi stok
            foreach ($items as $bookId => $quantity) {
                $borrowing->details()->create([
                    'book_id'  => $bookId,
                    'quantity' => $quantity,
                ]);

                $books->get($bookId)->decrement('stock', $quantity);
            }
        });

        return redirect()
            ->route('borrowings.index')
            ->with('success', 'Peminjaman berhasil dicatat dan stok buku sudah dikurangi. Jatuh tempo: ' . now()->addDays(7)->format('d-m-Y') . '.');
    }

    public function show(Borrowing $borrowing)
    {
        $borrowing->load(['member', 'user', 'details.book.category']);

        return view('borrowings.show', compact('borrowing'));
    }

    public function returnBook(Borrowing $borrowing)
    {
        $returned = DB::transaction(function () use ($borrowing) {
            $locked = Borrowing::with('details.book')
                ->lockForUpdate()
                ->findOrFail($borrowing->id);

            // Cegah stok bertambah dua kali untuk transaksi yang sama
            if ($locked->status === 'returned') {
                return false;
            }

            $locked->update([
                'return_date' => now()->toDateString(),
                'status'      => 'returned',
            ]);

            foreach ($locked->details as $detail) {
                $detail->book->increment('stock', $detail->quantity);
            }

            return true;
        });

        if (! $returned) {
            return redirect()
                ->route('borrowings.show', $borrowing)
                ->with('error', 'Transaksi ini sudah dikembalikan sebelumnya.');
        }

        return redirect()
            ->route('borrowings.show', $borrowing)
            ->with('success', 'Buku berhasil dikembalikan dan stok buku bertambah.');
    }
}