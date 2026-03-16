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
        Schema::table('porudzbine', function (Blueprint $table) {
            $table->foreignId('restoran_id')->nullable()->constrained('restorani')->onDelete('set null');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('porudzbine', function (Blueprint $table) {
            $table->dropForeign(['restoran_id']);
            $table->dropColumn('restoran_id');
    });
    }
};
