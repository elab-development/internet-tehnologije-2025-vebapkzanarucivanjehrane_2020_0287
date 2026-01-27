<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Porudzbina;
use App\Models\Jelo;
use App\Models\StavkaPorudzbine;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StavkaPorudzbine>
 */
class StavkaPorudzbineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'porudzbina_id' => Porudzbina::factory(),
            'jelo_id' => Jelo::factory(),
            'kolicina' => $this->faker->numberBetween(1, 5),
            'cena' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
