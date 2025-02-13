<?php

namespace App\Http\Controllers;

use App\Exports\DataBaExport;
use App\Exports\DataStoExport;
use App\Models\Barang;
use App\Models\SessionSto;
use App\Models\Sto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class StoController extends Controller
{

    protected $progress;

    // Melakukan dependency injection UserController
    public function __construct(DashboardController $progress)
    {
        $this->progress = $progress;
    }

    function saveTimer($id)
    {

        $id_session_sto   = SessionSto::where('session_sto', $id);

        $progress = json_decode($this->progress->getProgress()->content(), true);

        if ($progress['percentage'] > 0) {
            $id_session_sto->update([
                'progress' => $progress['percentage'],
            ]);
            return redirect()->route('page.dashboard');
        }

        session()->flash('error', 'Belum ada item yang di sto.');
        return redirect()->route('page.sto', [$id, 'false']);
    }

    function saveSto($id)
    {

        $id_session_sto   = SessionSto::where('session_sto', $id);
        $reset_status_sto = Barang::select('status_sto');


        //untuk mengurai string JSON tersebut menjadi array atau objek
        $total_durasi = json_decode($this->timer()->content(), true);

        $progress = json_decode($this->progress->getProgress()->content(), true);
        // dd($progress['percentage'] == 100);
        if ($progress['percentage'] == 100) {

            $id_session_sto->update([
                'progress' => $progress['percentage'],
                'durasi'  => $total_durasi['result_time'],
                'save_sto' => now()
            ]);

            $reset_status_sto->update([
                'status_sto' => 0
            ]);

            return redirect()->route('page.dashboard');
        }

        session()->flash('error', 'Sto belum dapat di close karena baru ' . $progress['percentage'] . '%, silahkan di selesaikan hingga 100%.');
        return redirect()->route('page.sto', [$id, 'false']);
    }

    function timer()
    {
        session_start();

        $time =  SessionSto::select('created_at')->latest()->first();

        // Set waktu mulai jika belum ada di session
        if (!isset($_SESSION['start_time'])) {
            $_SESSION['start_time'] =  $start_time = strtotime($time->created_at);
        }

        if (empty($time)) {
            // Timer berhenti
            $elapsed_time = 0;
        } else {
            // Ambil waktu mulai dari session
            $start_time = $_SESSION['start_time'] = $start_time = strtotime($time->created_at);
            // Timer berhenti
            $elapsed_time = time() - $start_time; // Hitung selisih waktu
        }


        // Format hasil dalam jam:menit:detik
        $hours = floor($elapsed_time / 3600);
        $minutes = floor(($elapsed_time % 3600) / 60);
        $seconds = $elapsed_time % 60;

        return response()->json([
            // 'hours' => $hours,
            // 'minutes' => $minutes,
            // 'seconds' => $seconds,
            'result_time'  => sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds),
            'elapsed_time' => $elapsed_time
        ]);
    }

    public function index($id, $status = 'false')
    {


        $index_sto = Sto::orderBy('created_at', 'desc')->get();
        $flag_timer =  SessionSto::select('save_sto')->latest()->first();
        $total_durasi =  SessionSto::select('durasi', 'id', 'session_sto')->where('session_sto', $id)->get();
        // $not_yet_sto = Barang::select('*')->where('tgl_masuk', '<', date('Y-m-d'))->whereNull('tgl_terakhir_sto')->orderBy('created_at', 'asc')->get();
        // $not_yet_sto = Barang::select('*')->Where(DB::raw('month(tgl_terakhir_sto)'), '<', date('m'))->orWhereNull('tgl_terakhir_sto')->orWhereYear('tgl_terakhir_sto', '<', date('Y'))->orderBy('created_at', 'asc')->get();
        $not_yet_sto = Barang::select('*')->where('status_sto', 0)->orderBy('created_at', 'asc')->get();
        $id_session = $total_durasi[0]->id;


        $finish_sto =  Sto::select('*')->where('session_sto', '=', $id_session)->get();

        //check table save_sto apakah false or true
        $flag_timer = empty($flag_timer->save_sto) ? 'false' : 'true';

        // dd(($flag_timer));
        return view('menu.sto.sto', compact('index_sto', 'flag_timer', 'id', 'status', 'total_durasi', 'not_yet_sto', 'finish_sto'));
    }

    public function edit($id, $no_sto, $id_session)
    {


        $barang = Barang::where('no_asset', '=', $id)->get();
        $sto_old = Sto::where('no_asset', $id)->latest()->first();
        $endpoint = substr($id_session, strlen($id_session) - 4);
        // $endpoint = substr($id_session, 0, strlen($id_session) - 5);

        // dd($endpoint);

        if (empty($sto_old)) {
            $tgl_sto_old = '';
            $status_old = '';
        } else {
            $tgl_sto_old = $sto_old->tgl_save_sto;
            $status_old = $sto_old->status;
        }


        $enumValues = DB::select("SHOW COLUMNS FROM sto WHERE Field = 'status'");
        $enum = [];
        if (isset($enumValues[0])) {
            preg_match("/enum\(('(.*?[^'])*')\)/", $enumValues[0]->Type, $matches);
            $enum = array_map(function ($value) {
                return trim($value, "'");
            }, explode("','", $matches[1]));
        }

        // if ($barang[0]->status_sto != 1) {
        return view('fiture.sto.update_sto', compact('barang', 'enum', 'tgl_sto_old', 'status_old', 'id_session', 'no_sto', 'endpoint'));
        // } else {
        //     session()->flash('error_scan', 'no asset sudah di sto');
        //     return redirect()->route('page.sto', [$no_sto, 'false']);
        // }
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'tgl_sto'   => $request->tgl_end_sto,
        //     'no_asset'  => $request->no_asset_id,
        //     'status'    => $request->status_id,
        //     'user'      => $request->Auth::user()->name
        // ]);

        //Mengambil tgl-sto-sebelumnya
        $sto = Sto::where('no_asset', $request->no_asset_id)->latest()->first();
        $update_save_sto = Barang::where('no_asset', $request->no_asset_id);

        // dd($update_save_sto->get()[0]->status_sto);
        if ($update_save_sto->get()[0]->status_sto != 1) {
            if (empty($sto)) {
                $tgl_sto_old = $request->tgl_end_sto;
            } else {
                $tgl_sto_old = $sto->tgl_save_sto;
            }

            // dd($tgl_sto_old->tgl_save_sto);
            Sto::create([
                'session_sto'   => $request->id_session,
                'tgl_sto'       => $tgl_sto_old,
                'no_asset'      => $request->no_asset_id,
                'status'        => $request->status_id,
                'user'          => Auth::user()->name,
                'tgl_save_sto'  => date('Y-m-d')
            ]);

            $update_save_sto->update([
                'tgl_terakhir_sto' => date('Y-m-d'),
                'status_sto'       => 1
            ]);

            session()->flash('success', 'Sto berhasil di update.');
            return redirect()->route('page.sto', [$request->session_sto, 'false']);
        } else {
            session()->flash('error_scan', 'no asset sudah di sto');
            return redirect()->route('page.sto',  [$request->session_sto, 'false']);
        }
    }

    public function update(Request $request)
    {

        $sto_edit = Sto::select('no_asset', 'session_sto', 'status')->where('no_asset', $request->no_asset_id)
            ->where('session_sto', $request->id_session);

        $sto_edit->update([
            'status' => $request->status_id
        ]);

        return redirect()->route('page.sto', [$request->session_sto, 'false']);
    }

    public function scan(Request $request)
    {
        $barang = Barang::where('no_asset', '=', $request->id_qrcode)->get();
        $current_sto = SessionSto::select('session_sto')->orderBy('created_at', 'desc')->latest()->first();

        // dd($barang);
        if ($barang->isEmpty()) {
            return response()->json([
                'status' => 404
            ]);
        } else {

            return response()->json([
                'status' => 200,
                'session_sto' => $current_sto->session_sto
            ]);
        }
    }

    // Export data yang dipilih ke Excel
    public function exportExcel(Request $request)
    {
        $id_session = $request->id_session;

        if (empty($id_session)) {
            return back()->with('error', 'Data tidak ditemukan');
        }

        $sto_export = Sto::where('session_sto', $id_session)->get();

        //  Export ke Excel
        return Excel::download(new DataStoExport($sto_export), date('YmdHis') . '_REKAP STO' . '.xlsx');
    }


    // Export data yang dipilih ke Excel
    public function exportBa(Request $request)
    {
        $id_session = $request->id_session;


        $sto_export = Sto::where('session_sto', $id_session)->where('status', 'Rusak')->get();
        // // dd($sto_export->count());
        // if ($sto_export->count() == 0) {
        //     return response()->json([
        //         'message' => 'Detail Data Post',
        //     ]);
        // }

        // dd($sto_export);

        // Mengecek apakah data ditemukan
        if ($sto_export->isEmpty()) {
            // Jika tidak ada data, mengembalikan response error
            return response()->json([
                'message' => 'Tidak ada data dengan status Rusak untuk session ini.',
            ], 404); // 404 Not Found
        }

        //  Export ke Excel
        return Excel::download(new DataBaExport($sto_export), date('YmdHis') . '_BERITA ACARA' . '.xlsx');
    }
}
