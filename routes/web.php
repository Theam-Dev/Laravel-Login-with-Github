<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GitHubController;

Route::get('auth/github', [GitHubController::class, 'gitHubLogin']);
Route::get('auth/github/callback', [GitHubController::class, 'gitHubCallback']);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
