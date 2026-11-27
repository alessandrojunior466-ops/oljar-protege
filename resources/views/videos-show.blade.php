<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->titulo }} - Olhar Que Protege</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/topbar-shared.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog-show.css') }}">
</head>

<body>
    <div class="container">

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

                <form action="{{ url()->current() }}" method="GET" class="search-bar" id="searchBar" role="search">
                    <input type="search" name="q" id="searchInput" class="search-input" value="{{ request('q') }}" placeholder="Pesquisar nesta página..." aria-label="Pesquisar nesta página" autocomplete="off" />
                    <button type="submit" class="search-submit" aria-label="Confirmar busca">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="nav-backdrop" id="navBackdrop"></div>

        <main class="container-blog" id="conteudoPesquisavel">
            <div class="espacoo"></div>

            <div class="busca-banner" id="buscaBanner">
                <span id="buscaStatus"></span>
                <button type="button" class="busca-limpar-btn" id="limparBuscaBtn">Limpar destaque</button>
            </div>

            <a href="{{ route('videos.index') }}" class="btn-voltar">&larr; Voltar para Vídeos</a>

            <article class="detalhe-post">
                <span class="post-date">
                    POR {{ mb_strtoupper($video->autor?->name ?? $video->autor?->nome ?? 'Administrador') }}
                    @if ($video->created_at)
                        &bull; PUBLICADO EM {{ $video->created_at->format('d/m/Y') }}
                    @endif
                </span>

                <h1>{{ $video->titulo }}</h1>

                @php
                    $candidata = $video->youtube_url ?? $video->url_video ?? $video->arquivo ?? null;
                    $ytId = null;
                    if (!empty($candidata) && preg_match('/(?:youtube\.com\/(?:watch\?v=|embed\/|shorts\/)|youtu\.be\/)([A-Za-z0-9_-]{11})/', (string) $candidata, $m)) {
                        $ytId = $m[1];
                    }

                    $thumb = !empty($video->thumbnail_url)
                        ? $video->thumbnail_url
                        : ($ytId ? "https://img.youtube.com/vi/{$ytId}/hqdefault.jpg" : null);

                    $embedUrl = $ytId ? "https://www.youtube-nocookie.com/embed/{$ytId}" : null;

                    $arquivoLocal = (!$ytId && !empty($video->arquivo) && !str_starts_with((string) $video->arquivo, 'http'))
                        ? asset('storage/' . $video->arquivo)
                        : null;
                @endphp

                @if ($thumb)
                    <div style="width: 100%; margin: 20px 0;">
                        <img
                            src="{{ $thumb }}"
                            alt="Thumbnail de {{ $video->titulo }}"
                            class="imagem-detalhe"
                            style="width: 100%; aspect-ratio: 16 / 10; max-height: 420px; object-fit: cover; object-position: center; border-radius: 12px; display: block; margin: 0;"
                        >
                    </div>
                @endif

                <div class="imagem-detalhe" style="width: 100%; background-color: #000; max-height: none; overflow: hidden; border-radius: 12px;">
                    @if ($embedUrl)
                        <iframe
                            src="{{ $embedUrl }}"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen
                            style="width: 100%; aspect-ratio: 16 / 9; min-height: 360px; display: block; border: 0;"
                        ></iframe>
                    @elseif ($arquivoLocal)
                        <video controls @if($thumb) poster="{{ $thumb }}" @endif style="width: 100%; max-height: 500px; display: block;" preload="metadata">
                            <source src="{{ $arquivoLocal }}" type="video/mp4">
                            Seu navegador não suporta a exibição de vídeos.
                        </video>
                    @endif
                </div>

                <div class="conteudo-texto">
                    {!! nl2br(e($video->descricao)) !!}
                </div>
            </article>
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
            const containerMain = document.getElementById('conteudoPesquisavel');
            const banner = document.getElementById('buscaBanner');
            const statusEl = document.getElementById('buscaStatus');
            const limparBtn = document.getElementById('limparBuscaBtn');

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

            function clearHighlights() {
                if (!containerMain) return;
                containerMain.querySelectorAll('mark.busca-destaque').forEach(mark => {
                    const parent = mark.parentNode;
                    parent.replaceChild(document.createTextNode(mark.textContent), mark);
                    parent.normalize();
                });
                if (banner) banner.classList.remove('visivel');
            }

            function highlightTerm(term) {
                clearHighlights();
                const clean = term.trim();
                if (!clean || !containerMain) return;

                const escaped = clean.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
                const regex = new RegExp(`(${escaped})`, 'gi');
                let count = 0;
                let firstMark = null;

                const walker = document.createTreeWalker(containerMain, NodeFilter.SHOW_TEXT, {
                    acceptNode: function (node) {
                        if (!node.nodeValue || !node.nodeValue.trim()) return NodeFilter.FILTER_REJECT;
                        const tag = node.parentElement ? node.parentElement.tagName : '';
                        if (['SCRIPT', 'STYLE', 'MARK', 'BUTTON', 'INPUT'].includes(tag)) return NodeFilter.FILTER_REJECT;
                        if (node.parentElement && node.parentElement.closest('#buscaBanner')) return NodeFilter.FILTER_REJECT;
                        return regex.test(node.nodeValue) ? NodeFilter.FILTER_ACCEPT : NodeFilter.FILTER_SKIP;
                    }
                });

                const nodes = [];
                while (walker.nextNode()) nodes.push(walker.currentNode);

                nodes.forEach(node => {
                    regex.lastIndex = 0;
                    const parts = node.nodeValue.split(regex);
                    if (parts.length <= 1) return;
                    const frag = document.createDocumentFragment();
                    parts.forEach(part => {
                        if (part.toLowerCase() === clean.toLowerCase()) {
                            const mark = document.createElement('mark');
                            mark.className = 'busca-destaque';
                            mark.textContent = part;
                            frag.appendChild(mark);
                            if (!firstMark) firstMark = mark;
                            count++;
                        } else if (part) {
                            frag.appendChild(document.createTextNode(part));
                        }
                    });
                    node.parentNode.replaceChild(frag, node);
                });

                if (banner && statusEl) {
                    statusEl.textContent = count > 0
                        ? `Encontramos ${count} ocorrência(s) de "${clean}" nesta página.`
                        : `Nenhuma ocorrência exata de "${clean}" nesta página.`;
                    banner.classList.add('visivel');
                }

                if (firstMark) {
                    firstMark.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }

            if (searchBar && searchInput) {
                searchBar.addEventListener('submit', function (e) {
                    const q = searchInput.value.trim();
                    if (!q) {
                        e.preventDefault();
                        clearHighlights();
                        return;
                    }
                    e.preventDefault();
                    const url = new URL(window.location.href);
                    url.searchParams.set('q', q);
                    window.history.replaceState({}, '', url);
                    highlightTerm(q);
                    closeAll();
                });

                if (searchInput.value.trim()) {
                    highlightTerm(searchInput.value.trim());
                }
            }

            if (limparBtn) {
                limparBtn.addEventListener('click', function () {
                    if (searchInput) searchInput.value = '';
                    clearHighlights();
                    const url = new URL(window.location.href);
                    url.searchParams.delete('q');
                    window.history.replaceState({}, '', url);
                });
            }
        });
    </script>
</body>

</html>