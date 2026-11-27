<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $temYoutubeUrl = Schema::hasColumn('blogs', 'youtube_url');

        $posts = [
            // PRIMEIRA POSTAGEM (No topo do painel)
            [
                'titulo'      => 'Você conhece o Google Family Link?',
                'conteudo'    => "Este vídeo faz parte do Curso Google Family Link\n\nSeus filhos estão muito conectados? Você sabia que dá pra limitar o uso do celular de forma fácil e automática?\n🚫 Mensagens? Proibido!\n😴 Celular depois das 22h? Não pode! Com o Google Family Link, você pode controlar exatamente o que seu filho pode fazer no smartphone.\n\nDesde 2017, o Family Link vem sendo atualizado, permitindo que os pais criem regras sobre o que os filhos podem acessar, o tempo de tela e até mesmo em quais horários eles podem usar o celular.\n\n📅 Seja Android ou iPhone, você terá controle total de maneira simples!\n\nQuer saber como configurar? Vou te ensinar o passo a passo para usar o Google Family Link e garantir uma navegação segura e saudável para seus filhos! 👨‍👩‍👧‍👦.",
                'imagem'      => 'https://i.ytimg.com/vi/psiKm-E4hes/hqdefault.jpg?sqp=-oaymwEnCPYBEIoBSFryq4qpAxkIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB&rs=AOn4CLBtzeQPGjJm80yJssvTQ-IKY3OvfA',
                'youtube_url' => 'https://youtube.com/playlist?list=PLctQ-77DDszY',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],

            // SEGUNDA POSTAGEM (No meio do painel)
            [
                'titulo'      => '[ALERTA] NÃO DEIXE O CELULAR ESCRAVIZAR AS CRIANÇAS - vídeo educativo para mostrar pais e crianças',
                'conteudo'    => "vídeo educativo curto que mostra de forma lúdica o que os celulares fazem com as crianças e também adultos.\n\nassista e repense seus comportamentos\nestimule as crianças a brincadeiras saudáveis.",
                'imagem'      => 'https://i.ytimg.com/vi/uuDbHj1P8dU/hqdefault.jpg?sqp=-oaymwEmCOADEOgC8quKqQMa8AEB-AGoA4AC8AGKAgwIABABGFwgXChcMA8=&rs=AOn4CLBZNnWzYXBZouh9WNhZ9aQrAavuOA',
                'youtube_url' => 'https://www.youtube.com/watch?v=uuDbHj1P8dU',
                'created_at'  => now()->subDays(1),
                'updated_at'  => now()->subDays(1),
            ],

            // TERCEIRA POSTAGEM (No final do painel)
            [
                'titulo'      => 'Plataforma Roblox é alvo de denúncias e investigações por riscos a crianças',
                'conteudo'    => 'A reportagem do SP Record expõe os perigos da segurança infantil na plataforma Roblox, onde pais denunciam a presença de conteúdo impróprio e riscos de interação com adultos. Popular entre crianças, a plataforma enfrenta críticas pela falta de controle rigoroso. Investigações sobre exploração de trabalho infantil estão em andamento, enquanto a Roblox afirma investir em segurança com o uso de inteligência artificial.',
                'imagem'      => 'https://www.pichauarena.com.br/wp-content/uploads/2025/07/Millions-of-immersive-experiences-on-Roblox-2048x1152.png.webp',
                'youtube_url' => 'https://www.youtube.com/watch?v=greZh5h4O1A',
                'created_at'  => now()->subDays(2),
                'updated_at'  => now()->subDays(2),
            ],
        ];

        foreach ($posts as $post) {
            $dados = [
                'conteudo'   => $post['conteudo'],
                'imagem'     => $post['imagem'],
                'created_at' => $post['created_at'],
                'updated_at' => $post['updated_at'],
            ];

            if ($temYoutubeUrl) {
                $dados['youtube_url'] = $post['youtube_url'];
            }

            Blog::updateOrCreate(
                ['titulo' => $post['titulo']],
                $dados
            );
        }

        $this->command->info('BlogSeeder executado com sucesso (imagens e links do YouTube configurados)!');
    }
}