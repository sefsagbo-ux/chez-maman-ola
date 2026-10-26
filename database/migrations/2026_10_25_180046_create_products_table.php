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
        // Table des produits = les mèches en vente
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); 
        // Lien vers categories, si on supprime une catégorie, ses produits partent aussi
        
            $table->string('nom'); // Ex: Brésilienne Lisse 14 pouces
            $table->text('description'); // Détails, longueur, qualité
            $table->integer('prix'); // Prix en FCFA, ex: 25000
            $table->integer('stock'); // Quantité restante
            $table->string('image')->nullable(); // Chemin de l'image
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
