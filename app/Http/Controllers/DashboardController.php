<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SessionSto;
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



    function createSessionSto()
    {

        $tb_session_sto = new SessionSto();
        $flag = $tb_session_sto::select('session_sto', 'save_sto')->latest()->first();

        //Check no urut session sto
        if (!empty($flag)) {

            if ($flag->save_sto == '' || $flag->save_sto === null) {
                return dd('kosong');
            } else {
                $not_yet_sto = Barang::select('*')->where('tgl_masuk', '<', date('Y-m-d'))->whereNull('tgl_terakhir_sto')->orderBy('created_at', 'asc')->get();

                if (empty($not_yet_sto[0]->no_asset)) {
                    return back()->with('message', 'Tidak ada item yg akan di sto');
                } else {
                    $no_index = intval(substr($flag->session_sto, 3)) + 1;
                    $tb_session_sto::create([
                        'session_sto'   =>  'STO' . sprintf('%02d', $no_index),
                        'progress'      =>  0,
                        'durasi'        =>  '-',
                        'tgl_sto'       =>  now()
                        // 'tgl_sto'       =>  date("Y-m-d"),
                    ]);
                    return redirect()->route('page.sto', ['STO' . sprintf('%02d', $no_index), 'false']);
                }
            }
        } else {
            $no_index = 1;
            $tb_session_sto::create([
                'session_sto'   =>  'STO' . sprintf('%02d', $no_index),
                'progress'      =>  0,
                'durasi'        =>  '-',
                'tgl_sto'       =>  now(),
                // 'tgl_sto'       =>  date("Y-m-d"),
            ]);
            return redirect()->route('page.sto', ['STO' . sprintf('%02d', $no_index), 'false']);
        }
    }

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

        $session_sto = SessionSto::select('session_sto', 'progress', 'durasi', 'tgl_sto', 'save_sto')->orderBy('session_sto', 'desc')->get();

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





        return view('menu.dashboard.dashboard', compact('count_user', 'count_barang', 'count_rusak', 'count_layak', 'count_cukup', 'count_sangat', 'session_sto'));
    }
}
