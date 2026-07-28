<?php

<<<<<<< HEAD
use Illuminate\Support\Facades\Route;
=======
use App\Http\Controllers\ProfileController;
>>>>>>> 5080b4ab29b3706a542768000df6a4aa5adfb902
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Rotas do Site
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'index'])->name('home');

=======
// Rotas Públicas do Site
Route::get('/', [SiteController::class, 'index'])->name('home');
>>>>>>> 5080b4ab29b3706a542768000df6a4aa5adfb902
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');
Route::get('/videos', [SiteController::class, 'videos'])->name('videos');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

// Exibe a sua tela personalizada de login
Route::get('/login', [SiteController::class, 'login'])->name('login');

<<<<<<< HEAD

/*
|--------------------------------------------------------------------------
| Dashboard (Jetstream)
|--------------------------------------------------------------------------
*/

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
=======
// Carrega o resto das autenticações do auth.php (como o POST do login)
if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}
>>>>>>> 5080b4ab29b3706a542768000df6a4aa5adfb902

// Painel Protegido (Dashboard)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Altere para a sua view do painel se tiver outro nome
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
