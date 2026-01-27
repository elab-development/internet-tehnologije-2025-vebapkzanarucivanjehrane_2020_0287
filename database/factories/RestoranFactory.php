<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Restoran;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restoran>
 */
class RestoranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'naziv' => $this->faker->company(),
            'lokacija' => $this->faker->address(),
            'aktivan' => $this->faker->boolean(),
        ];
    }
}
