@extends('layouts.app')

@section('title', 'Edit Anggota')

@section('content')
    <h2>Edit Anggota</h2>

    <form action="{{ route('members.update', $member) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="field">
            <label>Nama</label><br>
            <input type="text" name="name" value="{{ old('name', $member->name) }}">
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Kode Anggota</label><br>
            <input type="text" name="member_code" value="{{ old('member_code', $member->member_code) }}">
            @error('member_code')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Telepon</label><br>
            <input type="text" name="phone" value="{{ old('phone', $member->phone) }}">
            @error('phone')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <div class="field">
            <label>Alamat</label><br>
            <input type="text" name="address" value="{{ old('address', $member->address) }}">
            @error('address')
                <p class="error">{{ $message }}</p>
            @enderror
        </div>
        <button type="submit">Update</button>
    </form>

    <p><a href="{{ route('members.index') }}">&larr; Kembali ke daftar anggota</a></p>
@endsection