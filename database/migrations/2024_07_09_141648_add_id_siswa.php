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
        Schema::table('surat_mutasi_siswas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_siswa')->after('id')->required();
            $table->foreign('id_siswa')->references('id')->on('tbl_data_siswa');
            $table->unsignedBigInteger('id_kelas_ditinggalkan')->after('id')->required();
            $table->foreign('id_kelas_ditinggalkan')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_mutasi_siswas', function (Blueprint $table) {
            $table->dropColumn('id_kelas_ditinggalkan');
        });
    }
};
