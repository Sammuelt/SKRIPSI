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
        Schema::create('saldo_keuangans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('Saldo_semua')->nullable();
            $table->bigInteger('Saldo_bos')->nullable();
            $table->bigInteger('Saldo_lain')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saldo_keuangans');
    }
};
