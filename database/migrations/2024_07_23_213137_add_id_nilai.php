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
        Schema::table('raport_mbkm', function (Blueprint $table) {
            $table->unsignedBigInteger('id_nilai')->nullable(); 
            $table->foreign('id_nilai')->references('id')->on('nilai_projek')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport_mbkm', function (Blueprint $table) {
            $table->dropColumn('id_nilai');
        });
    }
};
