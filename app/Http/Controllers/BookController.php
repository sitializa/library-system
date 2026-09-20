<?php

namespace App\Http\Controllers;

class BookController extends Controller
{
    public function index()
    {
        $books = [
            ['id' => 1, 'title' => 'Pemrograman PHP',                'author' => 'Budi Santoso', 'year' => 2020, 'stock' => 5],
            ['id' => 2, 'title' => 'Laravel untuk Pemula',           'author' => 'Siti Rahma',   'year' => 2022, 'stock' => 3],
            ['id' => 3, 'title' => 'Basis Data',                     'author' => 'Andi Wijaya',  'year' => 2019, 'stock' => 0],
            ['id' => 4, 'title' => 'Algoritma dan Pemrograman',      'author' => 'Dewi Lestari', 'year' => 2021, 'stock' => 7],
            ['id' => 5, 'title' => 'Pemrograman Berorientasi Objek', 'author' => 'Eko Prasetyo', 'year' => 2023, 'stock' => 2],
        ];

        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $stock = 7;

        return view('books.show', compact('id', 'stock'));
    }
}