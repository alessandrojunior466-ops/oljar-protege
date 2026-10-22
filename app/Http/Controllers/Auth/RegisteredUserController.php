<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // 1. Salvar no banco de dados do Laravel (como já fazia)
        $user = User::create([
            'name' => $request->name, // Ajustado para 'name' (padrão do Breeze/Jetstream)
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // 2. Salvar as informações no arquivo JSON dentro da pasta storage/app/
        $path = 'users.json';

        $users = [];
        if (Storage::exists($path)) {
            $json = Storage::get($path);
            $users = json_decode($json, true) ?? [];
        }

        $users[] = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Criptografada por segurança
            'created_at' => now()->toIso8601String(),
        ];

        Storage::put($path, json_encode($users, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        // 3. Finalização padrão do Laravel (Eventos, Login e Redirecionamento)
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
