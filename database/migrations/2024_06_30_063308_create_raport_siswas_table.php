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
        Schema::create('raport_siswas', function (Blueprint $table) {
            $table->id();
            $table->foreign('kode_mapel')->references('kode_mapel')->on('tbl_mapel')->onDelete('cascade');
            $table->string('nilai');
            $table->integer('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_siswas');
    }
};
