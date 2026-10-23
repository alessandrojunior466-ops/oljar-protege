<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminAuthController extends Controller
{
    /**
     * Mostra o formulário de login do administrador.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard/blog');
        }

        return view('admin-login');
    }

    /**
     * Processa o login do administrador.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors(['email' => 'E-mail ou senha inválidos.'])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $usuario = Auth::user();

        // Garante que apenas administradores entrem por aqui
        if ($usuario->role !== 'admin') {
            Auth::logout();
            return back()->withErrors(['email' => 'Acesso negado. Esta conta não é de administrador.']);
        }

        return redirect('/admin/dashboard/blog');
    }

    /**
     * Mostra o formulário de registro de administrador.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/admin/dashboard/blog');
        }

        return view('admin-register');
    }

    /**
     * Processa o registro de um novo administrador.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin', // Força o papel de administrador
        ]);

        Auth::login($user);

        return redirect('/admin/dashboard/blog');
    }

    /**
     * Realiza o logout do administrador.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/admin/login');
    }
}
