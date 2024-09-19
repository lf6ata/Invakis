<?php

namespace App\Http\Controllers;

use App\Models\categori;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;

class MasterdataController extends Controller
{
    // function tampil() {
    //     return View("master.barang");
    // }

    //  function categoriCreate(Request $request)  
    //  {
    //      $Categori = new categori();
         

    //      $Categori->id_categori = $request->id_categori;
    //      $Categori->categori = $request->categori;
    //      $Categori->save();
    //      //dd('Categori');
    //      return redirect()->route('page.categori');  
    //  }

    function pageCategori()  
    {
         //$Categori = categori::latest()->get();
         $Categori = categori::get();
        // dd($Categori);
        return view('menu.barang.input_categori', compact('Categori'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */


    function categoriCreate(Request $request)  
    {   
        $request->validate([
            'id_categori' => 'required|max:2',
            'categori' =>  'required'
        ]);
     

      categori::create($request->all());
      return redirect()->route('page.categori');  
    }

    function showCategoriEdit(categori $post)
    {
        //return response
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $post  
        ]); 
    }
    
    function categoriEdit(Request $request, string $id)  
    {   
        $data = $request->validate([
            'id_categori' => 'required|max:2',
            'categori' =>  'required'
        ]);
     

        categori::find($id)->update($data);
        return redirect()->route('page.categori');  
    }











    public function pageJenis()  
    {
        return view('menu.barang.input_jenis');
    }

    public function pageMerek()  
    {
        return view('menu.barang.input_merek');
    }

    public function pageWarna()  
    {
        return view('menu.barang.input_warna');
    }

    public function pageBarang()  
    {
        return view('menu.barang.input_barang');
    }

}
