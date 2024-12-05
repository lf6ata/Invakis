<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterdataController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StoController;
use App\Http\Controllers\UserController;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/session_sto', [DashboardController::class, 'createSessionSto'])->name('create_session_sto');

Route::get('/timer', [StoController::class, 'timer']);

Route::get('/save_timer/{id}', [StoController::class, 'saveTimer'])->name('save_timer');

//View Page Login
Route::get('/login', [AuthController::class, 'authLogin'])->name('login')->middleware(['preventloggedin']);
//Prosse login
Route::post('/login/auth', [AuthController::class, 'store'])->name('auth.login')->middleware(['preventloggedin']);

//Prosse logut
Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.logout');

// Route::get('/', [MasterdataController::class,'pageCategori'])->name('page.dashboard');

//View Content Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'pageDashboard'])->name('page.dashboard');

    Route::middleware('admin')->group(function () {
        //View Halaman Pegawai
        Route::get('/invakis/pegawai/{orderby}', [PegawaiController::class, 'getPegawai'])->name('page.pegawai');
        //Upload Form Barang
        Route::post('/Invakis/pegawai/store_karyawan', [PegawaiController::class, 'storeKaryawan'])->name('store.pegawai');
        //View Content Show Data Edit Barang
        Route::get('/invakis/pegawai/edit/{id}', [PegawaiController::class, 'editPegawai']);
        //Delete Data Pegawai
        Route::delete('/invakis/pegawai/delete_pegawai/{id}', [PegawaiController::class, 'destroyPegawai']);
        //Update Data Pegawai
        Route::put('/invakis/pegawai/update/{id}', [PegawaiController::class, 'updatePegawai']);

        //View Page User
        Route::get('/Invakis/user', [UserController::class, 'index'])->name('page.user');
        //add User
        Route::post('/Invakis/user/add', [UserController::class, 'store'])->name('store.user');
        //Delete User
        Route::delete('/Invakis/user/delete/{id}', [UserController::class, 'destroy'])->name('destroy.user');
        //Edit User
        Route::get('/Invakis/user/edit/{id}', [UserController::class, 'edit']);
        //Update User
        Route::put('/Invakis/user/update/{id}', [UserController::class, 'update']);


        //View Page Roles
        Route::get('/invakis/role', [RoleController::class, 'index'])->name('page.role');
        //add Roles
        Route::post('/invakis/role/add', [RoleController::class, 'store'])->name('store.roles');
        //Delete Role
        Route::delete('/invakis/delete/role/{id}', [RoleController::class, 'destroy'])->name('destroy.role');
        //Edit Role
        Route::get('/invakis/role/edit/{id}', [RoleController::class, 'edit']);
        //Update Role
        Route::put('/invakis/role/update/{id}', [RoleController::class, 'update']);
    });

    //View Content Data Categori
    Route::get('/invakis/barang/categori', [MasterdataController::class, 'pageCategori'])->name('page.categori');
    //View Content Create Categori
    Route::post('/invakis/barang/create_categori', [MasterdataController::class, 'categoriCreate'])->name('create.categori');
    //View Content Show Edit Categori
    Route::get('/invakis/barang/edit_categori/{post_id}', [MasterdataController::class, 'showCategoriEdit'])->name('fiture.edit_categori');
    // Route::resource('/posts', App\Http\Controllers\MasterdataController::class);
    Route::put('/invakis/barang/edit_categori/post/{post_id}', [MasterdataController::class, 'updateCategoriEdit']);
    //Delete Data Categori
    Route::delete('/invakis/barang/delete/{post_id}', [MasterdataController::class, 'destroyCategori']);

    //Input Data Jenis
    Route::post('/invakis/barang/create_jenis', [MasterdataController::class, 'createJenis'])->name('create.jenis');
    //View Content Show Edit Categori
    Route::get('/invakis/barang/tampil_jenis', [MasterdataController::class, 'DataJenis'])->name('halaman.jenis');
    //TES TAMPIL DATA AJA
    Route::get('/tes', [MasterdataController::class, 'getJenis'])->name('jenis.get');
    //TES DELETE DATA AJA
    Route::delete('/tes/delete/{id_jenis}', [MasterdataController::class, 'destroyJenis'])->name('jenis.delete');
    //TES VIEW DATA EDIT AJA
    Route::get('/tes/edit/{id_jenis}', [MasterdataController::class, 'showJenis']);
    //TES UPDATE DATA  AJA
    Route::put('/tes/update/{id_jenis}', [MasterdataController::class, 'updateJenis']);

    //TAMPIL DATA MEREK
    Route::get('/invakis/barang/get-merek', [MasterdataController::class, 'getMerek'])->name('merek.get');
    //Input Data Merek
    Route::post('/invakis/barang/store_merek', [MasterdataController::class, 'storeMerek'])->name('store.merek');
    //DELETE DATA MEREK
    Route::delete('/invakis/delete/merek/{id_merek}', [MasterdataController::class, 'destroyMerek'])->name('destroy.merek');
    //TES VIEW DATA EDIT AJA
    Route::get('/invakis/edit/{id_merek}', [MasterdataController::class, 'showMerek']);
    //TES UPDATE DATA  AJA
    Route::put('/invakis/update/{id_merek}', [MasterdataController::class, 'updateMerek']);

    //TAMPIL DATA WARNA
    Route::get('/invakis/get-warna', [MasterdataController::class, 'getWarna'])->name('page.warna');
    //Input Data WARNA
    Route::post('/invakis/store_warna', [MasterdataController::class, 'storeWarna'])->name('store.warna');
    //DELETE DATA WARNA
    Route::delete('/invakis/delete_warna/{id}', [MasterdataController::class, 'destroyWarna']);
    //VIEW DATA EDIT
    Route::get('/invakis/edit_warna/{id}', [MasterdataController::class, 'showWarna']);
    //UPDATE DATA 
    Route::put('/invakis/update_warna/{id}', [MasterdataController::class, 'updateWarna']);


    Route::get('/get-karyawan/{id_npk}', [MasterdataController::class, 'getKaryawan']);
    //Get View Foto
    Route::get('/invakis/barang/foto/{id_foto}', [MasterdataController::class, 'viewFoto']);
    //Upload Form Barang
    Route::post('/upload-image', [MasterdataController::class, 'storeBarang'])->name('image.upload');
    //View Halaman Barang
    Route::get('/invakis/barang/view_barang/{orderby}', [MasterdataController::class, 'getBarang'])->name('page.barang');
    //View Content Show Data Edit Barang
    Route::get('/invakis/barang/edit_barang/{id}', [MasterdataController::class, 'showBarang']);
    //Submit Update Data Barang
    Route::post('/invakis/barang/update_barang/{id}', [MasterdataController::class, 'updateBarang']);
    //Delete Data Barang
    Route::delete('/invakis/barang/delete_barang/{id}', [MasterdataController::class, 'destroyBarang']);
    Route::delete('/invakis/barang/delete_all', [MasterdataController::class, 'destroyAllBarang']);


    Route::post('/export-selected', [MasterdataController::class, 'exportSelected'])->name('export.selected');

    Route::post('/exportpdf.selected', [MasterdataController::class, 'generatePDF'])->name('exportpdf.selected');

    Route::get('/qrcode', [MasterdataController::class, 'generatePDF']);


    //View Page STO
    Route::get('/invakis/sto/{id}/{status}', [StoController::class, 'index'])->name('page.sto');
    //View Edit STO
    Route::get('/invakis/sto_edit/{id}/{no_session}/{id_session}', [StoController::class, 'edit'])->name('edit.sto');
    //POST STO
    Route::post('/invakis/sto_post', [StoController::class, 'store'])->name('store.sto');

    //View Scan QrCode
    Route::get('/invakis/index/scan/{id}', [QrCodeController::class, 'index'])->name('page.scan');
    //SCAN QR
    Route::post('/invakis/sto/scan', [StoController::class, 'scan']);
});
// Route::get('/dashboard', [DashboardController::class,'pageDashboard']
// )->middleware(['auth'])->name('page.dashboard');



//View Content Data Barang
// Route::get('/invakis/barang/input_barang', [MasterdataController::class,'pageBarang'])->name('page.barang');



// //QrCode
// Route::get('/invakis/scan', [QrCodeController::class, 'generate']);

// Route::get('/qrcode-scanner', function () {
//     return view('welcome');
// });

// Route::get('/tesuser', function () {
//     $user = User::find(FacadesAuth::user()->name);
//     dd(Auth::user()->roles()->where('name', 'admin')->exists());
// });



//Menegecek Query wher dengan Eloquent ORM
// Route::get('query', function () {
//     return dd(Barang::where('no_asset','=','31-SA-21-1')->get());
// });

//Menegecek Query wher dengan Eloquent ORM
// Route::get('tes', function ():View{
//     return view('welcome');
// });
