<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\SessionSto;
use App\Models\Sto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoController extends Controller
{

    function saveTimer($id)
    {

        $id_session_sto   = SessionSto::where('session_sto', $id);

        //untuk mengurai string JSON tersebut menjadi array atau objek
        $total_durasi = json_decode($this->timer()->content(), true);
        // dd(now());
        $id_session_sto->update([
            'durasi'  => $total_durasi['result_time'],
            'save_sto' => now()
        ]);
        return redirect()->route('page.dashboard');
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
        // dd($status);
        $index_sto = Sto::orderBy('created_at', 'desc')->get();
        $flag_timer =  SessionSto::select('save_sto')->latest()->first();
        $total_durasi =  SessionSto::select('durasi', 'id', 'session_sto')->where('session_sto', $id)->get();
        $not_yet_sto = Barang::select('*')->where('tgl_masuk', '<', date('Y-m-d'))->whereNull('tgl_terakhir_sto')->orderBy('created_at', 'asc')->get();
        $id_session = $total_durasi[0]->id;

        $finish_sto =  Sto::select('*')->where('session_sto', '=', $id_session)->get();

        //check table save_sto apakah false or true
        $flag_timer = empty($flag_timer->save_sto) ? 'false' : 'true';

        // dd(($flag_timer));
        return view('menu.sto.sto', compact('index_sto', 'flag_timer', 'id', 'status', 'total_durasi', 'not_yet_sto', 'finish_sto'));
    }

    public function edit($id, $no_sto, $id_session)
    {
        // dd($id_session);
        $barang = Barang::where('no_asset', '=', $id)->get();
        $sto_old = Sto::where('no_asset', $id)->latest()->first();

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

        return view('fiture.sto.update_sto', compact('barang', 'enum', 'tgl_sto_old', 'status_old', 'id_session', 'no_sto'));
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
            'tgl_save_sto'  => $request->tgl_end_sto
        ]);

        $update_save_sto->update([
            'tgl_terakhir_sto' => date('Y-m-d')
        ]);

        session()->flash('success', 'Sto berhasil di update.');
        return redirect()->route('page.sto', [$request->session_sto, 'false']);
    }

    public function scan(Request $request)
    {
        $barang = Barang::where('no_asset', '=', $request->id_qrcode)->get();
        // dd($barang);
        if ($barang->isEmpty()) {
            return response()->json([
                'status' => 404
            ]);
        } else {

            return response()->json([
                'status' => 200
            ]);
        }
    }
}
