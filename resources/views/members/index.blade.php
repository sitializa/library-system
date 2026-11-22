@extends('layouts.app')

@section('title', 'Data Anggota')

@section('content')
    <h2>Data Anggota</h2>

    <p><a href="{{ route('members.create') }}">+ Tambah Anggota</a></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($members as $member)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $member->member_code }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->phone }}</td>
                    <td>
                        <a href="{{ route('members.show', $member) }}">Detail</a> |
                        <a href="{{ route('members.edit', $member) }}">Edit</a> |
                        <form action="{{ route('members.destroy', $member) }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Hapus anggota ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada data anggota.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection