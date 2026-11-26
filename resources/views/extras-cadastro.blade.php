<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="theme-color" content="#898AC4">
    <title>Criar Conta | Olhar Que Protege</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/js/firebase-auth.js'])

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

        .button:disabled {
            opacity: 0.65;
            cursor: not-allowed;
            transform: none;
        }

        .button-google {
            width: 100%;
            border: 1px solid #dedff0;
            border-radius: 11px;
            padding: 13px 16px;
            background: #ffffff;
            color: #343456;
            font-family: inherit;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            margin-top: 12px;
            transition: .2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        .button-google:hover {
            background: #f7f7fc;
            border-color: #898ac4;
        }

        .button-google:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .google-icon {
            width: 20px;
            height: 20px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .phone-box {
            margin-top: 22px;
            padding: 18px;
            border-radius: 14px;
            background: #f8f8fd;
            border: 1px solid #dedff0;
        }

        .phone-title {
            font-size: 13px;
            font-weight: 800;
            color: #343456;
            margin-bottom: 12px;
            text-align: center;
        }

        .button-secondary {
            width: 100%;
            border: 1px solid #898ac4;
            border-radius: 11px;
            padding: 12px 14px;
            background: #ffffff;
            color: #7776bd;
            font-family: inherit;
            font-size: 12px;
            font-weight: 800;
            cursor: pointer;
            transition: .2s;
        }

        .button-secondary:hover {
            background: #f0effc;
        }

        .button-secondary:disabled {
            opacity: 0.65;
            cursor: not-allowed;
        }

        .sms-step {
            display: none;
            margin-top: 14px;
        }

        .sms-step.active {
            display: block;
        }

        #recaptcha-container {
            margin-top: 14px;
            display: flex;
            justify-content: center;
            overflow-x: auto;
        }

        .divider {
            text-align: center;
            font-size: 11px;
            font-weight: 700;
            color: #8e8ea6;
            margin: 16px 0 6px;
            text-transform: uppercase;
            letter-spacing: 1px;
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

        .status-box {
            display: none;
            padding: 13px;
            border-radius: 10px;
            font-size: 12px;
            line-height: 1.7;
            margin-bottom: 20px;
        }

        .status-box.error {
            display: block;
            background: #fff0f0;
            color: #a52b3a;
        }

        .status-box.success {
            display: block;
            background: #eefaf3;
            color: #1f6f43;
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

        <p class="tag">Junte-se a nós</p>
        <h1>Crie sua conta</h1>

        <p class="description">
            Cadastre-se para começar a acessar
            os conteúdos exclusivos do Olhar Que Protege.
        </p>

        @if ($errors->any())
            <div class="errors" role="alert">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <div id="firebase-status" class="status-box" role="alert"></div>

        <form id="cadastro-form" method="POST" action="{{ route('extras.register.submit') }}">
            @csrf
            <input type="hidden" id="firebase_token" name="firebase_token">
            <input type="hidden" id="verified_phone" name="phone_number">

            <div class="field">
                <label for="name">Nome completo</label>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="{{ old('name') }}"
                    autocomplete="name"
                    placeholder="Seu nome completo"
                    required
                >
            </div>

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
                    autocomplete="new-password"
                    placeholder="Mínimo de 8 caracteres"
                    required
                >
            </div>

            <div class="field">
                <label for="password_confirmation">Confirme a senha</label>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    placeholder="Repita sua senha"
                    required
                >
            </div>

            <button id="btn-submit" class="button" type="submit">
                Criar minha conta
            </button>

            <div class="divider">ou</div>

            <button id="btn-google" class="button-google" type="button">
                <img
                    src="{{ asset('assets/img/logogoogle.png') }}"
                    alt="Google"
                    class="google-icon"
                >
                <span>Continuar com Google</span>
            </button>

            <div class="phone-box">
                <div class="phone-title">Cadastrar / Entrar com SMS</div>

                <div class="field" style="margin-bottom: 12px;">
                    <label for="phone_input">Telefone (formato E.164)</label>
                    <input
                        id="phone_input"
                        type="tel"
                        value="+5514999990001"
                        placeholder="+5514999990001"
                    >
                </div>

                <button id="btn-send-sms" class="button-secondary" type="button">
                    Enviar código SMS
                </button>

                <div id="sms-step" class="sms-step">
                    <div class="field" style="margin-bottom: 12px;">
                        <label for="sms_code">Código de 6 dígitos</label>
                        <input
                            id="sms_code"
                            type="text"
                            maxlength="6"
                            placeholder="123456"
                        >
                    </div>

                    <button id="btn-verify-sms" class="button" type="button">
                        Confirmar código e acessar
                    </button>
                </div>

                <div id="recaptcha-container"></div>
            </div>
        </form>

        <div class="footer">
            Já possui uma conta?
            <a href="{{ route('extras.login') }}">Entrar</a>
        </div>

        <a href="{{ route('home') }}" class="back">
            ← Voltar para a página inicial
        </a>
    </main>

    <script type="module">
        const form = document.getElementById("cadastro-form");
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const passwordInput = document.getElementById("password");
        const passwordConfirmInput = document.getElementById("password_confirmation");
        const tokenInput = document.getElementById("firebase_token");
        const verifiedPhoneInput = document.getElementById("verified_phone");

        const phoneInput = document.getElementById("phone_input");
        const smsStep = document.getElementById("sms-step");
        const smsCodeInput = document.getElementById("sms_code");

        const btnSubmit = document.getElementById("btn-submit");
        const btnGoogle = document.getElementById("btn-google");
        const btnSendSms = document.getElementById("btn-send-sms");
        const btnVerifySms = document.getElementById("btn-verify-sms");
        const statusBox = document.getElementById("firebase-status");

        function mostrarStatus(mensagem, tipo = "error") {
            statusBox.textContent = mensagem;
            statusBox.className = `status-box ${tipo}`;
        }

        function setBotoesDesabilitados(desabilitar) {
            btnSubmit.disabled = desabilitar;
            btnGoogle.disabled = desabilitar;
            btnSendSms.disabled = desabilitar;
            btnVerifySms.disabled = desabilitar;
        }

        function liberarCamposParaFirebase() {
            nameInput.removeAttribute("required");
            emailInput.removeAttribute("required");
            passwordInput.removeAttribute("required");
            passwordConfirmInput.removeAttribute("required");

            if (!passwordInput.value) {
                const senhaTemporaria = "Firebase#" + Math.random().toString(36).slice(2, 12);
                passwordInput.value = senhaTemporaria;
                passwordConfirmInput.value = senhaTemporaria;
            }
        }

        function traduzirErroFirebase(code) {
            switch (code) {
                case "auth/email-already-in-use":
                    return "Este e-mail já está cadastrado.";
                case "auth/invalid-email":
                    return "Formato de e-mail inválido.";
                case "auth/weak-password":
                    return "A senha deve ter pelo menos 6 caracteres.";
                case "auth/invalid-phone-number":
                    return "Número de telefone inválido. Use o formato +5514999990001.";
                case "auth/invalid-verification-code":
                    return "Código SMS inválido.";
                case "auth/too-many-requests":
                    return "Muitas tentativas. Aguarde um pouco e tente novamente.";
                case "auth/popup-closed-by-user":
                    return "A janela de login do Google foi fechada antes de concluir.";
                case "auth/popup-blocked":
                    return "O navegador bloqueou o pop-up do Google. Permita pop-ups para este site.";
                default:
                    return `Erro na autenticação (${code || "desconhecido"}).`;
            }
        }

        form.addEventListener("submit", async (event) => {
            event.preventDefault();

            if (!window.firebaseAuth) {
                mostrarStatus("Aguarde a inicialização do serviço de autenticação...", "error");
                return;
            }

            const { cadastrarComEmail } = window.firebaseAuth;
            const nome = nameInput.value.trim();
            const email = emailInput.value.trim();
            const senha = passwordInput.value;
            const confirmacao = passwordConfirmInput.value;

            if (senha !== confirmacao) {
                mostrarStatus("As senhas não coincidem.", "error");
                return;
            }

            setBotoesDesabilitados(true);
            mostrarStatus("Criando sua conta no Firebase...", "success");

            try {
                const user = await cadastrarComEmail(email, senha, nome);

                tokenInput.value = await user.getIdToken();
                mostrarStatus("Conta criada! Redirecionando para /extras...", "success");

                form.submit();
            } catch (error) {
                mostrarStatus(traduzirErroFirebase(error.code), "error");
                setBotoesDesabilitados(false);
            }
        });

        btnGoogle.addEventListener("click", async () => {
            if (!window.firebaseAuth) {
                mostrarStatus("Aguarde a inicialização do serviço de autenticação...", "error");
                return;
            }

            const { entrarComGoogle } = window.firebaseAuth;

            setBotoesDesabilitados(true);
            mostrarStatus("Conectando com o Google...", "success");

            try {
                const user = await entrarComGoogle();

                if (!nameInput.value.trim() && user.displayName) {
                    nameInput.value = user.displayName;
                }
                if (!emailInput.value.trim() && user.email) {
                    emailInput.value = user.email;
                }

                liberarCamposParaFirebase();
                tokenInput.value = await user.getIdToken();
                mostrarStatus("Autenticado com o Google! Redirecionando para /extras...", "success");

                form.submit();
            } catch (error) {
                mostrarStatus(traduzirErroFirebase(error.code), "error");
                setBotoesDesabilitados(false);
            }
        });

        btnSendSms.addEventListener("click", async () => {
            if (!window.firebaseAuth) {
                mostrarStatus("Aguarde a inicialização do serviço de autenticação...", "error");
                return;
            }

            const telefone = phoneInput.value.trim();
            if (!telefone.startsWith("+")) {
                mostrarStatus("Informe o telefone com DDI, ex: +5514999990001.", "error");
                return;
            }

            const { enviarCodigoTelefone } = window.firebaseAuth;

            setBotoesDesabilitados(true);
            mostrarStatus("Enviando código SMS...", "success");

            try {
                await enviarCodigoTelefone(telefone, "recaptcha-container", false);
                smsStep.classList.add("active");
                mostrarStatus("Código enviado!", "success");
            } catch (error) {
                mostrarStatus(traduzirErroFirebase(error.code) || error.message, "error");
            } finally {
                setBotoesDesabilitados(false);
            }
        });

        btnVerifySms.addEventListener("click", async () => {
            if (!window.firebaseAuth) {
                mostrarStatus("Aguarde a inicialização do serviço de autenticação...", "error");
                return;
            }

            const codigo = smsCodeInput.value.trim();
            if (codigo.length < 6) {
                mostrarStatus("Digite o código de 6 dígitos.", "error");
                return;
            }

            const { confirmarCodigoTelefone } = window.firebaseAuth;

            setBotoesDesabilitados(true);
            mostrarStatus("Confirmando código SMS...", "success");

            try {
                const user = await confirmarCodigoTelefone(codigo);
                verifiedPhoneInput.value = user.phoneNumber || phoneInput.value.trim();
                tokenInput.value = await user.getIdToken();

                liberarCamposParaFirebase();
                mostrarStatus("Telefone verificado! Redirecionando para /extras...", "success");

                form.submit();
            } catch (error) {
                mostrarStatus(traduzirErroFirebase(error.code) || error.message, "error");
                setBotoesDesabilitados(false);
            }
        });
    </script>
</body>
</html>