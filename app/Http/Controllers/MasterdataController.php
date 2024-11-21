<?php

namespace App\Http\Controllers;

use App\Exports\DataExport;
use App\Models\Barang;
use App\Models\categori;
use App\Models\Jenis;
use App\Models\Karyawan;
use App\Models\Merek;
use App\Models\Warna;
use Barryvdh\DomPDF\Facade\Pdf;
use Faker\Core\File;
use Illuminate\Container\Attributes\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage as FacadesStorage;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Svg\Tag\Rect;
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
        $validator = $request->validate(
            [
                'id_categori' => 'required|digits_between:1,2|numeric|unique:categori,id_categori',
                'categori' =>  'required',
            ]
        );


        if ($validator) {
            categori::create($request->all());
            // Menggunakan flash message
            session()->flash('success', 'Kategori berhasil di tambah.');
            return redirect()->route('page.categori');
        } else {
            session()->flash('unsuccess', 'Gagal di tambah.');
            return redirect()->route('page.categori');
        }
    }

    function categoriEdit(Request $request, string $id)
    {
        $data = $request->validate([
            'id_categori' => 'required|digits_between:1,2|numeric|unique:categori,id_categori',
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
        $post = categori::where('id', $id);
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
        $categori = categori::where('id', $id);

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
            'id_jenis' => 'required|max:2|alpha|unique:jenis,id_jenis',
            'jenis' => 'required|unique:jenis,jenis',
        ]);

        // Simpan data ke database atau lakukan tindakan lain
        // Misalnya:

        Jenis::create([
            'id_jenis'  => strtoupper($request->id_jenis),
            'jenis'     => $request->jenis,
        ]); // Simpan data ke database atau lakukan tindakan lain

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


    public function getJenis(Request $request)
    {
        if ($request->ajax()) {
            //Ambil Data
            $jenis = Jenis::all();

            // Format id_jenis menggunakan sprintf
            $jenis = $jenis->map(function ($item) {
                $item->id_jenis = strtoupper($item->id_jenis); // Memformat id_jenis
                return $item;
            });
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
            'jenis' =>  'required | unique:jenis,jenis'
        ]);

        //check if validation fails
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 422);
        // }


        //create post
        $id_Jenis = Jenis::find($id);
        $id_Jenis->update([
            'id_jenis'  => strtoupper($request->id_jenis),
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


    public function getMerek(Request $request)
    {
        if ($request->ajax()) {
            //Ambil Data
            $merek = Merek::all();

            // Format id_merek menggunakan sprintf
            $merek = $merek->map(function ($item) {
                $item->id_merek = sprintf('%02d', $item->id_merek); // Memformat id_merek
                return $item;
            });

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
            'id_merek'  => strtoupper($request->id_merek),
            'merek'   => $request->merek
        ]);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil Diudapte!'
        ]);
    }

    /***************************************/
    /****** CONROLLER SUB FORM WARNA ********/
    /***************************************/


    public function getWarna(Request $request)
    {
        if ($request->ajax()) {
            $warna = Warna::all(); //Ambil Data

            // Format id_warna menggunakan strtoupper
            $warna = $warna->map(function ($item) {
                $item->id_warna = strtoupper($item->id_warna); // Memformat id_jenis
                return $item;
            });

            return DataTables::of($warna)->addIndexColumn()->make(true);
        }
    }

    public function storeWarna(Request $request)
    {
        // Validasi input data
        $validatedData = $request->validate([
            'id_warna'  => 'required|max:2|unique:warna,id_warna',
            'warna'     => 'required|unique:warna,warna',
        ]);

        Warna::create([
            'id_warna'  => strtoupper($request->id_warna),
            'warna'     => $request->warna,
        ]); // Simpan data ke database atau lakukan tindakan lain

        return response()->json(['success' => true]); // Mengirim respons sukses
    }

    public function destroyWarna($id)
    {
        $warna_id = Warna::find($id);

        $warna_id->delete();

        return response()->json(['success' => 'Kategori berhasil dihapus']); // Kembalikan response sukses
    }

    public function showWarna($id)
    {

        $warna_id = Warna::find($id);

        //return response
        return response()->json([
            'success' => true,
            'message' => 'Data Berhasil di update',
            'data'    => $warna_id
        ]);
    }

    public function updateWarna(Request $request, $id)
    {
        //define validation rules
        $request->validate([
            'id_warna' => 'required|max:2',
            'warna' =>  'required'
        ]);

        $warna_id = Warna::find($id); //update
        $warna_id->update([
            'id_warna'  => strtoupper($request->id_warna),
            'warna'   => $request->warna
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

    public function getBarang($orderby)
    {

        $get_barang = Barang::orderBy($orderby, 'desc')->get();
        $get_categori = categori::all();
        $get_jenis = Jenis::all();
        $get_merek = Merek::all();
        $get_warna = Warna::select('id', 'id_warna', 'warna')->get();
        $get_karyawan = Karyawan::all();


        return view('menu.barang.input_barang', compact('get_barang', 'get_categori', 'get_jenis', 'get_merek', 'get_warna', 'get_karyawan'));
    }

    public function getKaryawan($id_npk)
    {
        $karyawan = Karyawan::where('id', $id_npk)->first();

        if ($karyawan) {
            return response()->json([
                'nama_kr' => $karyawan->nama_kr,
                'npk' => $karyawan->npk,
                'divisi' => $karyawan->divisi,
            ]);
        } else {
            return response()->json(['error' => 'Karyawan tidak ditemukan'], 404);
        }
    }


    public function storeBarang(Request $request)
    {
        $tb_barang = new Barang();

        // Definisikan field yang memerlukan pesan `required` khusus
        $fields = [
            'categori_id'   => 'kategori',
            'jenis_id'      => 'jenis',
            'merek_id'      => 'merek',
            'warna_id'      => 'warna',
            'lokasi_id'     => 'lokasi',
            'npk_id'        => 'npk',
            'karyawan_id'   => 'karyawan',
            'divisi_id'     => 'divisi',
            'image'         => 'foto',
            'sn_id'         => 'serial number',
            'jlicense_id'   => 'jenis license',
            'kdlicense_id'  => 'kode license',
            'tanggal_masuk' => 'tanggal masuk'
        ];

        // Array untuk pesan kesalahan
        $messages = [];


        // Buat pesan kesalahan khusus menggunakan `foreach`
        foreach ($fields as $key => $field) {
            $messages["{$key}.required"]    = 'Inputan ' . ucfirst($field) . ' wajib diisi.';
            $messages["{$key}.string"]      = 'Inputan ' . ucfirst($field) . ' harus text.';
            $messages["{$key}.image"]       = 'Inputan ' . ucfirst($key) . ' harus gambar.';
            $messages["{$key}.mimes"]       = ucfirst($field) . ' harus berformatkan jpeg, png, jpg.';
            $messages["{$key}.max"]         = 'Size ' . ucfirst($field) . ' max 2MB';
            $messages["{$key}.date"]        = ucfirst($field) . ' inputan harus valid';
        }

        //Validasi file upload
        $request->validate(
            [
                'categori_id'   => 'required',
                'jenis_id'      => 'required',
                'merek_id'      => 'required',
                'warna_id'      => 'required',
                'lokasi_id'     => 'string |nullable',
                'npk_id'        => 'required',
                'karyawan_id'   => 'required',
                'divisi_id'     => 'required',
                'image'         => 'image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
                'sn_id'         => 'string |nullable',
                'jlicense_id'   => 'string |nullable',
                'kdlicense_id'  => 'string |nullable',
                'tanggal_masuk' => 'required | date'

            ],
            $messages
        );

        // dd($request->image);
        //Validasi Image apakah image kosong?
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            // Buat nama file baru dengan timestamp dan nama asli
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pindahkan file ke folder storage atau public
            $path = $file->storeAs('images', $filename, 'public'); // Simpan di folder 'public/images'

            // Mengirimkan response berhasil dengan nama file dan lokasi
            // return back()->with('success', 'Gambar berhasil diupload!')->with('image', $filename);
        } else {
            $path = 'Not Image';
        }
        // else{
        //     return back()->with('error', 'Gagal mengupload gambar!');
        // }

        $asset_barang   = Barang::latest()->first();
        $asset_categori = categori::find($request->categori_id)->id_categori;
        $asset_jenis    = Jenis::find($request->jenis_id)->id_jenis;
        $asset_merek    = Merek::find($request->merek_id)->id_merek;
        $asset_warna    = Warna::find($request->warna_id)->id_warna;

        //Validasi No Asset
        if (!empty($asset_barang->id)) {
            $no_index = intval(substr($asset_barang->no_asset, 13)) + 1;
        } else {
            $no_index = 1;
        }

        $tb_barang::create([
            'no_asset'      => sprintf('%02d', $asset_categori) . '-' . strtoupper($asset_jenis) . '-' . sprintf('%02d', $asset_merek) . '-' . strtoupper($asset_warna) . '-' . sprintf('%03d', $no_index),
            'id_categori'   => $request->categori_id,
            'id_jenis'      => $request->jenis_id,
            'id_merek'      => $request->merek_id,
            'id_warna'      => $request->warna_id,
            'lokasi'        => $request->lokasi_id,
            'npk'           => $request->npk_id,
            'nama_kr'       => $request->karyawan_id,
            'divisi'        => $request->divisi_id,
            'image'         => $path,
            'serial_number' => $request->sn_id,
            'jenis_license' => $request->jlicense_id,
            'kode_license'  => $request->kdlicense_id,
            'tgl_masuk'     => $request->tanggal_masuk,
        ]);


        session()->flash('success', 'Barang berhasil di tambah.');
        return redirect()->route('page.barang', 'created_at');
    }

    public function viewFoto($id)
    {

        $find_foto = Barang::find($id);

        //return response
        return response()->json([
            'data' => $find_foto,
        ]);
    }

    public function showBarang($id)
    {

        $index_barang = Barang::find($id);
        $get_categori = categori::all();
        $get_jenis = Jenis::all();
        $get_merek = Merek::all();
        $get_warna = Warna::select('id', 'id_warna', 'warna')->get();
        $get_karyawan = Karyawan::all();
        // $get_karyawan = Karyawan::all();
        //return response
        return response()->json([
            'index_barang'  => $index_barang,
            'get_categori'  => $get_categori,
            'get_jenis'     => $get_jenis,
            'get_merek'     => $get_merek,
            'get_warna'     => $get_warna,
            'get_karyawan'  => $get_karyawan
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
        // dd($request->imagenew);
        $index_barang   = Barang::find($id);

        // Definisikan field yang memerlukan pesan `required` khusus
        $fields = [
            'id_categori'   => 'kategori',
            'id_jenis'      => 'jenis',
            'id_merek'      => 'merek',
            'id_warna'      => 'warna',
            'lokasi'        => 'lokasi',
            'npk'           => 'npk',
            'nama'          => 'karyawan',
            'divisi'        => 'divisi',
            'imagenew'      => 'foto',
            'sn'            => 'serial number',
            'jlicense'      => 'jenis license',
            'kdlicense'     => 'kode license',
            'datein'        => 'tanggal masuk'
        ];

        // Array untuk pesan kesalahan
        $messages = [];


        // Buat pesan kesalahan khusus menggunakan `foreach`
        foreach ($fields as $key => $field) {
            $messages["{$key}.required"]    = 'Inputan ' . ucfirst($field) . ' wajib diisi.';
            $messages["{$key}.string"]      = 'Inputan ' . ucfirst($field) . ' harus text.';
            $messages["{$key}.image"]       = 'Inputan ' . ucfirst($key) . ' harus gambar.';
            $messages["{$key}.mimes"]       = ucfirst($field) . ' harus berformatkan jpeg, png, jpg.';
            $messages["{$key}.max"]         = 'Size ' . ucfirst($field) . ' max 1MB';
            $messages["{$key}.date"]        = ucfirst($field) . ' inputan harus valid';
        }

        //Validasi file upload
        $request->validate(
            [
                'id_categori'   => 'required',
                'id_jenis'      => 'required',
                'id_merek'      => 'required',
                'id_warna'      => 'required',
                'lokasi'        => 'string |nullable',
                'npk'           => 'required',
                'nama'          => 'required',
                'divisi'        => 'required',
                'imagenew'      => 'nullable|image|mimes:jpeg,png,jpg|max:1047', // Maksimal 1MB
                'sn'            => 'string |nullable',
                'jlicense'      => 'string |nullable',
                'kdlicense'     => 'string |nullable',
                'datein'        => 'required | date'
            ],
            $messages
        );

        if ($request->hasFile('imagenew')) {

            $file = $request->file('imagenew');

            // Mengahapus file image yang seblumnya
            $path_old = $index_barang->image;
            if (FacadesStorage::disk('public')->exists($path_old)) {
                FacadesStorage::disk('public')->delete($path_old);
            }

            // Buat nama file baru dengan timestamp dan nama asli
            $filename = time() . '_' . $file->getClientOriginalName();

            // Pindahkan file ke folder storage atau public
            $path = $file->storeAs('images', $filename, 'public'); // Simpan di folder 'public/images'

            $index_barang->image = $path;
            $index_barang->save();
        }



        $asset_categori = categori::find($request->id_categori)->id_categori;
        $asset_jenis    = Jenis::find($request->id_jenis)->id_jenis;
        $asset_merek    = Merek::find($request->id_merek)->id_merek;
        $asset_warna    = Warna::find($request->id_warna)->id_warna;
        $no_index       = intval(substr($index_barang->no_asset, 13));

        // if (!empty($index_barang)) {
        $index_barang->update([
            'no_asset'      => sprintf('%02d', $asset_categori) . '-' . strtoupper($asset_jenis) . '-' . sprintf('%02d', $asset_merek) . '-' . strtoupper($asset_warna) . '-' . sprintf('%03d', $no_index),
            'id_categori'   => $request->id_categori,
            'id_jenis'      => $request->id_jenis,
            'id_merek'      => $request->id_merek,
            'id_warna'      => $request->id_warna,
            'lokasi'        => $request->lokasi,
            'npk'           => $request->npk,
            'nama_kr'       => $request->nama,
            'divisi'        => $request->divisi,
            'serial_number' => $request->sn,
            // 'image'         => $path,
            'jenis_license' => $request->jlicense,
            'kode_license'  => $request->kdlicense,
            'tgl_masuk'     => $request->datein,
        ]);

        //return response
        return response()->json([
            'message' => 'Data Berhasil Diudapte!',
        ]);
    }

    function destroyBarang($id)
    {
        // Cari kategori berdasarkan ID
        $barang = Barang::find($id);


        // Jika kategori tidak ditemukan, kembalikan respon 404
        if (!$barang) {
            return response()->json(['message' => 'Barang not found'], 404);
        }

        // Mengahapus file image
        $path = $barang->image;
        if (FacadesStorage::disk('public')->exists($path)) {
            FacadesStorage::disk('public')->delete($path);
        }

        // Hapus kategori
        $barang->delete();

        // Kembalikan respon sukses
        return response()->json(['message' => 'Category deleted successfully'], 200);

        //Check image
        // return dd(FacadesStorage::disk('public')->exists($path));
        // return dd(FacadesStorage::disk('public')->delete($path));
    }

    function destroyAllBarang(Request $request)
    {
        $ids = $request->input('data'); // Ambil array ID dari request

        // Hapus data berdasarkan ID
        Barang::destroy($ids);

        return response()->json(['success' => 'Data berhasil dihapus.']);
    }



    // Export data yang dipilih ke Excel
    public function exportSelected(Request $request)
    {

        $selectedIds = $request->selected_ids;

        if (!$selectedIds) {
            return back()->with('error', 'No data selected');
        }

        $barang = Barang::whereIn('id', $selectedIds)->get();

        //  Export ke Excel
        return Excel::download(new DataExport($barang), date('Y-m-d') . '_inventaris' . date('H.i') . '.xlsx');
    }

    public function generatePDF(Request $request)
    {
        $selectedIds = $request->selected_ids;

        if (!$selectedIds) {
            return back()->with('error', 'No data selected');
        }

        // Ambil data yang akan digunakan dalam PDF
        $barang = Barang::whereIn('id', $selectedIds)->get();

        // Buat file PDF dari view
        $pdf = PDF::loadView('pdf.qrcode', compact('barang'));

        // Kirimkan PDF sebagai respons ke browser tanpa mendownload
        return $pdf->stream('barang.pdf');
    }

    // public function show(){
    //      return QrCode::generate(
    //         'Hello, World!',
    //     );
    // }

}
