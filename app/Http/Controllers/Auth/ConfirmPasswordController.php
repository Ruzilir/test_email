<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class ConfirmPasswordController extends Controller
{
    public function create() 
    {
        return Inertia::render('Auth/ConfirmPassword');
    }

    public function store(Request $request) {
        if (! Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['Предоставленный пароль не соответствует нашим записям.']
            ]);
        }
        
        $request->session()->passwordConfirmed();
        
        return redirect()->intended();
    }
}
