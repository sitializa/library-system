@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <h2>Dashboard</h2>
    <p>Ringkasan informasi perpustakaan.</p>

    <div class="cards">
        <div class="card"><span>Judul Buku</span><strong>{{ $totalBooks }}</strong></div>
        <div class="card"><span>Total Stok Buku</span><strong>{{ $totalStock }}</strong></div>
        <div class="card"><span>Kategori</span><strong>{{ $totalCategories }}</strong></div>
        <div class="card"><span>Anggota</span><strong>{{ $totalMembers }}</strong></div>
        <div class="card"><span>Total Transaksi</span><strong>{{ $totalBorrowings }}</strong></div>
        <div class="card"><span>Sedang Dipinjam</span><strong>{{ $activeBorrowings }}</strong></div>
    </div>

    <h3>Peminjaman Terbaru</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Anggota</th>
                <th>Petugas</th>
                <th>Tanggal Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($latestBorrowings as $borrowing)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $borrowing->member->name }}</td>
                    <td>{{ $borrowing->user->name }}</td>
                    <td>{{ $borrowing->borrowing_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->due_date->format('d-m-Y') }}</td>
                    <td>@include('borrowings._status', ['borrowing' => $borrowing])</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada transaksi peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection