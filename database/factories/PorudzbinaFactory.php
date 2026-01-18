<?php

namespace Database\Factories;

use App\Models\Dostavljac;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Porudzbina>
 */
class PorudzbinaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'dostavljac_id' => Dostavljac::factory(),
            'ukupna_cena' => $this->faker->randomFloat(2, 10, 200),
            'status' => $this->faker->randomElement(['na_cekanju', 'u_pripremi', 'dostava_u_toku', 'isporuceno', 'otkazano']),
            'adresa_isporuke' => $this->faker->address(),
            'vreme_kreiranja' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
