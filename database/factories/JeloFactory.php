<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Jelo>
 */
class JeloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => $this->faker->word(),
            'opis' => $this->faker->sentence(),
            'cena' => $this->faker->randomFloat(2, 5, 100),
            'restoran_id' => \App\Models\Restoran::factory(),
        ];
    }
}
