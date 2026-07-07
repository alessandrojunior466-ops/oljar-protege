<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    // Adicione ou corrija este método aqui dentro:
    public function index()
    {
        // Caso você use uma view específica para a home do seu site (ex: home.blade.php)
        return view('home'); 
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
    public function login()
    {
        return view('login');
    }
}