<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    /**
     * 1. PÁGINA INICIAL (HOME)
     */
    public function index()
    {
        $posts = Blog::latest()->get();
        return view('home', compact('posts'));
    }

    /**
     * 2. PÁGINA SOBRE
     */
    public function sobre()
    {
        return view('sobre');
    }

    /**
     * 3. PÁGINA DE VÍDEOS
     */
    public function videos()
    {
        return view('videos');
    }

    /**
     * 4. PÁGINA DO BLOG
     */
    public function blog()
    {
        $posts = Blog::latest()->get();
        return view('blog', compact('posts'));
    }

    /**
     * 5. DASHBOARD (PAINEL)
     */
    public function dashboard()
    {
        $publicacoes = Blog::latest()->get();
        $postEdicao = null;

        return view('dashboard', compact('publicacoes', 'postEdicao'));
    }

    /**
     * 6. SALVAR NOVA PUBLICAÇÃO (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $caminhoImagem = null;

        if ($request->hasFile('imagem')) {
            $caminhoImagem = $request->file('imagem')->store('posts', 'public');
        }

        Blog::create([
            'titulo' => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem' => $caminhoImagem,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicação criada com sucesso!');
    }

    /**
     * 7. CARREGAR PUBLICAÇÃO PARA EDIÇÃO (EDIT)
     */
    public function edit($id)
    {
        $publicacoes = Blog::latest()->get();
        $postEdicao = Blog::findOrFail($id);

        return view('dashboard', compact('publicacoes', 'postEdicao'));
    }

    /**
     * 8. ATUALIZAR PUBLICAÇÃO (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Blog::findOrFail($id);

        if ($request->hasFile('imagem')) {
            if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }
            $post->imagem = $request->file('imagem')->store('posts', 'public');
        }

        $post->titulo = $request->titulo;
        $post->conteudo = $request->conteudo;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Publicação atualizada com sucesso!');
    }

    /**
     * 9. EXCLUIR PUBLICAÇÃO (DESTROY)
     */
    public function destroy($id)
    {
        $post = Blog::findOrFail($id);

        if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
            Storage::disk('public')->delete($post->imagem);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Publicação excluída com sucesso!');
    }
}