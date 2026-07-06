<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// --- PÁGINAS PÚBLICAS ---

// Home (Página Inicial)
Route::get('/', function () {
    return view('home'); // Mudamos de 'welcome' para 'home' para ficar mais organizado
})->name('home');

// Sobre
Route::get('/sobre', function () {
    return view('sobre');
})->name('sobre');

// Vídeos
Route::get('/videos', function () {
    return view('videos');
})->name('videos');

// Blog
Route::get('/blog', function () {
    return view('blog');
})->name('blog');


// --- ÁREA RESTRITA (AUTENTICADA) ---

// Dashboard (Apenas usuários logados acessam)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Perfil do Usuário
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Carrega as rotas nativas de Login, Registro, etc.
require __DIR__.'/auth.php';