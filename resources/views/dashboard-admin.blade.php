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
<h1 class="text-2xl font-bold text-green-800 mt-2">Dashboard Admin - Gestion Totale</h1>

<div class="grid grid-cols-4 gap-4 mt-6">
<div class="bg-green-700 text-white p-4 rounded"><p>CA Total</p><p class="text-2xl font-bold">{{ number_format($caTotal,0,',',' ') }} FCFA</p></div>
<div class="bg-white p-4 rounded shadow"><p>Total Commandes</p><p class="text-2xl font-bold">{{ $totalCommandes }}</p></div>
<div class="bg-white p-4 rounded shadow"><p>Clients</p><p class="text-2xl font-bold">{{ $totalClients }}</p></div>
<div class="bg-white p-4 rounded shadow"><p>Produits</p><p class="text-2xl font-bold">{{ $produits->count() }}</p></div>
</div>

<h2 class="font-bold mt-6">10 dernières commandes</h2>
<div class="bg-white rounded shadow mt-2 p-4">
@foreach($commandes as $cmd)
<p class="border-b py-2">#{{ $cmd->id }} - {{ $cmd->user->name }} - {{ number_format($cmd->total,0,',',' ') }} FCFA - {{ $cmd->statut }}</p>
@endforeach
</div>
</body></html>