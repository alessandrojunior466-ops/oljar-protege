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

        <!-- BARRA LATERAL (SIDEBAR) -->
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
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Sair</button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- CONTEÚDO PRINCIPAL -->
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

                    <!-- ABA DA ESQUERDA: FORMULÁRIO DE CADASTRO/EDIÇÃO DE VÍDEO -->
                    <div class="welcome-card">
                        <h2>{{ isset($videoEdicao) && $videoEdicao ? 'Editar Vídeo' : 'Novo Vídeo' }}</h2>
                        <p class="form-subtitle">Use este espaço para gerenciar os vídeos da plataforma.</p>

                        <form action="{{ isset($videoEdicao) && $videoEdicao ? route('videos.update', $videoEdicao->id) : route('videos.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if (isset($videoEdicao) && $videoEdicao)
                                @method('PUT')
                            @endif

                            <div class="form-group">
                                <label for="titulo">Título do Vídeo</label>
                                <input type="text" name="titulo" id="titulo" value="{{ old('titulo', $videoEdicao->titulo ?? '') }}" required placeholder="Ex: Como identificar sinais de risco...">
                            </div>

                            <div class="form-group">
                                <label for="video">Arquivo do Vídeo</label>
                                <input type="file" name="video" id="video" accept="video/mp4,video/quicktime,video/avi,video/mkv" {{ isset($videoEdicao) ? '' : 'required' }}>
                                @if (isset($videoEdicao) && $videoEdicao->arquivo)
                                    <small style="color: #6b7280; display: block; margin-top: 4px;">Vídeo atual salvo: {{ basename($videoEdicao->arquivo) }}</small>
                                @endif
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

                    <!-- ABA DA DIREITA: LISTAGEM COM MINIATURA DOS VÍDEOS RECENTES -->
                    <div class="welcome-card">
                        <h2>Vídeos Recentes</h2>
                        <p class="form-subtitle">Vídeos atualmente salvos no seu banco de dados.</p>

                        <div class="posts-list">
                            @forelse($videos as $video)
                                <div class="post-item" style="display: flex; gap: 16px; align-items: flex-start;">
                                    
                                    <!-- MINIATURA DO VÍDEO -->
                                    @if($video->arquivo)
                                        <div class="video-thumb-preview" style="width: 110px; height: 75px; min-width: 110px; background-color: #000; border-radius: 8px; overflow: hidden; display: flex; align-items: center; justify-content: center; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                            <video style="width: 100%; height: 100%; object-fit: cover;" preload="metadata">
                                                <source src="{{ asset('storage/' . $video->arquivo) }}#t=0.1" type="video/mp4">
                                            </video>
                                        </div>
                                    @endif

                                    <!-- INFORMAÇÕES DO VÍDEO E BOTOES -->
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
</body>

</html>