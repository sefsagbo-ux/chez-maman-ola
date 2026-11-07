@extends('layouts.main')

@section('title', $produit->nom)

@section('content')
<section class="bg-black text-white min-h-screen">
    <div class="max-w-7xl mx-auto px-6 py-10">
        
        <a href="/" class="inline-flex items-center gap-2 text-zinc-500 text- uppercase tracking-[0.2em] hover:text-white transition">
            ← Retour à la boutique
        </a>

        <div class="grid md:grid-cols-2 gap-10 mt-8">
            
            {{-- IMAGE GAUCHE --}}
            <div class="relative bg-zinc-900 rounded- overflow-hidden border border-zinc-800 h-">
                @if($produit->image)
                    <img src="{{ asset('storage/'.$produit->image) }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-zinc-800">
                        <span class="text-7xl font-black text-zinc-700">OLA</span>
                    </div>
                @endif
                
                <div class="absolute top-4 left-4 flex gap-2">
                    <span class="bg-lime-300 text-black text- font-bold px-3 py-1 rounded-full">Bestseller</span>
                    <span class="bg-white text-black text- font-bold px-3 py-1 rounded-full">Stock: {{ $produit->stock }}</span>
                </div>

                <div class="absolute bottom-4 left-4 bg-black/60 backdrop-blur px-4 py-2 rounded-full text- text-white border border-white/10">
                    {{ $produit->category->nom ?? 'Mèche' }} • 100% qualité
                </div>
            </div>

            {{-- INFOS DROITE --}}
            <div class="flex flex-col justify-center">
                <p class="text-lime-300 text- uppercase tracking-[0.2em] font-bold">{{ $produit->category->nom ?? 'Maman OLA' }} — En stock</p>
                
                <h1 class="text- md:text- font-black leading-[0.9] tracking-tighter mt-3">
                    {{ $produit->nom }}
                </h1>

                <p class="text- font-black mt-6">
                    {{ number_format($produit->prix, 0, ',', ' ') }} <span class="text- font-normal text-zinc-500">FCFA</span>
                </p>
                <p class="text-zinc-500 text- mt-1">Livraison gratuite partout depuis Abomey-Calavi</p>

                <div class="mt-8 border-t border-zinc-800 pt-8">
                    <h4 class="text- uppercase tracking-widest text-zinc-400 font-bold">Description</h4>
                    <p class="text-zinc-300 text- leading-relaxed mt-3">
                        {{ $produit->description ?? "Brésilienne, douce, ne s'emmêle pas, ne pique pas. La qualité fait la différence. Longueur: 14 pouces, peut être lissée, bouclée. Idéale pour tresses, tissages." }}
                    </p>
                </div>

                {{-- ACTIONS --}}
                <div class="mt-10 space-y-3">
                    @auth
                            <form method="POST" action="{{ route('panier.ajouter', $produit->id) }}" class="flex items-center gap-3">                           
                            @csrf
                            
                            <div class="flex items-center bg-zinc-900 border border-zinc-800 rounded-full px-2 py-2">
                                <button type="button" onclick="this.nextElementSibling.stepDown()" class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center">-</button>
                                <input type="number" name="quantite" value="1" min="1" max="{{ $produit->stock }}" class="bg-transparent w-12 text-center text-white font-bold outline-none">
                                <button type="button" onclick="this.previousElementSibling.stepUp()" class="w-10 h-10 rounded-full bg-black text-white flex items-center justify-center">+</button>
                            </div>

                            <button type="submit" class="flex-1 bg-white text-black py-4 rounded-full text- font-black uppercase tracking-widest hover:bg-lime-300 transition">
                                Ajouter au panier
                            </button>
                        </form>
                    @else
                        <a href="/login" class="block bg-white text-black py-4 rounded-full text-center text- font-black uppercase tracking-widest">
                            Connecte-toi pour commander
                        </a>
                    @endauth

                    <a href="https://wa.me/2290145201908?text=Salut%20Maman%20OLA%20!%20Je%20veux%20commander%20{{ urlencode($produit->nom) }}%20à%20{{ $produit->prix }}%20FCFA%20-%20{{ urlencode(url()->current()) }}" target="_blank" class="flex items-center justify-center gap-2 border border-zinc-700 text-white py-4 rounded-full text- uppercase tracking-widest hover:bg-white hover:text-black transition">
                        <i class="ri-whatsapp-line text-"></i> Commander sur WhatsApp • 01 45 20 19 08
                    </a>

                    <div class="flex gap-6 mt-6 text- text-zinc-500 uppercase tracking-widest">
                        <span class="flex items-center gap-2"><i class="ri-truck-line"></i> Livraison 24h Calavi</span>
                        <span class="flex items-center gap-2"><i class="ri-shield-check-line"></i> Paiement MoMo</span>
                        <span class="flex items-center gap-2"><i class="ri-refresh-line"></i> Échange possible</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- AVIS -->
    <div class="max-w-4xl mx-auto px-6 mt-12">
        <h2 class="text- font-black">Avis clientes ⭐ {{ $produit->moyenneEtoiles() }}/5 ({{ $produit->reviews->count() }} avis)</h2>

        @auth
        <form method="POST" action="{{ route('produit.avis', $produit->id) }}" class="mt-6 bg-zinc-900 border border-zinc-800 rounded- p-6">
            @csrf
            <p class="text- uppercase text-zinc-400 font-bold">Laisser un avis</p>
            <div class="flex gap-2 mt-3 text-3xl">
                @for($i=1; $i<=5; $i++)
                <label class="cursor-pointer"><input type="radio" name="rating" value="{{ $i }}" class="hidden peer" required><span class="peer-checked:opacity-100 opacity-30">⭐</span></label>
                @endfor
            </div>
            <textarea name="comment" placeholder="Ex: Qualité top, j'adore la mèche, livraison rapide à Calavi..." class="mt-4 w-full bg-black border border-zinc-700 rounded- px-4 py-3 text- text-white outline-none h-"></textarea>
            <button class="mt-4 bg-white text-black px-8 py-3 rounded-full text- font-bold uppercase">Publier mon avis</button>
        </form>
        @else
        <p class="mt-6 text-zinc-500 text-">Connecte-toi pour laisser un avis. <a href="/login" class="text-white underline">Connexion</a></p>
        @endauth

        <div class="mt-8 space-y-4">
            @foreach($produit->reviews as $avis)
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-4">
                <p class="text- font-bold">{{ $avis->user->name ?? 'Cliente' }} <span class="text-yellow-400">{{ str_repeat('⭐', $avis->rating) }}</span></p>
                <p class="text- text-zinc-400 mt-1">{{ $avis->comment }}</p>
                <p class="text- text-zinc-600 mt-2">{{ $avis->created_at->format('d/m/Y') }}</p>
            </div>
            @endforeach
            @if($produit->reviews->isEmpty())
            <p class="text-zinc-500 text-">Pas encore d'avis. Sois la première à donner ton avis !</p>
            @endif
        </div>
    </div>
</section>
@endsection