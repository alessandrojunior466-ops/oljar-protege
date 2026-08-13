<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Garante que existe pelo menos um usuário no banco para associar como autor
        $user = User::first() ?? User::factory()->create([
            'nome' => 'Alessandro',
            'email' => 'alessandro@olharqueprotege.com',
            'password' => Hash::make('alequeprotege709'),
        ]);

        // Lista de vídeos correspondente à estrutura da tela e arquivos na pasta storage
        $videos = [
            [
                'titulo'    => 'Terceiro Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Terceiro Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/F8PCdITz4DZyiOxnpjSmiwkAWCImENfxwPm1fbTB.mp4',
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Segundo Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Segundo Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/PFJ9OKMDGK7nS4jk8ZeOZH5DtXv8eTTk.mp4', // ajuste a extensão caso não seja .mp4
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Vídeo Inicial de Apresentação',
                'descricao' => 'Breve descrição do Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/urEmwu5kZDEfYINjFScZZa78vazf0Xk3U3.mp4', // ajuste a extensão caso não seja .mp4
                'user_id'   => $user->id,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}