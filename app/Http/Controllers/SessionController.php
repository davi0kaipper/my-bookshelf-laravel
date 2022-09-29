<?php

namespace App\Http\Controllers;

use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('login.index');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (! auth()->attempt($attributes)) {
            throw ValidationException::withMessages([
                'email' => 'Suas credenciais não puderam ser verificadas.'
            ]);
        }

        session()->regenerate();

        return redirect('/books')->with('success', 'Bem vindo de volta!');
    }

    public function destroy()
    {
        auth()->logout();

        return redirect('/login')->with('success', 'Tchau!');
    }
}
