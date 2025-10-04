<?php

namespace App\Providers;

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
        if (config('database.default') === 'sqlite') {
            \Illuminate\Support\Facades\DB::statement('PRAGMA journal_mode=WAL;');
            \Illuminate\Support\Facades\DB::statement('PRAGMA synchronous=NORMAL;');
            \Illuminate\Support\Facades\DB::statement('PRAGMA foreign_keys=ON;');
            \Illuminate\Support\Facades\DB::statement('PRAGMA busy_timeout=5000;');
        }
    }
}
