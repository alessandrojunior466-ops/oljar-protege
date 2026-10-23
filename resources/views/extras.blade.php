<x-app-layout>
    <!-- Chamada direta do CSS personalizado específico para esta página -->
    @section('styles')
        <link rel="stylesheet" href="{{ asset('assets/css/extras.css') }}">
    @endsection

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Conteúdos Exclusivos') }}
        </h2>
    </x-slot>

    <div class="py-12 extras-container">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="extras-card">
                
                <span class="inline-block bg-indigo-50 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full uppercase tracking-wider mb-3">
                    Área Restrita
                </span>
                
                <h1 class="extras-title">
                    Bem-vindo aos Conteúdos Exclusivos!
                </h1>

                <p class="extras-text">
                    Esta área é dedicada aos usuários cadastrados da plataforma <strong>Olhar Que Protege</strong>. Aqui você tem acesso antecipado a materiais de apoio, guias de segurança digital e recursos educacionais exclusivos.
                </p>

                <div class="flex items-center gap-4">
                    <a href="{{ route('blog.index') }}" class="extras-btn">
                        Explorar Artigos do Blog
                    </a>

                    <a href="{{ route('home') }}" class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-base font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 transition">
                        Voltar à página inicial
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>