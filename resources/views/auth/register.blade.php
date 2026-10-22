
<x-guest-layout>
    <style>
        .register-container {
            width: 100%;
            max-width: 430px;
            margin: 0 auto;
            padding: 28px 32px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 3px 8px rgba(20, 27, 45, 0.14);
            font-family: 'Montserrat', Arial, sans-serif;
        }

        .register-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 22px;
        }

        .register-logo img {
            width: 145px;
            height: 75px;
            object-fit: contain;
        }

        .register-title {
            margin-bottom: 22px;
            text-align: center;
        }

        .register-title h1 {
            margin: 0 0 8px;
            color: #151b30;
            font-size: 23px;
            font-weight: 700;
        }

        .register-title p {
            margin: 0;
            color: #777b86;
            font-size: 12px;
            line-height: 1.6;
        }

        .register-container label {
            display: block;
            margin-bottom: 6px;
            color: #222638;
            font-size: 13px;
            font-weight: 500;
        }

        .register-container input {
            width: 100%;
            height: 40px;
            padding: 8px 11px;
            border: 1px solid #d2d2d6;
            border-radius: 5px;
            background: #ffffff;
            color: #222638;
            font-size: 13px;
            box-sizing: border-box;
            outline: none;
        }

        .register-container input:focus {
            border-color: #f58220;
            box-shadow: 0 0 0 2px rgba(245, 130, 32, 0.12);
        }

        .register-field {
            margin-top: 15px;
        }

        .register-container .register-error {
            display: block;
            margin-top: 5px;
            color: #c62828;
            font-size: 12px;
        }

        .register-submit {
            width: 100%;
            min-height: 43px;
            margin-top: 22px;
            border: none;
            border-radius: 5px;
            background: #151b30;
            color: #ffffff;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: background 0.2s;
        }

        .register-submit:hover {
            background: #f58220;
        }

        .register-login {
            margin-top: 20px;
            text-align: center;
            color: #777b86;
            font-size: 12px;
        }

        .register-login a {
            color: #f58220;
            font-weight: 700;
            text-decoration: none;
        }

        .register-login a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .register-container {
                padding: 24px 20px;
            }
        }
    </style>

    <div class="register-container">

        <a href="{{ url('/') }}" class="register-logo">
            <img
                src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}"
                alt="Olhar Que Protege"
            >
        </a>

        <div class="register-title">
            <h1>Crie sua conta</h1>
            <p>Juntos, podemos tornar a internet mais segura para os pequenos.</p>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="name">Nome completo</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Digite seu nome completo"
                    required
                    autofocus
                    autocomplete="name"
                >
                @error('name')
                    <span class="register-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="register-field">
                <label for="email">E-mail</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="seuemail@olharqueprotege.com"
                    required
                    autocomplete="username"
                >
                @error('email')
                    <span class="register-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="register-field">
                <label for="password">Senha</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    placeholder="Crie uma senha segura"
                    required
                    autocomplete="new-password"
                >
                @error('password')
                    <span class="register-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="register-field">
                <label for="password_confirmation">Confirmar senha</label>
                <input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                    placeholder="Digite a senha novamente"
                    required
                    autocomplete="new-password"
                >
            </div>

            <button type="submit" class="register-submit">
                CRIAR MINHA CONTA
            </button>

            <div class="register-login">
                Já possui uma conta?
                <a href="{{ route('login') }}">Entrar</a>
            </div>
        </form>
    </div>
</x-guest-layout>
