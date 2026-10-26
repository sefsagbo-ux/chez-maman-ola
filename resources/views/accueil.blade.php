<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEZ Maman OLA - Boutique de mèches à Calavi</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-50">

    {{-- HEADER VERT --}}
    <header class="bg-green-700 text-white p-4 shadow-lg">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <h1 class="text-2xl font-bold">CHEZ Maman OLA</h1>
        <span class="text-green-100 hidden md:block">Calavi - La beauté à portée de main</span>
        
        <div class="flex items-center gap-2">
            <a href="/panier" class="bg-green-600 hover:bg-green-800 px-3 py-2 rounded text-sm">🛒 Panier</a>
            
            @auth
                {{-- BOUTON DASHBOARD SELON LE ROLE --}}
                @if(Auth::user()->role === 'client')
                    <a href="{{ route('dashboard.client') }}" class="bg-white text-green-700 px-4 py-2 rounded font-bold text-sm">Mon Dashboard</a>
                @elseif(Auth::user()->role === 'responsable')
                    <a href="{{ route('dashboard.responsable') }}" class="bg-yellow-400 text-green-900 px-4 py-2 rounded font-bold text-sm">Dashboard Responsable</a>
                @elseif(Auth::user()->role === 'admin')
                    <a href="{{ route('dashboard.admin') }}" class="bg-black text-white px-4 py-2 rounded font-bold text-sm">Dashboard Admin</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="bg-green-800 px-3 py-2 rounded text-sm">Déconnexion</button>
                </form>
            @else
                <a href="/login" class="bg-white text-green-700 px-4 py-2 rounded font-bold">Connexion</a>
                <a href="/register" class="bg-green-500 text-white px-4 py-2 rounded font-bold">Inscription</a>
            @endauth
        </div>
    </div>
</header>

    <main class="max-w-6xl mx-auto p-6">
        <h2 class="text-3xl font-bold text-green-800 mb-2">Nos Mèches Disponibles</h2>
        <p class="text-gray-600 mb-6">Clique sur une mèche pour voir les détails et ajouter au panier</p>

        {{-- Vérifie si on a des produits --}}
        @if($produits->isEmpty())
            <div class="bg-yellow-100 p-6 rounded">
                <p>Aucun produit trouvé. As-tu bien lancé <code>php artisan db:seed</code> ?</p>
            </div>
        @else
            {{-- Grille des produits --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($produits as $produit)
                    <div class="bg-white rounded-lg shadow p-4 border-t-4 border-green-600">
                        {{-- Image placeholder --}}
                        <div class="h-40 bg-green-100 rounded flex items-center justify-center mb-3">
                            <span class="text-green-700 font-bold">{{ $produit->category->nom }}</span>
                        </div>

                        <h3 class="font-bold text-lg">{{ $produit->nom }}</h3>
                        <p class="text-sm text-gray-600">{{ Str::limit($produit->description, 60) }}</p>
                        
                        <div class="flex justify-between items-center mt-3">
                            <span class="text-green-700 font-bold text-xl">{{ number_format($produit->prix, 0, ',', ' ') }} FCFA</span>
                            
                            @if($produit->stock > 0)
                                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded">Stock: {{ $produit->stock }}</span>
                            @else
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded">Rupture</span>
                            @endif
                        </div>

                        <a href="{{ route('produit.detail', $produit->id) }}" 
                           class="block mt-4 bg-green-600 text-white text-center py-2 rounded hover:bg-green-700">
                           Voir détails
                        </a>
                    </div>
                @endforeach
            </div>
        @endif
    </main>

</body>
</html>