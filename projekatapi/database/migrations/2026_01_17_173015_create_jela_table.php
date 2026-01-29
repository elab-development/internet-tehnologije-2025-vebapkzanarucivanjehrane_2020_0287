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
        Schema::create('jela', function (Blueprint $table) {
            $table->id();
            $table->string('naziv');
            $table->string('opis')->nullable(); // znaci moze i da ostane prazno
            $table->double('cena');
            $table->foreignId('restoran_id')->constrained('restorani')->onDelete('cascade'); // ako obrisemo restoran, obrisacemo i sva njegova jela(cascade)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jela');
    }
};
