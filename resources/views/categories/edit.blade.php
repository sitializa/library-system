@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')
    <h2>Edit Kategori</h2>

    <form action="{{ route('categories.update', $category) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nama Kategori</label><br>
            <input type="text" name="name" value="{{ old('name', $category->name) }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>
@endsection