<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categorias')->insert([
            [
                "nome" => "Programação",
                "cor" => "#3B52F6",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nome" => "Inteligência Artificial",
                "cor" => "#8B5CF6",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nome" => "Hardware",
                "cor" => "#10B981",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nome" => "Cloud Computing",
                "cor" => "#F59E0B",
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "nome" => "Cyber Segurança", // Ajustado o erro de digitação de "Cyper" para "Cyber"
                "cor" => "#EF4444",
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}