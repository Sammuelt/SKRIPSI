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
        Schema::table('tbl_data_siswa', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas')->after('tanggal_lahir')->required();
            $table->foreign('id_kelas')->references('id')->on('kelas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_data_siswa', function (Blueprint $table) {
            $table->dropColumn('id_kelas');
        });
    }
};
