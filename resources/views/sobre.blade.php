<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Sobre</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/topbar-shared.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/sobre.css') }}">
</head>

<body>
    <div class="container">
        <header>
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

                <!-- Barra de Pesquisa Global -->
                <form action="{{ route('blog.index') }}" method="GET" class="search-bar" id="searchBar" data-page-type="text" role="search">
                    <input type="search" name="q" id="searchInput" class="search-input" value="{{ request('q') }}" placeholder="Pesquisar na página ou no site..." aria-label="Pesquisar" autocomplete="off" />
                    <button type="submit" class="search-submit" aria-label="Confirmar busca">
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>
            </div>
        </header>

        <div class="nav-backdrop" id="navBackdrop"></div>

        <main id="conteudoPesquisavel">
            <div class="busca-banner" id="buscaBanner">
                <span id="buscaStatus"></span>
                <button type="button" class="busca-limpar-btn" id="limparBuscaBtn">Limpar destaque</button>
            </div>

            <div class="conteudo-info">

                <section class="secao-bloco">
                    <img class="imagem-bloco" src="{{ asset('assets/img/tiazinha.jpg') }}" alt="Menina Chorando" />
                    <div class="texto-bloco">
                        <h1>Monitoramento Digital: Proteção Essencial para Suas Filhas</h1>
                        <p>
                            A internet representa hoje uma dimensão essencial da vida, oferecendo
                            um portal vasto de conhecimento e conexão. Contudo, para crianças e
                            adolescentes, essa ferramenta poderosa está intrinsecamente ligada a
                            uma série de riscos e vulnerabilidades que exigem uma atuação
                            protetora e ativa dos pais. Monitorar o uso da internet por suas
                            filhas — sejam elas crianças curiosas, pré-adolescentes exploradoras
                            ou adolescentes em busca de identidade — não deve ser visto como uma
                            invasão, mas sim como uma medida fundamental de segurança, carinho e
                            orientação no complexo ambiente digital.
                        </p>
                        <p>
                            O principal motivo para a vigilância é a proteção contra predadores e
                            assédio online. Indivíduos mal-intencionados frequentemente se
                            disfarçam em plataformas populares, como jogos e redes sociais,
                            visando a aproximação e o aliciamento. O acompanhamento regular e
                            discreto permite identificar e bloquear rapidamente contatos ou
                            comportamentos inadequados. Além disso, o monitoramento é vital na
                            prevenção e intervenção contra o cyberbullying, garantindo que suas
                            filhas não sejam vítimas de agressões virtuais que podem causar danos
                            psicológicos profundos e duradouros, ou mesmo autoras desses atos,
                            necessitando de correção imediata.
                        </p>
                        <p>
                            Outra preocupação central é a exposição a conteúdo inapropriado.
                            Apesar dos filtros e restrições, o acesso acidental ou intencional a
                            material violento, explícito ou que promova extremismo é um risco
                            constante. A supervisão atenta permite garantir que o consumo digital
                            esteja alinhado com a maturidade da criança ou adolescente. Igualmente
                            crucial é a necessidade de gerenciar a saúde mental e o tempo de tela.
                            A constante comparação com padrões irreais nas redes sociais pode
                            levar a distúrbios de autoimagem, ansiedade e depressão. Além disso, o
                            uso descontrolado pode resultar em vício em telas, prejudicando o
                            desempenho acadêmico, o sono e as interações sociais presenciais. Por
                            fim, a navegação sem supervisão expõe a família a riscos de fraudes e
                            roubo de dados, já que menores nem sempre compreendem os perigos de
                            compartilhar informações pessoais ou clicar em links maliciosos.
                        </p>
                        <p>
                            A maneira mais eficaz de monitorar, no entanto, é através de uma
                            combinação de tecnologia e diálogo aberto. O estabelecimento conjunto
                            de regras claras sobre tempo de uso e sites permitidos, o uso de
                            ferramentas de controle parental e a simples prática de manter os
                            dispositivos em áreas comuns da casa são passos construtivos. O
                            objetivo final não é a fiscalização punitiva, mas sim educar e
                            capacitar suas filhas para que desenvolvam uma relação segura,
                            equilibrada e responsável com a vasta e poderosa ferramenta que é a
                            internet.
                        </p>
                    </div>
                </section>

                <section class="secao-bloco invertida">
                    <img class="imagem-bloco" src="{{ asset('assets/img/familycircle.png') }}" alt="Círculo Familiar" />
                    <div class="texto-bloco">
                        <h1>Olhar Que Protege: O Conhecimento que Transforma Preocupação em Segurança Real.</h1>
                        <h2>A sua filha merece crescer protegida, e você merece a tranquilidade de saber como
                            defendê-la.</h2>
                        <p>
                            Em um mundo de constante evolução, as ameaças à segurança de nossas
                            meninas também mudam. A inocência da infância é colocada à prova
                            diariamente, muitas vezes, em ambientes que nem conseguimos enxergar —
                            especialmente no vasto universo digital. É por isso que criamos o
                            "Olhar Que Protege": uma plataforma de vídeos projetada para ser o seu
                            guia definitivo na missão de monitorar e proteger sua filha menor de
                            idade.
                        </p>
                        <p>
                            Nós oferecemos mais do que meras dicas; entregamos um treinamento
                            prático e acessível que capacita pais e mães a entenderem e agirem
                            sobre os riscos contemporâneos. Você aprenderá a navegar pelas redes
                            sociais e aplicativos com o conhecimento de um especialista,
                            identificando sinais sutis de cyberbullying, assédio ou envolvimento
                            com conteúdos perigosos. Além disso, ensinamos você a ir além da tela,
                            reconcendo alterações comportamentais cruciais que indicam a
                            necessidade de uma conversa e intervenção.
                        </p>
                        <p>
                            O "Olhar Que Protege" é a ponte entre o seu amor incondicional e a
                            ação protetiva eficaz. Não se trata de invadir a privacidade, mas de
                            construir uma rede de segurança sólida baseada na observação informada
                            e no diálogo aberto. Proporcione a si mesmo a paz de espírito que vem
                            de estar ativamente preparado.
                        </p>
                    </div>
                </section>

            </div>

            <section class="SobreNos">
                <h2>Como surgiu o "Olhar Que Protege"</h2>
                <p>
                    Temos o prazer de apresentar o "Olhar Que Protege", um projeto desenvolvido com paixão e expertise
                    por nossa equipe de alunos do curso técnico em Tecnologia da Informação: Alessandro, Ana, Felipe e
                    Alexandre. Nossa iniciativa nasceu não apenas de um desafio acadêmico, mas de um profundo
                    compromisso com a sociedade, alinhado diretamente à Agenda 2030 da Organização das Nações Unidas. O
                    "Olhar Que Protege" é a nossa resposta tecnológica à meta 5.2 dos Objetivos de Desenvolvimento
                    Sustentável (ODS), que visa eliminar todas as formas de violência contra todas as mulheres e
                    meninas.
                </p>
                <br>
                <p>
                    Em um mundo onde a violência e o risco, especialmente o abuso e a exploração, se manifestam
                    cada vez mais no ambiente digital, sentimos a urgência de criar uma ferramenta de empoderamento para
                    os pais. O "Olhar Que Protege" é uma plataforma de vídeos educativos que transforma o conhecimento
                    técnico em informações acessíveis, capacitando os responsáveis a monitorar proativamente o uso que
                    suas filhas menores de idade fazem da internet e das redes sociais. Nosso conteúdo ensina a
                    identificar e prevenir situações de risco online, como cyberbullying e contato com predadores, e,
                    crucialmente, a fortalecer o diálogo em casa, promovendo um ambiente seguro e de confiança.
                </p>
                <br>
                <p>
                    O projeto é a prova de que a Tecnologia da Informação não é apenas sobre códigos e sistemas, mas
                    sobre
                    soluções que salvam, protegem e transformam vidas. Por meio de uma interface simples e conteúdo
                    didático, estamos utilizando nossas habilidades em TI para construir um futuro onde as meninas
                    possam crescer livres do medo e da violência, online e offline. Esta é a nossa contribuição,
                    utilizando a TI como ferramenta para alcançar a ODS 5.2, garantindo um "Olhar Que Protege" a geração
                    de amanhã.
                </p>
            </section>
        </main>
    </div>

    <div class="mane">
        <div class="imagemzinha">
            <img src="{{ asset('assets/img/Capturar.PNG') }}" alt="Captura de tela do projeto" />
        </div>
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

    <script src="{{ asset('js/sobre.js') }}"></script>
</body>

</html>