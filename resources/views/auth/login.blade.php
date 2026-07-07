<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Olhar Que Protege - Login</title>
    <!-- Vinculando o CSS do Login -->
    <link class="sub-link" rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>
    <div class="container">

        <!-- CAIXA DE LOGIN CENTRALIZADA NA TELA -->
        <main class="container-login">
            <div class="card-login">

                <!-- Logo centralizado dentro do Card -->
                <div class="logo-login-container">
                    <img src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}" width="180"
                        height="auto" alt="Logo" />
                </div>

                @if ($errors->any())
                    <div class="erros-alerta">
                        E-mail ou senha incorretos.
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Campo Email -->
                    <div class="grupo-input">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus autocomplete="username" />
                    </div>

                    <!-- Campo Password -->
                    <div class="grupo-input">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required
                            autocomplete="current-password" />
                    </div>

                    <!-- Remember me -->
                    <div class="lembrar-senha">
                        <input id="remember_me" type="checkbox" name="remember">
                        <label for="remember_me">Remember me</label>
                    </div>

                    <!-- Ações -->
                    <div class="acoes-login">
                        @if (Route::has('password.request'))
                            <a class="link-esqueceu" href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        <button type="submit" class="btn-entrar">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </main>

    </div>
</body>

</html>
