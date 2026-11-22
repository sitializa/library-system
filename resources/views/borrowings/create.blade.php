@extends('layouts.app')

@section('title', 'Peminjaman Baru')

@section('content')
    <h2>Peminjaman Baru</h2>

    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if($members->isEmpty() || $books->isEmpty())
        <p>Peminjaman belum dapat dibuat. Pastikan sudah ada anggota dan buku dengan stok tersedia.</p>
    @else
        <form action="{{ route('borrowings.store') }}" method="POST">
            @csrf
            <div class="field">
                <label>Anggota</label><br>
                <select name="member_id">
                    <option value="">-- Pilih Anggota --</option>
                    @foreach($members as $member)
                        <option value="{{ $member->id }}" @selected(old('member_id') == $member->id)>
                            {{ $member->member_code }} - {{ $member->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <p>
                Isi jumlah pada buku yang dipinjam, biarkan 0 untuk buku yang tidak dipinjam.
                Lama peminjaman 7 hari.
            </p>

            <table>
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Stok</th>
                        <th>Jumlah Dipinjam</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->category?->name ?? '-' }}</td>
                            <td>{{ $book->stock }}</td>
                            <td>
                                <input type="number" name="items[{{ $book->id }}]"
                                       value="{{ old('items.' . $book->id, 0) }}" style="width: 80px">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <p><button type="submit">Simpan Peminjaman</button></p>
        </form>
    @endif

    <p><a href="{{ route('borrowings.index') }}">&larr; Kembali ke daftar peminjaman</a></p>
@endsection