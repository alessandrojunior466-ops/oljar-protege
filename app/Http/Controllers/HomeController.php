<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Define como null para que a view saiba que é uma "Nova Publicação"
        $postEdicao = null;

        // Se o teu painel listar os posts existentes nele, podes manter a busca deles aqui também
        // $posts = Blog::latest()->get();

        return view('dashboard', compact('postEdicao'));
    }
    public function visualizarNoticias()
    {
        return view('visualizar');
    }

    public function contato()
    {
        return view('contato');
    }
}
