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
        Schema::create('jenis', function (Blueprint $table) {
            $table->id();
            $table->char('id_jenis',2)->unique();
            // $table->integer('id_jenis',10)->primary()->autoIncrement(false)->unsigned(true);
            // $table->integer('id_jenis');
            // $table->integer('id_jenis')->unsigned(true)->comment('sdfsdfs')->change();
            $table->string('jenis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis');
    }
};
