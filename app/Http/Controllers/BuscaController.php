<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class BuscaController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $termo = Str::lower($q);

        $posts = collect();
        $videos = collect();
        $paginasEncontradas = collect();

        if ($termo !== '') {
            if (Schema::hasTable('posts')) {
                $posts = DB::table('posts')
                    ->where(function ($query) use ($q) {
                        $query->where('titulo', 'like', "%{$q}%")
                            ->orWhere('conteudo', 'like', "%{$q}%");
                    })
                    ->orderByDesc('id')
                    ->get();
            }

            if (Schema::hasTable('videos')) {
                $videos = DB::table('videos')
                    ->where(function ($query) use ($q) {
                        $query->where('titulo', 'like', "%{$q}%")
                            ->orWhere('descricao', 'like', "%{$q}%");
                    })
                    ->orderByDesc('id')
                    ->get();
            }

            $paginas = [
                [
                    'titulo' => 'Home',
                    'rota' => route('home'),
                    'resumo' => 'Monitorar é cuidar, segurança e cuidado digital, acompanhamento consciente, orientação e diálogo.',
                ],
                [
                    'titulo' => 'Sobre',
                    'rota' => route('sobre'),
                    'resumo' => 'Monitoramento digital, proteção essencial, cyberbullying, assédio online, círculo familiar, ODS 5.2, equipe Olhar Que Protege.',
                ],
                [
                    'titulo' => 'Vídeos',
                    'rota' => route('videos.index'),
                    'resumo' => 'Vídeos educativos sobre segurança digital, prevenção e orientação para pais e responsáveis.',
                ],
                [
                    'titulo' => 'Blog',
                    'rota' => route('blog.index'),
                    'resumo' => 'Artigos, notícias e orientações sobre proteção infantil e adolescente na internet.',
                ],
                [
                    'titulo' => 'Cadastrar-me',
                    'rota' => route('extras.register'),
                    'resumo' => 'Cadastro de usuário comum para acessar recursos da plataforma.',
                ],
                [
                    'titulo' => 'Entrar',
                    'rota' => route('extras.login'),
                    'resumo' => 'Login de usuário comum na plataforma Olhar Que Protege.',
                ],
                [
                    'titulo' => 'Extras',
                    'rota' => route('extras'),
                    'resumo' => 'Conteúdos extras e ferramentas complementares para responsáveis.',
                ],
                [
                    'titulo' => 'Equipe',
                    'rota' => route('admin.login'),
                    'resumo' => 'Acesso restrito para equipe e administração do sistema.',
                ],
            ];

            $paginasEncontradas = collect($paginas)->filter(function ($pagina) use ($termo) {
                return Str::contains(Str::lower($pagina['titulo']), $termo)
                    || Str::contains(Str::lower($pagina['resumo']), $termo);
            });
        }

        return view('busca', [
            'q' => $q,
            'posts' => $posts,
            'videos' => $videos,
            'paginas' => $paginasEncontradas,
        ]);
    }
}
