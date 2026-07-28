<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class SiteController extends Controller
{
    // ... mantêm os outros métodos (index, sobre, etc) ...

    // 1. SALVAR NOVA PUBLICAÇÃO
    public function store(Request $request)
    {
        $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:4096', // até 4MB
        ]);

        $caminhoImagem = null;

        // Se o usuário fez upload de imagem
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Salva na pasta 'storage/app/public/posts'
            $caminhoImagem = $request->file('imagem')->store('posts', 'public');
        }

        Blog::create([
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem'   => $caminhoImagem,
        ]);

        return redirect()->route('dashboard')->with('success', 'Publicação criada com sucesso!');
    }

    // 2. ATUALIZAR PUBLICAÇÃO EXISTENTE
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

        // Se enviou uma NOVA imagem ao editar
        if ($request->hasFile('imagem') && $request->file('imagem')->isValid()) {
            // Se já existia uma imagem antiga, remove do disco
            if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }

            // Salva a nova imagem
            $post->imagem = $request->file('imagem')->store('posts', 'public');
        }

        $post->save();

        return redirect()->route('dashboard')->with('success', 'Publicação atualizada com sucesso!');
    }
}