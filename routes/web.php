<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ExtrasAuthController;
use App\Http\Controllers\AdminAuthController;

/*
|--------------------------------------------------------------------------
| Rotas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', [SiteController::class, 'index'])->name('home');

Route::get('/sobre', [SiteController::class, 'sobre'])
    ->name('sobre');

// Vídeos
Route::get('/videos', [SiteController::class, 'videos'])
    ->name('videos.index');

Route::get('/videos/{id}', [SiteController::class, 'videosShow'])
    ->name('videos.show');

// Blog
Route::get('/blog', [SiteController::class, 'blog'])
    ->name('blog.index');

Route::get('/blog/{id}', [SiteController::class, 'blogShow'])
    ->name('blog.show');


/*
|--------------------------------------------------------------------------
| Compatibilidade com o login padrão do Laravel
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return redirect()->route('extras.login');
})->name('login');


/*
|--------------------------------------------------------------------------
| Cadastro e Login dos Usuários Comuns e Administração
|--------------------------------------------------------------------------
*/

// Cadastro de Usuários Comuns
Route::get('/extras/cadastro', [
    ExtrasAuthController::class,
    'showRegister'
])->name('extras.register');

Route::post('/extras/cadastro', [
    ExtrasAuthController::class,
    'register'
])->name('extras.register.submit');

// Login de Usuários Comuns
Route::get('/extras/login', [
    ExtrasAuthController::class,
    'showLogin'
])->name('extras.login');

Route::post('/extras/login', [
    ExtrasAuthController::class,
    'login'
])->name('extras.login.submit');

// Logout de Usuários Comuns
Route::post('/extras/logout', [
    ExtrasAuthController::class,
    'logout'
])->name('extras.logout');

// Login administrativo
Route::get('/admin/login', [
    AdminAuthController::class,
    'showLogin'
])->name('admin.login');

Route::post('/admin/login', [
    AdminAuthController::class,
    'login'
])->name('admin.login.submit');

// Cadastro de Administradores (Página Equipe acessível publicamente para novos membros)
Route::get('/admin/cadastro', [
    AdminAuthController::class,
    'showRegister'
])->name('admin.register');

Route::post('/admin/cadastro', [
    AdminAuthController::class,
    'register'
])->name('admin.register.submit');


/*
|--------------------------------------------------------------------------
| Conteúdos Exclusivos dos Usuários
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/extras', function (Request $request) {

        $usuario = $request->user();

        abort_unless(
            $usuario && $usuario->role === 'user',
            403,
            'Você não tem permissão para acessar esta área.'
        );

        return view('extras');
    })->name('extras');
});


/*
|--------------------------------------------------------------------------
| Painel Administrativo e Dashboard de Gerenciamento
|--------------------------------------------------------------------------
|
| Somente administradores autenticados podem acessar.
|
*/

Route::prefix('admin')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        // Página inicial administrativa
        Route::get('/', function () {
            return view('admin-dashboard');
        })->name('admin.dashboard');

        // Redirecionamento do /admin/dashboard para o /admin/dashboard/blog
        Route::redirect('/dashboard', '/admin/dashboard/blog');

        // Dashboard Blog (em /admin/dashboard/blog)
        Route::get('/dashboard/blog', [
            SiteController::class,
            'dashboard'
        ])->name('dashboard');

        Route::post('/dashboard/blog/store', [
            SiteController::class,
            'store'
        ])->name('blog.store');

        Route::get('/dashboard/blog/edit/{id}', [
            SiteController::class,
            'edit'
        ])->name('dashboard.edit');

        Route::put('/dashboard/blog/update/{id}', [
            SiteController::class,
            'update'
        ])->name('blog.update');

        Route::delete('/dashboard/blog/delete/{id}', [
            SiteController::class,
            'destroy'
        ])->name('blog.delete');


        // Dashboard Vídeos (em /admin/dashboard/videos)
        Route::get('/dashboard/videos', [
            SiteController::class,
            'dashboardVideos'
        ])->name('dashboard.videos');

        Route::post('/dashboard/videos', [
            SiteController::class,
            'videoStore'
        ])->name('videos.store');

        Route::get('/dashboard/videos/edit/{id}', [
            SiteController::class,
            'videoEdit'
        ])->name('dashboard.videos.edit');

        Route::put('/dashboard/videos/update/{id}', [
            SiteController::class,
            'videoUpdate'
        ])->name('videos.update');

        Route::delete('/dashboard/videos/{id}', [
            SiteController::class,
            'videoDestroy'
        ])->name('videos.delete');
    });


/*
|--------------------------------------------------------------------------
| Perfil do Usuário Autenticado
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');

    Route::patch('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');

    Route::delete('/profile', [
        ProfileController::class,
        'destroy'
    ])->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| Autenticação Padrão do Laravel Breeze (Desativada para evitar conflitos)
|--------------------------------------------------------------------------
*/

// if (file_exists(__DIR__ . '/auth.php')) {
//     require __DIR__ . '/auth.php';
// }