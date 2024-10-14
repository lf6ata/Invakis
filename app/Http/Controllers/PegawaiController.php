<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    // function __construct()
    // {
    //     $get_karyawan = Karyawan::;
    // }
    public function getPegawai($orderby){
        
        $get_pegawai = Karyawan::orderBy($orderby,'desc')->get();
        // $get_pegawai = Karyawan::all();

        return view('menu.pegawai.data_pegawai',compact('get_pegawai'));
    }

    public function storeKaryawan(Request $request) {
        
        // $request->validate([
        //     'id_merek' => 'required|max:2|unique:merek,id_merek',
        //     'merek' => 'required|unique:merek,merek',
        // ]);
        $tb_karywan = new Karyawan();

        $tb_karywan::create([
            'npk' => $request->npk_id,
            'nama_kr' => $request->karyawan_id,
            'divisi' => $request->divisi_id,
        ]);
    
        return redirect()->route('page.pegawai','created_at');  
    
    
    }

    public function editPegawai($id)
    {
        
        $find_karyawan = Karyawan::find($id);
        
        // $get_karyawan = Karyawan::all();
        //return response
        return response()->json([
            'index_karyawan' => $find_karyawan,
            
        ]); 

    }

    public function updatePegawai(Request $request, $id)
    {
        //find id
        $find_karyawan = Karyawan::where('id',$id);

        //define validation rules
        $request->validate([
            'npk'       => 'required',
            'nama_kr'   => 'required',
            'divisi'    => 'required',
        ]);

        //update data
        $find_karyawan->update([
            'npk'       => $request->npk, 
            'nama_kr'   => $request->nama_kr,
            'divisi'    => $request->divisi
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $find_karyawan  
        ]);
    }

    function destroyPegawai($id)
    {
        // Cari pegawai berdasarkan ID
        $find_pegawai = Karyawan::where('id',$id);

        // Jika id pegawai tidak ditemukan, kembalikan respon 404
        if (!$find_pegawai) {
            return response()->json(['message' => 'data pegawai not found'], 404);
        }

        // Hapus pegawai
        $find_pegawai->delete();

        // Kembalikan respon sukses
        return response()->json(['message' => 'Data Pegawai deleted successfully'], 200);
    }

}
