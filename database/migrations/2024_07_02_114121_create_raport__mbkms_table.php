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
        Schema::create('raport_mbkm', function (Blueprint $table) {
            $table->id();
            $table->string('judul_proyek');
            $table->string('deskripsi');
            $table->enum('beriman', ['BB', 'MB','BSH', 'SB']);
            $table->enum('berkebinakaan', ['BB', 'MB','BSH', 'SB']);
            $table->enum('kreatif1', ['BB', 'MB','BSH', 'SB']);
            $table->enum('kreatif2', ['BB', 'MB','BSH', 'SB']);
            $table->enum('gotong_royong', ['BB', 'MB','BSH', 'SB']);
            $table->string('catatan_proses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('raport_mbkm');
    }
};
