<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $post->titulo }} - Olhar Que Protege</title>
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
                    <a href="{{ route('home') }}">Home</a>
                    <a href="{{ route('sobre') }}">Sobre</a>
                    <a href="{{ route('videos.index') }}">Vídeos</a>
                    <a href="{{ route('blog') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a>
                    <a href="{{ route('login') }}">Login</a>
                </nav>
            </div>
        </header>

        <!-- CONTEÚDO DA NOTÍCIA -->
        <main class="container-blog">
            <div class="espacoo"></div>

            <a href="{{ route('blog') }}" class="btn-voltar">&larr; Voltar para o Blog</a>

            <article class="detalhe-post">
                <span class="post-date" style="font-size: 13px; color: #6b7280; display: block; margin-bottom: 10px;">
                    Por {{ $post->autor?->name ?? $post->autor?->nome ?? 'Administrador' }} • Publicado em {{ $post->created_at->format('d/m/Y') }}
                </span>

                <h1 style="font-size: 2.2rem; color: #1e1b4b; margin-bottom: 15px;">{{ $post->titulo }}</h1>

                @if ($post->imagem)
                    <img src="{{ asset('storage/' . $post->imagem) }}" alt="{{ $post->titulo }}" class="imagem-detalhe">
                @endif

                <div class="conteudo-texto">
                    {!! nl2br(e($post->conteudo)) !!}
                </div>
            </article>
        </main>

    </div>
</body>

</html>