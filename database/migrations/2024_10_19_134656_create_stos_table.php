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
        Schema::create('sto', function (Blueprint $table) {
            $table->id();
            $table->date("tgl_sto")->nullable();
            $table->text('no_asset');
            $table->enum('status',['Sangat Layak','Cukup Layak','Layak Pakai','Rusak'])->nullable();
            $table->text('user');
            $table->date('tgl_save_sto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sto');
    }
};
