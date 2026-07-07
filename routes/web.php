<?php

use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Rota Principal do seu site
Route::get('/', [SiteController::class, 'index'])->name('home');

// Outras rotas do seu site
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
Route::get('/login', [SiteController::class, 'mostrarLogin'])->name('login');

// Se o arquivo de autenticação existir, ele carrega. Se não, evita quebrar o site!
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}