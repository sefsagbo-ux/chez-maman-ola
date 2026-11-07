# 🖤 CHEZ Maman OLA - Boutique de Mèches en Ligne

Boutique e-commerce réelle à Calavi, Bénin - Style premium NEUTRA Full Black.

![Laravel](https://img.shields.io/badge/Laravel-11-red)
![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![MySQL](https://img.shields.io/badge/MySQL-8.0-orange)
![Tailwind](https://img.shields.io/badge/TailwindCSS-3-black)

## ✨ Fonctionnalités v2.0

### 🛍️ Côté Cliente
- Catalogue mèches Brésilienne / Péruvienne / Lace Front
- Recherche + filtres par catégorie
- Fiche produit avec photos, stock, avis
- Panier + Checkout
- **Paiement Mobile Money : MTN MoMo / Moov Money / Paiement à la livraison**
- **Facture PDF automatique** téléchargeable
- **Suivi livraison en temps réel** : En attente → En préparation → En route → Livrée
- **Avis clientes** : 5 étoiles + commentaire
- Confirmation WhatsApp : 01 45 20 19 08

### 👩‍💼 Côté Responsable
- Dashboard ventes du jour, commandes en attente, faible stock
- Changer statut commande (En attente → Livrée)
- Gérer stock rapidement
- Ajouter / Modifier produit avec photo

### 👨‍💻 Côté Admin
- Gestion complète produits / catégories / commandes
- Chiffre d'affaires total
- Gestion utilisateurs

## 🛠️ Stack Technique
- **Backend :** Laravel 11, PHP 8.2, MySQL
- **Frontend :** Blade, TailwindCSS, Design NEUTRA Full Black
- **PDF :** barryvdh/laravel-dompdf
- **Auth :** Laravel Breeze (3 rôles : admin / responsable / client)

## 🔑 Comptes Test

| Rôle | Email | Mot de passe |
|---|---|---|
| Admin | admin@chez-maman-ola.bj | password123 |
| Responsable | responsable@chez-maman-ola.bj | password123 |
| Cliente | cliente@test.bj | password123 |

## 🚀 Installation locale

```bash
git clone https://github.com/sefsagbo-ux/chez-maman-ola.git
cd chez-maman-ola
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan storage:link
php artisan serve
npm run dev