@extends('layouts.app')

@section('title', 'Tambah Anggota')

@section('content')
    <h2>Tambah Anggota</h2>

    <form action="{{ route('members.store') }}" method="POST">
        @csrf
        <div class="field">
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Kode Anggota</label><br>
            <input type="text" name="member_code" value="{{ old('member_code') }}">
            @error('member_code')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Telepon</label><br>
            <input type="text" name="phone" value="{{ old('phone') }}">
            @error('phone')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Alamat</label><br>
            <input type="text" name="address" value="{{ old('address') }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Simpan</button>
    </form>

    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>
@endsection