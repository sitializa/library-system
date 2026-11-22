@extends('layouts.app')

@section('title', 'Peminjaman')

@section('content')
    <h2>Transaksi Peminjaman</h2>

    <p><a href="{{ route('borrowings.create') }}">+ Peminjaman Baru</a></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($borrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->member->name }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->borrowing_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->due_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->return_date?->format('d-m-Y') ?? '-' }}</td>
                    <td>@include('borrowings._status', ['borrowing' => $borrowing])</td>
                    <td>
                        <a href="{{ route('borrowings.show', $borrowing) }}">Detail</a>
                        @if($borrowing->status === 'borrowed')
                            |
                            <form action="{{ route('borrowings.return', $borrowing) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Proses pengembalian buku?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit">Kembalikan</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8">Belum ada transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection