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

    private function extrairYoutubeId(?string $url): ?string
    {
        if (!$url) {
            return null;
        }
        if (preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    /**
     * 6. SALVAR NOVA PUBLICAÇÃO (STORE)
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'conteudo'    => 'required|string',
            'imagem'      => 'nullable',
            'imagem.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|url|max:2000',
            'youtube_url' => 'nullable|url|max:2000',
        ]);

        $midias = [];

        if ($request->hasFile('imagem')) {
            $arquivos = is_array($request->file('imagem')) ? $request->file('imagem') : [$request->file('imagem')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $midias[] = $arq->store('posts', 'public');
                }
            }
        }

        if ($request->filled('imagem_url')) {
            $midias[] = $request->imagem_url;
        }

        if ($request->filled('youtube_url')) {
            $midias[] = $request->youtube_url;
        }

        $imagemPrincipal = $midias[0] ?? null;

        $dados = [
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem'   => $imagemPrincipal,
            'user_id'  => Auth::id(),
        ];

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $dados['youtube_url'] = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        if (Schema::hasColumn('blogs', 'midias')) {
            $dados['midias'] = $midias;
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
            'imagem'      => 'nullable',
            'imagem.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|url|max:2000',
            'youtube_url' => 'nullable|url|max:2000',
        ]);

        $post = Blog::findOrFail($id);
        $midiasAtuais = is_array($post->midias) ? $post->midias : ($post->imagem ? [$post->imagem] : []);
        $novasMidias = [];

        if ($request->hasFile('imagem')) {
            $arquivos = is_array($request->file('imagem')) ? $request->file('imagem') : [$request->file('imagem')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $novasMidias[] = $arq->store('posts', 'public');
                }
            }
        }

        if ($request->filled('imagem_url')) {
            $novasMidias[] = $request->imagem_url;
        }

        if (!empty($novasMidias)) {
            $post->imagem = $novasMidias[0];
            $midiasAtuais = array_values(array_unique(array_merge($midiasAtuais, $novasMidias)));
        }

        if ($request->filled('youtube_url')) {
            $midiasAtuais[] = $request->youtube_url;
            $midiasAtuais = array_values(array_unique($midiasAtuais));
        }

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $post->youtube_url = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        if (Schema::hasColumn('blogs', 'midias')) {
            $post->midias = $midiasAtuais;
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

        if (is_array($post->midias)) {
            foreach ($post->midias as $m) {
                if (is_string($m) && !str_starts_with($m, 'http') && Storage::disk('public')->exists($m)) {
                    Storage::disk('public')->delete($m);
                }
            }
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
            'titulo'        => 'required|string|max:255',
            'descricao'     => 'required|string',
            'video'         => 'nullable|required_without:youtube_url',
            'video.*'       => 'file|mimes:mp4,mov,avi,mkv,webm|max:102400',
            'youtube_url'   => 'nullable|required_without:video|url|max:2000',
            'thumbnail_url' => 'nullable|url|max:2000',
        ]);

        $itensVideo = [];

        if ($request->hasFile('video')) {
            $arquivos = is_array($request->file('video')) ? $request->file('video') : [$request->file('video')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $itensVideo[] = $arq->store('videos', 'public');
                }
            }
        }

        if ($request->filled('youtube_url')) {
            $itensVideo[] = $request->youtube_url;
        }

        $arquivoPrincipal = $itensVideo[0] ?? null;
        $thumbFinal = $request->filled('thumbnail_url') ? $request->thumbnail_url : null;

        if (!$thumbFinal && $request->filled('youtube_url')) {
            $ytId = $this->extrairYoutubeId($request->youtube_url);
            if ($ytId) {
                $thumbFinal = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
            }
        }

        $dados = [
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
            'arquivo'   => $arquivoPrincipal,
            'user_id'   => Auth::id(),
        ];

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $dados['youtube_url'] = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        if (Schema::hasColumn('videos', 'thumbnail_url')) {
            $dados['thumbnail_url'] = $thumbFinal;
        }

        if (Schema::hasColumn('videos', 'midias')) {
            $dados['midias'] = $itensVideo;
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
            'titulo'        => 'required|string|max:255',
            'descricao'     => 'required|string',
            'video'         => 'nullable',
            'video.*'       => 'file|mimes:mp4,mov,avi,mkv,webm|max:102400',
            'youtube_url'   => 'nullable|url|max:2000',
            'thumbnail_url' => 'nullable|url|max:2000',
        ]);

        $video = Video::findOrFail($id);
        $midiasAtuais = is_array($video->midias) ? $video->midias : ($video->arquivo ? [$video->arquivo] : []);
        $novosItens = [];

        if ($request->hasFile('video')) {
            $arquivos = is_array($request->file('video')) ? $request->file('video') : [$request->file('video')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $novosItens[] = $arq->store('videos', 'public');
                }
            }
        }

        if ($request->filled('youtube_url')) {
            $novosItens[] = $request->youtube_url;
        }

        if (!empty($novosItens)) {
            $video->arquivo = $novosItens[0];
            $midiasAtuais = array_values(array_unique(array_merge($midiasAtuais, $novosItens)));
        }

        if ($request->filled('thumbnail_url')) {
            if (Schema::hasColumn('videos', 'thumbnail_url')) {
                $video->thumbnail_url = $request->thumbnail_url;
            }
        } elseif ($request->filled('youtube_url') && Schema::hasColumn('videos', 'thumbnail_url') && empty($video->thumbnail_url)) {
            $ytId = $this->extrairYoutubeId($request->youtube_url);
            if ($ytId) {
                $video->thumbnail_url = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
            }
        }

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $video->youtube_url = $request->filled('youtube_url') ? $request->youtube_url : null;
        }

        if (Schema::hasColumn('videos', 'midias')) {
            $video->midias = $midiasAtuais;
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

        if (is_array($video->midias)) {
            foreach ($video->midias as $m) {
                if (is_string($m) && !str_starts_with($m, 'http') && Storage::disk('public')->exists($m)) {
                    Storage::disk('public')->delete($m);
                }
            }
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