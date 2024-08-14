<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Ramsey\Uuid\Type\Integer;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inventaris_barangs', function (Blueprint $table) {
            $table->integer('total_biaya')->nullable()->after('lokasi'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inventaris_barangs', function (Blueprint $table) {
            $table->dropColumn('total_biaya');
        });
    }
};
