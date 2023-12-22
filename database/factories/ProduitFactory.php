<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lib_P' => $this->faker->randomElement(['Donut', 'Bubble Tea', 'Boisson', 'Milkshake', 'Magic Box']),
            'gout_P' => $this->faker->randomElement(['Chocolat', 'Vanille', 'Fraise', 'Framboise']),
            'allergene_P' => $this->faker->randomElement(['Gluten', 'Lactose', 'Oeuf', 'Arachide']),
            'etat_P' => $this->faker->randomElement(['Chaud', 'Froid', 'Ambiant']),
            'taille_P' => $this->faker->randomElement(['Petit', 'Moyen', 'Grand']),
            'prix_P' => number_format($this->faker->randomFloat(2, 0, 50), 2),

            'image_P' => $this->faker->randomElement(['magic box.jpeg']),
            'stock_P' => $this->faker->boolean(),
        ];
    }
}