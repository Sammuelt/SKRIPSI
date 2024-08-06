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
        Schema::table('kalender__sekolah', function (Blueprint $table) {
            $table->unsignedBigInteger('id_semester')->after('id')->required();
            $table->foreign('id_semester')->references('id')->on('semesters');
         
        
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kalender__sekolah', function (Blueprint $table) {
            $table->dropColumn('id_semester');
           
        });
    }
};
