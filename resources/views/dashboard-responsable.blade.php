@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-6">
        <h1 class="text- font-black">Dashboard Responsable</h1>
        
        {{-- STATS --}}
        <div class="grid md:grid-cols-3 gap-4 mt-8">
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-6">
                <p class="text- uppercase tracking-widest text-zinc-500">Ventes du jour</p>
                <p class="text- font-black mt-2">{{ number_format($ventesDuJour ?? 0,0,' ',' ') }} FCFA</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-6">
                <p class="text- uppercase tracking-widest text-zinc-500">Commandes à livrer</p>
                <p class="text- font-black mt-2">{{ $commandesEnAttente ?? 0 }}</p>
            </div>
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-6">
                <p class="text- uppercase tracking-widest text-zinc-500">Stock faible</p>
                <p class="text- font-black mt-2 text-red-400">{{ $produitsFaibleStock ?? 0 }}</p>
            </div>
        </div>

        {{-- COMMANDES --}}
        <h2 class="mt-12 font-bold text-">Commandes à gérer</h2>
        <div class="mt-4 space-y-3">
            @foreach($commandes as $cmd)
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-4 flex justify-between items-center">
                <div>
                    <p class="font-bold text-">Commande #{{ $cmd->id }} - {{ $cmd->user->name ?? 'Client' }} - {{ number_format($cmd->total,0,' ',' ') }} FCFA</p>
                    <p class="text- text-zinc-400">{{ $cmd->created_at->format('d/m H:i') }}</p>
                </div>
                <form method="POST" action="{{ route('commande.statut', $cmd->id) }}" class="flex gap-2">
                    @csrf
                    @method('PATCH')
                    <select name="statut" class="bg-black border border-zinc-700 rounded-full px-3 py-2 text- text-white">
                        <option value="en_attente" {{ $cmd->statut=='en_attente'?'selected':'' }}>En attente</option>
                        <option value="livree" {{ $cmd->statut=='livree'?'selected':'' }}>Livrée</option>
                        <option value="annulee" {{ $cmd->statut=='annulee'?'selected':'' }}>Annulée</option>
                    </select>
                    <button class="bg-white text-black px-4 py-2 rounded-full text- font-bold">OK</button>
                </form>
            </div>
            @endforeach
        </div>

        {{-- STOCK RAPIDE --}}
        <h2 class="mt-12 font-bold text-">Stock rapide</h2>
        <div class="mt-4 grid md:grid-cols-3 gap-3">
            @foreach($produits as $p)
            <form method="POST" action="{{ route('produit.stock', $p->id) }}" class="bg-zinc-900 border border-zinc-800 rounded- p-4 flex justify-between items-center">
                @csrf
                @method('PATCH')

                <span class="text- font-bold truncate">{{ $p->nom }}</span>
                <div class="flex items-center gap-2">
                    <input type="number" name="stock" value="{{ $p->stock }}" class="bg-black border border-zinc-700 rounded-full w-16 px-2 py-1 text- text-white text-center">
                    <button class="bg-lime-300 text-black px-3 py-1 rounded-full text- font-bold">MAJ</button>
                </div>
            </form>
            @endforeach
        </div>
    </div>
</section>
@endsection