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
        Schema::create('recenzije', function (Blueprint $table) {
            $table->id();
            $table->foreignId('korisnik_id')->constrained('users')->onDelete('cascade'); //povezujemo sa korisnikom
            $table->foreignId('restoran_id')->constrained('restorani')->onDelete('cascade'); //povezujemo sa restoranom
            $table->text('komentar');
            $table->integer('ocena'); 
            $table->string('naslov');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recenzije');
    }
};
