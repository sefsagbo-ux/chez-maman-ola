<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // Dashboard Responsable : ce que voit la gérante du magasin
    public function responsable()
    {
        // Vérifie que c'est bien la responsable ou l'admin
        if(!auth()->user()->estResponsable() && !auth()->user()->estAdmin()){
            abort(403, 'Accès réservé responsable');
        }

        $ventesDuJour = Order::whereDate('created_at', today())->sum('total');
        $commandesDuJour = Order::whereDate('created_at', today())->count();
        $produits = Product::with('category')->get();
        $alerteStock = Product::where('stock', '<=', 5)->get(); // Alerte si <=5
        $totalStockRestant = Product::sum('stock');
        
        // Produits les plus vendus
        $plusVendus = OrderItem::select('product_id', DB::raw('SUM(quantite) as total_vendu'))
                        ->groupBy('product_id')
                        ->orderByDesc('total_vendu')
                        ->with('product')
                        ->take(5)->get();

        return view('dashboard-responsable', compact('ventesDuJour', 'commandesDuJour', 'produits', 'alerteStock', 'totalStockRestant', 'plusVendus'));
    }

    // Dashboard Admin : toi, tu vois tout
    public function admin()
    {
        if(!auth()->user()->estAdmin()){
            abort(403, 'Accès réservé admin');
        }

        $caTotal = Order::sum('total');
        $totalCommandes = Order::count();
        $totalClients = User::where('role', 'client')->count();
        $produits = Product::all();
        $commandes = Order::with('user', 'orderItems.product')->latest()->take(10)->get();
        $alerteStock = Product::where('stock', '<=', 5)->get();

        return view('dashboard-admin', compact('caTotal', 'totalCommandes', 'totalClients', 'produits', 'commandes', 'alerteStock'));
    }
}