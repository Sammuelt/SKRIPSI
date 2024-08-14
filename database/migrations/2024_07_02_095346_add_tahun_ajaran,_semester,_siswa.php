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
        Schema::table('kehadirans', function (Blueprint $table) {
            //menambahkan kolom tahun ajaran dari tabel tahun_ajaran pada tbl raport_ekstrakuloikuler sebagai foreignKey
            $table->unsignedBigInteger('id_tahun_ajar')->after('id')->required();
            $table->foreign('id_tahun_ajar')->references('id')->on('tahun_ajarans');

          //menambahkan kolom semester dari tabel "semesters" pada tbl raport_ekstrakuloikuler sebagai foreignKey
            $table->unsignedBigInteger('id_semester')->after('id')->required();
            $table->foreign('id_semester')->references('id')->on('semesters');

            //menambahkan kolom siswa dari tabel "tbl_data_siswa" pada tbl raport_ekstrakuloikuler sebagai foreignKey
            $table->unsignedBigInteger('id_siswa')->after('id')->required();
            $table->foreign('id_siswa')->references('id')->on('tbl_data_siswa');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kehadirans', function (Blueprint $table) {
            $table->dropColumn('id_semester');
            $table->dropColumn('id_tahun_ajar');
            $table->dropColumn('id_siswa');
        });
    }
};
