<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //$this->call(UtilisateurTableSeeder::class);
        //$this->call(ProduitTableSeeder::class);
        //$this->call(CommandeTableSeeder::class);
        //$this->call(AchatTableSeeder::class);
        //$this->call(ActualiteTableSeeder::class);
        $this->call(MagicDonutTableSeeder::class);
    }
}
