<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Inertia\Inertia;

class ResetPasswordController extends Controller
{
    public function requestPass() 
    {
        return Inertia::render('Auth/ForgotPassword', [
            'status' => session('status'), 
        ]);
    }

    public function sendEmail(Request $request) 
    {
        $request->validate([
            'email' => 'required|email'
        ],
        [
            'email.required' => 'Пожалуйста, введите свой адрес электронной почты.',
            'email.email' => 'Введите действительный адрес электронной почты.',
        ]);
        
        $status = Password::sendResetLink(
            $request->only('email')
        );
        
        return $status === Password::RESET_LINK_SENT
                    ? back()->with(['status' => ('Мы отправили вам ссылку для сброса пароля по 
                        электронной почте.')])
                    : back()->withErrors(['email' => ('Пользователь с таким адресом электронной 
                        почты не найден. Пожалуйста, проверьте правильность ввода.')]);
    }

    public function resetForm(Request $request) 
    {
        return Inertia::render('Auth/ResetPassword', [
            'email' => $request->email,
            'token' => $request->route('token'),
        ]);
    }

    public function resetHandler(Request $request) 
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:3|confirmed',
        ],
        [   
            'email.required' => 'Пожалуйста, введите свой адрес электронной почты.',
            'email.email' => 'Введите действительный адрес электронной почты.',
            'password.required' => 'Пароль обязателен для ввода.',
            'password.confirmed' => 'Подтверждение поля пароля не совпадает.',
            'password.min' => 'Пароль должен содержать как минимум 3 символа.',
        ]);
        
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function (User $user, string $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));
        
                $user->save();
        
                event(new PasswordReset($user));
            }
        );

        return $status === Password::PASSWORD_RESET
                    ? redirect()->route('login')->with(['status' => ('Ваш пароль был сброшен.')])
                    : back()->withErrors(['email' => ('Мы не можем найти пользователя с таким адресом 
                        электронной почты.')]);
    }
}
