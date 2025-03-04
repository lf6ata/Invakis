<?php

namespace App\Http\Controllers;

use App\Models\categori;
use Illuminate\Http\Request;
use PhpParser\Node\Expr\Cast\String_;
use Ramsey\Uuid\Type\Integer;

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
            'id_categori' => 'required|max:2|unique:categori,id_categori',
            'categori' =>  'required',
        ]
    );
     

      categori::create($request->all());
      return redirect()->route('page.categori');  
    }



    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    
     public function showCategoriEdit($id)
    {

        $post_categori = categori::where('id_categori',$id)->first();
        //return response
        
        return response()->json([
            'success' => true,
            'message' => 'Detail Data Post',
            'data'    => $post_categori
        ]); 

    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $post
     * @return void
     */
    public function updateCategoriEdit(Request $request, $id)
    {
        //define validation rules
        $validator = $request->validate([
            'id_categori' => 'required|max:2',
            'categori' =>  'required'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }


        //create post
        $post = categori::where('id_categori',$id);
        $post->update([
            'id_categori'  => $request->id_categori, 
            'categori'   => $request->categori
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!',
            'data'    => $post  
        ]);
    }


function destroyCategori($id)
{
    // Cari kategori berdasarkan ID
    $categori = categori::where('id_categori',$id)->first();

    // Jika kategori tidak ditemukan, kembalikan respon 404
    if (!$categori) {
        return response()->json(['message' => 'Category not found'], 404);
    }

    // Hapus kategori
    $categori->delete();

    // Kembalikan respon sukses
    return response()->json(['message' => 'Category deleted successfully'], 200);
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
