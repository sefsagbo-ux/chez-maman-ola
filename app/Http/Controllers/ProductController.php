<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Affiche la page d'accueil avec toutes les mèches
     * C'est la vitrine de CHEZ Maman OLA
     */
    public function index()
    {
        // On récupère tous les produits avec leur catégorie
        // latest() = les plus récents en premier
        $produits = Product::with('category')->latest()->get();
        $categories = Category::all();

        // On envoie les données à la vue
        return view('accueil', compact('produits', 'categories'));
    }

    /**
     * Affiche la fiche d'un seul produit quand on clique dessus
     */
    public function show($id)
    {
        // findOrFail = trouve le produit ou affiche erreur 404
        $produit = Product::with('category')->findOrFail($id);
        
        return view('produit-detail', compact('produit'));
    }
}