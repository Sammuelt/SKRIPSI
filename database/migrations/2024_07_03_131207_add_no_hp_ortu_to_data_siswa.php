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
            $table->string('no_hp_ortu', 13)->nullable()->after('nama_orang_tua');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_data_siswa', function (Blueprint $table) {
            //
        });
    }
};
