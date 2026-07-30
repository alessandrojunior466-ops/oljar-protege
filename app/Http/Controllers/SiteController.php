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
     * 3. PÁGINA VÍDEOS
     */
    public function videos()
    {
        return view('videos');
    }

    /**
     * 4. PÁGINA BLOG
     */
    public function blog()
    {
        $posts = Blog::latest()->get();
        $destaque = $posts->first(); 
        $restante = $posts->skip(1); 

        return view('blog', compact('destaque', 'restante', 'posts'));
    }

    /**
     * 5. PÁGINA DE LOGIN
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * 6. DASHBOARD (PAINEL ADMINISTRATIVO)
     */
    public function dashboard()
    {
        $posts = Blog::latest()->get();
        $publicacoes = $posts; // Passa $publicacoes para a linha 116 da view!
        $postEdicao = null; 

        return view('dashboard', compact('posts', 'publicacoes', 'postEdicao'));
    }

    /**
     * 7. SALVAR NOVA PUBLICAÇÃO (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        $caminhoImagem = null;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            $caminhoImagem = $request->file('imagem')->store('posts', 'public');
        }

        Blog::create([
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem'   => $caminhoImagem,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicação criada com sucesso!');
    }

    /**
     * 8. EDITAR PUBLICAÇÃO (EDIT)
     */
    public function edit($id)
    {
        $posts = Blog::latest()->get();
        $publicacoes = $posts;
        $postEdicao = Blog::findOrFail($id); 

        return view('dashboard', compact('posts', 'publicacoes', 'postEdicao'));
    }

    /**
     * 9. ATUALIZAR PUBLICAÇÃO EXISTENTE (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096',
        ]);

        $post = Blog::findOrFail($id);

        $post->titulo = $request->titulo;
        $post->conteudo = $request->conteudo;

        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }

            $post->imagem = $request->file('imagem')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Publicação atualizada com sucesso!');
    }

    /**
     * 10. EXCLUIR PUBLICAÇÃO (DESTROY)
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