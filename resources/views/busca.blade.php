<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Buscar: {{ $q }} — Olhar Que Protege</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>
<body>
    <div class="container">
        <main style="padding: 24px 0 60px;">
            <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:12px; margin-bottom:24px;">
                <h1>Resultados para: "{{ $q }}"</h1>
                <a href="{{ route('home') }}">← Voltar para a Home</a>
            </div>

            @if($q === '')
                <p>Digite uma palavra ou frase na lupinha para pesquisar no site.</p>
            @else
                <h2>Páginas ({{ $paginas->count() }})</h2>
                @forelse($paginas as $pagina)
                    <div style="background:#fff3e4; padding:16px; border-radius:12px; margin-bottom:12px;">
                        <a href="{{ $pagina['rota'] }}"><strong>{{ $pagina['titulo'] }}</strong></a>
                        <p style="margin-top:6px;">{{ $pagina['resumo'] }}</p>
                    </div>
                @empty
                    <p style="margin-bottom:18px;">Nenhuma página encontrada.</p>
                @endforelse

                <h2 style="margin-top:24px;">Posts do Blog ({{ $posts->count() }})</h2>
                @forelse($posts as $post)
                    <div style="background:#fff3e4; padding:16px; border-radius:12px; margin-bottom:12px;">
                        <a href="{{ route('blog.show', $post) }}"><strong>{{ $post->titulo }}</strong></a>
                        <p style="margin-top:6px;">{{ Str::limit(strip_tags($post->conteudo ?? ''), 160) }}</p>
                    </div>
                @empty
                    <p style="margin-bottom:18px;">Nenhum post encontrado no blog.</p>
                @endforelse

                <h2 style="margin-top:24px;">Vídeos ({{ $videos->count() }})</h2>
                @forelse($videos as $video)
                    <div style="background:#fff3e4; padding:16px; border-radius:12px; margin-bottom:12px;">
                        <a href="{{ route('videos.show', $video) }}"><strong>{{ $video->titulo }}</strong></a>
                        <p style="margin-top:6px;">{{ Str::limit(strip_tags($video->descricao ?? ''), 160) }}</p>
                    </div>
                @empty
                    <p>Nenhum vídeo encontrado.</p>
                @endforelse
            @endif
        </main>
    </div>
</body>
</html>