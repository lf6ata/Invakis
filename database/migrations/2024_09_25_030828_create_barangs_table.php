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
            $table->string('no_asset',20)->nullable();
            $table->unsignedBigInteger('id_categori');
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_merek');
            $table->string('lokasi',20)->nullable();
            $table->unsignedBigInteger('npk');
            $table->string('nama_kr')->nullable();
            $table->timestamps();
            
            $table->index('id_categori')->key;  
            $table->index('id_jenis')->key;
            $table->index('id_merek')->key;

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
