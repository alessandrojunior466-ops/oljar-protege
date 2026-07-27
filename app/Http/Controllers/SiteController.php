<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    public function index()
    {
        return view('home');
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
        // 1. Busca a publicação mais recente para o topo (Destaque)
        $destaque = Blog::latest()->first();

        // 2. Busca as outras publicações para a grade abaixo (pula o destaque)
        $restante = Blog::latest()->skip(1)->take(10)->get();

        return view('blog', compact('destaque', 'restante'));
    }

    public function login()
    {
        return view('auth.login');
    }

    // --- MÉTODOS DO PAINEL / DASHBOARD ---

    public function dashboard($id = null)
    {
        // Busca todas as publicações cadastradas
        $publicacoes = Blog::latest()->get();

        // Se um ID foi passado na URL, busca para edição
        $postEdicao = $id ? Blog::find($id) : null;

        return view('dashboard', compact('publicacoes', 'postEdicao'));
    }

    public function salvarBlog(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        // Se houver ID no formulário, é uma Edição; caso contrário, é uma Criação
        if ($request->filled('id')) {
            $blog = Blog::findOrFail($request->id);
        } else {
            $blog = new Blog();
        }

        $blog->titulo   = $request->titulo;
        $blog->conteudo = $request->conteudo;

        // Upload de Imagem
        if ($request->hasFile('imagem')) {
            // Remove a imagem antiga se for edição
            if ($blog->imagem && file_exists(public_path($blog->imagem))) {
                @unlink(public_path($blog->imagem));
            }

            $image = $request->file('imagem');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/blog'), $imageName);
            $blog->imagem = 'uploads/blog/' . $imageName;
        }

        $blog->save();

        return redirect()->route('dashboard')->with('success', 'Publicação salva com sucesso!');
    }

    public function deletarBlog($id)
    {
        $blog = Blog::findOrFail($id);

        // Remove a imagem da pasta public/uploads/blog se existir
        if ($blog->imagem && file_exists(public_path($blog->imagem))) {
            @unlink(public_path($blog->imagem));
        }

        $blog->delete();

        return redirect()->route('dashboard')->with('success', 'Publicação excluída com sucesso!');
    }
}