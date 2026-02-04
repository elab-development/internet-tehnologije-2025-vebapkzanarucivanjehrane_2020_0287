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
        Schema::table('dostavljaci', function (Blueprint $table) {
            $table->string('grad')->nullable();
            $table->string('vozilo')->nullable();
            $table->text('napomena')->nullable();
            $table->enum('status', ['na_cekanju', 'odobren', 'odbijen'])
                ->default('na_cekanju');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dostavljaci', function (Blueprint $table) {
              $table->dropColumn([
                'grad',
                'vozilo',
                'napomena',
                'status'
            ]);
        });
    }
};
