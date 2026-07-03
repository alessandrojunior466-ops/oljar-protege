<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// Importação explícita de todos os seus seeders personalizados
use Database\Seeders\UsuarioSeeder;
use Database\Seeders\BlogSeeder;
use Database\Seeders\VideosSeeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class, // Cria os usuários primeiro
            BlogSeeder::class,    // Cria as categorias do blog
            VideosSeeder::class,  // Cria os vídeos vinculados às categorias
        ]);
    }
}