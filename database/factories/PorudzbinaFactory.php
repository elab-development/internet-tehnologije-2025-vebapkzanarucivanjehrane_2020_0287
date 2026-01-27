<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Porudzbina;
use App\Models\User;
use App\Models\Dostavljac;

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
            'korisnik_id' => User::factory(),
            'dostavljac_id' => Dostavljac::factory(),
            'ukupna_cena' => $this->faker->randomFloat(2, 100, 5000),
            'status' => $this->faker->randomElement(['na_cekanju', 'u_pripremi','na_putu', 'isporuceno']),
            'adresa_isporuke' => $this->faker->address(),
            'vreme_kreiranja' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
