<nav class="extras-navbar">
    <link rel="stylesheet" href="{{ asset('assets/css/extras.css') }}">

    <div class="extras-nav-left">
        <!-- Logo -->
        <div class="extras-brand">
            <a href="{{ route('blog.index') }}">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="130" height="auto" alt="Logo Olhar Que Protege" />
            </a>
        </div>

        <!-- Links de Navegação -->
        <div class="extras-nav-links">
            <a href="{{ route('blog.index') }}" class="extras-nav-link {{ request()->routeIs('blog.index') ? 'active' : '' }}">Blog</a>
            <a href="{{ url('/videos') }}" class="extras-nav-link {{ request()->is('videos*') ? 'active' : '' }}">Vídeos</a>
            <a href="{{ route('extras') }}" class="extras-nav-link {{ request()->routeIs('extras') ? 'active' : '' }}">Conteúdos Exclusivos</a>
        </div>
    </div>

    <div class="extras-nav-right">
        <span class="extras-user-name">{{ Auth::user()->name ?? Auth::user()->nome }}</span>
        
        <a href="{{ route('profile.edit') }}" class="extras-nav-link" style="font-size: 0.85rem;">Perfil</a>

        <!-- Logout -->
        <form method="POST" action="{{ route('extras.logout') }}" style="margin: 0;">
            @csrf
            <button type="submit" class="extras-logout-btn">Sair</button>
        </form>
    </div>
</nav>