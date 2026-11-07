<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    // DASHBOARD ADMIN
    public function admin()
    {
        $produits = Product::with('category')->latest()->get();
        $categories = Category::all();
        $commandes = Order::latest()->get();
        $totalCA = Order::where('statut', 'livree')->sum('total');
        
        return view('dashboard-admin', compact('produits', 'categories', 'commandes', 'totalCA'));
    }

    // DASHBOARD RESPONSABLE - CELUI QUI PLANTAIT
    public function responsable()
    {
        $commandes = Order::with('user')->latest()->get();
        $produits = Product::all();
        $categories = Category::all();
        
        // Stats pour les 3 cartes
        $ventesDuJour = Order::whereDate('created_at', today())->sum('total');
        $commandesEnAttente = Order::where('statut', 'en_attente')->count();
        $produitsFaibleStock = Product::where('stock', '<', 5)->count();

        return view('dashboard-responsable', compact('commandes', 'produits', 'categories', 'ventesDuJour', 'commandesEnAttente', 'produitsFaibleStock'));
    }

    // AJOUTER PRODUIT
    public function storeProduct(Request $request)
    {
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:4096'
        ]);

        $path = $request->file('image')->store('products', 'public');

        Product::create([
            'nom' => $request->nom,
            'prix' => $request->prix,
            'stock' => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image' => $path
        ]);

        return back()->with('success', 'Mèche ajoutée avec succès !');
    }

    // MODIFIER PRODUIT + PHOTO
    public function updateProduct(Request $request, $id)
    {
        $produit = Product::findOrFail($id);
        
        $request->validate([
            'nom' => 'required',
            'prix' => 'required|numeric',
            'stock' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096'
        ]);

        $produit->nom = $request->nom;
        $produit->prix = $request->prix;
        $produit->stock = $request->stock;
        
        if($request->hasFile('image')){
            if($produit->image){
                Storage::disk('public')->delete($produit->image);
            }
            $path = $request->file('image')->store('products', 'public');
            $produit->image = $path;
        }

        $produit->save();

        return back()->with('success', 'Produit modifié !');
    }

    // SUPPRIMER PRODUIT
    public function destroyProduct($id)
    {
        $produit = Product::findOrFail($id);
        if($produit->image){
            Storage::disk('public')->delete($produit->image);
        }
        $produit->delete();
        return back()->with('success', 'Produit supprimé');
    }

    // MODIFIER STATUT COMMANDE
    public function updateStatut(Request $request, $id)
    {
        $commande = Order::findOrFail($id);
        $commande->statut = $request->statut;
        $commande->save();
        return back()->with('success', 'Statut mis à jour');
    }

    // MODIFIER STOCK RAPIDE
    public function updateStock(Request $request, $id)
    {
        $produit = Product::findOrFail($id);
        $produit->stock = $request->stock;
        $produit->save();
        return back()->with('success', 'Stock mis à jour');
    }
}