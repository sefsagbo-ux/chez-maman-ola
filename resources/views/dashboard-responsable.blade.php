<!DOCTYPE html>
<html><head><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-green-50 p-6">

    <header class="bg-green-700 text-white p-4 shadow-lg">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">CHEZ Maman OLA</h1>
        <span class="text-green-100 hidden md:block">Calavi - La beauté à portée de main</span>
        <div class="flex items-center gap-3">
            <a href="/panier" class="text-white">🛒 Panier</a>
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-white text-green-700 px-4 py-2 rounded font-bold">Déconnexion ({{ Auth::user()->name }})</button>
                </form>
            @else
                <a href="/login" class="bg-white text-green-700 px-4 py-2 rounded font-bold">Connexion</a>
            @endauth
        </div>
    </div>
</header>

<a href="/" class="text-green-700">← Boutique</a>
<h1 class="text-2xl font-bold text-green-800 mt-2">Dashboard Responsable - CHEZ Maman OLA</h1>

<div class="grid grid-cols-3 gap-4 mt-6">
<div class="bg-white p-4 rounded shadow border-l-4 border-green-600"><p class="text-gray-500">Ventes du jour</p><p class="text-2xl font-bold">{{ number_format($ventesDuJour,0,',',' ') }} FCFA</p></div>
<div class="bg-white p-4 rounded shadow"><p class="text-gray-500">Commandes du jour</p><p class="text-2xl font-bold">{{ $commandesDuJour }}</p></div>
<div class="bg-white p-4 rounded shadow"><p class="text-gray-500">Stock restant total</p><p class="text-2xl font-bold">{{ $totalStockRestant }} mèches</p></div>
</div>

@if($alerteStock->count() > 0)
<div class="bg-red-100 border border-red-400 p-4 rounded mt-6">
<p class="font-bold text-red-700">⚠️ Alerte Stock Faible :</p>
@foreach($alerteStock as $p) <p>- {{ $p->nom }} : seulement {{ $p->stock }} restant</p> @endforeach
</div>
@endif

<h2 class="font-bold mt-6">Tous les produits - Vendus / Restants</h2>
<div class="bg-white rounded shadow mt-2 p-4">
@foreach($produits as $p)
<div class="flex justify-between border-b py-2"><span>{{ $p->nom }} ({{ $p->category->nom }})</span><span class="font-bold {{ $p->stock <=5 ? 'text-red-600' : 'text-green-600' }}">{{ $p->stock }} restants</span></div>
@endforeach
</div>
</body></html>