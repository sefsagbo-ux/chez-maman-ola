<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Champs qu'on peut remplir depuis un formulaire
    protected $fillable = ['nom', 'description'];

    /**
     * Une catégorie a plusieurs produits
     * Ex: Catégorie "Brésilienne" a 10 mèches brésiliennes
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}