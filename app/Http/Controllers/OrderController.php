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
    public function commander(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:mtn,moov,cash',
            'phone_momo' => 'required',
            'delivery_address' => 'required',
        ]);

        $paniers = \App\Models\Cart::where('user_id', auth()->id())->with('produit')->get();
        if($paniers->isEmpty()) return back();

        $total = $paniers->sum(fn($i)=> $i->produit->prix * $i->quantite);

        $order = \App\Models\Order::create([
            'user_id' => auth()->id(),
            'total' => $total,
            'statut' => 'en_attente',
            'payment_method' => $request->payment_method,
            'payment_status' => $request->payment_method == 'cash' ? 'en_attente' : 'paye',
            'delivery_address' => $request->delivery_address,
            'phone_momo' => $request->phone_momo,
        ]);

        foreach($paniers as $item){
            $order->produits()->attach($item->produit->id, ['quantite' => $item->quantite, 'prix_unitaire' => $item->produit->prix]);
            $item->produit->decrement('stock', $item->quantite);
        }

        \App\Models\Cart::where('user_id', auth()->id())->delete();

        return redirect()->route('commande.confirmation', $order->id);
    }

    public function checkout()
    {
        $paniers = \App\Models\Cart::where('user_id', auth()->id())->with('produit')->get();
        if($paniers->isEmpty()) return redirect('/');
        return view('checkout', compact('paniers'));
    }

    public function confirmation($id)
    {
        $order = \App\Models\Order::with('produits')->findOrFail($id);
        return view('commande-confirmation', compact('order'));
    }

    // Dashboard client : voir ses commandes
    public function dashboardClient()
    {
        $commandes = Order::with('orderItems.product')->where('user_id', Auth::id())->latest()->get();
        return view('dashboard-client', compact('commandes'));
    }
}