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
        Schema::table('inventaris_barangs', function (Blueprint $table) {
            $table->unsignedBigInteger('id_barang')->nullable()->after('tgl_pembelian'); 
            $table->foreign('id_barang')->references('id')->on('standart_hargas')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris_barangs', function (Blueprint $table) {
            $table->dropColumn('id_barang');
        });
    }
};
