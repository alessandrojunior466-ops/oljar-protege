<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Video;
use App\Models\User;
use Illuminate\Support\Facades\Hash; // <-- Importação necessária para o Hash::make()

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

        Video::create([
            'titulo'    => 'Vídeo Inicial de Apresentação',
            'descricao' => 'Breve descrição do Vídeo Inicial de Apresentação',
            'arquivo'   => 'videos/F8PCdITz4DZyiOxnpjSmiwkAWCImENfxwPm1fbTB.mp4',
            'user_id'   => $user->id,
        ]);
    }
}