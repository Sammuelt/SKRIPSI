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
        Schema::table('kelas', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['id_walikelas']);
            
            // Modify the column to be nullable
            $table->unsignedBigInteger('id_walikelas')->nullable()->change();
            
            // Add the foreign key constraint back
            $table->foreign('id_walikelas')->references('id')->on('tbl_guru');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelas', function (Blueprint $table) {
            // Drop foreign key first
            $table->dropForeign(['id_walikelas']);
            
            // Revert the column to not nullable
            $table->unsignedBigInteger('id_walikelas')->nullable(false)->change();
            
            // Add the foreign key constraint back
            $table->foreign('id_walikelas')->references('id')->on('tbl_guru');
        });
    }
};
