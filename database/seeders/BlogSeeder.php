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
        
        // 2. Garante que as imagens sejam lidas na mesma ordem alfabética do VSCode (h, o, w)
        sort($images, SORT_NATURAL | SORT_FLAG_CASE);

        // 3. A Importância da Proteção Infantil (No TOPO da lista)
        // Você pediu que essa fosse a terceira imagem
        Blog::create([
            'titulo'     => 'A Importância da Proteção Infantil',
            'conteudo'   => 'Texto detalhado sobre a importância de proteger as crianças e criar um ambiente seguro...',
            'imagem'     => $images[2] ?? null, // Pega a 3ª imagem da pasta
            'created_at' => now(), 
        ]);

        // 4. Como Identificar Sinais de Alerta (No MEIO da lista)
        // Você pediu que essa fosse a primeira imagem
        Blog::create([
            'titulo'     => 'Como Identificar Sinais de Alerta',
            'conteudo'   => 'Texto sobre como perceber comportamentos e prevenir situações de risco...',
            'imagem'     => $images[0] ?? null, // Pega a 1ª imagem da pasta
            'created_at' => now()->subDays(1), 
        ]);

        // 5. O Papel da Comunidade na Segurança (No FINAL da lista)
        // Você pediu que essa fosse a segunda imagem
        Blog::create([
            'titulo'     => 'O Papel da Comunidade na Segurança',
            'conteudo'   => 'Texto explicando como toda a sociedade pode contribuir no projeto Olhar Que Protege...',
            'imagem'     => $images[1] ?? null, // Pega a 2ª imagem da pasta
            'created_at' => now()->subDays(2), 
        ]);
        
        $this->command->info('BlogSeeder executado: Imagens exatas amarradas a cada postagem!');
    }
}