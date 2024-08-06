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
        Schema::table('tbl_guru', function (Blueprint $table) {
            $table->string('jabatan')->after('golongan')->required();
            $table->string('status')->after('golongan')->required();
            
 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tbl_guru', function (Blueprint $table) {
            $table->dropColumn('jabatan');
            $table->dropColumn('status');
      
        });
    }
};
