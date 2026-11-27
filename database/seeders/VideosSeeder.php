<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class VideosSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'alessandro@olharqueprotege.com'],
            [
                'nome'     => 'Alessandro',
                'password' => Hash::make('alequeprotege709'),
            ]
        );

        $videos = [
            [
                'titulo'        => 'ECA Digital: Redes sociais passam por transformação com aplicação de novas regras | CNN PRIME TIME',
                'descricao'     => 'O ECA Digital completa quatro meses em vigor nesta semana. A lei criou uma série de regras para proteger crianças e adolescentes nas redes sociais, mudando a forma de consumir conteúdo. Os pais também...',
                'arquivo'       => 'https://www.youtube.com/watch?v=jMHypDuvGlc',
                'youtube_url'   => 'https://www.youtube.com/watch?v=jMHypDuvGlc',
                'thumbnail_url' => 'https://img.youtube.com/vi/jMHypDuvGlc/hqdefault.jpg',
                'midias'        => ['https://www.youtube.com/watch?v=jMHypDuvGlc'],
                'user_id'       => $user->id,
            ],
            [
                'titulo'        => '"ECA Digital": Lei que protege crianças na internet entra em vigor hoje; especialista comenta',
                'descricao'     => "Entra em vigor nesta terça-feira (17) o Estatuto Digital da Criança e do Adolescente, conhecido como \"ECA Digital\" ou \"Lei Felca\".\n\nA nova legislação impõe regras rígidas para plataformas e redes sociais, proibindo a autodeclaração de idade e exigindo mecanismos de verificação mais seguros.",
                'arquivo'       => 'https://www.youtube.com/watch?v=8vlPYxH0pFU',
                'youtube_url'   => 'https://www.youtube.com/watch?v=8vlPYxH0pFU',
                'thumbnail_url' => 'https://img.youtube.com/vi/8vlPYxH0pFU/hqdefault.jpg',
                'midias'        => ['https://www.youtube.com/watch?v=8vlPYxH0pFU'],
                'user_id'       => $user->id,
            ],
            [
                'titulo'        => 'Animação lúdica sobre segurança na internet com a Boladeira.',
                'descricao'     => "A tecnologia faz parte do nosso dia a dia — e aprender a usar com segurança é muito importante!\n\nNeste episódio, a Cowgirl e o Cowboyzinho estão em frente ao computador aprendendo sobre o uso consciente da internet. De forma leve e acessível, o vídeo apresenta a ideia de que o ECA Digital veio para proteger e orientar, e não para proibir.",
                'arquivo'       => 'https://www.youtube.com/watch?v=qclcRH5jimU',
                'youtube_url'   => 'https://www.youtube.com/watch?v=qclcRH5jimU',
                'thumbnail_url' => 'https://img.youtube.com/vi/qclcRH5jimU/hqdefault.jpg',
                'midias'        => ['https://www.youtube.com/watch?v=qclcRH5jimU'],
                'user_id'       => $user->id,
            ],
            [
                'titulo'        => 'YouTuber ensina o Google Family Link',
                'descricao'     => "Quer monitorar e controlar o celular dos seus filhos de forma segura e gratuita? Neste guia completo do canal Teteu Tutors, você vai aprender o passo a passo definitivo para configurar o aplicativo Google Family Link em 2026 e controlar o celular da sua criança.\n\nMuitos pais têm dúvidas sobre como proteger as crianças na internet. Por isso, preparei este tutorial mostrando como configurar tanto o celular do pai/responsável quanto o celular do filho.",
                'arquivo'       => 'https://youtu.be/laExLC8PfS0',
                'youtube_url'   => 'https://youtu.be/laExLC8PfS0',
                'thumbnail_url' => 'https://img.youtube.com/vi/laExLC8PfS0/hqdefault.jpg',
                'midias'        => ['https://youtu.be/laExLC8PfS0'],
                'user_id'       => $user->id,
            ],
        ];

        $titulos = array_column($videos, 'titulo');
        Video::whereIn('titulo', $titulos)->delete();

        $temYoutubeUrl   = Schema::hasColumn('videos', 'youtube_url');
        $temThumbnailUrl = Schema::hasColumn('videos', 'thumbnail_url');
        $temMidias       = Schema::hasColumn('videos', 'midias');

        foreach ($videos as $video) {
            $payload = [
                'titulo'    => $video['titulo'],
                'descricao' => $video['descricao'],
                'arquivo'   => $video['arquivo'],
                'user_id'   => $video['user_id'],
            ];

            if ($temYoutubeUrl) {
                $payload['youtube_url'] = $video['youtube_url'];
            }
            if ($temThumbnailUrl) {
                $payload['thumbnail_url'] = $video['thumbnail_url'];
            }
            if ($temMidias) {
                $payload['midias'] = $video['midias'];
            }

            Video::create($payload);
        }
    }
}