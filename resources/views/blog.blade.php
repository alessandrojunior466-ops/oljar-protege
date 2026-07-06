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
        <main class="container-blog">

            <!-- Empurra o conteúdo para baixo do menu fixo -->
            <div class="espacoo"></div>

            <h1 class="titulo-blog">BLOG</h1>

            <!-- Post em Destaque (Grande) -->
            <div class="card-post-grande">
                <div class="imagem-post">
                    <!-- Imagem online: Jovem usando computador com fone de ouvido -->
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=600&auto=format&fit=crop"
                        alt="Perigos no Discord">
                </div>
                <div class="conteudo-post">
                    <h2>ENTENDA OS <span class="destaque-roxo">RISCOS DO DISCORD</span> E PROTEJA SEU FILHO</h2>
                    <p>Um guia essencial para pais, entendendo os risks ao utilizar a plataforma do Discord e como
                        garantir um ambiente seguro...</p>
                    <div class="tags-container">
                        <span class="tag-circular">DISCORD</span>
                        <span class="tag-circular">SEGURANÇA DIGITAL</span>
                    </div>
                </div>
            </div>

            <!-- Grade de Posts Menores (Lado a Lado) -->
            <div class="grade-posts">
                <!-- Post 2 -->
                <div class="card-post-pequeno">
                    <!-- Imagem online: Criança estudando no notebook com segurança -->
                    <img src="https://institutovillamil.com.br/wp-content/uploads/2020/09/uso-de-telas-na-infancia-instituto-villamil-3-1.png"
                        alt="Post">
                    <div class="conteudo-post-pequeno">
                        <h3>CRIANDO UM AMBIENTE DIGITAL SEGURO: DICAS PRÁTICAS</h3>
                        <p>Como aplicar regras de monitoramento saudáveis no dia a dia da sua família...</p>
                        <div class="tags-container">
                            <span class="tag-circular">DIGITAL</span>
                            <span class="tag-circular">CUIDAR</span>
                        </div>
                    </div>
                </div>

                <!-- Post 3 -->
                <div class="card-post-pequeno">
                    <!-- Imagem online: Mãe/Pai orientando a filha no computador -->
                    <img src="https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=500&auto=format&fit=crop"
                        alt="Post">
                    <div class="conteudo-post-pequeno">
                        <h3>A IMPORTÂNCIA DO DIÁLOGO ABERTO SOBRE RISCOS</h3>
                        <p>Orientar e oferecer diálogo aberto é a melhor forma de garantir a segurança digital das
                            crianças...</p>
                        <div class="tags-container">
                            <span class="tag-circular">AMAR</span>
                            <span class="tag-circular">EVITE</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</body>

</html>
