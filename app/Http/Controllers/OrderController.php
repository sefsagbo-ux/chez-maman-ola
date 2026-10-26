<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Quand le client clique sur Commander
    public function commander()
    {
        $userId = Auth::id();
        $paniers = Cart::with('product')->where('user_id', $userId)->get();

        if($paniers->isEmpty()){
            return redirect()->route('accueil')->with('error', 'Panier vide');
        }

        // Calcul total
        $total = 0;
        foreach($paniers as $item){
            $total += $item->product->prix * $item->quantite;
        }

        // Créer la commande
        $order = Order::create([
            'user_id' => $userId,
            'total' => $total,
            'statut' => 'en_attente',
            'adresse_livraison' => 'Calavi',
            'telephone' => '0145201908'
        ]);

        // Copier chaque ligne du panier dans order_items + diminuer stock
        foreach($paniers as $item){
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantite' => $item->quantite,
                'prix_unitaire' => $item->product->prix
            ]);

            // Diminue le stock
            $item->product->stock -= $item->quantite;
            $item->product->save();
        }

        // Vide le panier
        Cart::where('user_id', $userId)->delete();

        return redirect()->route('dashboard.client')->with('success', 'Commande passée !');
    }

    // Dashboard client : voir ses commandes
    public function dashboardClient()
    {
        $commandes = Order::with('orderItems.product')->where('user_id', Auth::id())->latest()->get();
        return view('dashboard-client', compact('commandes'));
    }
}