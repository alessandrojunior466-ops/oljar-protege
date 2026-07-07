<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
<<<<<<< HEAD
    public function index()
    {
        return view('home');
=======
    // Adicione ou corrija este método aqui dentro:
    public function index()
    {
        // Caso você use uma view específica para a home do seu site (ex: home.blade.php)
        return view('home'); 
>>>>>>> 62241afbb44e03cf2a42d39162daa874ced8cad5
    }

    public function sobre()
    {
        return view('sobre');
    }

    public function videos()
    {
        return view('videos');
    }

    public function blog()
    {
        return view('blog');
    }
<<<<<<< HEAD

    public function mostrarLogin()
=======
    public function login()
>>>>>>> 62241afbb44e03cf2a42d39162daa874ced8cad5
    {
        return view('auth.login');
    }
}