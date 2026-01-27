<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Recenzija>
 */
class RecenzijaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'korisnik_id' => \App\Models\User::factory(),
            'restoran_id' => \App\Models\Restoran::factory(),
            'ocena' => $this->faker->numberBetween(1, 5),
            'komentar' => $this->faker->sentence(),
        ];
    }
}
