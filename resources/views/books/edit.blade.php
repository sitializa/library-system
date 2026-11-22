@extends('layouts.app')

@section('title', 'Edit Buku')

@section('content')
    <h2>Edit Buku</h2>

    <form action="{{ route('books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Judul</label><br>
            <input type="text" name="title" value="{{ old('title', $book->title) }}">
            @error('title')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Penulis</label><br>
            <input type="text" name="author" value="{{ old('author', $book->author) }}">
            @error('author')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Tahun Terbit</label><br>
            <input type="number" name="year" value="{{ old('year', $book->year) }}">
            @error('year')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Stok</label><br>
            <input type="number" name="stock" value="{{ old('stock', $book->stock) }}">
            @error('stock')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Kategori</label><br>
            <select name="category_id">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('category_id', $book->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a></p>
@endsection