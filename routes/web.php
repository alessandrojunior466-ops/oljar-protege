<?php

<<<<<<< HEAD
=======
use App\Http\Controllers\ProfileController;
>>>>>>> 62241afbb44e03cf2a42d39162daa874ced8cad5
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;

<<<<<<< HEAD
/*
|--------------------------------------------------------------------------
| Rotas do Site
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'index'])->name('home');

=======
// Rota Principal do seu site
Route::get('/', [SiteController::class, 'index'])->name('home');

// Outras rotas do seu site
>>>>>>> 62241afbb44e03cf2a42d39162daa874ced8cad5
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');

Route::get('/videos', [SiteController::class, 'videos'])->name('videos');

Route::get('/blog', [SiteController::class, 'blog'])->name('blog');

Route::get('/login', [SiteController::class, 'mostrarLogin'])->name('login');

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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});
=======
// Se o arquivo de autenticação existir, ele carrega. Se não, evita quebrar o site!
if (file_exists(__DIR__.'/auth.php')) {
    require __DIR__.'/auth.php';
}
>>>>>>> 62241afbb44e03cf2a42d39162daa874ced8cad5
