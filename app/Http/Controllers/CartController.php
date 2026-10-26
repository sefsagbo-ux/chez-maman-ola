<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Ajouter une mèche au panier
    public function ajouter($id)
    {
        $produit = Product::findOrFail($id);

        // Vérifie si déjà dans le panier, sinon on crée
        $existant = Cart::where('user_id', Auth::id())
                        ->where('product_id', $id)->first();

        if ($existant) {
            $existant->quantite += 1;
            $existant->save();
        } else {
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $id,
                'quantite' => 1
            ]);
        }

        return redirect()->route('panier.voir')->with('success', 'Mèche ajoutée au panier !');
    }

    // Voir son panier
    public function voir()
    {
        $paniers = Cart::with('product')->where('user_id', Auth::id())->get();
        $total = 0;
        foreach($paniers as $item) {
            $total += $item->product->prix * $item->quantite;
        }

        return view('panier', compact('paniers', 'total'));
    }
}