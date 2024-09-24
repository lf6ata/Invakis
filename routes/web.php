<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterdataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('menu.dashboard.dashboard');
});

//View Content Dashboard
Route::get('/dashboard', [DashboardController::class,'pageDashboard'])->name('page.dashboard');


//View Content Data Categori
Route::get('/invakis/barang/categori', [MasterdataController::class,'pageCategori'])->name('page.categori');
//View Content Create Categori
Route::post('/invakis/barang/create_categori', [MasterdataController::class,'categoriCreate'])->name('create.categori');
//View Content Show Edit Categori
Route::get('/invakis/barang/edit_categori/{post_id}', [MasterdataController::class,'showCategoriEdit'])->name('fiture.edit_categori');
// Route::resource('/posts', App\Http\Controllers\MasterdataController::class);
Route::put('/invakis/barang/edit_categori/post/{post_id}', [MasterdataController::class,'updateCategoriEdit']);
//Delete Data Categori
Route::delete('/invakis/barang/delete/{post_id}', [MasterdataController::class,'destroyCategori']);

//Input Data Jenis
Route::post('/invakis/barang/create_jenis', [MasterdataController::class,'createJenis'])->name('create.jenis');
//View Content Show Edit Categori
Route::get('/invakis/barang/tampil_jenis', [MasterdataController::class,'DataJenis'])->name('halaman.jenis');


//TES TAMPIL DATA AJA
Route::get('/tes', [MasterdataController::class,'getJenis'])->name('jenis.get');
//TES DELETE DATA AJA
Route::delete('/tes/delete/{id_jenis}', [MasterdataController::class,'destroyJenis'])->name('jenis.delete');
//TES VIEW DATA EDIT AJA
Route::get('/tes/edit/{id_jenis}', [MasterdataController::class,'showJenis']);
//TES UPDATE DATA  AJA
Route::put('/tes/update/{id_jenis}', [MasterdataController::class,'updateJenis']);








//View Content Data Jenis
Route::get('/invakis/barang/jenis', [MasterdataController::class,'pageJenis'])->name('page.jenis');
//View Content Data Merek
Route::get('/invakis/barang/merek', [MasterdataController::class,'pageMerek'])->name('page.merek');
//View Content Data Warna
Route::get('/invakis/barang/warna', [MasterdataController::class,'pageMerek'])->name('page.warna');
//View Content Data Barang
Route::get('/invakis/barang/input_barang', [MasterdataController::class,'pageBarang'])->name('page.barang');


Route::get('/barang',[MasterdataController::class, "tampil"])->name("masterdata.tampil");
Route::post('/tambah_barang',[MasterdataController::class, "tambah"])->name("masterdata.tambah");