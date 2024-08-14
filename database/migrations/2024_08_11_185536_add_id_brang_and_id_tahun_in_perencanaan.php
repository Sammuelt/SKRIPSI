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
        Schema::table('perencanaan_danas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_tahun')->nullable()->after('id'); 
            $table->foreign('id_tahun')->references('id')->on('tahun_ajarans')->onDelete('set null');    
            $table->unsignedBigInteger('id_barang')->nullable()->after('id'); 
            $table->foreign('id_barang')->references('id')->on('standart_hargas')->onDelete('set null');    
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('perencanaan_danas', function (Blueprint $table) {
            $table->dropColumn('id_tahun');
            $table->dropColumn('id_barang');
        });
    }
};
