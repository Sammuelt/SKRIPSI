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
        Schema::table('raport_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mapel')->after('tahun_ajaran')->required();
 
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport_siswas', function (Blueprint $table) {
            //
        });
    }
};
