<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Busca os arquivos da pasta 'posts'
        $images = Storage::disk('public')->files('posts');
        
        // 2. Mantém a mesma ordem visual que você vê no seu VSCode (H, O, W)
        sort($images, SORT_NATURAL | SORT_FLAG_CASE);

        // PRIMEIRA POSTAGEM (No topo do painel) -> Recebe a ÚLTIMA thumb [2]
        Blog::create([
            'titulo'     => 'A Importância da Proteção Infantil',
            'conteudo'   => 'Texto detalhado sobre a importância de proteger as crianças e criar um ambiente seguro...',
            'imagem'     => $images[2] ?? null, // 3ª imagem da pasta (W1xdc...)
            'created_at' => now(), 
        ]);

        // SEGUNDA POSTAGEM (No meio do painel) -> Recebe a SEGUNDA thumb [1]
        Blog::create([
            'titulo'     => 'Como Identificar Sinais de Alerta',
            'conteudo'   => 'Texto sobre como perceber comportamentos e prevenir situações de risco...',
            'imagem'     => $images[1] ?? null, // 2ª imagem da pasta (odyl1...)
            'created_at' => now()->subDays(1), 
        ]);

        // ÚLTIMA POSTAGEM (No final do painel) -> Recebe a PRIMEIRA thumb [0]
        Blog::create([
            'titulo'     => 'O Papel da Comunidade na Segurança',
            'conteudo'   => 'Texto explicando como toda a sociedade pode contribuir no projeto Olhar Que Protege...',
            'imagem'     => $images[0] ?? null, // 1ª imagem da pasta (huBkn...)
            'created_at' => now()->subDays(2), 
        ]);
        
        $this->command->info('BlogSeeder executado: Imagens reordenadas (Última na primeira, etc)!');
    }
}