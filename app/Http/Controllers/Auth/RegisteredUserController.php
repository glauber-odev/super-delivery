<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|lowercase|email|max:255|unique:'.User::class,
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => 'required|string|between:11,15',
            'telefone_1' => 'required|string|between:11,15',
            'telefone_2' => 'string|nullable|between:11,15',
        ], [
            'cpf.between' => 'CPF inválido',
            'telefone_1.between' => 'Telefone inválido',
            'telefone_2.between' => 'Telefone inválido',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'telefone_1' => $request->telefone_1,
            'telefone_2' => $request->telefone_2,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->intended(route('dashboard', absolute: false));
    }
}
