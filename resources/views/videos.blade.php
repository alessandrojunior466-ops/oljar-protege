<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Olhar Que Protege - Vídeos</title>

    <link rel="stylesheet" href="{{ asset('assets/css/video2.css') }}">
</head>

<body>

    <div class="container">

        <header>

            <div class="cabecalho">

                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="200" alt="Logo">

                <nav>
                    <a href="{{ route('home') }}">Home</a>
                    <a href="/sobre">Sobre</a>
                    <a href="/videos">Vídeos</a>
                    <a href="/blog">Blog</a>
                    <a href="/login">Login</a>
                </nav>

            </div>

        </header>

        <main>

            <section class="videos-section">

                <h1>VÍDEOS</h1>

                <p>
                    Em breve você encontrará treinamentos, aulas e conteúdos educativos
                    sobre segurança digital para proteger crianças e adolescentes.
                </p>

                <div class="videos-grid">

                    @for ($i = 1; $i <= 9; $i++)
                        <div class="video-card">

                            <div class="play-icon">
                                ▶
                            </div>

                            <h3>Vídeo {{ $i }}</h3>

                            <span>Em breve</span>

                        </div>
                    @endfor

                </div>

            </section>

        </main>

    </div>

    <script src="{{ asset('assets/js/script.js') }}"></script>

</body>

</html>
