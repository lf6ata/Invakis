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
        Schema::create('session_sto', function (Blueprint $table) {
            $table->id();
            $table->string('session_sto')->unique();
            $table->tinyInteger('progress');
            $table->time('durasi')->nullable();
            $table->timestamp('tgl_sto');
            $table->timestamp('save_sto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('session_sto');
    }
};
