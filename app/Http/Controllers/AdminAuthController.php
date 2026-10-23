<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminAuthController extends Controller
{
    //
    public function showLogin()
    {
        return view('admin-login'); // ou o nome da view de login de admin que você usa
    }

    public function showRegister()
    {
        return view('admin-register'); // ou o nome da view de cadastro de admin que você usa
    }
}
