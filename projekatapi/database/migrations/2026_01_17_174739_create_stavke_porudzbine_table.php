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
        Schema::create('stavke_porudzbine', function (Blueprint $table) {
            $table->id();
            $table->foreignId('porudzbina_id')->constrained('porudzbine')->onDelete('cascade'); //povezujemo sa tabelom porudzbine
            $table->foreignId('jelo_id')->constrained('jela')->onDelete('cascade'); //povezujemo sa tabelom jela
            $table->integer('kolicina');
            $table->decimal('podtotal', 10, 2); // cena jela * kolicina
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavke_porudzbine');
    }
};
