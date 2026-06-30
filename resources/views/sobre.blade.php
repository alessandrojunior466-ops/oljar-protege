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
                    <a href="/">Home</a>
                    <a href="#">Vídeos</a>
                    <a href="#">Blogs</a>
                    <a href="#">Login</a>
                </div>

            </div>
        </nav>

        <section class="py-16 text-center">

            <h1 class="text-5xl font-black text-[#6d69a5]">
                SOBRE O PROJETO
            </h1>

        </section>

        <section class="max-w-7xl mx-auto px-6 py-12">

            <div class="grid md:grid-cols-2 gap-12 items-center">

                <div>
                    <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3"
                        class="rounded-3xl shadow-xl w-full">
                </div>

                <div class="bg-[#a4a1d8] p-8 rounded-3xl text-white shadow-lg">

                    <h2 class="text-3xl font-bold mb-6">
                        Por que monitorar?
                    </h2>

                    <div class="space-y-5 text-sm leading-7">

                        <p>
                            A internet representa hoje uma dimensão essencial da vida,
                            oferecendo um portal vasto de conhecimento e conexão.
                            Contudo, para crianças e adolescentes, essa ferramenta
                            poderosa está ligada a uma série de riscos e
                            vulnerabilidades que exigem uma atuação protetora e ativa
                            dos pais.
                        </p>

                        <p>
                            Monitorar o uso da internet não deve ser visto como invasão,
                            mas como uma medida fundamental de segurança, carinho e
                            orientação dentro do ambiente digital.
                        </p>

                        <p>
                            O principal motivo para a vigilância é a proteção contra
                            predadores, assédio online e cyberbullying. O
                            acompanhamento permite identificar rapidamente situações de
                            risco e agir antes que causem danos graves.
                        </p>

                        <p>
                            Além disso, a supervisão ajuda a evitar exposição a
                            conteúdos inadequados, golpes, roubo de dados e excesso de
                            tempo de tela, protegendo a saúde mental e emocional das
                            crianças e adolescentes.
                        </p>

                    </div>

                </div>

            </div>

        </section>

        <section class="max-w-7xl mx-auto px-6 py-16">

            <div class="grid md:grid-cols-2 gap-12 items-center">

                <div class="bg-[#a4a1d8] p-8 rounded-3xl text-white shadow-lg">

                    <h2 class="text-3xl font-bold mb-6">
                        Olhar Que Protege
                    </h2>

                    <h3 class="text-xl font-semibold mb-4">
                        O conhecimento que transforma preocupação em segurança real.
                    </h3>

                    <p class="mb-5 leading-7">
                        A sua filha merece crescer protegida, e você merece a
                        tranquilidade de saber como defendê-la.
                    </p>

                    <p class="mb-5 leading-7">
                        Criamos o Olhar Que Protege para ser uma plataforma de vídeos
                        educativos e treinamentos voltados à proteção de crianças e
                        adolescentes no ambiente digital.
                    </p>

                    <p class="leading-7">
                        Ensinamos pais e responsáveis a reconhecer sinais de
                        cyberbullying, assédio, golpes, manipulação e outros perigos,
                        fortalecendo o diálogo familiar e criando uma rede de proteção
                        baseada em informação e prevenção.
                    </p>

                </div>

                <div>
                    <img src="https://images.unsplash.com/photo-1511895426328-dc8714191300"
                        class="rounded-full shadow-xl w-[450px] h-[450px] object-cover mx-auto">
                </div>

            </div>

        </section>

        <section class="max-w-6xl mx-auto px-6 pb-24">

            <div class="bg-[#8e8ac9] rounded-3xl p-12 shadow-xl">

                <h2 class="text-4xl font-black text-white mb-8 text-center">
                    Como surgiu o "Olhar Que Protege"
                </h2>

                <div class="text-white leading-8 space-y-5">

                    <p>
                        O projeto foi desenvolvido pelos alunos Alessandro, Ana,
                        Felipe e Alexandre do curso técnico em Tecnologia da
                        Informação.
                    </p>

                    <p>
                        Nossa iniciativa nasceu do compromisso com a Agenda 2030 da
                        ONU, especialmente com a ODS 5.2, que busca eliminar todas as
                        formas de violência contra mulheres e meninas.
                    </p>

                    <p>
                        Percebemos que grande parte dos riscos enfrentados por crianças
                        e adolescentes acontece no ambiente digital, através de
                        cyberbullying, exploração, assédio e contato com pessoas
                        mal-intencionadas.
                    </p>

                    <p>
                        O Olhar Que Protege transforma conhecimento técnico em
                        conteúdo acessível para pais e responsáveis, ensinando como
                        identificar riscos, fortalecer o diálogo e criar um ambiente
                        seguro dentro e fora da internet.
                    </p>

                    <p>
                        Acreditamos que a Tecnologia da Informação deve ser usada para
                        proteger vidas, gerar impacto social e construir um futuro
                        mais seguro para a próxima geração.
                    </p>

                </div>

            </div>

        </section>

    </div>
@endsection
