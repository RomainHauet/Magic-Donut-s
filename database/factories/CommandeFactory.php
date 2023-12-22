<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Utilisateur;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_U' => Utilisateur::all()->random()->id_U,
            'etat_C' => $this->faker->word(),
            'cout_C' => $this->faker->randomFloat(2, 0, 100),
            'date_C' => $this->faker->date(),
        ];
    }
}
