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
        Schema::table('surat_tugas', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru')->after('id')->required();
            $table->foreign('id_guru')->references('id')->on('tbl_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_tugas', function (Blueprint $table) {
            $table->dropColumn('id_guru');
        });
    }
};
