<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas do Site
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

// Exibe a sua tela personalizada de login
Route::get('/login', [SiteController::class, 'login'])->name('login');

// Carrega o resto das autenticações do auth.php (como o POST do login)
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// Painel Protegido (Dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Altere para a sua view do painel se tiver outro nome
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
