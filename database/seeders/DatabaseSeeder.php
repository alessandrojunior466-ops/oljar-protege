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
    \App\Models\User::factory()->create([
        'nome' => 'Alessandro',
        'email' => 'alessandro@olharqueprotege.com',
        'password' => \Illuminate\Support\Facades\Hash::make('alequeprotege709'),
    ]);

    \App\Models\User::factory()->create([
        'nome' => 'Ana',
        'email' => 'ana@olharqueprotege.com',
        'password' => \Illuminate\Support\Facades\Hash::make('anaqueprotege709'),
    ]);

    \App\Models\User::factory()->create([
        'nome' => 'Felipe',
        'email' => 'felipe@olharqueprotege.com',
        'password' => \Illuminate\Support\Facades\Hash::make('fequeprotege709'),
    ]);

    \App\Models\User::factory()->create([
        'nome' => 'Luis',
        'email' => 'luis@olharqueprotege.com',
        'password' => \Illuminate\Support\Facades\Hash::make('luqueprotege709'),
    ]);
}
}
