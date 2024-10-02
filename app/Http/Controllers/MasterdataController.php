<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\categori;
use App\Models\Category;
use App\Models\Jenis;
use App\Models\Merek;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Yajra\DataTables\DataTables;

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
            $request->validate
            (   [
                    'id_categori' => 'required|digits_between:1,2|numeric|unique:categori,id_categori',
                    'categori' =>  'required',
                ]
            );
     

      categori::create($request->all());
      return redirect()->route('page.categori');  
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


    /**
     * show
     *
     * @param  mixed $post
     * @return void
     */
    
     public function showCategoriEdit($id)
    {

        // $post_categori = categori::where('id_categori',$id)->first();
        $post_categori = categori::find($id);
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
        $request->validate([
            'id_categori' => 'required|max:2',
            'categori' =>  'required'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }


        //create post
        $post = categori::where('id',$id);
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
        $categori = categori::where('id',$id);

        // Jika kategori tidak ditemukan, kembalikan respon 404
        if (!$categori) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        // Hapus kategori
        $categori->delete();

        // Kembalikan respon sukses
        return response()->json(['message' => 'Category deleted successfully'], 200);
    }


    /***************************************/
    /****** CONROLLER SUB FORM JENIS ********/
    /***************************************/


        /**
         * @param  mixed $request
         */

    function createJenis(Request $request)
        {
            // Validasi input data
            $validatedData = $request->validate([
                'id_jenis' => 'required|max:2|alpha',
                'jenis' => 'required',
            ]);

            // Simpan data ke database atau lakukan tindakan lain
            // Misalnya:
            Jenis::create($validatedData);

            // Mengirim respons sukses
            return response()->json(['success' => true]);
        }

    function DataJenis()
        {
            // Ambil data dari database
            $data = Jenis::latest()->get();

            // Kirim response sebagai JSON
            return response()->json($data);
        }


    public function getJenis(Request $request){
        if($request->ajax()){
            //Ambil Data
            $jenis = Jenis::query();
            return DataTables::of($jenis)->addIndexColumn()->make(true);
        }

    }

    public function destroyJenis($id)
        {
            $jenis_tes = Jenis::find($id);
            // Cari kategori berdasarkan ID dan hapus
            // dd($jenis_tes);
            
            $jenis_tes->delete();

            // Kembalikan response sukses
            return response()->json(['success' => 'Kategori berhasil dihapus']);
        }
        
    public function showJenis($id)
        {

        $id_jenis = Jenis::find($id);
        //return response
        
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil di update',
            'data'    => $id_jenis
        ]); 

    }

    public function updateJenis(Request $request, $id)
    {
        //define validation rules
        $request->validate([
            'id_jenis' => 'required|max:2',
            'jenis' =>  'required'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        
        //create post
        $id_Jenis = Jenis::find($id);
        $id_Jenis->update([
            'id_jenis'  => $request->id_jenis, 
            'jenis'   => $request->jenis
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!'
        ]);
    }

    /***************************************/
    /****** CONROLLER SUB FORM MEREK ********/
    /***************************************/

    
    public function getMerek(Request $request){
        if($request->ajax()){
            //Ambil Data
            $merek = Merek::query();
            return DataTables::of($merek)->addIndexColumn()->make(true);
        }
    
    }

    public function storeMerek(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'id_merek' => 'required|max:2|unique:merek,id_merek',
            'merek' => 'required|unique:merek,merek',
        ]);

        // Simpan data ke database atau lakukan tindakan lain
        // Misalnya:
        Merek::create($validatedData);

        // Mengirim respons sukses
        return response()->json(['success' => true]);
    }

    public function destroyMerek($id)
    {
        $merek_id = Merek::find($id);
        // Cari kategori berdasarkan ID dan hapus
        // dd($jenis_tes);
        
        $merek_id->delete();

        // Kembalikan response sukses
        return response()->json(['success' => 'Kategori berhasil dihapus']);
    }

    public function showMerek($id)
    {

        $merek_id = Merek::find($id);
        //return response
        
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil di update',
            'data'    => $merek_id
        ]); 

    }

    public function updateMerek(Request $request, $id)
    {
        //define validation rules
        $request->validate([
            'id_merek' => 'required|max:2',
            'merek' =>  'required'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }

        
        //create post
        $merek_id = Merek::find($id);
        $merek_id->update([
            'id_merek'  => $request->id_merek, 
            'merek'   => $request->merek
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!'
        ]);
    }

    
    /***************************************/
    /****** CONROLLER BARANG ********/
    /***************************************/

    public function getBarang($orderby){
        
        $get_barang = Barang::orderBy($orderby,'desc')->get();
        $get_categori = categori::all();
        $get_jenis = Jenis::all();
        $get_merek = Merek::all();

        return view('menu.barang.input_barang', compact('get_barang', 'get_categori', 'get_jenis', 'get_merek'));
    }


    public function storeBarang(Request $request) {
        $tb_barang = new Barang();
        // Validasi file upload
        // $request->validate([
        //     // 'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Maksimal 2MB
        //     'id_categori' => 'required',
        //     'id_jenis' => 'required',
        //     'id_merek' => 'required'
        // ]);
        $asset_barang   = Barang::latest()->first();
        $asset_categori = categori::find($request->categori_id)->id_categori;
        $asset_jenis    = Jenis::find($request->jenis_id)->id_jenis;
        $asset_merek    = Merek::find($request->merek_id)->id_merek;

        if(!empty($asset_barang->id)){
            $no_index = intval(substr($asset_barang->no_asset,9))+1;
        }
        else
        {
            $no_index = 1;
        }
        $tb_barang::create([
            'no_asset' => $asset_categori.'-'.$asset_jenis.'-'.$asset_merek.'-'.$no_index,
            'id_categori' => $request->categori_id,
            'id_jenis' => $request->jenis_id,
            'id_merek' => $request->merek_id,
        ]);

        return redirect()->route('page.barang','created_at');  

        // dd($tes);
       
        // dd($tes);

        // if ($request->hasFile('image')) {

        //     $file = $request->file('image');

        //     // Buat nama file baru dengan timestamp dan nama asli
        //     $filename = time() . '_' . $file->getClientOriginalName();

        //     // Pindahkan file ke folder storage atau public
        //     $path = $file->storeAs('images', $filename, 'public'); // Simpan di folder 'public/images'

        //     // Mengirimkan response berhasil dengan nama file dan lokasi
        //     return back()->with('success', 'Gambar berhasil diupload!')->with('image', $filename);
        // }

        // return back()->with('error', 'Gagal mengupload gambar!');

    }

    public function showBarang($id)
    {
        
        $index_barang = Barang::find($id);
        $get_categori = categori::all();
        $get_jenis = Jenis::all();
        $get_merek = Merek::all();
        //return response
        return response()->json([
            'index_barang' => $index_barang,
            'get_categori' => $get_categori,
            'get_jenis' => $get_jenis,
            'get_merek' => $get_merek
        ]); 

    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function updateBarang(Request $request, $id)
    {
        //define validation rules
        // $request->validate([
        //     'id_categori' => 'required',
        //     // 'id_jenis' => 'required',
        //     // 'id_merek' => 'required',
        // ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }
        

        $index_barang = Barang::find($id);
        
        if (!empty($index_barang)) {

            $index_barang->update([
                'id_categori'  => $request->id_categori,
                'id_jenis' => $request->id_jenis,
                'id_merek' => $request->id_merek,
            ]);
            
            
            //return response
            return response()->json([
                'message' => 'Data Berhasil Diudapte!', 
                'data' => $index_barang
            ]);

            
        }
        

        return response()->json([
            'message' => 'Data Gagal di Update' 
        ]);
        
        
    }

    function destroyBarang($id)
    {
        // Cari kategori berdasarkan ID
        $barang = Barang::where('id',$id);

        // Jika kategori tidak ditemukan, kembalikan respon 404
        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Hapus kategori
        $barang->delete();

        // Kembalikan respon sukses
        return response()->json(['message' => 'Category deleted successfully'], 200);
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

    // public function pageBarang()  
    // {
    //     return view('menu.barang.input_barang');
    // }

}
