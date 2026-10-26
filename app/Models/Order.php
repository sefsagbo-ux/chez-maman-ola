<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'total', 'statut', 'adresse_livraison', 'telephone'];

    // Une commande appartient à un client
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Une commande a plusieurs lignes (plusieurs mèches)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}