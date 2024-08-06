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
            $table->unsignedBigInteger('id_semester')->after('id')->required();
 
            $table->foreign('id_semester')->references('id')->on('semesters');
            $table->unsignedBigInteger('id_tahun_ajar')->after('id')->required();
 
            $table->foreign('id_tahun_ajar')->references('id')->on('tahun_ajarans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport_siswas', function (Blueprint $table) {
            $table->dropColumn('id_semester');
            $table->dropColumn('id_tahun_ajar');
        });
    }
};
