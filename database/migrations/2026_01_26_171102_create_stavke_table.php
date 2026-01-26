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
        Schema::create('stavke', function (Blueprint $table) {
            $table->id();
            $table->foreignId('porudzbina_id')->constrained('porudzbine')->onDelete('cascade');
            $table->foreignId('jelo_id')->constrained('jela')->onDelete('cascade');
            $table->integer('kolicina');
            $table->decimal('cena', 8, 2);  

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stavke');
    }
};
