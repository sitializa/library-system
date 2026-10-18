@extends('layouts.app')

@section('title', 'Tambah Buku')

@section('content')
    <h2>Tambah Buku</h2>

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <div>
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title') }}">
            @error('title')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>Penulis</label><br>
            <input type="text" name="author" value="{{ old('author') }}">
            @error('author')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>Tahun Terbit</label><br>
            <input type="number" name="year" value="{{ old('year') }}">
            @error('year')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label>Stok</label><br>
            <input type="number" name="stock" value="{{ old('stock') }}">
            @error('stock')
                <p style="color: red;">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>
@endsection