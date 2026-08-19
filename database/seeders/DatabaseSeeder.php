<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Criar os usuários administradores garantindo idempotência
        User::firstOrCreate(
            ['email' => 'alessandro@olharqueprotege.com'],
            ['nome' => 'Alessandro', 'password' => Hash::make('alequeprotege709')]
        );

        User::firstOrCreate(
            ['email' => 'ana@olharqueprotege.com'],
            ['nome' => 'Ana', 'password' => Hash::make('anaqueprotege709')]
        );

        User::firstOrCreate(
            ['email' => 'felipe@olharqueprotege.com'],
            ['nome' => 'Felipe', 'password' => Hash::make('fequeprotege709')]
        );

        User::firstOrCreate(
            ['email' => 'luis@olharqueprotege.com'],
            ['nome' => 'Luis', 'password' => Hash::make('luqueprotege709')]
        );

        // 2. Chamar os outros Seeders
        $this->call([
            BlogSeeder::class,
            VideosSeeder::class,
        ]);
    }
}
