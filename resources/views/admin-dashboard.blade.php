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

        <!-- BARRA LATERAL (SIDEBAR) -->
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

        <!-- CONTEÚDO PRINCIPAL -->
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

                    <!-- ABA DA ESQUERDA: FORMULÁRIO DE CADASTRO/EDIÇÃO DE POST -->
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
                                <label for="imagem">Imagem do PC (opcional se usar link de imagem ou YouTube)</label>
                                <input type="file" name="imagem" id="imagem" accept="image/*">
                                @if (isset($postEdicao) && $postEdicao->imagem)
                                    <small style="color: #6b7280; display: block; margin-top: 6px;">Imagem atual:</small>
                                    <div style="margin-top: 4px;">
                                        <img src="{{ str_starts_with($postEdicao->imagem, 'http') ? $postEdicao->imagem : asset('storage/' . $postEdicao->imagem) }}" alt="Preview" style="max-height: 80px; border-radius: 6px; object-fit: cover;">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="imagem_url">Link da Imagem (URL externa, opcional)</label>
                                <input
                                    type="url"
                                    name="imagem_url"
                                    id="imagem_url"
                                    value="{{ old('imagem_url', isset($postEdicao->imagem) && str_starts_with((string) $postEdicao->imagem, 'http') ? $postEdicao->imagem : '') }}"
                                    placeholder="https://exemplo.com/imagem.jpg"
                                >
                                <div id="blog-img-url-preview" style="margin-top: 10px; display: none;">
                                    <small style="color: #6b7280; display: block; margin-bottom: 6px;">Prévia do link da imagem:</small>
                                    <img id="blog-img-url-tag" src="" alt="Prévia da imagem" style="max-height: 140px; max-width: 100%; border-radius: 8px; object-fit: cover;">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="youtube_url">Link do YouTube (opcional)</label>
                                <input
                                    type="url"
                                    name="youtube_url"
                                    id="youtube_url"
                                    value="{{ old('youtube_url', $postEdicao->youtube_url ?? '') }}"
                                    placeholder="https://www.youtube.com/watch?v=..."
                                >
                                <div id="blog-yt-preview" style="margin-top: 10px; display: none;">
                                    <small style="color: #6b7280; display: block; margin-bottom: 6px;">Prévia automática do YouTube:</small>
                                    <iframe id="blog-yt-iframe" src="" style="width: 100%; aspect-ratio: 16 / 9; border: 0; border-radius: 8px;" allowfullscreen></iframe>
                                </div>
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

                    <!-- ABA DA DIREITA: LISTAGEM COM MINIATURA DOS POSTS RECENTES -->
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
                const url = (imgUrlInput.value || '').trim();
                if (url && /^https?:\/\//i.test(url)) {
                    imgTag.src = url;
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
            const ytIframe = document.getElementById('blog-yt-iframe');

            function extrairId(url) {
                const match = (url || '').match(/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/);
                return match ? match[1] : null;
            }

            function atualizarYtPreview() {
                const id = extrairId(ytInput.value);
                if (id) {
                    ytIframe.src = 'https://www.youtube-nocookie.com/embed/' + id;
                    ytBox.style.display = 'block';
                } else {
                    ytIframe.src = '';
                    ytBox.style.display = 'none';
                }
            }

            ytInput.addEventListener('input', atualizarYtPreview);
            atualizarYtPreview();
        })();
    </script>
</body>

</html>