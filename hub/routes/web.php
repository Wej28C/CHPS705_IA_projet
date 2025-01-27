<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;

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

    Route::get('/connections', function() {
        return view('connections');
    })->name('connections');

    Route::get('/robots', function() {
        return view('robots');
    })->name('robots');

    Route::get('/hosts', function() {
        return view('hosts');
    })->name('hosts');

    Route::get('/games', function() {
        return view('games');
    })->name('games');

    Route::get('/games/export', [GameController::class, 'export'])->name('games.export');
});
