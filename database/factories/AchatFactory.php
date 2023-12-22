<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Produit;
use App\Models\Commande;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achat>
 */
class AchatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_P' => Produit::all()->random()->id_P,
            'id_C' => Commande::all()->random()->id_C,
            'qte_A' => $this->faker->numberBetween(1, 100),
        ];
    }
}