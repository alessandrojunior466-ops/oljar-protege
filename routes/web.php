<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// ... Suas outras rotas (Sobre, Videos, Contato) que fizemos antes ficam aqui em cima ...
Route::get('/', function () {
    return view('home');
})->name('home');

// Suas outras rotas continuam normais abaixo...
Route::get('/home', [SiteController::class, 'index'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/login', [SiteController::class, 'mostrarLogin'])->name('login');

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
