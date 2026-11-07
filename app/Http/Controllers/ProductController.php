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
    public function index(Request $request)
    {
        $query = Product::with('category');
    
    // Recherche par nom
        if($request->search){
            $query->where('nom', 'like', '%'.$request->search.'%');
        }
    
    // Filtre par catégorie
        if($request->category_id){
            $query->where('category_id', $request->category_id);
        }

        $produits = $query->get();
        $categories = \App\Models\Category::all();

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