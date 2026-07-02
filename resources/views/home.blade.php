@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-[#b9b7df]">

        <nav class="bg-[#f0e8db] shadow-md">
            <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-orange-500 rounded-full flex items-center justify-center">
                        🛡️
                    </div>

                    <div>
                        <h1 class="font-black text-xl text-[#1f3264] leading-none">
                            OLHAR
                        </h1>

                        <h1 class="font-black text-xl text-[#1f3264] leading-none">
                            QUE PROTEGE
                        </h1>
                    </div>
                </div>

                <div class="flex gap-8 font-bold text-[#1f3264]">
                    <a href="/sobre" class="hover:text-purple-700">Sobre</a>
                    <a href="#" class="hover:text-purple-700">Vídeos</a>
                    <a href="#" class="hover:text-purple-700">Blogs</a>
                    <a href="#" class="hover:text-purple-700">Login</a>
                </div>

            </div>
        </nav>


        <section class="py-16">

            <div class="max-w-6xl mx-auto px-6">

                <h1 class="text-center text-5xl font-black text-[#6d69a5]">
                    MONITORAR = CUIDAR
                </h1>

                <p class="text-center max-w-4xl mx-auto mt-5 text-gray-700">
                    Muitas ameaças estão expostas a nossos menores.
                    É de extrema importância que os responsáveis estejam atentos
                    ao comportamento online, orientando e oferecendo diálogo aberto
                    para garantir a segurança digital deles.
                </p>

                <div class="mt-12 rounded-3xl overflow-hidden shadow-xl">

                    <img src="banner1.png" class="w-full h-[450px] object-cover">

                </div>

            </div>

        </section>


        <section class="py-24">

            <div class="max-w-5xl mx-auto">

                <div class="relative flex flex-wrap justify-center gap-8">

                    <div class="bubble bg-[#f2ead7]" data-message="Amar é estar presente também no mundo digital.">
                        AMAR
                    </div>

                    <div class="bubble bg-white" data-message="Cuidar é acompanhar sem invadir.">
                        CUIDAR
                    </div>

                    <div class="bubble bg-[#8d8ae6]" data-message="Zelar pela segurança online é proteger o futuro.">
                        ZELAR
                    </div>

                    <div class="bubble bg-[#b7b4ff]" data-message="Evite que pessoas mal-intencionadas se aproximem.">
                        EVITAR
                    </div>

                </div>

                <div id="bubble-message"
                    class="mt-12 max-w-xl mx-auto bg-white rounded-2xl shadow-lg p-6 text-center text-lg text-gray-700 hidden">
                </div>

            </div>

        </section>

        <section class="py-20">

            <div class="max-w-6xl mx-auto px-6">

                <div class="grid md:grid-cols-3 gap-8">

                    <div class="bg-white rounded-3xl p-8 shadow-lg">

                        <div class="text-5xl mb-4">🎥</div>

                        <h3 class="font-bold text-2xl text-[#1f3264]">
                            Vídeos Educativos
                        </h3>

                        <p class="mt-3 text-gray-600">
                            Aprenda através de vídeos rápidos e objetivos sobre
                            segurança digital.
                        </p>

                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-lg">

                        <div class="text-5xl mb-4">📝</div>

                        <h3 class="font-bold text-2xl text-[#1f3264]">
                            Blogs
                        </h3>

                        <p class="mt-3 text-gray-600">
                            Artigos completos explicando golpes,
                            redes sociais e proteção infantil.
                        </p>

                    </div>

                    <div class="bg-white rounded-3xl p-8 shadow-lg">

                        <div class="text-5xl mb-4">🛡️</div>

                        <h3 class="font-bold text-2xl text-[#1f3264]">
                            Treinamentos
                        </h3>

                        <p class="mt-3 text-gray-600">
                            Conteúdos aprofundados para pais,
                            professores e responsáveis.
                        </p>

                    </div>

                </div>

            </div>

        </section>


        <section class="pb-24">

            <div class="max-w-4xl mx-auto px-6">

                <div class="bg-[#7b78c4] rounded-3xl p-12 text-center shadow-xl">

                    <h2 class="text-4xl font-black text-white">
                        Cuidar e Amar Pode Salvar e Poupar.
                    </h2>

                    <p class="text-white mt-5 text-lg">
                        Comece hoje a aprender como proteger seus filhos dos perigos da internet.
                    </p>

                    <button class="mt-8 bg-white text-[#7b78c4] px-8 py-4 rounded-xl font-bold hover:scale-105 transition">
                        Começar Agora
                    </button>

                </div>

            </div>

        </section>

    </div>

    <style>
        .bubble {
            width: 180px;
            height: 180px;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 900;
            font-size: 2rem;
            color: #5b2f75;
            cursor: pointer;
            transition: all .4s ease;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .1);
        }

        .bubble:hover {
            transform: scale(1.25);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {

            const bubbles = document.querySelectorAll('.bubble');
            const messageBox = document.getElementById('bubble-message');

            bubbles.forEach(bubble => {

                bubble.addEventListener('mouseenter', () => {

                    messageBox.classList.remove('hidden');

                    messageBox.innerHTML =
                        bubble.getAttribute('data-message');

                });

            });

        });
    </script>
@endsection
