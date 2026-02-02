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
        Schema::table('restorani', function (Blueprint $table) {
            $table->decimal('prosecna_ocena', 3, 2)
                  ->nullable()
                  ->after('lokacija');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('restorani', function (Blueprint $table) {
             $table->dropColumn('prosecna_ocena');
        });
    }
};
