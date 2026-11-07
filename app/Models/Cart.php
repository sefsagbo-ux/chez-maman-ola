<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id','product_id','quantite'];

    // Ancien nom - on le garde
    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Nouveau nom - pour que ->produit marche aussi
    public function produit(){
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}