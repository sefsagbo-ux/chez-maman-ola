<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $produit->nom }} - CHEZ Maman OLA</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
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
    <a href="/" class="text-green-700">← Retour à l'accueil</a>
    
    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow mt-4">
        <h1 class="text-3xl font-bold text-green-800">{{ $produit->nom }}</h1>
        <p class="text-gray-500">{{ $produit->category->nom }}</p>
        
        <div class="h-64 bg-green-100 rounded flex items-center justify-center my-6">
            <span class="text-green-700 text-2xl">{{ $produit->nom }}</span>
        </div>

        <p class="text-gray-700 mb-4">{{ $produit->description }}</p>
        <p class="text-3xl font-bold text-green-700 mb-2">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</p>
        <p class="mb-6">Stock disponible: {{ $produit->stock }}</p>

        {{-- <button class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700">
            Ajouter au panier (on le fait à l'étape suivante)
        </button> --}}
        {{-- Si la personne est connectée, on affiche le vrai bouton panier --}}
    @auth
        <form method="POST" action="{{ route('panier.ajouter', $produit->id) }}">
            @csrf
            <button type="submit" class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700">
                Ajouter au panier
            </button>
        </form>
    @else
    {{-- Si elle n'est pas connectée, on lui dit de se connecter --}}
        <a href="/login" class="block w-full bg-green-600 text-white py-3 rounded-lg text-center font-bold hover:bg-green-700">
            Connecte-toi pour commander
        </a>
    @endauth
    </div>
</body>
</html>