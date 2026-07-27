<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

// Rotas Públicas do Site
Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

// Exibe a tela personalizada de login
Route::get('/login', [SiteController::class, 'login'])->name('login');

// Carrega as autenticações do Laravel Breeze / Auth
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}

// Painel Protegido (Dashboard & Ações Administrativas)
Route::middleware('auth')->group(function () {

    // Carrega o Painel (com suporte a carregar a lista ou um post específico para edição)
    Route::get('/dashboard/{id?}', [SiteController::class, 'dashboard'])->name('dashboard');

    // Salvar ou Atualizar Publicação (POST)
    Route::post('/blog', [SiteController::class, 'salvarBlog'])->name('blog');

    // Excluir Publicação (DELETE)
    Route::delete('/blog/{id}', [SiteController::class, 'deletarBlog'])->name('blog.delete');

    // Rotas de Perfil do Usuário
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});