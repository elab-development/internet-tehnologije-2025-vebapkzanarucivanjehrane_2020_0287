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
        Schema::table('stavke_porudzbine', function (Blueprint $table) {
            $table->dropColumn('podtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stavke_porudzbine', function (Blueprint $table) {
            $table->decimal('podtotal', 8, 2)->after('kolicina');
        });
    }
};
