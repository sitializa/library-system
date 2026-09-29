<?php

namespace Database\Seeders;

use App\Models\Book;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Book::create(['title' => 'Pemrograman PHP',                'author' => 'Budi Santoso', 'year' => 2020, 'stock' => 5]);
        Book::create(['title' => 'Laravel untuk Pemula',           'author' => 'Siti Rahma',   'year' => 2022, 'stock' => 3]);
        Book::create(['title' => 'Basis Data',                     'author' => 'Andi Wijaya',  'year' => 2019, 'stock' => 0]);
        Book::create(['title' => 'Algoritma dan Pemrograman',      'author' => 'Dewi Lestari', 'year' => 2021, 'stock' => 7]);
        Book::create(['title' => 'Pemrograman Berorientasi Objek', 'author' => 'Eko Prasetyo', 'year' => 2023, 'stock' => 2]);
    }
}