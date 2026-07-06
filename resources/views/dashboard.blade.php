<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Painel</title>
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <div class="dashboard-container">

        <!-- BARRA LATERAL (SIDEBAR) -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="160" height="auto"
                    alt="Logo" />
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item active">Dashboard</a>
                {{-- 
    <a href="#" class="menu-item">Usuários</a>
    <a href="#" class="menu-item">Configurações</a> 
    --}}
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->nome }}</p>
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
                <h1>Gerenciar Publicações</h1>
            </header>

            <section class="content-body">

                <!-- Notificação de Sucesso -->
                @if (session('success'))
                    <div class="alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="dashboard-grid">

                    <!-- FORMULÁRIO DE NOVA PUBLICAÇÃO -->
                    <!-- Bloco do Formulário Dinâmico (Criação / Edição) -->
                    <div class="welcome-card">
                        <h2>{{ $postEdicao ? 'Editar Publicação' : 'Nova Publicação' }}</h2>
                        <p class="form-subtitle">Use este espaço para gerenciar o conteúdo do blog do projeto.</p>

                        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($postEdicao)
                                <input type="hidden" name="id" value="{{ $postEdicao->id }}">
                            @endif

                            <div class="form-group">
                                <label for="titulo">Título da Publicação</label>
                                <input type="text" name="titulo" id="titulo"
                                    value="{{ $postEdicao ? $postEdicao->titulo : '' }}" required
                                    placeholder="Ex: A importância do diálogo aberto...">
                            </div>

                            <div class="form-group">
                                <label for="imagem">Imagem da Publicação</label>
                                <input type="file" name="imagem" id="imagem" accept="image/*">
                                @if ($postEdicao && $postEdicao->imagem)
                                    <div style="margin-top: 10px;">
                                        <small>Imagem atual:</small><br>
                                        <img src="{{ asset($postEdicao->imagem) }}" width="100"
                                            style="border-radius: 4px; margin-top: 5px;">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="conteudo">Conteúdo / Texto</label>
                                <textarea name="conteudo" id="conteudo" rows="6" required
                                    placeholder="Digite o conteúdo completo da sua publicação aqui...">{{ $postEdicao ? $postEdicao->conteudo : '' }}</textarea>
                            </div>

                            <button type="submit" class="btn-submit">
                                {{ $postEdicao ? 'Atualizar no Blog' : 'Publicar no Blog' }}
                            </button>

                            @if ($postEdicao)
                                <a href="{{ route('dashboard') }}"
                                    style="display: block; text-align: center; margin-top: 10px; color: #6b7280; font-size: 13px; text-decoration: none; font-weight: 600;">Cancelar
                                    Edição</a>
                            @endif
                        </form>
                    </div>

                    <!-- Bloco de Listagem Lateral com Botões Editar e Excluir -->
                    <div class="welcome-card">
                        <h2>Publicações Recentes</h2>
                        <p class="form-subtitle">Artigos atualmente salvos no seu banco de dados.</p>

                        <div class="posts-list">
                            @forelse($publicacoes as $post)
                                <div class="post-item">
                                    <div style="display: flex; gap: 15px; align-items: start;">
                                        @if ($post->imagem)
                                            <img src="{{ asset($post->imagem) }}" width="70" height="70"
                                                style="object-fit: cover; border-radius: 6px; border: 1px solid #e5e7eb;">
                                        @endif
                                        <div style="flex-grow: 1;">
                                            <span class="post-date">Criado em:
                                                {{ $post->created_at->format('d/m/Y H:i') }}</span>
                                            <h3>{{ $post->titulo }}</h3>
                                            <p>{{ Str::limit($post->conteudo, 80) }}</p>
                                        </div>
                                    </div>

                                    <!-- Botões de Ação -->
                                    <div class="post-actions"
                                        style="display: flex; gap: 10px; margin-top: 15px; justify-content: flex-end;">
                                        <a href="{{ route('dashboard', $post->id) }}"
                                            class="btn-action-edit">Editar</a>

                                        <form action="{{ route('blog.delete', $post->id) }}" method="POST"
                                            onsubmit="return confirm('Tem certeza que deseja excluir esta publicação?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">Excluir</button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <p>Nenhuma publicação encontrada no banco de dados.</p>
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
