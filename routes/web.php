<?php

use Illuminate\Support\Facades\Route;
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
    
    // Commande + Dashboard Client
    Route::post('/commander', [OrderController::class, 'commander'])->name('commander');
    Route::get('/dashboard-client', [OrderController::class, 'dashboardClient'])->name('dashboard.client');

    Route::get('/dashboard-responsable', [DashboardController::class, 'responsable'])->name('dashboard.responsable');
    Route::get('/dashboard-admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});

require __DIR__.'/auth.php';