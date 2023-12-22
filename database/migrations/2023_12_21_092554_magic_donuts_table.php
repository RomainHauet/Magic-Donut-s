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
        Schema::create('magic_donuts', function (Blueprint $table) {
            $table->id();
            $table->integer('num_tel_Md');
            // 10000 caractères max
            $table->string('adresse_Md', 10000);
            $table->string('desc_Md', 10000);
            $table->string('horaire_Md', 10000);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magic_donuts');
    }
};
