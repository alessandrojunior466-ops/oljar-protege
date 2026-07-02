<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function visualizarNoticias()
    {
        return view('visualizar');
    }

    public function contato(){
        return view('contato');
    }
}
