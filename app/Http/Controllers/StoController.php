<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class StoController extends Controller
{
    public function index() {
        return view('menu.sto.sto');
    }

    public function edit($id){
       
        $barang = Barang::where('no_asset','=',$id)->get();
        return view('fiture.sto.update_sto',compact('barang'));
        
    }

    public function scan(Request $request){
        // dd($this->edit($request->id_qrcode));
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
