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
        // Table des catégories de mèches (ex: Brésilienne, Péruvienne, Lace)
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Clé primaire auto-incrémentée
            $table->string('nom')->unique(); // Nom de la catégorie
            $table->string('description')->nullable(); // Petite description
            $table->timestamps(); // created_at et updated_at auto
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
