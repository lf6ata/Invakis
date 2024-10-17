<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:edit articles');
    // }
    
    public function pageDashboard()  
    {
   
        $user = User::find(Auth::user()->id); // Ambil satu user
        // dd(Auth::user()->roles->getRoleNames());
        dd($user->getRoleNames());


        // $user = ne

          
        return view('menu.dashboard.dashboard');
    }
}
