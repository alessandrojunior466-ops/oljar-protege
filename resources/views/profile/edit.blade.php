<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Perfil</title>
    <!-- Reaproveitando o CSS do Dashboard para manter a identidade -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashboard.css') }}">
</head>

<body>
    <div class="dashboard-container">

        <!-- BARRA LATERAL (SIDEBAR) -->
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="160" height="auto"
                    alt="Logo" />
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('dashboard') }}" class="menu-item">Dashboard</a>
            </nav>

            <div class="sidebar-footer">
                <div class="user-info">
                    <p class="user-name">{{ Auth::user()->nome }}</p>
                    <p class="user-email">{{ Auth::user()->email }}</p>
                </div>

                <div class="footer-actions">
                    <a href="{{ route('profile.edit') }}" class="btn-profile">Perfil</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn-logout">Sair</button>
                    </form>
                </div>
            </div>
        </aside>

        <!-- CONTEÚDO PRINCIPAL (FORMULÁRIOS) -->
        <main class="main-content">
            <header class="content-header">
                <h1>Meu Perfil</h1>
            </header>

            <section class="content-body">

                <!-- Bloco 1: Informações do Perfil -->
                <div class="welcome-card">
                    @include('profile.partials.update-profile-information-form')
                </div>

                <!-- Bloco 2: Atualizar Senha -->
                <div class="welcome-card">
                    @include('profile.partials.update-password-form')
                </div>

                <!-- Bloco 3: Deletar Conta -->
                <div class="welcome-card">
                    @include('profile.partials.delete-user-form')
                </div>

            </section>
        </main>

    </div>
</body>

</html>
