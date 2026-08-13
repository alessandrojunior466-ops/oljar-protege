<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar os usuários administradores
        User::factory()->create([
            'nome' => 'Alessandro',
            'email' => 'alessandro@olharqueprotege.com',
            'password' => Hash::make('alequeprotege709'),
        ]);

        User::factory()->create([
            'nome' => 'Ana',
            'email' => 'ana@olharqueprotege.com',
            'password' => Hash::make('anaqueprotege709'),
        ]);

        User::factory()->create([
            'nome' => 'Felipe',
            'email' => 'felipe@olharqueprotege.com',
            'password' => Hash::make('fequeprotege709'),
        ]);

        User::factory()->create([
            'nome' => 'Luis',
            'email' => 'luis@olharqueprotege.com',
            'password' => Hash::make('luqueprotege709'),
        ]);

        // 2. Chamar os outros Seeders (Publicações do Blog e Vídeos)
        $this->call([
            BlogSeeder::class,
            VideosSeeder::class,
        ]);
    }
}
