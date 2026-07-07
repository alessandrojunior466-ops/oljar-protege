<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VideosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('videos')->insert([
            [
                "titulo" => "Dominando o Laravel do Zero",
                "descricao" => "Um guia completo para iniciar com o framework PHP mais utilizado do mercado.",
                "url" => "https://www.youtube.com/watch?v=exemplo1",
                "categoria_id" => 1, // Vinculado a 'Programação'
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "titulo" => "Como criar Redes Neurais com Python",
                "descricao" => "Entenda os conceitos básicos por trás do Machine Learning e Deep Learning.",
                "url" => "https://www.youtube.com/watch?v=exemplo2",
                "categoria_id" => 2, // Vinculado a 'Inteligência Artificial'
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "titulo" => "Montando o PC Gamer Ideal em 2026",
                "descricao" => "Análise de peças, compatibilidade e custo-benefício para o seu setup.",
                "url" => "https://www.youtube.com/watch?v=exemplo3",
                "categoria_id" => 3, // Vinculado a 'Hardware'
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "titulo" => "Introdução prática à AWS e Azure",
                "descricao" => "Aprenda a subir sua primeira aplicação na nuvem usando os maiores provedores.",
                "url" => "https://www.youtube.com/watch?v=exemplo4",
                "categoria_id" => 4, // Vinculado a 'Cloud Computing'
                "created_at" => now(),
                "updated_at" => now(),
            ],
            [
                "titulo" => "Como se proteger de ataques Phishing",
                "descricao" => "Dicas essenciais de segurança da informação para blindar seus sistemas.",
                "url" => "https://www.youtube.com/watch?v=exemplo5",
                "categoria_id" => 5, // Vinculado a 'Cyber Segurança'
                "created_at" => now(),
                "updated_at" => now(),
            ],
        ]);
    }
}