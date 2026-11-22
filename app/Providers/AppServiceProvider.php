<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Hanya admin yang boleh mengelola akun pengguna
        Gate::define('manage-users', function ($user) {
            return $user->role === 'admin';
        });

        // Hanya admin yang boleh menambah, mengubah, dan menghapus kategori
        Gate::define('manage-categories', function ($user) {
            return $user->role === 'admin';
        });
    }
}