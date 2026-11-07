<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DashboardController;

Route::get('/', [ProductController::class, 'index'])->name('accueil');
Route::get('/produit/{id}', [ProductController::class, 'show'])->name('produit.detail');

Route::middleware('auth')->group(function () {
    // Panier
    Route::post('/panier/ajouter/{id}', [CartController::class, 'ajouter'])->name('panier.ajouter');
    Route::get('/panier', [CartController::class, 'voir'])->name('panier.voir');
    Route::delete('/panier/{id}', [CartController::class, 'supprimer'])->name('panier.supprimer');                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
    
    // Commande + Dashboard Client
    Route::post('/commander', [OrderController::class, 'commander'])->name('commander');
    Route::get('/dashboard-client', [OrderController::class, 'dashboardClient'])->name('dashboard.client');

    Route::get('/dashboard-responsable', [DashboardController::class, 'responsable'])->name('dashboard.responsable');
    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard.admin');

    Route::post('/admin/produit/ajouter', [DashboardController::class, 'storeProduct'])->name('admin.produit.ajouter');
    Route::delete('/admin/produit/{id}', [DashboardController::class, 'destroyProduct'])->name('admin.produit.supprimer');
    Route::post('/admin/produit/modifier/{id}', [DashboardController::class, 'updateProduct'])->name('admin.produit.modifier');

    Route::patch('/commande/{id}/statut', [DashboardController::class, 'updateStatut'])->name('commande.statut');
    Route::patch('/produit/{id}/stock', [DashboardController::class, 'updateStock'])->name('produit.stock');

    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/commande/{id}/confirmation', [OrderController::class, 'confirmation'])->name('commande.confirmation');

    Route::get('/commande/{id}/facture', function($id){
        $order = \App\Models\Order::with('produits','user')->findOrFail($id);
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('facture', compact('order'));
        return $pdf->download('Facture-OLA-'.$order->id.'.pdf');
    })->name('commande.facture');

    Route::post('/produit/{id}/avis', [ReviewController::class, 'store'])->name('produit.avis');

});

require __DIR__.'/auth.php';