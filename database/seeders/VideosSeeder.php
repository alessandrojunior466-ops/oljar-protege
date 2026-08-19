<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class VideosSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'alessandro@olharqueprotege.com'],
            [
                'nome' => 'Alessandro',
                'password' => Hash::make('alequeprotege709'),
            ]
        );

        $videos = [
            [
                'titulo'    => 'Terceiro Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Terceiro Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/urEMwu5kZDEfYlNjFScZZa78vazf0Xk3U3JNBqvB.mp4',
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Segundo Vídeo de Apresentação',
                'descricao' => 'Breve descrição do Segundo Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/PFJ9OKMDGK7nS4jk8ZeOZH5DtXv8eTTkWewTH8XV.mp4',
                'user_id'   => $user->id,
            ],
            [
                'titulo'    => 'Vídeo Inicial de Apresentação',
                'descricao' => 'Breve descrição do Vídeo Inicial de Apresentação',
                'arquivo'   => 'videos/F8PCdITz4DZyiOxnpjSmiwkAWCImENfxwPm1fbTB.mp4',
                'user_id'   => $user->id,
            ],
        ];

        foreach ($videos as $video) {
            Video::create($video);
        }
    }
}
