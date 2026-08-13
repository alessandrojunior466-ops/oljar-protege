<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->titulo }} - Olhar Que Protege</title>
    <link rel="stylesheet" href="{{ asset('assets/css/blog-show.css') }}">
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

        <!-- CONTEÚDO PRINCIPAL DO VÍDEO -->
        <main class="container-blog">
            <div class="espacoo"></div>

            <a href="{{ route('videos.index') }}" class="btn-voltar">&larr; Voltar para o Vídeos</a>

            <article class="detalhe-post">
                <span class="post-date" style="font-size: 13px; color: #6b7280; display: block; margin-bottom: 10px;">
                    POR {{ mb_strtoupper($video->autor?->name ?? $video->autor?->nome ?? 'Administrador') }} • PUBLICADO EM {{ $video->created_at->format('d/m/Y') }}
                </span>

                <h1 style="font-size: 2.2rem; color: #1e1b4b; margin-bottom: 15px;">{{ $video->titulo }}</h1>

                <!-- PLAYER DE VÍDEO NO LUGAR DA IMAGEM -->
                <div style="margin: 20px 0; background-color: #000; border-radius: 12px; overflow: hidden;">
                    @if (filter_var($video->arquivo ?? $video->url_video, FILTER_VALIDATE_URL))
                        <iframe src="{{ $video->url_video }}" frameborder="0" allowfullscreen style="width: 100%; height: 450px; display: block;"></iframe>
                    @else
                        <video controls style="width: 100%; max-height: 500px; display: block;" preload="metadata">
                            <source src="{{ asset('storage/' . $video->arquivo) }}" type="video/mp4">
                            Seu navegador não suporta a exibição de vídeos.
                        </video>
                    @endif
                </div>

                <!-- DESCRIÇÃO DO VÍDEO -->
                <div class="conteudo-texto">
                    {!! nl2br(e($video->descricao)) !!}
                </div>
            </article>
        </main>

    </div>
</body>

</html>