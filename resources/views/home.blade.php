<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege</title>
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>
    <div class="container">
        <header>
            <div class="cabecalho">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" height="auto"
                    alt="Logo" />
                <nav>
                    <a href="">Home</a>
                    <a href="/sobre">Sobre</a>
                    <a href="/videos">Videos</a>
                    <a href="/contato">Contato</a>
                    <a href="/login">Login</a>
                </nav>
            </div>
        </header>

        <section>
            <div class="cabecalho2">
                <img src="{{ asset('assets/img/image 5.png') }}" width="60" height="auto" />
                <img src="{{ asset('assets/img/MONITORAR = CUIDAR..png') }}" width="400" height="auto" />
                <br /><br />
                <img src="{{ asset('assets/img/Rectangle 7.png') }}" width="600" height="auto" id="retangulo" />
            </div>
        </section>

        <section>
            <div class="slideshow-container">
                <div class="mySlides fade" style="display: block;">
                    <img src="{{ asset('assets/img/banner1.png') }}" style="width: 100%" class="img3" />
                </div>

                <div class="mySlides fade">
                    <img src="{{ asset('assets/img/banner2.png') }}" style="width: 100%" class="img3" />
                </div>

                <div class="mySlides fade">
                    <img src="{{ asset('assets/img/banner3.png') }}" style="width: 100%" class="img3" />
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>
            </div>

            <br />

            <div style="text-align: center">
                <span class="dot active" onclick="currentSlide(1)"></span>
                <span class="dot" onclick="currentSlide(2)"></span>
                <span class="dot" onclick="currentSlide(3)"></span>
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
                <img src="{{ asset('assets/img/SUA_IMAGEM_AQUI.jpg') }}" class="imagem-quadrado"
                    alt="Descrição da imagem" />
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

    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
