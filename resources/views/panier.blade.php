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
<a href="/" class="text-green-700">← Continuer mes achats</a>
<h1 class="text-2xl font-bold text-green-800 mt-4">Mon Panier</h1>

@if($paniers->isEmpty())
    <p class="mt-6">Ton panier est vide.</p>
@else
    <div class="bg-white p-6 rounded mt-4">
        @foreach($paniers as $item)
            <div class="flex justify-between border-b py-2">
            <span>{{ $item->product->nom }} x {{ $item->quantite }}</span>
            <span>{{ number_format($item->product->prix * $item->quantite, 0, ',', ' ') }} FCFA</span>
            </div>
        @endforeach
        <p class="font-bold text-xl mt-4">Total: {{ number_format($total, 0, ',', ' ') }} FCFA</p>
        <form method="POST" action="{{ route('commander') }}">
            @csrf
            <button class="w-full bg-green-600 text-white py-3 rounded mt-4 font-bold">Commander - {{ number_format($total, 0, ',', ' ') }} FCFA</button>
        </form>
    </div>
@endif
</body></html>