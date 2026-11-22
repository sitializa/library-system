@extends('layouts.app')

@section('title', 'Daftar Buku')

@section('content')
    <h2>Daftar Buku</h2>

    <p><a href="{{ route('books.create') }}">+ Tambah Buku</a></p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th>Tahun Terbit</th>
                <th>Kategori</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>{{ $book->year }}</td>
                    <td>{{ $book->category?->name ?? '-' }}</td>
                    <td>
                        @if($book->stock > 0)
                            Tersedia ({{ $book->stock }})
                        @else
                            Habis
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('books.show', $book) }}">Detail</a> |
                        <a href="{{ route('books.edit', $book) }}">Edit</a> |
                        <form action="{{ route('books.destroy', $book) }}" method="POST" style="display:inline"
                              onsubmit="return confirm('Hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data buku.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection