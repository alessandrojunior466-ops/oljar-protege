<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        DB::table("usuarios")->insert([
            [
                "nome" => "Luis Antonio",
                "email" => "luisantoniodeassisjunior@gmail.com",
                "perfil" => "admnistrador",
                "password" => Hash::make("12345678"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nome" => "Eduardo Henrique",
                "email" => "eduardohenrique@gmail.com",
                "perfil" => "editor",
                "password" => Hash::make("12345678"),
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}
