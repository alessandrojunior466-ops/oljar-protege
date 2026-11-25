<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ExtrasAuthController extends Controller
{
    /**
     * Mostra o formulário de login dos usuários comuns.
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'user'
                ? redirect()->route('extras')
                : redirect('/');
        }

        return view('extras-login');
    }

    /**
     * Processa o login dos usuários comuns (e-mail/senha, Google ou SMS/Firebase).
     */
    public function login(Request $request)
    {
        $temTokenFirebase = $request->filled('firebase_token');
        $loginPorTelefone = $temTokenFirebase && $request->filled('phone_number') && !$request->filled('email');

        $rules = [
            'email' => [$loginPorTelefone ? 'nullable' : 'required', 'email'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'name' => ['nullable', 'string', 'max:255'],
            'firebase_token' => ['nullable', 'string'],
        ];

        if (!$temTokenFirebase) {
            $rules['password'] = ['required', 'string'];
        }

        $request->validate($rules);

        if ($temTokenFirebase) {
            $usuario = $this->resolverUsuarioFirebase($request);

            if ($usuario->role !== 'user') {
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Esta conta é de administrador. Utilize o login da equipe.'
                ]);
            }

            if ($request->filled('name') && !$usuario->name) {
                $usuario->update(['name' => $request->input('name')]);
            }

            Auth::login($usuario, true);
            $request->session()->regenerate();

            return redirect()->route('extras');
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (!Auth::attempt($credentials)) {
            return back()
                ->withErrors([
                    'email' => 'E-mail ou senha inválidos.',
                ])
                ->onlyInput('email');
        }

        $request->session()->regenerate();

        $usuario = Auth::user();

        if ($usuario->role !== 'user') {
            Auth::logout();
            return redirect()->route('admin.login')->withErrors([
                'email' => 'Esta conta é de administrador. Utilize o login da equipe.'
            ]);
        }

        return redirect()->route('extras');
    }

    /**
     * Mostra o formulário de registo dos usuários comuns.
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return Auth::user()->role === 'user'
                ? redirect()->route('extras')
                : redirect('/');
        }

        return view('extras-cadastro');
    }

    /**
     * Processa o registo do novo usuário comum (e-mail/senha, Google ou SMS/Firebase).
     */
    public function register(Request $request)
    {
        $temTokenFirebase = $request->filled('firebase_token');
        $cadastroPorTelefone = $temTokenFirebase && $request->filled('phone_number') && !$request->filled('email');

        $rules = [
            'email' => [$cadastroPorTelefone ? 'nullable' : 'required', 'string', 'email', 'max:255'],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'firebase_token' => ['nullable', 'string'],
        ];

        if ($temTokenFirebase) {
            $rules['password'] = ['nullable', 'string', 'min:6'];
        } else {
            $rules['email'][] = 'unique:users';
            $rules['password'] = ['required', 'string', 'min:8', 'confirmed'];
        }

        $request->validate($rules);

        if ($temTokenFirebase) {
            $usuario = $this->resolverUsuarioFirebase($request);

            if ($usuario->role !== 'user') {
                return redirect()->route('admin.login')->withErrors([
                    'email' => 'Esta conta é de administrador. Utilize o login da equipe.'
                ]);
            }

            Auth::login($usuario, true);
            $request->session()->regenerate();

            return redirect()->route('extras');
        }

        $userName = $request->input('nome')
            ?? $request->input('name')
            ?? $request->input('username')
            ?? explode('@', $request->email)[0];

        $senhaParaHash = !empty($request->password)
            ? $request->password
            : Str::random(32);

        $user = User::create([
            'name' => $userName,
            'email' => $request->email,
            'password' => Hash::make($senhaParaHash),
            'role' => 'user',
        ]);

        $this->salvarUsuarioJson($user);

        Auth::login($user, true);
        $request->session()->regenerate();

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

    /**
     * Localiza ou cria o usuário no banco do Laravel a partir dos dados do Firebase (E-mail, Google ou Telefone).
     */
    private function resolverUsuarioFirebase(Request $request): User
    {
        $telefoneLimpo = preg_replace('/[^0-9]/', '', (string) $request->input('phone_number'));

        $email = $request->filled('email')
            ? $request->input('email')
            : ('tel_' . ($telefoneLimpo ?: Str::random(10)) . '@telefone.olharqueprotege.local');

        $usuario = User::where('email', $email)->first();

        if (!$usuario) {
            $userName = $request->input('name')
                ?? $request->input('nome')
                ?? $request->input('username')
                ?? ($request->filled('phone_number') ? $request->input('phone_number') : explode('@', $email)[0]);

            $usuario = User::create([
                'name' => $userName,
                'email' => $email,
                'password' => Hash::make(Str::random(32)),
                'role' => 'user',
            ]);

            $this->salvarUsuarioJson($usuario);
        }

        return $usuario;
    }

    /**
     * Registra o usuário no arquivo storage/app/users.json.
     */
    private function salvarUsuarioJson(User $user): void
    {
        $path = storage_path('app/users.json');

        $users = [];
        if (file_exists($path)) {
            $json = file_get_contents($path);
            $users = json_decode($json, true) ?? [];
        }

        $users[] = [
            'name' => $user->name,
            'email' => $user->email,
            'password' => $user->password,
            'role' => $user->role,
            'created_at' => now()->toIso8601String(),
        ];

        file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }
}