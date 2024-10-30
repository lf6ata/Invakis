<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sto;
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

        // $user = User::find(Auth::user()->id); // Ambil satu user
        // // dd(Auth::user()->roles->getRoleNames());
        // dd($user->getRoleNames());


        $count_user = User::count();
        if (empty($count_user)) {
            $count_user = 0;
        } else {
            $count_user;
        }

        $count_barang = Barang::count();
        // dd($count_barang);
        if (empty($count_barang)) {
            $count_barang = 0;
        } else {
            $count_barang;
        }

        $count_rusak = Sto::where('status', 'Rusak')->count();

        if (empty($count_rusak)) {
            $count_rusak = 0;
        } else {
            $count_rusak;
        }

        return view('menu.dashboard.dashboard', compact('count_user', 'count_barang', 'count_rusak'));
    }
}
