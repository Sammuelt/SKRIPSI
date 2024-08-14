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
            
            $table->dropForeign(['id_mapel']);
                  
            $table->unsignedBigInteger('id_mapel')->nullable()->change();
                   
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport_siswas', function (Blueprint $table) {
            $table->dropForeign(['id_mapel']);
                  
            $table->unsignedBigInteger('id_mapel')->nullable(false)->change();
                   
            $table->foreign('id_mapel')->references('id')->on('mata_pelajarans');

          
        });
    }
};
