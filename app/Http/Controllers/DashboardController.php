<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function pageDashboard()  
    {
        return view('menu.dashboard.dashboard');
    }
}
