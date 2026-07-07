<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege</title>
    <link rel="stylesheet" href="{{ asset('assets/css/video.css') }}">
</head>

<body>
    <div class="container">
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

        <main>
            <div class="conteudo-info">

                <div class="espacoo"></div>

                <div class="Info">
                    <h1>Vídeos</h1>
                </div>

                <div class="AreaVd">
                    <video id="meuVideo" src="{{ asset('assets/video/kjknjkn.mp4') }}" loop playsinline
                        controls></video>
                </div>

            </div>
        </main>
    </div>
</body>

</html>
