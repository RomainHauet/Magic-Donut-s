<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // Table pour les commandes
    // id_C : identifiant du commande (clé primaire auto incrémenté)
    // id_U : identifiant de l'utilisateur (clé étrangère)
    // cout_C : cout du commande (somme des produits)
    // etat_C : etat du commande (en cours ou terminé)
    // date_C : date du commande

    public function up(): void
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->increments('id_C');
            $table->foreignId('id_U')->references('id_U')->on('utilisateurs')->onDelete('cascade');

            // le cout sera àrrondie à 2 chiffres après la virgule
            $table->decimal('cout_C', 10, 2);
            $table->string('etat_C');
            $table->date('date_C');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commandes');
    }
};
