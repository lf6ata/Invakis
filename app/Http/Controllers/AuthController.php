<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{  
    public function authLogin(){
        return view('auth.login');
    }

    public function store(Request $request){
        $credential = $request->validate([
            'email'     => 'required | email:dns',
            'password'  => 'required'
        ]);

        // $request->authenticate();


        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('wrong','user and password wrong');
        
    }

    public function destroy(Request $request){
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        Auth::logout();
        return redirect('/login');
    }
}
