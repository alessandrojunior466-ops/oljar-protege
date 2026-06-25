<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Roboto:ital,wdth,wght@0,75..100,100..900;1,75..100,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: #c0c9ee !important;
            font-family: 'Montserrat', sans-serif;
        }

        header {
            height: 180px;
        }

        .cabecalho {
            display: flex;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            z-index: 100;
            align-items: center;
            justify-content: space-between;
            background-color: #fff3e4;
            border-radius: 12px;
            padding: 15px 30px;
            margin-top: 30px;
            max-width: 1400px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.1);
        }

        .cabecalho nav {
            display: flex;
            gap: 30px;
        }

        .cabecalho2 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 30px;
        }

        nav a {
            text-decoration: none;
            color: #000;
            font-weight: bold;
        }

        nav a:hover {
            color: rgb(91, 133, 189);
        }

        .slideshow-container {
            max-width: 1000px;
            position: relative;
            margin: auto;
        }

        .mySlides {
            display: none;
            /* O JS controla isso, mas o primeiro terá uma exceção inline */
            width: 100%;
        }

        .img3 {
            border: #fff solid 10px;
            border-radius: 20px;
            box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
        }

        .prev,
        .next {
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: auto;
            padding: 16px;
            color: #898AC4;
            font-weight: bold;
            font-size: 24px;
            transition: 0.6s ease;
            border-radius: 50%;
            user-select: none;
            z-index: 10;
        }

        .next {
            right: -50px;
        }

        .prev {
            left: -50px;
        }

        .prev:hover,
        .next:hover {
            background-color: rgba(255, 255, 255, 0.8);
        }

        .dot {
            cursor: pointer;
            height: 15px;
            width: 15px;
            margin: 0 4px;
            background-color: #bbb;
            border-radius: 50%;
            display: inline-block;
            transition: background-color 0.6s ease;
        }

        .active,
        .dot:hover {
            background-color: #717171;
        }

        .fade {
            animation-name: fade;
            animation-duration: 1.0s;
        }

        @keyframes fade {
            from {
                opacity: .4
            }

            to {
                opacity: 1
            }
        }

        .abaixo {
            text-align: center;
            font-size: 18px;
            color: #4a4b7c;
            max-width: 800px;
            margin: 40px auto;
            line-height: 1.6;
            padding: 0 20px;
        }

        .quadrado {
            margin: 40px auto;
            width: 90%;
            max-width: 1200px;
            height: auto;
            /* Mudado para dinâmico para se adaptar à imagem */
            min-height: 350px;
            background: #A2AADB;
            border-radius: 20px;
            box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.15);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* AJUSTE PARA A IMAGEM NÃO CORTAR */
        .imagem-quadrado {
            width: 100%;
            height: 100%;
            object-fit: contain;
            /* Garante que toda a arte seja exibida sem cortes */
            border-radius: 20px;
        }

        .final {
            width: 90%;
            max-width: 1200px;
            background: #898AC4;
            border-radius: 25px;
            margin: 50px auto;
            padding: 40px;
            box-shadow: 0px 20px 30px rgba(0, 0, 0, 0.15);
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
        }

        .meninas {
            width: 100%;
            max-width: 450px;
            height: auto;
            border: #fff solid 4px;
            border-radius: 30px;
            box-shadow: 0px 15px 25px rgba(0, 0, 0, 0.2);
        }

        .caixa {
            text-align: left;
        }

        .textinFinal {
            color: #fff;
            font-size: 32px;
            font-weight: 800;
            line-height: 1.4;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <div class="cabecalho">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" height="auto" />
                <nav>
                    <h2><a href="/sobre">Sobre</a></h2>
                    <h2><a href="/videos">Videos</a></h2>
                    <h2><a href="/login">Login</a></h2>
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
