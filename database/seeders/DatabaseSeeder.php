<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Limpa ou cria os administradores com a password rigorosamente gerada por Hash
        $admins = [
            ['name' => 'Alessandro', 'email' => 'alessandro@olharqueprotege.com', 'password' => 'aloqueprotege789'],
            ['name' => 'Ana', 'email' => 'ana@olharqueprotege.com', 'password' => 'anaqueprotege789'],
            ['name' => 'Felipe', 'email' => 'felipe@olharqueprotege.com', 'password' => 'fequeprotege789'],
            ['name' => 'Luis', 'email' => 'luis@olharqueprotege.com', 'password' => 'luqueprotege789'],
        ];

        foreach ($admins as $admin) {
            User::updateOrCreate(
                ['email' => $admin['email']],
                [
                    'name' => $admin['name'],
                    'password' => Hash::make($admin['password']),
                    'role' => 'admin'
                ]
            );
        }

        // Chamar os outros Seeders se existirem
        $this->call([
            BlogSeeder::class,
            VideosSeeder::class,
        ]);
    }
}
