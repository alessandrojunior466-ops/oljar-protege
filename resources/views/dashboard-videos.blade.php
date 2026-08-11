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
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="160" height="auto" alt="Logo" />
            </div>

            <nav class="sidebar-menu">
                <a href="{{ url('/dashboard/blog') }}" class="menu-item {{ request()->is('dashboard/blog*') ? 'active' : '' }}">Blog</a>
                <a href="{{ url('/dashboard/videos') }}" class="menu-item {{ request()->is('dashboard/videos*') ? 'active' : '' }}">Vídeos</a>
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

                <!-- Notificação de Sucesso -->
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Exibição de Erros de Validação -->
                @if ($errors->any())
                    <div class="alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 10px 15px; border-radius: 6px; margin-bottom: 20px;">
                        <ul style="margin: 0; padding-left: 20px;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="dashboard-grid">

                    <!-- FORMULÁRIO DE ENVIO DE VÍDEO -->
                    <div class="welcome-card">
                        <h2>Novo Vídeo</h2>
                        <p class="form-subtitle">Envie vídeos educativos e treinamentos para a plataforma.</p>

                        <form action="{{ route('video.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                                <label for="titulo">Título do Vídeo</label>
                                <input type="text" name="titulo" id="titulo" required placeholder="Ex: Treinamento de Segurança Digital">
                            </div>

                            <div class="form-group">
                                <label for="video">Arquivo de Vídeo (MP4, MOV, AVI)</label>
                                <input type="file" name="video" id="video" accept="video/*" required>
                            </div>

                            <button type="submit" class="btn-submit">
                                Enviar Vídeo
                            </button>
                        </form>
                    </div>

                    <!-- LISTAGEM DE VÍDEOS -->
                    <div class="welcome-card">
                        <h2>Vídeos Cadastrados</h2>
                        <p class="form-subtitle">Vídeos atualmente exibidos na área pública.</p>

                        <div class="posts-list">
                            @forelse($videos ?? [] as $video)
                                <div class="post-item" style="display: flex; justify-content: space-between; align-items: center;">
                                    <div>
                                        <h3>{{ $video->titulo }}</h3>
                                        <span class="post-date">Enviado em: {{ $video->created_at->format('d/m/Y H:i') }}</span>
                                    </div>

                                    <form action="{{ route('video.delete', $video->id) }}" method="POST" onsubmit="return confirm('Excluir este vídeo?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete">Excluir</button>
                                    </form>
                                </div>
                            @empty
                                <div class="empty-state">
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