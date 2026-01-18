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
        Schema::table('recenzije', function (Blueprint $table) {
             $table->dropForeign(['korisnik_id']);
            $table->dropColumn('korisnik_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recenzije', function (Blueprint $table) {
            $table->unsignedBigInteger('korisnik_id')->after('id');
             $table->foreign('korisnik_id')->references('id')->on('users');
        });
    }
};
