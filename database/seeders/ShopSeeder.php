<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ShopSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Créer 3 catégories de mèches
        $bresilienne = Category::create([
            'nom' => 'Brésilienne',
            'description' => 'Mèches lisses et soyeuses origine Brésil'
        ]);

        $peruvienne = Category::create([
            'nom' => 'Péruvienne',
            'description' => 'Mèches bouclées et volumineuses'
        ]);

        $lace = Category::create([
            'nom' => 'Lace Front',
            'description' => 'Perruques avec lace naturelle'
        ]);

        // 2. Créer 6 produits pour CHEZ Maman OLA
        Product::create([
            'category_id' => $bresilienne->id,
            'nom' => 'Brésilienne Lisse 14 pouces',
            'description' => 'Qualité premium, lisse, facile à coiffer. Longueur 14 pouces.',
            'prix' => 25000, // Prix en FCFA
            'stock' => 15,
            'image' => null
        ]);

        Product::create([
            'category_id' => $bresilienne->id,
            'nom' => 'Brésilienne Lisse 20 pouces',
            'description' => 'Longue et brillante, 20 pouces, 100% naturelle.',
            'prix' => 40000,
            'stock' => 8,
            'image' => null
        ]);

        Product::create([
            'category_id' => $peruvienne->id,
            'nom' => 'Péruvienne Bouclée 16 pouces',
            'description' => 'Boucles bien définies, volume naturel.',
            'prix' => 35000,
            'stock' => 12,
            'image' => null
        ]);

        Product::create([
            'category_id' => $peruvienne->id,
            'nom' => 'Péruvienne Deep Wave 18 pouces',
            'description' => 'Ondulations profondes, très tendance à Calavi.',
            'prix' => 38000,
            'stock' => 3, // Stock faible pour tester l'alerte du dashboard responsable
            'image' => null
        ]);

        Product::create([
            'category_id' => $lace->id,
            'nom' => 'Lace Front Naturelle',
            'description' => 'Perruque lace avec raie invisible, prête à porter.',
            'prix' => 55000,
            'stock' => 5,
            'image' => null
        ]);

        Product::create([
            'category_id' => $lace->id,
            'nom' => 'Lace Front Bouclée',
            'description' => 'Perruque bouclée avec bonnet respirant.',
            'prix' => 60000,
            'stock' => 0, // En rupture pour tester
            'image' => null
        ]);

        // 3. Créer 3 comptes pour tester les 3 dashboards
        // Compte ADMIN = toi
        User::create([
            'name' => 'Admin Maman OLA',
            'email' => 'admin@chez-maman-ola.bj',
            'password' => Hash::make('password123'),
            'role' => 'admin'
        ]);

        // Compte RESPONSABLE = la gérante du magasin
        User::create([
            'name' => 'Responsable Boutique',
            'email' => 'responsable@chez-maman-ola.bj',
            'password' => Hash::make('password123'),
            'role' => 'responsable'
        ]);

        // Compte CLIENT = une cliente test
        User::create([
            'name' => 'Cliente Test',
            'email' => 'cliente@test.bj',
            'password' => Hash::make('password123'),
            'role' => 'client'
        ]);
    }
}