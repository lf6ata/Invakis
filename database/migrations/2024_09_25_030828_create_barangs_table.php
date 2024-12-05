<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('barang', function (Blueprint $table) {
            $table->id();
            $table->string('no_asset', 20);
            $table->unsignedBigInteger('id_categori')->nullable()->default(0);
            $table->unsignedBigInteger('id_jenis')->nullable()->default(0);
            $table->unsignedBigInteger('id_merek')->nullable()->default(0);
            $table->unsignedBigInteger('id_warna')->nullable()->default(0);
            $table->unsignedBigInteger('npk')->nullable()->default(0);
            $table->string('lokasi', 20)->nullable();
            $table->string('nama_kr')->nullable();
            $table->string('divisi')->nullable();
            $table->tinyText('image')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('jenis_license')->nullable();
            $table->string('kode_license')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_terakhir_sto')->nullable();
            $table->timestamps();

            $table->index('id_categori')->key;
            $table->index('id_jenis')->key;
            $table->index('id_merek')->key;
            $table->index('npk')->key;

            // $table->unsignedBigInteger('id_categori');
            // $table->unsignedBigInteger('id_jenis');
            // $table->unsignedBigInteger('id_merek');

            // $table->foreign('id_jenis')->references('id')->on('jenis')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('id_categori')->references('id')->on('categori')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('id_merek')->references('id')->on('merek')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
