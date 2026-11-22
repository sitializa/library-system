@extends('layouts.app')

@section('title', 'Kategori Buku')

@section('content')
    <h2>Kategori Buku</h2>

    @can('manage-categories')
        <p><a href="{{ route('categories.create') }}">+ Tambah Kategori</a></p>
    @endcan

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Jumlah Buku</th>
                @can('manage-categories')
                    <th>Aksi</th>
                @endcan
            </tr>
        </thead>
        <tbody>
            @forelse($categories as $category)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->books_count }}</td>
                    @can('manage-categories')
                        <td>
                            <a href="{{ route('categories.edit', $category) }}">Edit</a> |
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Hapus kategori ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    @endcan
                </tr>
            @empty
                <tr>
                    <td colspan="4">Belum ada kategori.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection