<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <!-- ADICIONE ESTA LINHA AQUI NO HEAD -->
    @vite(['resources/js/app.js'])
</head>

<body>
    <div class="container">
        <header>
            <div class="cabecalho">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" height="auto" alt="Logo" />
                <nav>
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('sobre') }}" class="{{ request()->routeIs('sobre') ? 'active' : '' }}">Sobre</a>
                    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">Vídeos</a>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>
                    
                    <!-- Cadastrar-me (Usuário Comum) -->
                    <a href="{{ route('extras.register') }}" class="{{ request()->routeIs('extras.register') ? 'active' : '' }}">
                        Cadastrar-me
                    </a>

                    <!-- Entrar (Usuário Comum) -->
                    <a href="{{ route('extras.login') }}" class="{{ request()->routeIs('extras.login') ? 'active' : '' }}">
                        Entrar
                    </a>
                    
                    <!-- Extras (Usuário Comum) -->
                    <a href="{{ route('extras') }}" class="{{ request()->routeIs('extras') ? 'active' : '' }}">
                        Extras
                    </a>
                    
                    <!-- Página Equipe por último -->
                    <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.register') ? 'active' : '' }}">
                        Equipe
                    </a>
                </nav>
            </div>
        </header>

        <section>
            <div class="cabecalho2">
                <img src="{{ asset('assets/img/image 5.png') }}" width="60" height="auto" alt="Ícone" />
                <img src="{{ asset('assets/img/MONITORAR = CUIDAR..png') }}" width="400" height="auto" alt="Monitorar é Cuidar" />
                <br /><br />
                <img src="{{ asset('assets/img/Rectangle 7.png') }}" width="600" height="auto" id="retangulo" alt="Destaque" />
            </div>
        </section>

        <!-- SEÇÃO DO CARROSSEL MODERNO -->
        <section class="carousel-section">
            <div class="carousel-container" id="mainCarousel">
                
                <!-- Banners do Carrossel -->
                <div class="carousel-track">
                    <div class="carousel-slide active">
                        <img src="{{ asset('assets/img/banner1.png') }}" alt="Banner 1" class="carousel-img" />
                        <div class="carousel-caption">
                            <h3>Segurança e Cuidado Digital</h3>
                            <p>Protegendo nossas crianças e adolescentes no ambiente virtual.</p>
                        </div>
                    </div>

                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/banner2.png') }}" alt="Banner 2" class="carousel-img" />
                        <div class="carousel-caption">
                            <h3>Acompanhamento Consciente</h3>
                            <p>Monitorar é um ato de amor e preservação da integridade.</p>
                        </div>
                    </div>

                    <div class="carousel-slide">
                        <img src="{{ asset('assets/img/banner3.png') }}" alt="Banner 3" class="carousel-img" />
                        <div class="carousel-caption">
                            <h3>Orientação e Diálogo</h3>
                            <p>Fortaleça os laços familiares através de conversas abertas.</p>
                        </div>
                    </div>
                </div>

                <!-- Botões de Navegação com Ícones Modernos -->
                <button class="carousel-btn prev" id="prevBtn" aria-label="Anterior">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
                <button class="carousel-btn next" id="nextBtn" aria-label="Próximo">
                    <i class="fa-solid fa-chevron-right"></i>
                </button>

                <!-- Indicadores (Dots) e Progress Bar -->
                <div class="carousel-indicators">
                    <span class="dot active" data-slide="0"></span>
                    <span class="dot" data-slide="1"></span>
                    <span class="dot" data-slide="2"></span>
                </div>

                <!-- Barra de Progresso do Autoplay -->
                <div class="carousel-progress-bar">
                    <div class="carousel-progress" id="carouselProgress"></div>
                </div>
            </div>
        </section>

        <div class="abaixo">
            <p>
                Muitas meninas estão expostas a riscos na internet. É de extrema
                importância que os responsáveis estejam atentos ao comportamento online,
                orientando e oferecendo diálogo aberto para garantir a segurança digital
                delas.
            </p>
        </div>

        <section>
            <div class="quadrado">
                <img src="{{ asset('assets/img/SUA_IMAGEM_AQUI.jpg') }}" class="imagem-quadrado" alt="Descrição da imagem" />
            </div>
        </section>

        <section>
            <div class="final">
                <img src="{{ asset('assets/img/meninas-assistindo-laptop-adolescentes-modernos-em-casa-surpresa-e-emocoes 1.png') }}"
                    class="meninas" alt="meninas assistindo laptop" />
                <div class="caixa">
                    <p class="textinFinal">CUIDAR E AMAR, PODE</p>
                    <p class="textinFinal">SALVAR E POUPAR.</p>
                </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>