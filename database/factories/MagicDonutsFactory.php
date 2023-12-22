<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class MagicDonutsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // num qui commence par 06 ou 07
            'num_tel_Md' => $this->faker->regexify('0[67][0-9]{8}'),
            'adresse_Md' => $this->faker->address(),
            'desc_Md' => $this->faker->text(),
            // Lundi au vendredi de 8h à 18h
            'horaire_Md' => $this->faker->regexify('Lundi au vendredi de 8h à 18h'),
        ];
    }
}
