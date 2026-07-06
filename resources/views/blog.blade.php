<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Blog</title>
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
</head>

<body>
    <div class="container">

        <!-- CABEÇALHO FIXO ORIGINAL -->
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
        <!-- CONTEÚDO PRINCIPAL -->
        <main class="container-blog">

            <!-- Empurra o conteúdo para baixo do menu fixo -->
            <div class="espacoo"></div>

            <h1 class="titulo-blog">BLOG</h1>

            @if ($destaque)
                <!-- Post em Destaque Dinâmico (Sempre a primeira publicação do banco) -->
                <div class="card-post-grande">
                    <div class="imagem-post">
                        <!-- Imagem do banco ou padrão se estiver vazia -->
                        <img src="{{ $destaque->imagem ? asset($destaque->imagem) : 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=600&auto=format&fit=crop' }}"
                            alt="{{ $destaque->titulo }}">
                    </div>
                    <div class="conteudo-post">
                        <span class="post-date"
                            style="font-size: 12px; color: #6b7280; display: block; margin-bottom: 5px;">
                            {{ $destaque->created_at->format('d/m/Y') }}
                        </span>
                        <h2>{{ $destaque->titulo }}</h2>
                        <p>{{ $destaque->conteudo }}</p>
                        <div class="tags-container">
                            <span class="tag-circular">DESTAQUE</span>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Grade de Posts Menores -->
            <div class="grade-posts">
                @forelse($restante as $post)
                    <!-- Card de Post Individual -->
                    <div class="card-post-pequeno">
                        @if ($post->imagem)
                            <img src="{{ asset($post->imagem) }}" alt="{{ $post->titulo }}"
                                style="width: 100%; height: 180px; object-fit: cover;">
                        @endif
                        <div class="conteudo-post-pequeno">
                            <span class="post-date"
                                style="font-size: 11px; color: #9ca3af; display: block; margin-bottom: 5px;">
                                {{ $post->created_at->format('d/m/Y') }}
                            </span>

                            <h3>{{ $post->titulo }}</h3>
                            <p>{{ $post->conteudo }}</p>

                            <div class="tags-container">
                                <span class="tag-circular">LEITURA</span>
                            </div>
                        </div>
                    </div>
                @empty
                    @if (!$destaque)
                        <!-- Exibe apenas se o banco estiver 100% vazio (sem destaque e sem listagem) -->
                        <div class="empty-state"
                            style="grid-column: 1 / -1; text-align: center; padding: 40px; color: #9ca3af;">
                            <p>Nenhuma publicação encontrada no momento. Volte mais tarde!</p>
                        </div>
                    @endif
                @endforelse
            </div>
        </main>

    </div>
</body>

</html>
