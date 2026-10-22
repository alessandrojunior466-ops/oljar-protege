<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#898AC4">
    <title>Entrar | Olhar Que Protege</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(135deg, #c0c9ee, #f4eaff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px 16px;
            color: #343456;
        }

        .container {
            width: 100%;
            max-width: 440px;
            background: white;
            padding: 42px;
            border-radius: 24px;
            box-shadow: 0 15px 45px rgba(75, 69, 130, .15);
        }

        .logo {
            display: block;
            width: 130px;
            height: auto;
            margin: 0 auto 28px;
        }

        .tag {
            text-align: center;
            color: #7776bd;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 11px;
            font-weight: 800;
            margin-bottom: 12px;
        }

        h1 {
            text-align: center;
            font-size: 29px;
            margin-bottom: 12px;
        }

        .description {
            color: #77778c;
            font-size: 13px;
            line-height: 1.8;
            text-align: center;
            margin-bottom: 30px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 15px;
            border: 1px solid #dedff0;
            border-radius: 11px;
            font-family: inherit;
            font-size: 13px;
            outline: none;
            transition: .2s;
        }

        input:focus {
            border-color: #898ac4;
            box-shadow: 0 0 0 3px #898ac422;
        }

        .button {
            width: 100%;
            border: none;
            border-radius: 11px;
            padding: 15px;
            background: #898ac4;
            color: white;
            font-family: inherit;
            font-weight: 800;
            cursor: pointer;
            margin-top: 6px;
            transition: .2s;
        }

        .button:hover {
            background: #7071ad;
            transform: translateY(-1px);
        }

        .errors {
            padding: 13px;
            border-radius: 10px;
            background: #fff0f0;
            color: #a52b3a;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .footer {
            margin-top: 25px;
            text-align: center;
            font-size: 12px;
            color: #77778c;
            line-height: 1.9;
        }

        a {
            color: #7776bd;
            font-weight: 800;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back {
            display: block;
            text-align: center;
            font-size: 12px;
            margin-top: 22px;
        }

        @media (max-width: 480px) {
            .container {
                padding: 30px 23px;
            }
        }
    </style>
</head>
<body>
    <main class="container">
        <img
            src="{{ asset('assets/img/olhar_que_protege_transparente.svg') }}"
            alt="Olhar Que Protege"
            class="logo"
        >

        <p class="tag">Bem-vindo de volta</p>
        <h1>Que bom ter você aqui!</h1>

        <p class="description">
            Entre na sua conta para continuar acessando
            os conteúdos exclusivos do Olhar Que Protege.
        </p>

        @if ($errors->any())
            <div class="errors" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('extras.login.submit') }}">
            @csrf

            <div class="field">
                <label for="email">E-mail</label>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    placeholder="seuemail@olharqueprotege.com"
                    required
                >
            </div>

            <div class="field">
                <label for="password">Senha</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    placeholder="Digite sua senha"
                    required
                >
            </div>

            <button class="button" type="submit">
                Entrar na minha conta
            </button>
        </form>

        <div class="footer">
            Ainda não tem uma conta?
            <a href="{{ route('extras.register') }}">Cadastre-se</a>
        </div>

        <a href="{{ route('home') }}" class="back">
            ← Voltar para a página inicial
        </a>
    </main>
</body>
</html>
```