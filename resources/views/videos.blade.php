<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Vídeos</title>
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
    <style>
        .video-player-container {
            width: 100%;
            height: 100%;
            min-height: 250px;
            background-color: #000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .video-player-container video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">

        <!-- CABEÇALHO FIXO -->
        <header>
            <div class="cabecalho">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" height="auto"
                    alt="Logo Olhar Que Protege" />
                <nav>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('sobre') }}">Sobre</a>
                    <a href="{{ route('videos') }}">Vídeos</a>
                    <a href="{{ route('blog') }}">Blog</a>
                    <a href="{{ route('login') }}">Login</a>
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
                            <video controls preload="metadata">
                                <source src="{{ asset('storage/' . $destaque->arquivo) }}#t=0.1" type="video/mp4">
                                Seu navegador não suporta a exibição deste vídeo.
                            </video>
                        </div>
                    </div>
                    <div class="conteudo-post">
                        <span class="post-date"
                            style="font-size: 12px; color: #6b7280; display: block; margin-bottom: 5px;">
                            Por {{ $destaque->autor?->name ?? $destaque->autor?->nome ?? 'Administrador' }} • {{ $destaque->created_at->format('d/m/Y') }}
                        </span>
                        <h2>{{ $destaque->titulo }}</h2>
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
                        <div style="width: 100%; height: 180px; background-color: #000;">
                            <video controls preload="metadata" style="width: 100%; height: 100%; object-fit: cover;">
                                <source src="{{ asset('storage/' . $video->arquivo) }}#t=0.1" type="video/mp4">
                                Seu navegador não suporta a exibição deste vídeo.
                            </video>
                        </div>
                        <div class="conteudo-post-pequeno">
                            <span class="post-date"
                                style="font-size: 11px; color: #9ca3af; display: block; margin-bottom: 5px;">
                                Por {{ $video->autor?->name ?? $video->autor?->nome ?? 'Administrador' }} • {{ $video->created_at->format('d/m/Y') }}
                            </span>

                            <h3>{{ $video->titulo }}</h3>
                            <p>{{ Str::limit($video->descricao, 120) }}</p>

                            <div class="tags-container">
                                <span class="tag-circular">VÍDEO</span>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (!$destaque)
                        <div class="empty-state"
                            style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #9ca3af;">
                            <p>Nenhum vídeo encontrado no momento. Volte mais tarde!</p>
                        </div>
                    @endif
                @endforelse
            </div>
        </main>

    </div>
</body>

</html>