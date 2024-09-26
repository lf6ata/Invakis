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
            $table->unsignedBigInteger('id_categori');
            $table->unsignedBigInteger('id_jenis');
            $table->unsignedBigInteger('id_merek');

            // $table->foreign('id_jenis')->constrained(
            //     table: 'jenis', indexName: 'id'
            // )->onUpdate('cascade')->onDelete('cascade');
            // $table->string('id_asset');
            // $table->string('id_jenis',255);
            // $table->foreign('id_jenis')->references('id_jenis')->on('jenis');
            // $table->foreignId('id_jenis')->constrained()->onDelete('cascade');
            // $table->foreignId('id_merek')->constrained()->onDelete('cascade');
            // $table->string('image_asset')->nullable();
            $table->timestamps();

            $table->foreign('id_jenis')->references('id')->on('jenis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_categori')->references('id')->on('categori')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_merek')->references('id')->on('merek')->onUpdate('cascade')->onDelete('cascade');
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
