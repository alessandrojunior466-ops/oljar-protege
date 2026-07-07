<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

// Home, Sobre, Vídeos...
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/sobre', function () { return view('sobre'); })->name('sobre');
Route::get('/videos', function () { return view('videos'); })->name('videos');

// Blog (Página Pública)
Route::get('/blog', function () {
    $publicacoes = Blog::orderBy('created_at', 'asc')->get();
    $destaque = $publicacoes->first();
    $restante = $publicacoes->skip(1);
    return view('blog', compact('destaque', 'restante'));
})->name('blog');

// Dashboard (Exibe formulário de criação ou edição se receber um ID)
Route::get('/dashboard/{id?}', function ($id = null) {
    $publicacoes = Blog::orderBy('created_at', 'desc')->get();
    $postEdicao = $id ? Blog::find($id) : null;
    return view('dashboard', compact('publicacoes', 'postEdicao'));
})->middleware(['auth', 'verified'])->name('dashboard');

// Salvar / Atualizar Publicação
Route::post('/blog/store', function (Request $request) {
    $request->validate([
        'titulo' => 'required|string|max:255',
        'conteudo' => 'required|string',
        'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
    ]);

    if ($request->filled('id')) {
        // Modo Edição
        $blog = Blog::findOrFail($request->id);
        $mensagem = 'Publicação atualizada com sucesso!';
    } else {
        // Modo Nova Publicação
        $blog = new Blog();
        $mensagem = 'Publicação criada com sucesso!';
    }

    $blog->titulo = $request->titulo;
    $blog->conteudo = $request->conteudo;

    // Upload da Imagem
    if ($request->hasFile('imagem')) {
        // Se já existia uma imagem antiga na edição, apaga ela
        if ($blog->imagem && File::exists(public_path($blog->imagem))) {
            File::delete(public_path($blog->imagem));
        }

        $imageName = time() . '.' . $request->imagem->extension();
        $request->imagem->move(public_path('uploads'), $imageName);
        $blog->imagem = 'uploads/' . $imageName;
    }

    $blog->save();

    return redirect()->route('dashboard')->with('success', $mensagem);
})->middleware(['auth'])->name('blog.store');

// Excluir Publicação
Route::delete('/blog/delete/{id}', function ($id) {
    $blog = Blog::findOrFail($id);
    
    if ($blog->imagem && File::exists(public_path($blog->imagem))) {
        File::delete(public_path($blog->imagem));
    }
    
    $blog->delete();
    return redirect()->route('dashboard')->with('success', 'Publicação excluída com sucesso!');
})->middleware(['auth'])->name('blog.delete');

// Perfil e Auth...
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
require __DIR__.'/auth.php';
