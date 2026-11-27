<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Video;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class SiteController extends Controller
{
    /**
     * 1. PÁGINA INICIAL (HOME)
     */
    public function index()
    {
        $posts = Blog::with('autor')->latest()->get();
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
     * 3. PÁGINA DE VÍDEOS (PÚBLICA)
     */
    public function videos()
    {
        $videos = Video::with('autor')->latest()->get();
        return view('videos', compact('videos'));
    }

    /**
     * 3.1 EXIBIR VÍDEO INDIVIDUAL (SHOW)
     */
    public function videosShow($id)
    {
        $video = Video::with('autor')->findOrFail($id);
        return view('videos-show', compact('video'));
    }

    /**
     * 4. PÁGINA DO BLOG
     */
    public function blog()
    {
        $posts = Blog::with('autor')->latest()->get();
        $destaque = $posts->first();
        $restante = $posts->skip(1);

        return view('blog', compact('destaque', 'restante', 'posts'));
    }

    /**
     * 4.1 EXIBIR NOTÍCIA INDIVIDUAL (SHOW)
     */
    public function blogShow($id)
    {
        $post = Blog::with('autor')->findOrFail($id);
        return view('blog-show', compact('post'));
    }

    /**
     * 5. DASHBOARD - GERENCIAR BLOG
     */
    public function dashboard()
    {
        $publicacoes = Blog::with('autor')->latest()->get();
        $postEdicao = null;

        return view('admin-dashboard', compact('publicacoes', 'postEdicao'));
    }

    /**
     * 5.1 DASHBOARD - GERENCIAR VÍDEOS
     */
    public function dashboardVideos()
    {
        $videos = Video::with('autor')->latest()->get();
        $videoEdicao = null;

        return view('admin-dashboard-videos', compact('videos', 'videoEdicao'));
    }

    /**
     * 6. SALVAR NOVA PUBLICAÇÃO (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'conteudo'    => 'required|string',
            'imagem'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|url|max:2000',
            'youtube_url' => 'nullable|url|max:2000',
        ]);

        $imagemFinal = null;

        if ($request->hasFile('imagem')) {
            $imagemFinal = $request->file('imagem')->store('posts', 'public');
        } elseif ($request->filled('imagem_url')) {
            $imagemFinal = $request->imagem_url;
        }

        $dados = [
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem'   => $imagemFinal,
            'user_id'  => Auth::id(),
        ];

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $dados['youtube_url'] = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        Blog::create($dados);

        return redirect()->route('dashboard')->with('success', 'Publicação criada com sucesso!');
    }

    /**
     * 7. CARREGAR PUBLICAÇÃO PARA EDIÇÃO (EDIT)
     */
    public function edit($id)
    {
        $publicacoes = Blog::with('autor')->latest()->get();
        $postEdicao = Blog::findOrFail($id);

        return view('admin-dashboard', compact('publicacoes', 'postEdicao'));
    }

    /**
     * 8. ATUALIZAR PUBLICAÇÃO (UPDATE)
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'conteudo'    => 'required|string',
            'imagem'      => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|url|max:2000',
            'youtube_url' => 'nullable|url|max:2000',
        ]);

        $post = Blog::findOrFail($id);

        if ($request->hasFile('imagem')) {
            if ($post->imagem && !str_starts_with($post->imagem, 'http') && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }
            $post->imagem = $request->file('imagem')->store('posts', 'public');
        } elseif ($request->filled('imagem_url')) {
            if ($post->imagem && !str_starts_with($post->imagem, 'http') && Storage::disk('public')->exists($post->imagem)) {
                Storage::disk('public')->delete($post->imagem);
            }
            $post->imagem = $request->imagem_url;
        }

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $post->youtube_url = $request->filled('youtube_url') ? $request->youtube_url : null;
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

        if ($post->imagem && !str_starts_with($post->imagem, 'http') && Storage::disk('public')->exists($post->imagem)) {
            Storage::disk('public')->delete($post->imagem);
        }

        $post->delete();

        return redirect()->route('dashboard')->with('success', 'Publicação excluída com sucesso!');
    }

    /**
     * 10. SALVAR NOVO VÍDEO (VIDEO STORE)
     */
    public function videoStore(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descricao'   => 'required|string',
            'video'       => 'nullable|required_without:youtube_url|file|mimes:mp4,mov,avi,mkv|max:102400',
            'youtube_url' => 'nullable|required_without:video|url|max:2000',
        ]);

        $caminhoVideo = null;

        if ($request->hasFile('video')) {
            $caminhoVideo = $request->file('video')->store('videos', 'public');
        } elseif ($request->filled('youtube_url')) {
            $caminhoVideo = $request->youtube_url;
        }

        $dados = [
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
            'arquivo'   => $caminhoVideo,
            'user_id'   => Auth::id(),
        ];

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $dados['youtube_url'] = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        Video::create($dados);

        return redirect()->route('dashboard.videos')->with('success', 'Vídeo enviado com sucesso!');
    }

    /**
     * 10.1 CARREGAR VÍDEO PARA EDIÇÃO
     */
    public function videoEdit($id)
    {
        $videos = Video::with('autor')->latest()->get();
        $videoEdicao = Video::findOrFail($id);

        return view('admin-dashboard-videos', compact('videos', 'videoEdicao'));
    }

    /**
     * 10.2 ATUALIZAR VÍDEO
     */
    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'descricao'   => 'required|string',
            'video'       => 'nullable|file|mimes:mp4,mov,avi,mkv|max:102400',
            'youtube_url' => 'nullable|url|max:2000',
        ]);

        $video = Video::findOrFail($id);

        if ($request->hasFile('video')) {
            if ($video->arquivo && !str_starts_with($video->arquivo, 'http') && Storage::disk('public')->exists($video->arquivo)) {
                Storage::disk('public')->delete($video->arquivo);
            }
            $video->arquivo = $request->file('video')->store('videos', 'public');
        } elseif ($request->filled('youtube_url')) {
            if ($video->arquivo && !str_starts_with($video->arquivo, 'http') && Storage::disk('public')->exists($video->arquivo)) {
                Storage::disk('public')->delete($video->arquivo);
            }
            $video->arquivo = $request->youtube_url;
        }

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $video->youtube_url = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        $video->titulo = $request->titulo;
        $video->descricao = $request->descricao;
        $video->save();

        return redirect()->route('dashboard.videos')->with('success', 'Vídeo atualizado com sucesso!');
    }

    /**
     * 11. EXCLUIR VÍDEO (VIDEO DESTROY)
     */
    public function videoDestroy($id)
    {
        $video = Video::findOrFail($id);

        if ($video->arquivo && !str_starts_with($video->arquivo, 'http') && Storage::disk('public')->exists($video->arquivo)) {
            Storage::disk('public')->delete($video->arquivo);
        }

        $video->delete();

        return redirect()->route('dashboard.videos')->with('success', 'Vídeo excluído com sucesso!');
    }

    /**
     * 12. API VÍDEOS
     */
    public function apiVideos()
    {
        $videos = Video::latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $videos
        ], 200);
    }
}