<x-app-layout>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/extras.css') }}">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="display: none;">
            {{ __('Painel Exclusivo') }}
        </h2>
    </x-slot>

    <div class="extras-wrapper">
        <div class="extras-card-modern">
            
            <span class="badge-restricted">
                🔒 Área Restrita &bull; Membros
            </span>
            
            <h1 class="extras-title-modern">
                Bem-vindo aos Conteúdos Exclusivos!
            </h1>

            <p class="extras-desc-modern">
                Esta área é dedicada aos usuários cadastrados da plataforma <strong>Olhar Que Protege</strong>. Aqui você tem acesso antecipado a materiais de apoio, guias avançados de segurança digital e recursos educacionais exclusivos para a sua proteção.
            </p>

            <div class="extras-actions-modern">
                <a href="{{ route('blog.index') }}" class="btn-primary-modern">
                    Explorar Artigos do Blog
                </a>

                <a href="{{ route('home') }}" class="btn-secondary-modern">
                    Voltar à página inicial
                </a>
            </div>

        </div>
    </div>
</x-app-layout>