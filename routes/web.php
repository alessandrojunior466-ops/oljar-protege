<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// ... Suas outras rotas (Sobre, Videos, Contato) que fizemos antes ficam aqui em cima ...
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Suas outras rotas continuam normais abaixo...
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/contato', [SiteController::class, 'contato'])->name('contato');
Route::get('/login', [AuthController::class, 'mostrarLogin'])->name('login');

// Cole o código da Dashboard aqui no final do routes/web.php:
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
