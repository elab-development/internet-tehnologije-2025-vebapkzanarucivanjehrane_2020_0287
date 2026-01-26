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
        Schema::create('porudzbine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korisnik_id')->constrained('users');
            $table->foreignId('dostavljac_id')->constrained('dostavljaci');
            $table->datetime('vreme_kreiranja');
            $table->string('status');
            $table->decimal('ukupna_cena', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('porudzbine');
    }
};
