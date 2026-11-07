<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','total','statut','payment_method','payment_status','delivery_address','phone_momo'];
    // Une commande appartient à un client
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Pour que $cmd->produits marche
    public function produits(){
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantite','prix_unitaire')->withTimestamps();
    }

    // Pour que $cmd->products marche aussi
    public function products(){
        return $this->belongsToMany(Product::class, 'order_items')->withPivot('quantite','prix_unitaire')->withTimestamps();
    }

    // Une commande a plusieurs lignes (plusieurs mèches)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}