<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Lista de noticia do banco
     */
    public function index()
    {
        $videos = Video::all();
        return view('admin.videos.index', [
            'videos' => $videos
        ]);
    }

    /**
     * Chamar a view do cadastrar noticia
     */
    public function create()
    {
        return view("admin.videos.cadastrar");
    }

    /**
     * Armazenar dados.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Visualizar uma noticia
     */

    /**
     * Chamar a view do editar noticias
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Armazenar a atualizacao dos dados da noticia
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * excluir uma noticia de banco de dados.
     */
    public function destroy(string $id)
    {
        //
    }
}
