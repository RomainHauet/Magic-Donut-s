<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // id_P : identifiant du produit (clé étrangère)
    // id_C : identifiant de l'utilisateur (clé étrangère)
    // qte_A : quantité de produit acheté
    public function up(): void
    {
        Schema::create('achats', function (Blueprint $table) {
            $table->unsignedBigInteger('id_P');
            $table->unsignedBigInteger('id_C');

            $table->foreign('id_P')->references('id_P')->on('produits');
            $table->foreign('id_C')->references('id_C')->on('commandes')->onDelete('cascade');
            $table->integer('qte_A');

            $table->primary(['id_P', 'id_C']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achats');
    }
};
