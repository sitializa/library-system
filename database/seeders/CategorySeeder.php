<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $names = [
            'Pemrograman',
            'Basis Data',
            'Jaringan Komputer',
            'Sistem Informasi',
            'Algoritma',
        ];

        $categories = collect($names)
            ->map(fn ($name) => Category::firstOrCreate(['name' => $name]))
            ->values();

        // Buku lama yang belum punya kategori dibagi rata ke kategori di atas
        Book::whereNull('category_id')->get()->each(function ($book, $index) use ($categories) {
            $book->update([
                'category_id' => $categories[$index % $categories->count()]->id,
            ]);
        });
    }
}