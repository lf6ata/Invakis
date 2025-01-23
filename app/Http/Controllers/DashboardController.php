<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SessionSto;
use App\Models\Sto;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('permission:edit articles');
    // }



    function createSessionSto()
    {

        $tb_session_sto = new SessionSto();
        $reset_status_sto = Barang::select('status_sto');
        $flag = $tb_session_sto::select('session_sto', 'save_sto')->latest()->first();

        $reset_status_sto->update([
            'status_sto' => 0
        ]);

        //Check no urut session sto
        if (!empty($flag)) {

            if ($flag->save_sto == '' || $flag->save_sto === null) {
                return back()->with('message', 'Selesaikan session sebelumnya dahulu');
            } else {
                // $not_yet_sto = Barang::select('*')->where('tgl_masuk', '<', date('Y-m-d'))->whereNull('tgl_terakhir_sto')->orderBy('created_at', 'asc')->get();
                // $not_yet_sto = Barang::select('*')->where('tgl_masuk', '<', date('Y-m-d'))->whereNull('tgl_terakhir_sto')->orWhereMonth('tgl_terakhir_sto', '<', date('m'))->orwhereYear('tgl_terakhir_sto', '<', date('Y'))->orderBy('created_at', 'asc')->get();
                $not_yet_sto = Barang::select('status_sto')->where('status_sto', 0)->get();
                // dd(empty($not_yet_sto[0]));
                // if (empty($not_yet_sto[0]->no_asset)) {
                if (empty($not_yet_sto[0])) {
                    return back()->with('message', 'Belum ada barang yang dapat di sto');
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

    function  getBulan($bln)
    {
        switch ($bln) {
            case  1:
                return  "Januari";
                break;
            case  2:
                return  "Februari";
                break;
            case  3:
                return  "Maret";
                break;
            case  4:
                return  "April";
                break;
            case  5:
                return  "Mei";
                break;
            case  6:
                return  "Juni";
                break;
            case  7:
                return  "Juli";
                break;
            case  8:
                return  "Agustus";
                break;
            case  9:
                return  "September";
                break;
            case  10:
                return  "Oktober";
                break;
            case  11:
                return  "November";
                break;
            case  12:
                return  "Desember";
                break;
        }
    }

    function getChartData()
    {
        $currentYear = Carbon::now()->year;


        // Ambil data status dan tgl_sto dari tabel
        $data = Sto::select(DB::raw('session_sto as session, status, count(*) as count'))
            ->whereYear('created_at', $currentYear)  // Filter berdasarkan tahun sekarang
            ->groupBy('session', 'status') // Kelompokkan berdasarkan bulan dan status
            ->orderBy('session') // Urutkan berdasarkan bulan
            ->get();
        // dd($data2);
        // // Ambil data status dan tgl_sto dari tabel
        // $data = Sto::select(DB::raw('MONTH(created_at) as month, status, count(*) as count'))
        //     ->whereYear('created_at', $currentYear)  // Filter berdasarkan tahun sekarang
        //     ->groupBy('month', 'status') // Kelompokkan berdasarkan bulan dan status
        //     ->orderBy('month') // Urutkan berdasarkan bulan
        //     ->get();
        // // dd($data);


        $arrSession = [];
        $arrSto = [];
        $session = SessionSto::select('id', 'session_sto')->get();
        foreach ($session as  $sto) {
            array_push($arrSession, $sto->id);
            array_push($arrSto, $sto->session_sto);
        }

        $totalBarang = Barang::all()->count();

        // dd(count($arrSession));

        // dd($data[1]->status);


        // Inisialisasi array bulan (Januari sampai Desember)
        // Nama bulan dalam bahasa Indonesia

        // $months = [
        //     'Januari',
        //     'Februari',
        //     'Maret',
        //     'April',
        //     'Mei',
        //     'Juni',
        //     'Juli',
        //     'Agustus',
        //     'September',
        //     'Oktober',
        //     'November',
        //     'Desember',
        // ];

        // dd($months);

        // $data2 = [
        //     ['sto' => "STO01", 'status' => 'Rusak', 'count' => 2],
        //     ['sto' => "STO01", 'status' => 'Sangat Layak', 'count' => 4],
        //     ['sto' => "STO02", 'status' => 'Sangat Layak', 'count' => 4],
        // ];

        // dd($data);


        // Inisialisasi array untuk status
        $statusLabels = ['Sangat Layak', 'Cukup Layak', 'Layak Pakai', 'Rusak', 'Hilang'];
        $statusCounts = [];


        // Inisialisasi data kosong untuk setiap status
        foreach ($statusLabels as $status) {
            $statusCounts[$status] = array_fill(0, count($session), 0);  // automatic panjang categori
        }

        // Loop untuk mengisi data jumlah berdasarkan bulan dan status
        // foreach ($data as $row) {
        //     dd($months);
        //     // Bulan dimulai dari 1 (Januari) hingga 12 (Desember)
        //     $monthIndex = array_search($this->getBulan($row->month), $months);
        //     $statusCounts[$row->status][$monthIndex] = $row->count;
        // }
        // Loop untuk mengisi data jumlah berdasarkan bulan dan status
        // foreach ($data2 as $row) {
        //     // dd($arrSession);
        //     // Bulan dimulai dari 1 (Januari) hingga 12 (Desember)
        //     $monthIndex = array_search($row['sto'], $arrSession);
        //     $statusCounts[$row['status']][$monthIndex] = $row['count'];
        // }

        foreach ($data as $row) {
            // dd(intval($row->count  / 7 * 100) . '%');
            // Bulan dimulai dari 1 (Januari) hingga 12 (Desember)
            $sessionIndex = array_search($row->session, $arrSession);
            $statusCounts[$row->status][$sessionIndex] =  $row->count;
            // dd($persentase);
        }
        // dd($statusCounts);

        $arrSto == [] ? $arrSto = ['STO01', 'STO02', 'STO03', 'STO04', 'STO05', 'STO06', 'STO07', 'STO08', 'STO09', 'STO010'] : 'oke';

        // dd($persentase);

        return response()->json([
            'sessions' => $arrSto,
            'totalBarang' => $totalBarang,
            'statusCounts' => $statusCounts,
            'currentYear' => $currentYear
        ]);
        // return response()->json([
        //     'months' => $months,
        //     'statusCounts' => $statusCounts,
        //     'currentYear' => $currentYear
        // ]);

    }

    public function pageDashboard()
    {

        $current_sto = SessionSto::select('*')->orderBy('created_at', 'desc')->latest()->first();
        if ($current_sto == null) {
            $total_hilang = $total_rusak = $total_layak_pakai = $total_cukup_layak = $total_sangat_layak = 0;
        } else {
            $total_hilang = Sto::select('*')->where('session_sto', $current_sto->id)->where('status', 'Hilang')->count();
            $total_rusak = Sto::select('*')->where('session_sto', $current_sto->id)->where('status', 'Rusak')->count();
            $total_layak_pakai = Sto::select('*')->where('session_sto', $current_sto->id)->where('status', 'Layak Pakai')->count();
            $total_cukup_layak = Sto::select('*')->where('session_sto', $current_sto->id)->where('status', 'Cukup Layak')->count();
            $total_sangat_layak = Sto::select('*')->where('session_sto', $current_sto->id)->where('status', 'Sangat Layak')->count();
        }


        // dd($tes);
        // dd($total_layak_pakai);
        // dd(Sto::orderBy('ceated_at', 'desc'));
        // $user = User::find(Auth::user()->id); // Ambil satu user
        // // dd(Auth::user()->roles->getRoleNames());
        // dd($user->getRoleNames());
        // $decode_json = json_decode($this->getChartData()->content(), true);

        // $months = $decode_json['months'];
        // $statusCounts = $decode_json['statusCounts'];
        // $currentYear = $decode_json['currentYear'];

        // dd($statusCounts);

        // $dates = $data->pluck('date')->unique()->toArray(); // Tanggal unik
        // $statusLabels = ['Sangat Layak', 'Cukup Layak', 'Layak Pakai', 'Rusak']; // Status
        // $statusCounts = [];

        // // Inisialisasi array kosong untuk setiap status
        // foreach ($statusLabels as $status) {
        //     $statusCounts[$status] = array_fill(0, count($dates), 0);
        // }

        // // Loop untuk mengisi data jumlah berdasarkan status dan tanggal
        // foreach ($data as $row) {
        //     $index = array_search($row->date, $dates);
        //     $statusCounts[$row->status][$index] = $row->count;
        // }

        $count_status = DB::table('sto')
            ->select('status', DB::raw('COALESCE(COUNT(*),0) as total_count'))
            ->join(
                DB::raw('(SELECT no_asset, MAX(created_at) as created_at FROM sto GROUP BY no_asset) as latest'),
                'sto.no_asset',
                '=',
                'latest.no_asset'
            )
            ->whereIn('sto.status', ['Sangat Layak', 'Cukup Layak', 'Layak Pakai', 'Rusak'])
            ->whereColumn('sto.created_at', '=', 'latest.created_at')
            ->groupBy('sto.status')
            ->orderByDesc('total_count')
            ->get();

        // dd($count_status);

        // $data = DB::table(DB::raw('(SELECT 
        //                         no_asset, 
        //                         status, 
        //                         created_at,
        //                         ROW_NUMBER() OVER (PARTITION BY no_asset ORDER BY created_at DESC) AS rn
        //                     FROM sto) as LatestData'))
        //     // Menyaring data yang memiliki rn = 1 (data terbaru untuk setiap no_asset)
        //     ->where('rn', 1)
        //     ->select('status', DB::raw('IFNULL(COUNT(*), 0) AS total_count'))
        //     ->whereIn('status', ['Sangat Layak', 'Cukup Layak', 'Layak Pakai', 'Rusak'])
        //     ->groupBy('status')

        //     // UNION ALL for categories that do not exist
        //     ->unionAll(
        //         DB::table(DB::raw('(SELECT no_asset, status FROM sto WHERE status = "Sangat Layak" LIMIT 1) as check_status'))
        //             ->selectRaw("'Sangat Layak' as status")
        //             ->whereNotExists(function ($query) {
        //                 $query->from('sto')
        //                     ->where('status', 'Sangat Layak');
        //             })
        //             ->selectRaw('0 as total_count')
        //     )
        //     ->unionAll(
        //         DB::table(DB::raw('(SELECT no_asset, status FROM sto WHERE status = "Cukup Layak" LIMIT 1) as check_status'))
        //             ->selectRaw("'Cukup Layak' as status")
        //             ->whereNotExists(function ($query) {
        //                 $query->from('sto')
        //                     ->where('status', 'Cukup Layak');
        //             })
        //             ->selectRaw('0 as total_count')
        //     )
        //     ->unionAll(
        //         DB::table(DB::raw('(SELECT no_asset, status FROM sto WHERE status = "Layak Pakai" LIMIT 1) as check_status'))
        //             ->selectRaw("'Layak Pakai' as status")
        //             ->whereNotExists(function ($query) {
        //                 $query->from('sto')
        //                     ->where('status', 'Layak Pakai');
        //             })
        //             ->selectRaw('0 as total_count')
        //     )
        //     ->unionAll(
        //         DB::table(DB::raw('(SELECT no_asset, status FROM sto WHERE status = "Rusak" LIMIT 1) as check_status'))
        //             ->selectRaw("'Rusak' as status")
        //             ->whereNotExists(function ($query) {
        //                 $query->from('sto')
        //                     ->where('status', 'Rusak');
        //             })
        //             ->selectRaw('0 as total_count')
        //     )
        //     ->orderBy('total_count', 'desc')
        //     ->get();


        $countStatusSto = json_decode($this->getChartData()->content(), true);

        $session_sto = SessionSto::select('id', 'session_sto', 'progress', 'durasi', 'tgl_sto', 'save_sto')->orderBy('session_sto', 'desc')->get();

        // $barang = Barang::where('id_categori', 1)->count();

        $count_user = User::count();
        if (empty($count_user)) {
            $count_user = 0;
        } else {
            $count_user;
        }

        $count_session = empty($session_sto->where('save_sto', '!=', '')->count()) ? 0 : $session_sto->where('save_sto', '!=', '')->count();

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


        return view('menu.dashboard.dashboard', compact('total_hilang', 'total_rusak', 'total_layak_pakai', 'total_cukup_layak', 'total_sangat_layak', 'count_user', 'count_barang', 'count_rusak', 'count_layak', 'count_cukup', 'count_sangat', 'count_session', 'count_status', 'session_sto'));
    }

    public function getProgress()
    {
        $total_barang = Barang::count();
        // $done_sto = Barang::select('tgl_terakhir_sto')->where(DB::raw('year(tgl_terakhir_sto)'), '=', date('Y'))->where(DB::raw('month(tgl_terakhir_sto)'), '=', date('m'))->whereNotNull('tgl_terakhir_sto')->count();
        $done_sto = Barang::select('tgl_terakhir_sto')->where('status_sto', '=', 1)->count();

        $percentage = ($total_barang > 0) ? intval(ceil($done_sto / $total_barang * 100)) : 0;

        return response()->json([
            'percentage'    => $percentage
        ]);
    }
}
