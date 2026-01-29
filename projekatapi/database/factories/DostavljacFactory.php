<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dostavljac>
 */
class DostavljacFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), //ovo ce biti postavljeno prilikom kreiranja korisnika
            'ime' => $this->faker->firstName(),
            'kontakt' => $this->faker->phoneNumber(),
        ];
    }
}