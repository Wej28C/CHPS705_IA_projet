<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/matchmaking', function() {
        return view('matchmaking');
    })->name('matchmaking');

    Route::get('/game', function() {
        return view('game');
    })->name('game');
});
