<?php

namespace Database\Factories;
use App\Models\Restoran;

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
            'restoran_id' => Restoran::factory(),
            'naziv' => $this->faker->word(),
            'opis' => $this->faker->paragraph(),
            'cena' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
