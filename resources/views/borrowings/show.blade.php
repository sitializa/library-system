@extends('layouts.app')

@section('title', 'Detail Peminjaman')

@section('content')
    <h2>Detail Peminjaman #{{ $borrowing->id }}</h2>

    <p><strong>Anggota:</strong> {{ $borrowing->member->member_code }} - {{ $borrowing->member->name }}</p>
    <p><strong>Petugas:</strong> {{ $borrowing->user->name }}</p>
    <p><strong>Tanggal Pinjam:</strong> {{ $borrowing->borrowing_date->format('d-m-Y') }}</p>
    <p><strong>Jatuh Tempo:</strong> {{ $borrowing->due_date->format('d-m-Y') }}</p>
    <p><strong>Tanggal Kembali:</strong> {{ $borrowing->return_date?->format('d-m-Y') ?? '-' }}</p>
    <p><strong>Status:</strong> @include('borrowings._status', ['borrowing' => $borrowing])</p>

    <h3>Buku yang Dipinjam</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Jumlah</th>
                <th>Stok Saat Ini</th>
            </tr>
        </thead>
        <tbody>
            @foreach($borrowing->details as $detail)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $detail->book->title }}</td>
                    <td>{{ $detail->book->category?->name ?? '-' }}</td>
                    <td>{{ $detail->quantity }}</td>
                    <td>{{ $detail->book->stock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    @if($borrowing->status === 'borrowed')
        <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" style="margin-top: 16px"
              onsubmit="return confirm('Proses pengembalian buku?')">
            @csrf
            @method('PATCH')
            <button type="submit">Kembalikan Buku</button>
        </form>
    @endif

    <p><a href="{{ route('borrowings.index') }}">&larr; Kembali ke daftar peminjaman</a></p>
@endsection