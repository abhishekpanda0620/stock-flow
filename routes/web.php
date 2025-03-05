<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('filament-panels::pages.auth.login');
});

Route::get('/clear-cache', function() {
    Artisan::call('optimize:clear');
    return "Cache cleared!";
});

Route::get('/migrate', function () {
    Artisan::call('migrate', ['--force' => true]);
    return 'Database migrated!';
});
