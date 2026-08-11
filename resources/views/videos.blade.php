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
                    <a href="{{ route('sobre') }}">Sobre</a>
                    <a href="{{ route('videos') }}">Vídeos</a>
                    <a href="{{ route('blog') }}">Blog</a>
                    <a href="{{ route('login') }}">Login</a>
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
    @forelse($videos as $video)
        <div class="video-card">
            <video controls width="100%" style="border-radius: 8px;">
                <source src="{{ asset('storage/' . $video->arquivo) }}" type="video/mp4">
                Seu navegador não suporta a exibição de vídeos.
            </video>
            <h3>{{ $video->titulo }}</h3>
            <p>{{ $video->descricao }}</p>
        </div>
    @empty
        <div class="empty-state">
            <p>Nenhum vídeo disponível no momento.</p>
        </div>
    @endforelse
</div>

</body>

</html>