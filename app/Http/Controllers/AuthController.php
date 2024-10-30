<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function authLogin()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {

        $credential = $request->validate(
            [
                'email'     => 'required | email:dns',
                'password'  => 'required'
            ],
            [
                'email.required'    => 'Email tidak boleh kosong',
                'email.email'       => 'Email harus valid',
                'password.required' => 'Password tidak boleh kosong'
            ]
        );

        // $request->authenticate();


        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('wrong', 'user dan password yang anda masukan salah');
    }

    public function destroy(Request $request)
    {
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Auth::logout();
        // return redirect('/login');
    }
}
