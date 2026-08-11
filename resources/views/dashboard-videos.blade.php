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
                    <a href="{{ url('/user/profile') }}" class="btn-profile">Perfil</a>
                    <form method="POST" action="{{ url('/logout') }}">
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
                    <div class="alert-success" style="background-color: #d4edda; color: #155724; padding: 12px 15px; border-radius: 6px; margin-bottom: 20px;">
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

                    <!-- FORMULÁRIO DE ENVIO / EDIÇÃO DE VÍDEO -->
                    <div class="welcome-card">
                        <h2>{{ isset($videoEdicao) ? 'Editar Vídeo' : 'Novo Vídeo' }}</h2>
                        <p class="form-subtitle">
                            {{ isset($videoEdicao) ? 'Altere as informações do vídeo selecionado.' : 'Envie vídeos educativos e treinamentos para a plataforma.' }}
                        </p>

                        <form action="{{ isset($videoEdicao) ? url('/dashboard/videos/update/' . $videoEdicao->id) : url('/dashboard/videos') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @if(isset($videoEdicao))
                                @method('PUT')
                            @endif

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="titulo">Título do Vídeo</label>
                                <input type="text" name="titulo" id="titulo" required placeholder="Ex: Treinamento de Segurança Digital" value="{{ old('titulo', $videoEdicao->titulo ?? '') }}">
                            </div>

                            <div class="form-group" style="margin-bottom: 15px;">
                                <label for="descricao">Descrição do Vídeo</label>
                                <textarea name="descricao" id="descricao" rows="4" required placeholder="Digite uma breve descrição do vídeo...">{{ old('descricao', $videoEdicao->descricao ?? '') }}</textarea>
                            </div>

                            <div class="form-group" style="margin-bottom: 20px;">
                                <label for="video">Arquivo de Vídeo (MP4, MOV, AVI)</label>
                                <input type="file" name="video" id="video" accept="video/*" {{ isset($videoEdicao) ? '' : 'required' }}>
                                @if(isset($videoEdicao) && $videoEdicao->arquivo)
                                    <small style="color: #6b7280; display: block; margin-top: 5px;">Deixe este campo em branco se não quiser trocar o vídeo atual.</small>
                                @endif
                            </div>

                            <button type="submit" class="btn-submit">
                                {{ isset($videoEdicao) ? 'Atualizar Vídeo' : 'Enviar Vídeo' }}
                            </button>

                            @if(isset($videoEdicao))
                                <a href="{{ url('/dashboard/videos') }}" style="display: block; text-align: center; margin-top: 10px; color: #6b7280; text-decoration: none; font-size: 14px;">Cancelar Edição</a>
                            @endif
                        </form>
                    </div>

                    <!-- LISTAGEM DE VÍDEOS -->
                    <div class="welcome-card">
                        <h2>Vídeos Cadastrados</h2>
                        <p class="form-subtitle">Vídeos atualmente exibidos na área pública.</p>

                        <div class="posts-list">
                            @forelse($videos as $video)
                                <div class="post-item" style="display: flex; flex-direction: column; gap: 12px; padding: 15px; border-bottom: 1px solid #e5e7eb;">
                                    
                                    <!-- PLAYER DE PRÉ-VISUALIZAÇÃO DO VÍDEO -->
                                    <div style="width: 100%;">
                                        <video controls preload="metadata" style="width: 100%; max-height: 180px; border-radius: 8px; background-color: #000;">
                                            <source src="{{ asset('storage/' . $video->arquivo) }}" type="video/mp4">
                                            Seu navegador não suporta a exibição deste vídeo.
                                        </video>
                                    </div>

                                    <div>
                                        <h3 style="margin: 0; font-size: 16px; font-weight: 700;">{{ $video->titulo }}</h3>
                                        <p style="color: #4b5563; font-size: 14px; margin: 6px 0;">{{ $video->descricao }}</p>
                                        <span class="post-date" style="font-size: 12px; color: #9ca3af;">Enviado em: {{ $video->created_at->format('d/m/Y H:i') }}</span>
                                    </div>

                                    <!-- AÇÕES DE EDITAR E EXCLUIR -->
                                    <div style="display: flex; gap: 10px; align-items: center; margin-top: 5px;">
                                        <a href="{{ url('/dashboard/videos/edit/' . $video->id) }}" class="btn-action-edit" style="background-color: #3b82f6; color: #fff; padding: 6px 12px; border-radius: 4px; text-decoration: none; font-size: 13px;">Editar</a>
                                        
                                        <form action="{{ url('/dashboard/videos/' . $video->id) }}" method="POST" onsubmit="return confirm('Tem certeza que deseja excluir este vídeo?');" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">Excluir</button>
                                        </form>
                                    </div>

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