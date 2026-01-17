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
            $table->dropColumn('naslov');
            $table->unsignedTinyInteger('ocena')->change(); //znaci ocena ne moze biti negativna
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recenzije', function (Blueprint $table) {
            $table->string('naslov');
            $table->integer('ocena')->change();
        });
    }
};
