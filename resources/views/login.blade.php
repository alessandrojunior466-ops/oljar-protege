<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege</title>
    <link rel="stylesheet" href="{{ asset('assets/css/sobre.css') }}">
</head>

<body>
    <div class="container">
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

        <main>

            <div class="conteudo-info">

                <section class="secao-bloco">


                    <script src="{{ asset('js/sobre.js') }}"></script>
</body>

</html>
