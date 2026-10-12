@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <p>
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title') }}" required>
        </p>
        <p>
            <label>Penulis</label><br>
            <input type="text" name="author" value="{{ old('author') }}" required>
        </p>
        <p>
            <label>Tahun Terbit</label><br>
            <input type="number" name="year" value="{{ old('year') }}" required>
        </p>
        <p>
            <label>Stok</label><br>
            <input type="number" name="stock" value="{{ old('stock') }}" required>
        </p>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>
@endsection