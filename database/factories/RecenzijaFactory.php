<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Restoran;
use App\Models\Recenzija;
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
            'korisnik_id' => User::factory(),
            'restoran_id' => Restoran::factory(),
            'ocena' => $this->faker->numberBetween(1, 5),
            'komentar' => $this->faker->sentence(),
        ];
    }
}
