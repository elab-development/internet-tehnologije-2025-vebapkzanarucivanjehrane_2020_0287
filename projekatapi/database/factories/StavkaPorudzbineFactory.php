<?php

namespace Database\Factories;
use App\Models\Porudzbina;
use App\Models\Jelo;

use Illuminate\Database\Eloquent\Factories\Factory;

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
    protected $model = \App\Models\StavkaPorudzbine::class;
    
    public function definition(): array
    {
        return [
            'porudzbina_id' => Porudzbina::factory(),
            'jelo_id' => Jelo::factory(),
            'kolicina' => $this->faker->numberBetween(1, 5),
            'cena' => $this->faker->randomFloat(2, 5, 100),
        ];
    }
}
