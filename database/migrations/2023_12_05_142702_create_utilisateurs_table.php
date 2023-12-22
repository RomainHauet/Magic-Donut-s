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
        // id_U : identifiant de l'objet (clé primaire auto incrémenté)
        // nom_U : nom de l'objet
        // prenom_U : prenom de l'objet
        // email : email de l'objet
        // mdp_U : mot de passe de l'objet
        // admin_U : si l'utilisateur est admin ou non (defaut à faux)
        // recoit_news_U : si l'utilisateur recoit les news ou non

        Schema::create('utilisateurs', function (Blueprint $table) {
            $table->increments('id_U');
            $table->string('nom_U');
            $table->string('prenom_U');
            $table->string('email_U');
            $table->string('mdp_U');
            $table->boolean('admin_U')->default(false);
            $table->boolean('recoit_news_U')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('utilisateurs');
    }
};
