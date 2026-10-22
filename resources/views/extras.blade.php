
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Conteúdos Exclusivos
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-lg p-6">
                <h1 class="text-2xl font-bold mb-4">
                    Bem-vindo aos Conteúdos Exclusivos!
                </h1>

                <p class="text-gray-600">
                    Esta área é destinada aos usuários cadastrados
                    do Olhar Que Protege.
                </p>

                <div class="mt-6">
                    <a href="{{ route('home') }}"
                       class="text-indigo-600 hover:underline">
                        Voltar à página inicial
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
C:\xampp\htdocs\oljar-protege\resources\views\profile\extras.blade.php