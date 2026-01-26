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
            $table->foreignId('restoran_id')->constrained('restorani');
            $table->string('naziv');
            $table->string('opis');
            $table->decimal('cena', 8, 2);

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
