<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Sto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StoController extends Controller
{
    public function index() {

        $index_sto = Sto::orderBy('created_at','desc')->get();
        return view('menu.sto.sto',compact('index_sto'));
    }

    public function edit($id){
       
        $barang = Barang::where('no_asset','=',$id)->get();
        $sto_old = Sto::where('no_asset',$id)->latest()->first();

        if (empty($sto_old) ) {
            $tgl_sto_old = ''; 
            $status_old = '';
        }

        else{
            $tgl_sto_old = $sto_old->tgl_save_sto;
            $status_old = $sto_old->status;
        }

        
        $enumValues = DB::select("SHOW COLUMNS FROM sto WHERE Field = 'status'");
        $enum = [];
        if (isset($enumValues[0])) {
            preg_match("/enum\(('(.*?[^'])*')\)/", $enumValues[0]->Type, $matches);
            $enum = array_map(function($value) {
                return trim($value, "'");
            }, explode("','", $matches[1]));
        }

        return view('fiture.sto.update_sto',compact('barang','enum','tgl_sto_old','status_old'));
        
    }

    public function store(Request $request){
        // $request->validate([
        //     'tgl_sto'   => $request->tgl_end_sto,
        //     'no_asset'  => $request->no_asset_id,
        //     'status'    => $request->status_id,
        //     'user'      => $request->Auth::user()->name
        // ]);
        
        //Mengambil tgl-sto-sebelumnya
        $sto = Sto::where('no_asset',$request->no_asset_id)->latest()->first();
        
        if (empty($sto)) {
            $tgl_sto_old = $request->tgl_end_sto;
        } else {
            $tgl_sto_old = $sto->tgl_save_sto;
        }
        
        // dd($tgl_sto_old->tgl_save_sto);
        Sto::create([
            'tgl_sto'       => $tgl_sto_old,
            'no_asset'      => $request->no_asset_id,
            'status'        => $request->status_id,
            'user'          => Auth::user()->name,
            'tgl_save_sto'  => $request->tgl_end_sto
        ]);

        session()->flash('success', 'Sto berhasil di update.');
        return redirect()->route('page.sto');
    }

    public function scan(Request $request){
        
        $barang = Barang::where('no_asset', '=', $request->id_qrcode)->get();
        if ( $barang->isEmpty()) {
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
