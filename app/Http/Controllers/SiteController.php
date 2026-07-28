<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Alterado para apontar para o Model correto (Blog)
use App\Models\Blog;

class SiteController extends Controller
{
<<<<<<< HEAD
    // Adicione ou corrija este método aqui dentro:
    public function index()
    {
        // Caso você use uma view específica para a home do seu site (ex: home.blade.php)
        return view('home'); 
=======
    public function index()
    {
        // ... seu código existente (ex: buscar posts) ...

        // Passa a variável como null por padrão para não dar erro no formulário de criação
        return view('home');
>>>>>>> 5080b4ab29b3706a542768000df6a4aa5adfb902
    }

    public function sobre()
    {
        return view('sobre');
    }

    public function videos()
    {
        return view('videos');
    }

    public function blog()
    {
<<<<<<< HEAD
        return view('blog');
=======
        // 1. Busca a publicação mais recente criada no dashboard para o topo (Destaque)
        $destaque = Blog::latest()->first();

        // 2. Busca TODAS as outras publicações menos a primeira (Destaque) para a grade abaixo
        // O skip(1) pula o primeiro registro que já está no destaque
        $restante = Blog::latest()->skip(1)->take(10)->get();

        // 3. Passa ambas as variáveis para a view 'blog'
        return view('blog', compact('destaque', 'restante'));
    }
    public function edit($id)
    {
        $postEdicao = Post::findOrFail($id);

        return view('dashboard', compact('postEdicao'));
>>>>>>> 5080b4ab29b3706a542768000df6a4aa5adfb902
    }
    public function login()
    {
        return view('auth.login');
    }
}
