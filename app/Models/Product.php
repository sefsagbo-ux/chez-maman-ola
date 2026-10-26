<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Tous les champs qu'on autorise à remplir
    protected $fillable = [
        'category_id', 
        'nom', 
        'description', 
        'prix', 
        'stock', 
        'image'
    ];

    /**
     * Un produit appartient à une catégorie
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Un produit peut être dans plusieurs paniers
     */
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    /**
     * Un produit peut être dans plusieurs commandes (détails)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Vérifie si le produit est en rupture
     * Utile pour le dashboard responsable
     */
    public function estEnRupture(): bool
    {
        return $this->stock <= 0;
    }
}