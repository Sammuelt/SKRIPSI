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
        Schema::table('raport_mbkm', function (Blueprint $table) {
            $table->enum('nilai', ['BB', 'MB','BSH','SB']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('raport_mbkm', function (Blueprint $table) {
            //
        });
    }
};
