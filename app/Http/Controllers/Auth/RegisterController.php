<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RegisterController extends Controller
{
    public function create()
    {
        return Inertia::render('Auth/Register');
    }

    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|lowercase|email|max:255',
            'password' => 'required|confirmed|min:3'
        ],
        [   'name.required' => 'Пожалуйста, введите своё имя.',
            'email.required' => 'Пожалуйста, введите свой адрес электронной почты.',
            'email.email' => 'Введите действительный адрес электронной почты.',
            'password.required' => 'Пароль обязателен для ввода.',
            'password.confirmed' => 'Подтверждение поля пароля не совпадает.',
            'password.min' => 'Пароль должен содержать как минимум 3 символа.',
        ]);

        $user = User::create($credentials);
    
        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('home');
    }
}
