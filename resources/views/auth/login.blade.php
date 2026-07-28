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

                    <div class="mt-4">
                        <label for="email">Email</label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                            autofocus style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" />
                    </div>

                    <div class="mt-4">
                        <label for="password">Password</label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox" name="remember">
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a href="{{ route('password.request') }}"
                            style="margin-right: 15px; color: #666; text-decoration: none;">
                            Forgot your password?
                        </a>

                        <button type="submit"
                            style="background-color: #0f172a; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
                            LOG IN
                        </button>
                    </div>
                </form>
            </div>
        </main>

    </div>
</body>

</html>
