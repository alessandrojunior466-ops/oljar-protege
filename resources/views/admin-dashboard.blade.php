<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Painel do Blog</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <div class="dashboard-container">

        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="160" height="auto" alt="Logo Olhar Que Protege" />
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item {{ request()->routeIs('dashboard*') ? 'active' : '' }}">Blog</a>
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
                <h1>Gerenciar Publicações</h1>
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
                        <h2>{{ isset($postEdicao) && $postEdicao ? 'Editar Publicação' : 'Nova Publicação' }}</h2>
                        <p class="form-subtitle">Use este espaço para gerenciar o conteúdo do blog do projeto.</p>

                        <form action="{{ isset($postEdicao) && $postEdicao ? route('blog.update', $postEdicao->id) : route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($postEdicao) && $postEdicao)
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="titulo">Título da Publicação</label>
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $postEdicao->titulo ?? '') }}" required placeholder="Ex: Importância da segurança digital...">
                            </div>

                            <div class="form-group">
                                <label for="imagem">Imagem(ns) do PC (pode selecionar mais de uma)</label>
                                <input type="file" name="imagem[]" id="imagem" accept="image/*" multiple>
                                @if (isset($postEdicao) && $postEdicao->imagem)
                                    <small style="color: #6b7280; display: block; margin-top: 6px;">Imagem(ns) atual(is):</small>
                                    <div style="margin-top: 4px; display: flex; gap: 8px; flex-wrap: wrap;">
                                        @foreach((is_array($postEdicao->midias) && count($postEdicao->midias) ? $postEdicao->midias : [$postEdicao->imagem]) as $midiaItem)
                                            @if(is_string($midiaItem) && !preg_match('/(?:youtube\.com|youtu\.be)/', $midiaItem) && !preg_match('/\.(mp4|mov|avi|mkv|webm)$/i', $midiaItem))
                                                <img src="{{ str_starts_with($midiaItem, 'http') ? $midiaItem : asset('storage/' . $midiaItem) }}" alt="Preview" style="max-height: 80px; border-radius: 6px; object-fit: cover;">
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="imagem_url">Link(s) da Imagem (URL externa, um por linha ou separados por vírgula)</label>
                                <textarea
                                    name="imagem_url"
                                    id="imagem_url"
                                    rows="2"
                                    placeholder="https://exemplo.com/imagem1.jpg&#10;https://exemplo.com/imagem2.jpg"
                                >{{ old('imagem_url', isset($postEdicao->imagem) && str_starts_with((string) $postEdicao->imagem, 'http') ? $postEdicao->imagem : '') }}</textarea>
                                <div id="blog-img-url-preview" style="margin-top: 10px; display: none;">
                                    <small style="color: #6b7280; display: block; margin-bottom: 6px;">Prévia do link da imagem:</small>
                                    <img id="blog-img-url-tag" src="" alt="Prévia da imagem" style="max-height: 140px; max-width: 100%; border-radius: 8px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="youtube_url">Link(s) de Vídeos ou Playlists do YouTube (um por linha ou separados por vírgula)</label>
                                <textarea
                                    name="youtube_url"
                                    id="youtube_url"
                                    rows="3"
                                    placeholder="https://www.youtube.com/watch?v=...&#10;https://www.youtube.com/playlist?list=..."
                                >{{ old('youtube_url', $postEdicao->youtube_url ?? '') }}</textarea>
                                <div id="blog-yt-preview" style="margin-top: 10px; display: grid; gap: 10px;"></div>
                            </div>

                            <div class="form-group">
                                <label for="conteudo">Conteúdo / Texto</label>
                                <textarea name="conteudo" id="conteudo" rows="6" required placeholder="Digite o conteúdo completo da publicação aqui...">{{ old('conteudo', $postEdicao->conteudo ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                {{ isset($postEdicao) && $postEdicao ? 'ATUALIZAR NO BLOG' : 'CADASTRAR PUBLICAÇÃO' }}
                            </button>

                            @if (isset($postEdicao) && $postEdicao)
                                <a href="{{ route('dashboard') }}" style="display: block; text-align: center; margin-top: 12px; color: #6b7280; font-size: 13px; text-decoration: none; font-weight: 600;">
                                    Cancelar Edição
                                </a>
                            @endif
                        </form>
                    </div>

                    <div class="welcome-card">
                        <h2>Publicações Recentes</h2>
                        <p class="form-subtitle">Artigos atualmente salvos no seu banco de dados.</p>

                        <div class="posts-list">
                            @forelse($publicacoes as $post)
                                @php
                                    $ytId = null;
                                    if (!empty($post->youtube_url) && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $post->youtube_url, $m)) {
                                        $ytId = $m[1];
                                    }

                                    $imgSrc = null;
                                    if (!empty($post->imagem)) {
                                        $imgSrc = str_starts_with($post->imagem, 'http')
                                            ? $post->imagem
                                            : asset('storage/' . $post->imagem);
                                    } elseif ($ytId) {
                                        $imgSrc = "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg";
                                    }
                                @endphp

                                <div class="post-item" style="display: flex; gap: 16px; align-items: flex-start;">

                                    @if($imgSrc)
                                        <div class="post-thumb-preview" style="width: 110px; height: 75px; min-width: 110px; background-color: #000; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <img src="{{ $imgSrc }}" alt="{{ $post->titulo }}" style="width: 100%; height: 100%; object-fit: cover;">
                                        </div>
                                    @endif

                                    <div class="post-item-content" style="flex: 1;">
                                        <span class="post-date">Criado em: {{ $post->created_at->format('d/m/Y H:i') }}</span>
                                        <h3 style="margin: 4px 0;">{{ $post->titulo }}</h3>
                                        <p style="margin-bottom: 8px;">{{ Str::limit($post->conteudo, 80) }}</p>

                                        <div class="post-actions">
                                            <a href="{{ route('dashboard.edit', $post->id) }}" class="btn-action-edit">Editar</a>
                                            <form action="{{ route('blog.delete', $post->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir esta publicação?');" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action-delete">Excluir</button>
                                            </form>
                                        </div>
                                    </div>

                                </div>
                            @empty
                                <div class="empty-state" style="text-align: center; color: #9ca3af; padding: 30px 0;">
                                    <p>Nenhuma publicação cadastrada no momento.</p>
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
            const imgUrlInput = document.getElementById('imagem_url');
            const imgBox = document.getElementById('blog-img-url-preview');
            const imgTag = document.getElementById('blog-img-url-tag');

            function atualizarImgPreview() {
                const raw = (imgUrlInput.value || '').split(/[\r\n,]+/).map(s => s.trim()).find(u => /^https?:\/\//i.test(u));
                if (raw) {
                    imgTag.src = raw;
                    imgBox.style.display = 'block';
                } else {
                    imgTag.src = '';
                    imgBox.style.display = 'none';
                }
            }

            imgUrlInput.addEventListener('input', atualizarImgPreview);
            imgTag.addEventListener('error', function () {
                imgBox.style.display = 'none';
            });
            atualizarImgPreview();

            const ytInput = document.getElementById('youtube_url');
            const ytBox = document.getElementById('blog-yt-preview');

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

            function atualizarYtPreview() {
                const urls = (ytInput.value || '').split(/[\r\n,]+/).map(s => s.trim()).filter(Boolean);
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

            ytInput.addEventListener('input', atualizarYtPreview);
            atualizarYtPreview();
        })();
    </script>
</body>

</html>