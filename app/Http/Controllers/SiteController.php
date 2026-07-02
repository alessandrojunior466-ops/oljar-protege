<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function sobre()
    {
        return view('sobre'); // Garanta que você tem o arquivo sobre.blade.php em resources/views
    }

    public function videos()
    {
        return view('videos');
    }

    public function blog()
    {
        return view('blog');
    }
    public function mostrarLogin()
    {
        return view('login');
    }
}
