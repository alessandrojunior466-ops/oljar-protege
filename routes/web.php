<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;

// Rotas Públicas do Site
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// Rotas Públicas
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

// ROTA DO LOGIN (Nomeada como 'login' para que o menu funcione!)
// AGORA (manda direto para a tela de login nativa do Laravel)
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Carrega o resto das autenticações do auth.php (como o POST do login)
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// Painel Protegido (Dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Altere para a sua view do painel se tiver outro nome
    })->name('dashboard');
// Painel Protegido (Dashboard & Gerenciamento)
Route::middleware(['auth'])->group(function () {
    // Tela principal do Dashboard
    Route::get('/dashboard', [SiteController::class, 'dashboard'])->name('dashboard');
    
    // Rotas do Blog (Criar, Editar, Atualizar e Excluir)
    Route::post('/dashboard/store', [SiteController::class, 'store'])->name('blog.store');
    Route::get('/dashboard/edit/{id}', [SiteController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/update/{id}', [SiteController::class, 'update'])->name('blog.update');
    Route::delete('/dashboard/delete/{id}', [SiteController::class, 'destroy'])->name('blog.delete');

    // Rotas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});