@extends('layouts.app')

@section('title', 'Detail Anggota')

@section('content')
    <h2>Detail Anggota</h2>
    <p><strong>Kode:</strong> {{ $member->member_code }}</p>
    <p><strong>Nama:</strong> {{ $member->name }}</p>
    <p><strong>Telepon:</strong> {{ $member->phone }}</p>
    <p><strong>Alamat:</strong> {{ $member->address ?? '-' }}</p>

    <h3>Riwayat Peminjaman</h3>

    <table>
        <thead>
            <tr>
                <th>No</th>
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
                    <td>{{ $borrowing->borrowing_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->due_date->format('d-m-Y') }}</td>
                    <td>{{ $borrowing->return_date?->format('d-m-Y') ?? '-' }}</td>
                    <td>@include('borrowings._status', ['borrowing' => $borrowing])</td>
                    <td><a href="{{ route('borrowings.show', $borrowing) }}">Detail</a></td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Anggota ini belum pernah meminjam buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>
@endsection