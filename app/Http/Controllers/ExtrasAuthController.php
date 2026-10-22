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
        return view('extras-login'); // Ajuste o nome da view se necessário
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

        // Impede que administradores entrem na área de usuários comuns.
        if ($usuario->role !== 'user') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()
                ->route('extras.login')
                ->withErrors([
                    'email' => 'Esta área é exclusiva para usuários comuns.',
                ]);
        }

        return redirect()->route('extras');
    }

    /**
     * Mostra o formulário de registo dos usuários comuns.
     */
    public function showRegister()
    {
        return view('extras-cadastro');
    }

    /**
     * Processa o registo do novo usuário comum.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // 1. Salva no banco de dados do Laravel
        $user = User::create([
            'nome' => $request->name,   // Ajustado para 'nome' conforme a coluna da sua tabela
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',           // Força o papel de usuário comum
        ]);

        // 2. Salva as informações no arquivo JSON usando caminho absoluto no storage/app/users.json
        $path = storage_path('app/users.json');

        $users = [];
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $users = json_decode($json, true) ?? [];
        }

        $users[] = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'created_at' => now()->toIso8601String(),
        ];

        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        Auth::login($user);

        return redirect()->route('extras');
    }
}
