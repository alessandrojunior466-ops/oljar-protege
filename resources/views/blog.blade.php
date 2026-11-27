<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Blog</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/topbar-shared.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/blog.css') }}">
</head>

<body>
    <div class="container">

        <!-- CABEÇALHO FIXO -->
        <header class="topo-fixo">
            <div class="cabecalho">
                <!-- Esquerda: Menu Sanduíche -->
                <button type="button" class="menu-toggle" id="menuToggle" aria-label="Abrir menu" aria-expanded="false" aria-controls="mainNav">
                    <i class="fa-solid fa-bars" id="menuIcon"></i>
                </button>

                <!-- Centro: Logo -->
                <a href="{{ route('home') }}" class="logo-link" aria-label="Página inicial Olhar Que Protege">
                    <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" class="logo-img" alt="Logo Olhar Que Protege" />
                </a>

                <!-- Direita: Botão Pesquisar -->
                <button type="button" class="search-toggle" id="searchToggle" aria-label="Abrir pesquisa" aria-expanded="false" aria-controls="searchBar">
                    <i class="fa-solid fa-magnifying-glass" id="searchIcon"></i>
                </button>

                <!-- Menu Sanduíche -->
                <nav id="mainNav" class="main-nav">
                    <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
                    <a href="{{ route('sobre') }}" class="{{ request()->routeIs('sobre') ? 'active' : '' }}">Sobre</a>
                    <a href="{{ route('videos.index') }}" class="{{ request()->routeIs('videos.*') ? 'active' : '' }}">Vídeos</a>
                    <a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog.*') ? 'active' : '' }}">Blog</a>

                    <!-- Cadastrar-me -->
                    <a href="{{ route('extras.register') }}" class="{{ request()->routeIs('extras.register') ? 'active' : '' }}">
                        Cadastrar-me
                    </a>

                    <!-- Entrar -->
                    <a href="{{ route('extras.login') }}" class="{{ request()->routeIs('extras.login') ? 'active' : '' }}">
                        Entrar
                    </a>

                    <!-- Extras (Usuário Comum) -->
                    <a href="{{ route('extras') }}" class="{{ request()->routeIs('extras') ? 'active' : '' }}">
                        Extras
                    </a>

                    <!-- Página Equipe por último -->
                    <a href="{{ route('admin.login') }}" class="{{ request()->routeIs('admin.register') || request()->routeIs('admin.login') ? 'active' : '' }}">
                        Equipe
                    </a>
                </nav>

                <!-- Barra de Pesquisa -->
                <form action="{{ route('blog.index') }}" method="GET" class="search-bar" id="searchBar" role="search">
                    <input type="search" name="q" id="searchInput" class="search-input" value="{{ request('q') }}" placeholder="Pesquisar no blog..." aria-label="Pesquisar no blog" autocomplete="off" />
                    <button type="submit" class="search-submit" aria-label="Confirmar busca">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="nav-backdrop" id="navBackdrop"></div>

        <!-- CONTEÚDO PRINCIPAL -->
        <main class="container-blog">

            <!-- Título centralizado logo abaixo da barra creme, no fundo azul -->
            <div class="blog-topo">
                <h1 class="titulo-blog">BLOG</h1>
            </div>

            <div class="busca-banner" id="buscaBanner">
                <span id="buscaStatus"></span>
                <button type="button" class="busca-limpar-btn" id="limparBuscaBtn">Limpar filtro</button>
            </div>

            @php
                $colecaoPosts =$posts ?? collect();
                $destaque = $colecaoPosts->first();$listaSecundaria = $colecaoPosts->values()->all();$fallbackImg = 'https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=600&auto=format&fit=crop';
            @endphp

            @if ($destaque)
                @php
                    $autorDestaque = $destaque->autor?->name ?? $destaque->autor?->nome ?? 'Administrador';
                    $dataDestaque = $destaque->created_at ? $destaque->created_at->format('d/m/Y') : '';
                    $imgDestaque =$destaque->imagem
                        ? (str_starts_with($destaque->imagem, 'http') ? $destaque->imagem : asset('storage/' .$destaque->imagem))
                        : $fallbackImg;
                    $buscaDestaque = mb_strtolower($destaque->titulo . ' ' . $destaque->conteudo . ' ' .$autorDestaque);
                @endphp
                <a href="{{ route('blog.show', $destaque->id) }}"
                   class="post-link searchable-item"
                   data-search="{{ $buscaDestaque }}">
                    <div class="card-post-grande">
                        <div class="imagem-post">
                            <img src="{{ $imgDestaque }}" alt="{{ $destaque->titulo }}" onerror="this.onerror=null;this.src='{{ $fallbackImg }}';">
                        </div>
                        <div class="conteudo-post">
                            <span class="post-date">
                                Por {{ $autorDestaque }}{{ $dataDestaque ? ' • ' . $dataDestaque : '' }}
                            </span>
                            <h2>{{ $destaque->titulo }}</h2>
                            <p>{{ \Illuminate\Support\Str::limit($destaque->conteudo, 200) }}</p>
                            <div class="tags-container">
                                <span class="tag-circular">DESTAQUE</span>
                            </div>
                        </div>
                    </div>
                </a>
            @endif

            <!-- Grelha de Publicações Menores -->
            <div class="grade-posts" id="listaPosts">
                @if (count($listaSecundaria) > 1)
                    @for ($i = 1; $i < count($listaSecundaria);$i++)
                        @php
                            $post =$listaSecundaria[$i];$autorPost = $post->autor?->name ?? $post->autor?->nome ?? 'Administrador';
                            $dataPost = $post->created_at ? $post->created_at->format('d/m/Y') : '';
                            $imgPost =$post->imagem
                                ? (str_starts_with($post->imagem, 'http') ? $post->imagem : asset('storage/' .$post->imagem))
                                : null;
                            $buscaPost = mb_strtolower($post->titulo . ' ' . $post->conteudo . ' ' .$autorPost);
                        @endphp
                        <a href="{{ route('blog.show', $post->id) }}"
                           class="post-link searchable-item"
                           data-search="{{ $buscaPost }}">
                            <div class="card-post-pequeno">
                                @if ($imgPost)
                                    <div class="thumb-wrapper">
                                        <img src="{{ $imgPost }}" alt="{{ $post->titulo }}" class="thumb-post" onerror="this.onerror=null;this.src='{{ $fallbackImg }}';">
                                    </div>
                                @endif
                                <div class="conteudo-post-pequeno">
                                    <span class="post-date-small">
                                        Por {{ $autorPost }}{{ $dataPost ? ' • ' . $dataPost : '' }}
                                    </span>

                                    <h3>{{ $post->titulo }}</h3>
                                    <p>{{ \Illuminate\Support\Str::limit($post->conteudo, 120) }}</p>

                                    <div class="tags-container">
                                        <span class="tag-circular">LEITURA</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endfor
                @elseif (! $destaque)
                    <div class="empty-state">
                        <p>Nenhuma publicação encontrada no momento. Volte mais tarde!</p>
                    </div>
                @endif
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
            const items = Array.from(document.querySelectorAll('.searchable-item'));
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

            function filtrarItens(termo) {
                const q = (termo || '').trim().toLowerCase();
                if (!q) {
                    items.forEach(el => el.style.display = '');
                    if (banner) banner.classList.remove('visivel');
                    return;
                }

                let encontrados = 0;
                items.forEach(el => {
                    const texto = (el.getAttribute('data-search') || '').toLowerCase();
                    const match = texto.includes(q);
                    el.style.display = match ? '' : 'none';
                    if (match) encontrados++;
                });

                if (banner && statusEl) {
                    statusEl.textContent = encontrados > 0
                        ? `A mostrar ${encontrados} resultado(s) para "${termo.trim()}".`
                        : `Nenhuma publicação encontrada para "${termo.trim()}".`;
                    banner.classList.add('visivel');
                }
            }

            if (searchInput) {
                searchInput.addEventListener('input', function () {
                    filtrarItens(this.value);
                });

                if (searchBar) {
                    searchBar.addEventListener('submit', function (e) {
                        e.preventDefault();
                        const q = searchInput.value.trim();
                        filtrarItens(q);
                        const url = new URL(window.location.href);
                        if (q) url.searchParams.set('q', q);
                        else url.searchParams.delete('q');
                        window.history.replaceState({}, '', url);
                        closeAll();
                    });
                }

                if (searchInput.value.trim()) {
                    filtrarItens(searchInput.value.trim());
                }
            }

            if (limparBtn) {
                limparBtn.addEventListener('click', function () {
                    if (searchInput) searchInput.value = '';
                    filtrarItens('');
                    const url = new URL(window.location.href);
                    url.searchParams.delete('q');
                    window.history.replaceState({}, '', url);
                });
            }
        });
    </script>
</body>

</html>