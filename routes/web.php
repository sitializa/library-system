<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\UserController;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login');
    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Semua fitur internal wajib login
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::resource('books', BookController::class);

    // Kategori: admin dan petugas boleh melihat, hanya admin yang boleh mengelola
    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories.index');

    Route::middleware('can:manage-categories')->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except(['index', 'show']);
    });

    Route::resource('members', MemberController::class);

    // Peminjaman dan pengembalian
    Route::resource('borrowings', BorrowingController::class)
        ->only(['index', 'create', 'store', 'show']);
    Route::patch('/borrowings/{borrowing}/return', [BorrowingController::class, 'returnBook'])
        ->name('borrowings.return');
});

// Pengelolaan pengguna khusus admin
Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::resource('users', UserController::class)->only(['index']);
});