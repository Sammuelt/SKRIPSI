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
        Schema::table('prestasis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_siswa')->nullable()->after('id'); 
            $table->foreign('id_siswa')->references('id')->on('tbl_data_siswa')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('prestasis', function (Blueprint $table) {
            $table->dropColumn('id_siswa');
        });
    }
};
