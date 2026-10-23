<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ExtrasAuthController extends Controller
{
    /**
     * Mostra o formulário de login dos usuários comuns.
     */
    public function showLogin()
    {
        // Se já estiver logado, redireciona estritamente para a página inicial
        if (Auth::check()) {
            return redirect('/');
        }

        return view('extras-login');
    }

    /**
     * Processa o login dos usuários comuns.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'E-mail ou senha inválidos.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $usuario = Auth::user();

        // Se um administrador tentar logar pela tela de usuário comum, bloqueia e redireciona
        if ($usuario->role !== 'user') {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Esta conta é de administrador. Utilize o login da equipe.'
            ]);
        }

        // Redireciona para a área de conteúdos exclusivos de usuários comuns
        return redirect()->route('extras');
    }

    /**
     * Mostra o formulário de registo dos usuários comuns.
     */
    public function showRegister()
    {
        // Se já estiver logado, redireciona estritamente para a página inicial
        if (Auth::check()) {
            return redirect('/');
        }

        return view('extras-cadastro');
    }

    /**
     * Processa o registo do novo usuário comum.
     */
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Procura pelo nome em qualquer variação possível enviada pelo formulário
        $userName = $request->input('nome') ?? $request->input('name') ?? $request->input('username');

        // Se o nome não vier preenchido do formulário, extrai o nome do e-mail para evitar crash na BD
        if (!$userName) {
            $userName = explode('@', $request->email)[0];
        }

        // 1. Salva no banco de dados do Laravel com segurança
        $user = User::create([
            'name' => $userName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user', // Força o papel de usuário comum
        ]);

        // 2. Salva as informações no arquivo JSON usando caminho absoluto no storage/app/users.json
        $path = storage_path('app/users.json');

        $users = [];
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $users = json_decode($json, true) ?? [];
        }

        $users[] = [
            'name' => $userName,
            'email' => $request->email,
            'password' => $user->password, // Salva a password já hasheada
            'role' => 'user',
            'created_at' => now()->toIso8601String(),
        ];

        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        Auth::login($user);

        // Redireciona para a área de extras após o cadastro
        return redirect()->route('extras');
    }

    /**
     * Realiza o logout do usuário comum.
     */
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
