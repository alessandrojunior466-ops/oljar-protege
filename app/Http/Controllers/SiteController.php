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
    public function index()
    {
        $posts = Blog::with('autor')->latest()->get();
        return view('home', compact('posts'));
    }

    public function sobre()
    {
        return view('sobre');
    }

    public function videos()
    {
        $videos = Video::with('autor')->latest()->get();
        return view('videos', compact('videos'));
    }

    public function videosShow($id)
    {
        $video = Video::with('autor')->findOrFail($id);
        return view('videos-show', compact('video'));
    }

    public function blog()
    {
        $posts = Blog::with('autor')->latest()->get();
        $destaque = $posts->first();
        $restante = $posts->skip(1);

        return view('blog', compact('destaque', 'restante', 'posts'));
    }

    public function blogShow($id)
    {
        $post = Blog::with('autor')->findOrFail($id);
        return view('blog-show', compact('post'));
    }

    public function dashboard()
    {
        $publicacoes = Blog::with('autor')->latest()->get();
        $postEdicao = null;

        return view('admin-dashboard', compact('publicacoes', 'postEdicao'));
    }

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

    private function extrairPlaylistId(?string $url): ?string
    {
        if (!$url) {
            return null;
        }
        if (preg_match('/[?&]list=([A-Za-z0-9_-]+)/', $url, $m)) {
            return $m[1];
        }
        return null;
    }

    private function parseUrls(?string $texto): array
    {
        if (!$texto) {
            return [];
        }

        // Extrai todas as URLs http/https mesmo separadas por vírgula, espaço, quebra de linha ou coladas
        preg_match_all('/https?:\/\/[^\s,]+/i', $texto, $matches);
        $candidatas = $matches[0] ?? [];

        if (empty($candidatas)) {
            $partes = preg_split('/[\r\n,]+/', $texto);
            $candidatas = is_array($partes) ? $partes : [];
        }

        $urls = [];
        foreach ($candidatas as $parte) {
            $limpo = trim($parte, " \t\n\r\0\x0B\"'(),;");
            if ($limpo !== '' && filter_var($limpo, FILTER_VALIDATE_URL)) {
                $urls[] = $limpo;
            }
        }

        return array_values(array_unique($urls));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'conteudo'    => 'required|string',
            'imagem'      => 'nullable',
            'imagem.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|string|max:4000',
            'youtube_url' => 'nullable|string|max:4000',
        ]);

        $urlsImagem = $this->parseUrls($request->input('imagem_url'));
        $urlsVideo  = $this->parseUrls($request->input('youtube_url'));

        $midias = [];
        if ($request->hasFile('imagem')) {
            $arquivos = is_array($request->file('imagem')) ? $request->file('imagem') : [$request->file('imagem')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $midias[] = $arq->store('posts', 'public');
                }
            }
        }

        foreach ($urlsImagem as $uImg) {
            $midias[] = $uImg;
        }
        foreach ($urlsVideo as $uVid) {
            $midias[] = $uVid;
        }
        $midias = array_values(array_unique($midias));

        $imagemPrincipal = $midias[0] ?? null;

        $dados = [
            'titulo'   => $request->titulo,
            'conteudo' => $request->conteudo,
            'imagem'   => $imagemPrincipal,
            'user_id'  => Auth::id(),
        ];

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $dados['youtube_url'] = !empty($urlsVideo) ? implode("\n", $urlsVideo) : null;
        }

        if (Schema::hasColumn('blogs', 'midias')) {
            $dados['midias'] = $midias;
        }

        Blog::create($dados);

        return redirect()->route('dashboard')->with('success', 'Publicação criada com sucesso!');
    }

    public function edit($id)
    {
        $publicacoes = Blog::with('autor')->latest()->get();
        $postEdicao = Blog::findOrFail($id);

        return view('admin-dashboard', compact('publicacoes', 'postEdicao'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'titulo'      => 'required|string|max:255',
            'conteudo'    => 'required|string',
            'imagem'      => 'nullable',
            'imagem.*'    => 'image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'imagem_url'  => 'nullable|string|max:4000',
            'youtube_url' => 'nullable|string|max:4000',
        ]);

        $post = Blog::findOrFail($id);
        $urlsImagem = $this->parseUrls($request->input('imagem_url'));
        $urlsVideo  = $this->parseUrls($request->input('youtube_url'));

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

        foreach ($urlsImagem as $uImg) {
            $novasMidias[] = $uImg;
        }

        if (!empty($novasMidias)) {
            $post->imagem = $novasMidias[0];
            $midiasAtuais = array_values(array_unique(array_merge($midiasAtuais, $novasMidias)));
        }

        if (!empty($urlsVideo)) {
            $midiasAtuais = array_values(array_unique(array_merge($midiasAtuais, $urlsVideo)));
        }

        if (Schema::hasColumn('blogs', 'youtube_url')) {
            $post->youtube_url = !empty($urlsVideo) ? implode("\n", $urlsVideo) : null;
        }

        if (Schema::hasColumn('blogs', 'midias')) {
            $post->midias = $midiasAtuais;
        }

        $post->titulo = $request->titulo;
        $post->conteudo = $request->conteudo;
        $post->save();

        return redirect()->route('dashboard')->with('success', 'Publicação atualizada com sucesso!');
    }

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

    public function videoStore(Request $request)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'descricao'     => 'required|string',
            'video'         => 'nullable|required_without:youtube_url',
            'video.*'       => 'file|mimes:mp4,mov,avi,mkv,webm|max:102400',
            'youtube_url'   => 'nullable|required_without:video|string|max:4000',
            'thumbnail_url' => 'nullable|string|max:4000',
        ]);

        $urlsVideo  = $this->parseUrls($request->input('youtube_url'));
        $urlsThumbs = $this->parseUrls($request->input('thumbnail_url'));

        $itensVideo = [];
        if ($request->hasFile('video')) {
            $arquivos = is_array($request->file('video')) ? $request->file('video') : [$request->file('video')];
            foreach ($arquivos as $arq) {
                if ($arq && $arq->isValid()) {
                    $itensVideo[] = $arq->store('videos', 'public');
                }
            }
        }

        foreach ($urlsVideo as $uVid) {
            $itensVideo[] = $uVid;
        }

        $arquivoPrincipal = $itensVideo[0] ?? null;
        $thumbFinal = !empty($urlsThumbs) ? implode("\n", $urlsThumbs) : null;

        if (!$thumbFinal && !empty($urlsVideo)) {
            foreach ($urlsVideo as $uVid) {
                $ytId = $this->extrairYoutubeId($uVid);
                if ($ytId) {
                    $thumbFinal = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                    break;
                }
            }
        }

        $dados = [
            'titulo'    => $request->titulo,
            'descricao' => $request->descricao,
            'arquivo'   => $arquivoPrincipal,
            'user_id'   => Auth::id(),
        ];

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $dados['youtube_url'] = !empty($urlsVideo) ? implode("\n", $urlsVideo) : null;
        }

        if (Schema::hasColumn('videos', 'thumbnail_url')) {
            $dados['thumbnail_url'] = $thumbFinal;
        }

        if (Schema::hasColumn('videos', 'midias')) {
            $dados['midias'] = $itensVideo;
        }

        Video::create($dados);

        return redirect()->route('dashboard.videos')->with('success', 'Vídeo(s) / playlist enviado(s) com sucesso!');
    }

    public function videoEdit($id)
    {
        $videos = Video::with('autor')->latest()->get();
        $videoEdicao = Video::findOrFail($id);

        return view('admin-dashboard-videos', compact('videos', 'videoEdicao'));
    }

    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'descricao'     => 'required|string',
            'video'         => 'nullable',
            'video.*'       => 'file|mimes:mp4,mov,avi,mkv,webm|max:102400',
            'youtube_url'   => 'nullable|string|max:4000',
            'thumbnail_url' => 'nullable|string|max:4000',
        ]);

        $video = Video::findOrFail($id);
        $urlsVideo  = $this->parseUrls($request->input('youtube_url'));
        $urlsThumbs = $this->parseUrls($request->input('thumbnail_url'));

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

        foreach ($urlsVideo as $uVid) {
            $novosItens[] = $uVid;
        }

        if (!empty($novosItens)) {
            $video->arquivo = $novosItens[0];
            $midiasAtuais = array_values(array_unique(array_merge($midiasAtuais, $novosItens)));
        }

        if (!empty($urlsThumbs)) {
            if (Schema::hasColumn('videos', 'thumbnail_url')) {
                $video->thumbnail_url = implode("\n", $urlsThumbs);
            }
        } elseif (!empty($urlsVideo) && Schema::hasColumn('videos', 'thumbnail_url') && empty($video->thumbnail_url)) {
            foreach ($urlsVideo as $uVid) {
                $ytId = $this->extrairYoutubeId($uVid);
                if ($ytId) {
                    $video->thumbnail_url = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                    break;
                }
            }
        }

        if (Schema::hasColumn('videos', 'youtube_url')) {
            $video->youtube_url = !empty($urlsVideo) ? implode("\n", $urlsVideo) : null;
        }

        if (Schema::hasColumn('videos', 'midias')) {
            $video->midias = $midiasAtuais;
        }

        $video->titulo = $request->titulo;
        $video->descricao = $request->descricao;
        $video->save();

        return redirect()->route('dashboard.videos')->with('success', 'Vídeo(s) / playlist atualizado(s) com sucesso!');
    }

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

    public function apiVideos()
    {
        $videos = Video::latest()->get();

        return response()->json([
            'success' => true,
            'data'    => $videos
        ], 200);
    }
}