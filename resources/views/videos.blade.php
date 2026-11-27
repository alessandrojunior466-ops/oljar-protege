<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Vídeos</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/topbar-shared.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/videos.css') }}">
</head>

<body>
    <div class="container">

        <!-- CABEÇALHO FIXO (MENU ESQ + LOGO CENTRO + BUSCA DIR) -->
        <header>
            <div class="cabecalho">
                <button type="button" class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="mainNav">
                    <i class="fa-solid fa-bars" id="menuIcon"></i>
                </button>

                <a href="{{ route('home') }}" class="logo-link" aria-label="Página inicial Olhar Que Protege">
                    <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" class="logo-img" alt="Logo Olhar Que Protege" />
                </a>

                <button type="button" class="search-toggle" id="searchToggle" aria-label="Abrir pesquisa" aria-expanded="false" aria-controls="searchBar">
                    <i class="fa-solid fa-magnifying-glass" id="searchIcon"></i>
                </button>

                <nav id="mainNav" class="main-nav">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('sobre') }}" class="{{ request()->routeIs('sobre') ? 'active' : '' }}">Sobre</a>
                    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">Vídeos</a>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>

                    <a href="{{ route('extras.register') }}" class="{{ request()->routeIs('extras.register') ? 'active' : '' }}">
                        Cadastrar-me
                    </a>

                    <a href="{{ route('extras.login') }}" class="{{ request()->routeIs('extras.login') ? 'active' : '' }}">
                        Entrar
                    </a>

                    <a href="{{ route('extras') }}" class="{{ request()->routeIs('extras') ? 'active' : '' }}">
                        Extras
                    </a>

                    <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.register') || request()->routeIs('admin.login') ? 'active' : '' }}">
                        Equipe
                    </a>
                </nav>

                <!-- Barra de Pesquisa Expansível -->
                <form action="{{ route('videos.index') }}" method="GET" class="search-bar" id="searchBar" role="search">
                    <input type="search" name="q" id="searchInput" class="search-input" value="{{ request('q') }}" placeholder="Pesquisar nos vídeos..." aria-label="Pesquisar nos vídeos" autocomplete="off" />
                    <button type="submit" class="search-submit" aria-label="Confirmar busca">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="nav-backdrop" id="navBackdrop"></div>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="container-blog">

            <div class="espacoo"></div>

            <h1 class="titulo-blog">VÍDEOS</h1>

            @php
                $q = trim((string) request('q', ''));
                $videosFiltrados = $q !== ''
                    ? $videos->filter(function ($video) use ($q) {
                        $needle = mb_strtolower($q);
                        $titulo = mb_strtolower((string) ($video->titulo ?? ''));
                        $descricao = mb_strtolower((string) ($video->descricao ?? ''));
                        $autor = mb_strtolower((string) ($video->autor?->name ?? $video->autor?->nome ?? ''));
                        return str_contains($titulo, $needle)
                            || str_contains($descricao, $needle)
                            || str_contains($autor, $needle);
                    })->values()
                    : $videos->values();

                $destaque = $videosFiltrados->first();

                $extrairUrls = function (?string $texto): array {
                    if (!$texto) {
                        return [];
                    }
                    preg_match_all('/https?:\/\/[^\s,]+/i', $texto, $matches);
                    $brutas = $matches[0] ?? [];
                    if (empty($brutas)) {
                        $brutas = preg_split('/[\r\n,]+/', $texto) ?: [];
                    }
                    $limpas = [];
                    foreach ($brutas as $u) {
                        $uClean = trim($u, " \t\n\r\0\x0B\"'(),;");
                        if ($uClean !== '' && filter_var($uClean, FILTER_VALIDATE_URL)) {
                            $limpas[] = $uClean;
                        }
                    }
                    return array_values(array_unique($limpas));
                };

                $resolverMidiaVideo = function ($video) use ($extrairUrls) {
                    $candidatas = [];
                    foreach ([$video->youtube_url ?? null, $video->url_video ?? null, $video->arquivo ?? null] as $campo) {
                        if (!empty($campo)) {
                            foreach ($extrairUrls((string) $campo) as $u) {
                                $candidatas[] = $u;
                            }
                            foreach (preg_split('/[\r\n,]+/', (string) $campo) as $bruto) {
                                $bruto = trim($bruto);
                                if ($bruto !== '' && !str_starts_with($bruto, 'http')) {
                                    $candidatas[] = $bruto;
                                }
                            }
                        }
                    }
                    if (is_array($video->midias ?? null)) {
                        foreach ($video->midias as $mItem) {
                            if (is_string($mItem) && trim($mItem) !== '') {
                                $candidatas[] = trim($mItem);
                            }
                        }
                    }
                    $candidatas = array_values(array_unique($candidatas));

                    $ytId = null;
                    $listId = null;
                    $arquivoLocal = null;

                    foreach ($candidatas as $item) {
                        if (!$ytId && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', $item, $mVid)) {
                            $ytId = $mVid[1];
                        }
                        if (!$listId && preg_match('/[?&]list=([A-Za-z0-9_-]+)/', $item, $mList)) {
                            $listId = $mList[1];
                        }
                        if (!$arquivoLocal && !str_starts_with($item, 'http')) {
                            $arquivoLocal = asset('storage/' . $item) . '#t=0.1';
                        }
                    }

                    $thumbsInformadas = $extrairUrls($video->thumbnail_url ?? null);
                    $thumb = $thumbsInformadas[0] ?? ($ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : null);

                    $embedUrl = null;
                    if ($listId && $ytId) {
                        $embedUrl = "https://www.youtube-nocookie.com/embed/{$ytId}?list=" . urlencode($listId);
                    } elseif ($listId) {
                        $embedUrl = "https://www.youtube-nocookie.com/embed/videoseries?list=" . urlencode($listId);
                    } elseif ($ytId) {
                        $embedUrl = "https://www.youtube-nocookie.com/embed/{$ytId}";
                    }

                    return compact('ytId', 'listId', 'thumb', 'embedUrl', 'arquivoLocal');
                };
            @endphp

            @if ($q !== '')
                <div class="busca-banner visivel" id="buscaBanner">
                    <span>A mostrar {{ $videosFiltrados->count() }} resultado(s) para "{{ $q }}".</span>
                    <a href="{{ route('videos.index') }}" class="busca-limpar-btn">Limpar filtro</a>
                </div>
            @endif

            @if ($destaque)
                @php $mDest = $resolverMidiaVideo($destaque); @endphp
                <article class="card-post-grande">
                    <a href="{{ route('videos.show', $destaque->id) }}" class="card-link-overlay" aria-label="Abrir vídeo: {{ $destaque->titulo }}"></a>

                    <div class="imagem-post">
                        <div class="video-player-container">
                            @if ($mDest['thumb'])
                                <div class="video-thumb-media">
                                    <img
                                        src="{{ $mDest['thumb'] }}"
                                        alt="{{ $destaque->titulo }}"
                                        onerror="const wrap = this.closest('.video-thumb-media'); if (wrap) wrap.style.display = 'none'; const parent = this.closest('.video-player-container'); const iframe = parent && parent.querySelector('iframe.fallback-embed'); if (iframe) iframe.style.display = 'block';"
                                    >
                                    <span class="video-play-badge"><i class="fa-solid fa-play"></i></span>
                                </div>
                                @if ($mDest['embedUrl'])
                                    <iframe
                                        src="{{ $mDest['embedUrl'] }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                        class="video-iframe fallback-embed"
                                        style="display: none;"
                                    ></iframe>
                                @endif
                            @elseif ($mDest['embedUrl'])
                                <iframe
                                    src="{{ $mDest['embedUrl'] }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen
                                    class="video-iframe"
                                ></iframe>
                            @elseif ($mDest['arquivoLocal'])
                                <video controls preload="metadata">
                                    <source src="{{ $mDest['arquivoLocal'] }}" type="video/mp4">
                                </video>
                            @endif
                        </div>
                    </div>

                    <div class="conteudo-post">
                        <span class="post-meta-date">
                            Por {{ $destaque->autor?->name ?? $destaque->autor?->nome ?? 'Administrador' }}
                            {{ $destaque->created_at?->format('d/m/Y') }}
                        </span>

                        <h2>{{ $destaque->titulo }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit($destaque->descricao, 200) }}</p>
                        <div class="tags-container">
                            <span class="tag-circular">DESTAQUE</span>
                        </div>
                    </div>
                </article>
            @endif

            <!-- Grade de Vídeos Menores -->
            <div class="grade-posts">
                @forelse($videosFiltrados->skip(1) as $video)
                    @php $mVid = $resolverMidiaVideo($video); @endphp
                    <article class="card-post-pequeno">
                        <a href="{{ route('videos.show', $video->id) }}" class="card-link-overlay" aria-label="Abrir vídeo: {{ $video->titulo }}"></a>

                        <div class="video-thumb-small">
                            <div class="video-thumb-media">
                                @if ($mVid['thumb'])
                                    <img
                                        src="{{ $mVid['thumb'] }}"
                                        alt="{{ $video->titulo }}"
                                        onerror="const wrap = this.closest('.video-thumb-media'); if (wrap) wrap.style.display = 'none'; const parent = this.closest('.video-thumb-small'); const iframe = parent && parent.querySelector('iframe.fallback-embed'); if (iframe) iframe.style.display = 'block';"
                                    >
                                    <span class="video-play-badge"><i class="fa-solid fa-play"></i></span>
                                @elseif ($mVid['embedUrl'])
                                    <iframe
                                        src="{{ $mVid['embedUrl'] }}"
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        referrerpolicy="strict-origin-when-cross-origin"
                                        allowfullscreen
                                    ></iframe>
                                @elseif ($mVid['arquivoLocal'])
                                    <video controls preload="metadata">
                                        <source src="{{ $mVid['arquivoLocal'] }}" type="video/mp4">
                                    </video>
                                @endif
                            </div>
                            @if ($mVid['thumb'] && $mVid['embedUrl'])
                                <iframe
                                    src="{{ $mVid['embedUrl'] }}"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                    referrerpolicy="strict-origin-when-cross-origin"
                                    allowfullscreen
                                    class="fallback-embed"
                                    style="display: none;"
                                ></iframe>
                            @endif
                        </div>

                        <div class="conteudo-post-pequeno">
                            <span class="post-meta-small">
                                Por {{ $video->autor?->name ?? $video->autor?->nome ?? 'Administrador' }}
                                {{ $video->created_at?->format('d/m/Y') }}
                            </span>

                            <h3>{{ $video->titulo }}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($video->descricao, 120) }}</p>

                            <div class="tags-container">
                                <span class="tag-circular">VÍDEO</span>
                            </div>
                        </div>
                    </article>
                @empty
                    @if (!$destaque)
                        <div class="empty-state-grid">
                            @if ($q !== '')
                                <p>Nenhum vídeo encontrado para "{{ $q }}".</p>
                            @else
                                <p>Nenhum vídeo encontrado no momento. Volte mais tarde!</p>
                            @endif
                        </div>
                    @endif
                @endforelse
            </div>
        </main>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const menuToggle = document.getElementById('menuToggle');
            const mainNav = document.getElementById('mainNav');
            const menuIcon = document.getElementById('menuIcon');
            const searchToggle = document.getElementById('searchToggle');
            const searchBar = document.getElementById('searchBar');
            const searchInput = document.getElementById('searchInput');
            const searchIcon = document.getElementById('searchIcon');
            const navBackdrop = document.getElementById('navBackdrop');

            function setMenuState(isOpen) {
                if (!mainNav || !menuToggle) return;
                mainNav.classList.toggle('open', isOpen);
                menuToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (menuIcon) menuIcon.className = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-bars';
            }

            function setSearchState(isOpen) {
                if (!searchBar || !searchToggle) return;
                searchBar.classList.toggle('open', isOpen);
                searchToggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                if (searchIcon) searchIcon.className = isOpen ? 'fa-solid fa-xmark' : 'fa-solid fa-magnifying-glass';
                if (isOpen && searchInput) setTimeout(() => searchInput.focus(), 120);
            }

            function syncBackdrop() {
                const anyOpen = (mainNav && mainNav.classList.contains('open')) || (searchBar && searchBar.classList.contains('open'));
                if (navBackdrop) navBackdrop.classList.toggle('active', anyOpen);
                document.body.classList.toggle('menu-open', anyOpen);
            }

            function closeAll() {
                setMenuState(false);
                setSearchState(false);
                syncBackdrop();
            }

            if (menuToggle) menuToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const open = !(mainNav && mainNav.classList.contains('open'));
                if (open) setSearchState(false);
                setMenuState(open);
                syncBackdrop();
            });

            if (searchToggle) searchToggle.addEventListener('click', (e) => {
                e.stopPropagation();
                const open = !(searchBar && searchBar.classList.contains('open'));
                if (open) setMenuState(false);
                setSearchState(open);
                syncBackdrop();
            });

            if (navBackdrop) navBackdrop.addEventListener('click', closeAll);
            document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeAll(); });
        });
    </script>
</body>

</html>