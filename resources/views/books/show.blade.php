@extends('layouts.app')

@section('title', 'Detail Buku')

@section('content')
    <h2>Detail Buku</h2>
    <p><strong>Judul:</strong> {{ $book->title }}</p>
    <p><strong>Penulis:</strong> {{ $book->author }}</p>
    <p><strong>Tahun Terbit:</strong> {{ $book->year }}</p>
    <p>
        <strong>Stok:</strong>
        @if($book->stock > 0)
            Tersedia ({{ $book->stock }})
        @else
            Habis
        @endif
    </p>

    <a href="{{ route('books.index') }}">&larr; Kembali ke daftar buku</a>
@endsection