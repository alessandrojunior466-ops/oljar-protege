<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Rota Principal do seu site
Route::get('/', [SiteController::class, 'index'])->name('home');
=======
// ... Suas outras rotas (Sobre, Videos, Contato) que fizemos antes ficam aqui em cima ...
Route::get('/', function () {
    return view('home');
})->name('home');
>>>>>>> 21ef279a6863b0615344a6fdb696cafb7c6fc8fa

// Outras rotas do seu site
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');
<<<<<<< HEAD
=======
Route::get('/login', [SiteController::class, 'mostrarLogin'])->name('login');
>>>>>>> 21ef279a6863b0615344a6fdb696cafb7c6fc8fa

// Se o arquivo de autenticação existir, ele carrega. Se não, evita quebrar o site!
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}