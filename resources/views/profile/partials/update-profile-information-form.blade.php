<section>
    <header style="margin-bottom: 20px;">
        <h2 style="font-size: 18px; font-weight: 700; color: #0f172a;">Informações do Perfil</h2>
        <p style="font-size: 14px; color: #6b7280;">Atualize o nome e o endereço de e-mail da sua conta.</p>
    </header>

    <form method="POST" action="{{ route('profile.update') }}"
        style="display: flex; flex-direction: column; gap: 20px; max-width: 450px;">
        @csrf
        @method('patch')

        <!-- Campo Nome (Corrigido para 'nome') -->
        <div class="grupo-input">
            <label for="nome">Nome</label>
            <input id="nome" name="nome" type="text" value="{{ old('nome', $user->nome) }}" required autofocus
                autocomplete="name"
                style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;" />
            @if ($errors->updateProfileInformation->has('nome'))
                <span
                    style="color: #dc2626; font-size: 13px;">{{ $errors->updateProfileInformation->first('nome') }}</span>
            @endif
        </div>

        <!-- Campo Email -->
        <div class="grupo-input">
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required
                autocomplete="username"
                style="width: 100%; padding: 10px 14px; border: 1px solid #d1d5db; border-radius: 6px; font-size: 16px;" />
            @if ($errors->updateProfileInformation->has('email'))
                <span
                    style="color: #dc2626; font-size: 13px;">{{ $errors->updateProfileInformation->first('email') }}</span>
            @endif
        </div>

        <div style="display: flex; align-items: center; gap: 15px;">
            <button type="submit" class="btn-entrar" style="width: auto;">Salvar</button>

            @if (session('status') === 'profile-updated')
                <p style="font-size: 14px; color: #16a34a; font-weight: 600;">Salvo com sucesso!</p>
            @endif
        </div>
    </form>
</section>
