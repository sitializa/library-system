@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
    <h2>Tambah Kategori</h2>

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="field">
            <label>Nama Kategori</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('categories.index') }}">&larr; Kembali ke daftar kategori</a></p>
@endsection