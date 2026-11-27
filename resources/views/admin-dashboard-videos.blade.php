<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Painel de Vídeos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="160" height="auto" alt="Logo Olhar Que Protege" />
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">Blog</a>
                <a href="{{ route('dashboard.videos') }}" class="menu-item {{ request()->routeIs('dashboard.videos*') ? 'active' : '' }}">Vídeos</a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->name ?? Auth::user()->nome }}</p>
                    <p class="user-email">{{ Auth::user()->email }}</p>
                </div>
                <div class="footer-actions">
                    <a href="{{ route('profile.edit') }}" class="btn-profile">Perfil</a>
                    <form method="POST" action="{{ route('extras.logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Sair</button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="content-header">
                <h1>Gerenciar Vídeos</h1>
            </header>

            <section class="content-body">

                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert-danger" style="background-color: #fee2e2; color: #dc2626; padding: 12px 16px; border-radius: 8px; margin-bottom: 20px; font-size: 14px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="dashboard-grid">

                    <div class="welcome-card">
                        <h2>{{ isset($videoEdicao) && $videoEdicao ? 'Editar Vídeo' : 'Novo Vídeo' }}</h2>
                        <p class="form-subtitle">Use este espaço para gerenciar os vídeos e playlists da plataforma.</p>

                        <form action="{{ isset($videoEdicao) && $videoEdicao ? route('videos.update', $videoEdicao->id) : route('videos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($videoEdicao) && $videoEdicao)
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="titulo">Título do Vídeo / Playlist</label>
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $videoEdicao->titulo ?? '') }}" required placeholder="Ex: Como identificar sinais de risco...">
                            </div>

                            <div class="form-group">
                                <label for="thumbnail_url">URL(s) da Thumbnail / Imagem (separadas por vírgula, linha ou espaço, opcional)</label>
                                <textarea
                                    name="thumbnail_url"
                                    id="thumbnail_url"
                                    rows="3"
                                    placeholder="https://exemplo.com/thumb1.jpg, https://exemplo.com/thumb2.png&#10;https://exemplo.com/thumb3.webp"
                                >{{ old('thumbnail_url', $videoEdicao->thumbnail_url ?? '') }}</textarea>
                                <div id="vid-thumb-preview" style="margin-top: 10px; display: flex; gap: 8px; flex-wrap: wrap;"></div>
                            </div>

                            <div class="form-group">
                                <label for="video">Arquivo(s) do Vídeo do PC (pode selecionar mais de um)</label>
                                <input type="file" name="video[]" id="video" accept="video/mp4,video/quicktime,video/avi,video/mkv,video/webm" multiple>
                                @if (isset($videoEdicao) && $videoEdicao->arquivo)
                                    <small style="color: #6b7280; display: block; margin-top: 4px;">Arquivo principal atual: {{ basename($videoEdicao->arquivo) }}</small>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="youtube_url">Link(s) de Vídeos ou Playlists do YouTube (um por linha ou separados por vírgula)</label>
                                <textarea
                                    name="youtube_url"
                                    id="youtube_url"
                                    rows="3"
                                    placeholder="https://www.youtube.com/watch?v=...&#10;https://www.youtube.com/playlist?list=..."
                                >{{ old('youtube_url', $videoEdicao->youtube_url ?? (isset($videoEdicao->arquivo) && str_starts_with((string) $videoEdicao->arquivo, 'http') ? $videoEdicao->arquivo : '')) }}</textarea>
                                <div id="video-yt-preview" style="margin-top: 10px; display: grid; gap: 10px;"></div>
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição do Vídeo</label>
                                <textarea name="descricao" id="descricao" rows="5" required placeholder="Digite a descrição completa sobre o conteúdo do vídeo aqui...">{{ old('descricao', $videoEdicao->descricao ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                {{ isset($videoEdicao) && $videoEdicao ? 'ATUALIZAR VÍDEO' : 'CADASTRAR VÍDEO' }}
                            </button>

                            @if (isset($videoEdicao) && $videoEdicao)
                                <a href="{{ route('dashboard.videos') }}" style="display: block; text-align: center; margin-top: 12px; color: #6b7280; font-size: 13px; text-decoration: none; font-weight: 600;">
                                    Cancelar Edição
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="welcome-card">
                        <h2>Vídeos Recentes</h2>
                        <p class="form-subtitle">Vídeos atualmente salvos no seu banco de dados.</p>

                        <div class="posts-list">
                            @forelse($videos as $video)
                                @php
                                    $fonteYt = $video->youtube_url ?? (str_contains((string) $video->arquivo, 'http') ? $video->arquivo : null);
                                    $ytId = null;
                                    if (!empty($fonteYt) && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $fonteYt, $m)) {
                                        $ytId = $m[1];
                                    }

                                    $primeiraThumb = null;
                                    if (!empty($video->thumbnail_url) && preg_match('/https?:\/\/[^\s,]+/i', (string) $video->thumbnail_url, $mThumb)) {
                                        $primeiraThumb = trim($mThumb[0], " \t\n\r\0\x0B\"'(),;");
                                    }

                                    $thumbSrc = $primeiraThumb ?? ($ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : null);
                                @endphp

                                <div class="post-item" style="display: flex; gap: 16px; align-items: flex-start;">

                                    @if($thumbSrc)
                                        <div class="video-thumb-preview" style="width: 110px; height: 75px; min-width: 110px; background-color: #000; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <img src="{{ $thumbSrc }}" alt="{{ $video->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @elseif($video->arquivo)
                                        <div class="video-thumb-preview" style="width: 110px; height: 75px; min-width: 110px; background-color: #000; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <video style="width: 100%; height: 100%; object-fit: cover;" preload="metadata">
                                                <source src="{{ asset('storage/' . $video->arquivo) }}#t=0.1" type="video/mp4">
                                            </video>
                                        </div>
                                    @endif

                                    <div class="post-item-content" style="flex: 1;">
                                        <span class="post-date">Cadastrado em: {{ $video->created_at->format('d/m/Y H:i') }}</span>
                                        <h3 style="margin: 4px 0;">{{ $video->titulo }}</h3>
                                        <p style="margin-bottom: 8px;">{{ Str::limit($video->descricao, 80) }}</p>

                                        <div class="post-actions">
                                            <a href="{{ route('dashboard.videos.edit', $video->id) }}" class="btn-action-edit">Editar</a>
                                            <form action="{{ route('videos.delete', $video->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este vídeo?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-delete">Excluir</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @empty
                                <div class="empty-state" style="text-align: center; color: #9ca3af; padding: 30px 0;">
                                    <p>Nenhum vídeo cadastrado no momento.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </section>
        </main>

    </div>

    <script>
        (function () {
            function extrairUrls(texto) {
                const matches = (texto || '').match(/https?:\/\/[^\s,]+/gi) || [];
                return [...new Set(matches.map(u => u.replace(/[),;]+$/, '')))];
            }

            const thumbInput = document.getElementById('thumbnail_url');
            const thumbBox = document.getElementById('vid-thumb-preview');

            function atualizarThumb() {
                const urls = extrairUrls(thumbInput.value);
                thumbBox.innerHTML = '';
                urls.forEach((url) => {
                    const img = document.createElement('img');
                    img.src = url;
                    img.alt = 'Prévia da thumbnail';
                    img.style.maxHeight = '110px';
                    img.style.maxWidth = '180px';
                    img.style.borderRadius = '8px';
                    img.style.objectFit = 'cover';
                    img.addEventListener('error', () => img.remove());
                    thumbBox.appendChild(img);
                });
            }
            thumbInput.addEventListener('input', atualizarThumb);
            atualizarThumb();

            const ytInput = document.getElementById('youtube_url');
            const ytBox = document.getElementById('video-yt-preview');

            function montarEmbedUrl(url) {
                const vidMatch = (url || '').match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/);
                const listMatch = (url || '').match(/[?&]list=([A-Za-z0-9_-]+)/);
                const vidId = vidMatch ? vidMatch[1] : null;
                const listId = listMatch ? listMatch[1] : null;

                if (listId && vidId) return 'https://www.youtube-nocookie.com/embed/' + vidId + '?list=' + encodeURIComponent(listId);
                if (listId) return 'https://www.youtube-nocookie.com/embed/videoseries?list=' + encodeURIComponent(listId);
                if (vidId) return 'https://www.youtube-nocookie.com/embed/' + vidId;
                return null;
            }

            function atualizarPreview() {
                const urls = extrairUrls(ytInput.value);
                const embeds = [...new Set(urls.map(montarEmbedUrl).filter(Boolean))];

                ytBox.innerHTML = '';
                embeds.forEach((src) => {
                    const iframe = document.createElement('iframe');
                    iframe.src = src;
                    iframe.style.width = '100%';
                    iframe.style.aspectRatio = '16 / 9';
                    iframe.style.border = '0';
                    iframe.style.borderRadius = '8px';
                    iframe.allowFullscreen = true;
                    ytBox.appendChild(iframe);
                });
            }

            ytInput.addEventListener('input', atualizarPreview);
            atualizarPreview();
        })();
    </script>
</body>

</html>