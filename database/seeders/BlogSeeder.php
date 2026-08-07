<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // Insira os posts que você quer cadastrar
        Blog::create([
            'titulo'   => 'A Importância da Proteção Infantil',
            'conteudo' => 'Texto detalhado sobre a importância de proteger as crianças e criar um ambiente seguro...',
            'imagem'   => null,
        ]);

        Blog::create([
            'titulo'   => 'Como Identificar Sinais de Alerta',
            'conteudo' => 'Texto sobre como perceber comportamentos e prevenir situações de risco...',
            'imagem'   => null,
        ]);

        Blog::create([
            'titulo'   => 'O Papel da Comunidade na Segurança',
            'conteudo' => 'Texto explicando como toda a sociedade pode contribuir no projeto Olhar Que Protege...',
            'imagem'   => null,
        ]);
    }
}