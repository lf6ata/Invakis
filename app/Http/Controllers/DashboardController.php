<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:edit articles');
    // }
    function countSto($status)
    {
        $subquery = Sto::select('no_asset', DB::raw('MAX(updated_at) as max_updated'))->groupBy('no_asset');
        return Sto::joinSub($subquery, 'latest_assets', function ($join) {
            $join->on('Sto.no_asset', '=', 'latest_assets.no_asset')
                ->on('Sto.updated_at', '=', 'latest_assets.max_updated');
        })->where('Sto.status', $status)->count();
    }
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




        $count_sangat = $this->countSto('Sangat Layak');
        $count_cukup = $this->countSto('Cukup Layak');
        $count_layak = $this->countSto('Layak Pakai');
        $count_rusak = $this->countSto('Rusak');




        return view('menu.dashboard.dashboard', compact('count_user', 'count_barang', 'count_rusak', 'count_layak', 'count_cukup', 'count_sangat'));
    }
}
