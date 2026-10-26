<!DOCTYPE html>
<html><head><script src="https://cdn.tailwindcss.com"></script></head>
<body class="bg-green-50 p-8">

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
<h1 class="text-2xl font-bold text-green-800 mt-4">Mon Dashboard - Mes Commandes</h1>

@foreach($commandes as $cmd)
<div class="bg-white p-4 rounded shadow mt-4">
<p class="font-bold">Commande #{{ $cmd->id }} - {{ $cmd->statut }} - {{ number_format($cmd->total,0,',',' ') }} FCFA</p>
@foreach($cmd->orderItems as $item)
<p class="text-sm">- {{ $item->product->nom }} x {{ $item->quantite }}</p>
@endforeach
</div>
@endforeach

@if($commandes->isEmpty()) <p class="mt-6">Aucune commande pour l'instant.</p> @endif
</body></html>