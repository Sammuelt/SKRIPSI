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
            $table->date('tgl_pembelian')->after('id');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris_barangs', function (Blueprint $table) {
            $table->dropColumn('tgl_pembelian');
        });
    }
};
