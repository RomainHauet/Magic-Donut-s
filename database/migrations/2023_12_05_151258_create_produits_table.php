<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // id_P : identifiant de l'objet (clé primaire auto incrémenté)
        // lib_P : nom de l'objet
        // gout_P : gout de l'objet
        // allergene_P : allergene de l'objet
        // etat_P : etat de l'objet (chaud froid ou normal)
        // taille_P : taille de l'objet (petit moyen ou grand)
        // prix_P : prix de l'objet
        // image_P : image de l'objet
        // stock_P : si l'objet est en stock ou non
        // visible_P : si l'objet est visible ou non

        Schema::create('produits', function (Blueprint $table) {
            $table->increments('id_P');
            $table->string('lib_P');
            $table->string('gout_P');
            $table->string('allergene_P');
            $table->string('etat_P');
            $table->string('taille_P');
            $table->decimal('prix_P', 10, 2);
            $table->string('image_P');
            $table->boolean('stock_P');
            $table->boolean('visible_P')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produits');
    }
};
