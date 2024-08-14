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
        Schema::table('tp/cp', function (Blueprint $table) {
            $table->unsignedBigInteger('id_kelas')->nullable()->after('id'); 
            $table->foreign('id_kelas')->references('id')->on('kelas')->onDelete('set null'); 

            $table->unsignedBigInteger('id_mapel')->nullable()->after('id'); 
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans')->onDelete('set null'); 

            $table->unsignedBigInteger('id_semester')->nullable()->after('id'); 
            $table->foreign('id_semester')->references('id')->on('semesters')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tp/cp', function (Blueprint $table) {
            $table->dropColumn('id_kelas');
            $table->dropColumn('id_mapel');
            $table->dropColumn('id_semester');
        });
    }
};
