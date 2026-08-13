<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'index'])->name('home');
Route::get('/sobre', [SiteController::class, 'sobre'])->name('sobre');

// Nome padronizado para bater com as views (videos.index)
Route::get('/videos', [SiteController::class, 'videos'])->name('videos.index');

Route::get('/videos/{id}', [SiteController::class, 'videosShow'])->name('videos.show');

// Blog
Route::get('/blog', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{id}', [SiteController::class, 'blogShow'])->name('blog.show');

// Login
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

/*
|--------------------------------------------------------------------------
| Painel Protegido (Dashboard)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::redirect('/dashboard', '/dashboard/blog');

    // Dashboard Blog
    Route::get('/dashboard/blog', [SiteController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/blog/store', [SiteController::class, 'store'])->name('blog.store');
    Route::get('/dashboard/blog/edit/{id}', [SiteController::class, 'edit'])->name('dashboard.edit');
    Route::put('/dashboard/blog/update/{id}', [SiteController::class, 'update'])->name('blog.update');
    Route::delete('/dashboard/blog/delete/{id}', [SiteController::class, 'destroy'])->name('blog.delete');

    // Dashboard Vídeos
    Route::get('/dashboard/videos', [SiteController::class, 'dashboardVideos'])->name('dashboard.videos');
    Route::post('/dashboard/videos', [SiteController::class, 'videoStore'])->name('videos.store');
    Route::get('/dashboard/videos/edit/{id}', [SiteController::class, 'videoEdit'])->name('dashboard.videos.edit');
    Route::put('/dashboard/videos/update/{id}', [SiteController::class, 'videoUpdate'])->name('videos.update');
    Route::delete('/dashboard/videos/{id}', [SiteController::class, 'videoDestroy'])->name('videos.delete');
});

/*
|--------------------------------------------------------------------------
| Perfil & Auth
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

if (file_exists(__DIR__ . '/auth.php')) {
    require __DIR__ . '/auth.php';
}