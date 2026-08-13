<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Vídeos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/videos.css') }}">
</head>

<body>
    <div class="container">

        <!-- CABEÇALHO FIXO -->
        <header>
            <div class="cabecalho">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" height="auto"
                    alt="Logo Olhar Que Protege" />
                <nav>
    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
    <a href="{{ route('sobre') }}" class="{{ request()->routeIs('sobre') ? 'active' : '' }}">Sobre</a>
    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">Vídeos</a>
    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'active' : '' }}">Login</a>
</nav>
            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="container-blog">

            <div class="espacoo"></div>

            <h1 class="titulo-blog">VÍDEOS</h1>

            @php
                $destaque = $videos->first();
            @endphp

            @if ($destaque)
                <!-- Vídeo em Destaque (Card Grande) -->
                <div class="card-post-grande">
                    <div class="imagem-post">
                        <div class="video-player-container">
                            @if (filter_var($destaque->arquivo ?? $destaque->url_video, FILTER_VALIDATE_URL))
                                <iframe src="{{ $destaque->url_video }}" frameborder="0" allowfullscreen class="video-iframe"></iframe>
                            @else
                                <video controls preload="metadata">
                                    <source src="{{ asset('storage/' . $destaque->arquivo) }}#t=0.1" type="video/mp4">
                                    Seu navegador não suporta a exibição deste vídeo.
                                </video>
                            @endif
                        </div>
                    </div>
                    <div class="conteudo-post">
                        <span class="post-meta-date">
                            Por {{ $destaque->autor?->name ?? $destaque->autor?->nome ?? 'Administrador' }} • {{ $destaque->created_at->format('d/m/Y') }}
                        </span>

                        <a href="{{ route('videos.show', $destaque->id) }}" style="text-decoration: none; color: inherit;">
                            <h2>{{ $destaque->titulo }}</h2>
                        </a>

                        <p>{{ Str::limit($destaque->descricao, 200) }}</p>
                        <div class="tags-container">
                            <span class="tag-circular">DESTAQUE</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Grade de Vídeos Menores -->
            <div class="grade-posts">
                @forelse($videos->skip(1) as $video)
                    <!-- Card de Vídeo Individual -->
                    <div class="card-post-pequeno">
                        <div class="video-thumb-small">
                            @if (filter_var($video->arquivo ?? $video->url_video, FILTER_VALIDATE_URL))
                                <iframe src="{{ $video->url_video }}" frameborder="0" allowfullscreen class="video-iframe"></iframe>
                            @else
                                <video controls preload="metadata">
                                    <source src="{{ asset('storage/' . $video->arquivo) }}#t=0.1" type="video/mp4">
                                    Seu navegador não suporta a exibição deste vídeo.
                                </video>
                            @endif
                        </div>
                        <div class="conteudo-post-pequeno">
                            <span class="post-meta-small">
                                Por {{ $video->autor?->name ?? $video->autor?->nome ?? 'Administrador' }} • {{ $video->created_at->format('d/m/Y') }}
                            </span>

                            <a href="{{ route('videos.show', $video->id) }}" style="text-decoration: none; color: inherit;">
                                <h3>{{ $video->titulo }}</h3>
                            </a>

                            <p>{{ Str::limit($video->descricao, 120) }}</p>

                            <div class="tags-container">
                                <span class="tag-circular">VÍDEO</span>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (!$destaque)
                        <div class="empty-state-grid">
                            <p>Nenhum vídeo encontrado no momento. Volte mais tarde!</p>
                        </div>
                    @endif
                @endforelse
            </div>
        </main>

    </div>
</body>

</html>