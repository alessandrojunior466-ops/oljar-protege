<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogApiController extends Controller
{
    /**
     * Lista todos os posts ordenados por data
     */
    public function index()
    {
        $posts = Blog::latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $posts,
        ], 200);
    }

    /**
     * Cadastra um novo post
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $caminhoImagem = null;
        if ($request->hasFile('imagem')) {
            $caminhoImagem = $request->file('imagem')->store('posts', 'public');
        }

        $post = Blog::create([
            'titulo'   => $validated['titulo'],
            'conteudo' => $validated['conteudo'],
            'imagem'   => $caminhoImagem,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Publicação criada com sucesso!',
            'data'    => $post,
        ], 201);
    }

    /**
     * Exibe um post específico
     */
    public function show($id)
    {
        $post = Blog::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Publicação não encontrada.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $post,
        ], 200);
    }

    /**
     * Atualiza um post existente
     */
    public function update(Request $request, $id)
    {
        $post = Blog::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Publicação não encontrada.',
            ], 404);
        }

        $validated = $request->validate([
            'titulo'   => 'required|string|max:255',
            'conteudo' => 'required|string',
            'imagem'   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagem')) {
            if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }
            $post->imagem = $request->file('imagem')->store('posts', 'public');
        }

        $post->titulo = $validated['titulo'];
        $post->conteudo = $validated['conteudo'];
        $post->save();

        return response()->json([
            'success' => true,
            'message' => 'Publicação atualizada com sucesso!',
            'data'    => $post,
        ], 200);
    }

    /**
     * Remove um post
     */
    public function destroy($id)
    {
        $post = Blog::find($id);

        if (!$post) {
            return response()->json([
                'success' => false,
                'message' => 'Publicação não encontrada.',
            ], 404);
        }

        if ($post->imagem && Storage::disk('public')->exists($post->imagem)) {
            Storage::disk('public')->delete($post->imagem);
        }

        $post->delete();

        return response()->json([
            'success' => true,
            'message' => 'Publicação excluída com sucesso!',
        ], 200);
    }
}