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
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); //povezujemo tabelu sa korisnikom
            $table->foreignId('dostavljac_id')->nullable()->constrained('dostavljaci')->onDelete('set null'); //povezujemo sa dostavljacem
            $table->dateTime('vreme_kreiranja');
            $table->enum('status', ['na_cekanju', 'u_pripremi', 'dostava_u_toku', 'isporuceno', 'otkazano'])
                  ->default('na_cekanju');
            $table->decimal('ukupna_cena', 10, 2);
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
