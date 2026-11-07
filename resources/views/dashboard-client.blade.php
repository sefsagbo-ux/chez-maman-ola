@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-12">
    <div class="max-w-6xl mx-auto px-6">
        <h1 class="text-2xl font-black">Bonjour {{ Auth::user()->name }} 👋</h1>
        <p class="text-zinc-500 text-sm mt-1">Voici vos commandes chez Maman OLA</p>

        <div class="mt-10 grid gap-4">
            @forelse($commandes as $cmd)
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-6">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="font-bold">Commande #{{ $cmd->id }} - {{ $cmd->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm mt-2 text-zinc-400">Statut:
                            @if($cmd->statut=='en_attente') <span class="bg-yellow-300 text-black px-3 py-1 rounded-full text- font-bold">En attente</span>
                            @elseif($cmd->statut=='en_preparation') <span class="bg-blue-300 text-black px-3 py-1 rounded-full text- font-bold">En préparation</span>
                            @elseif($cmd->statut=='en_route') <span class="bg-orange-300 text-black px-3 py-1 rounded-full text- font-bold">En route</span>
                            @elseif($cmd->statut=='livree') <span class="bg-lime-300 text-black px-3 py-1 rounded-full text- font-bold">Livrée</span>
                            @else <span class="bg-red-500 text-white px-3 py-1 rounded-full text- font-bold">{{ $cmd->statut }}</span>
                            @endif
                        </p>
                        <p class="text- text-zinc-500 mt-2">{{ strtoupper($cmd->payment_method ?? 'cash') }} - {{ $cmd->phone_momo ?? '' }} | Livraison: {{ $cmd->delivery_address ?? 'Calavi' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-black text-">{{ number_format($cmd->total,0,' ',' ') }} FCFA</p>
                        <a href="{{ route('commande.facture', $cmd->id) }}" class="inline-block mt-2 bg-white text-black px-4 py-2 rounded-full text- font-bold uppercase">📄 Facture</a>
                    </div>
                </div>

                <!-- BARRE DE SUIVI LIVRAISON -->
                @php
                    $etapes = ['en_attente' => 'En attente', 'en_preparation' => 'En préparation', 'en_route' => 'En route', 'livree' => 'Livrée'];
                    $indexActuel = array_search($cmd->statut, array_keys($etapes));
                    if($indexActuel === false) $indexActuel = 0;
                @endphp
                <div class="flex items-center mt-6 px-1">
                    @foreach($etapes as $key => $label)
                        @php $i = $loop->index; $active = $i <= $indexActuel; @endphp
                        <div class="flex items-center {{ !$loop->last ? 'flex-1' : '' }}">
                            <div class="flex flex-col items-center">
                                <div class="w-9 h-9 rounded-full flex items-center justify-center text- font-black {{ $active ? 'bg-lime-300 text-black' : 'bg-zinc-800 text-zinc-500 border border-zinc-700' }}">
                                    {{ $active ? '✓' : $i+1 }}
                                </div>
                                <p class="text- mt-1 text-center whitespace-nowrap {{ $active ? 'text-white font-bold' : 'text-zinc-500' }}">{{ $label }}</p>
                            </div>
                            @if(!$loop->last)
                            <div class="flex-1 h- mx-2 mb-5 {{ $i < $indexActuel ? 'bg-lime-300' : 'bg-zinc-800' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
                @if($cmd->statut == 'en_route')
                <p class="mt-2 text- text-lime-300">🚚 Ton livreur est en route vers {{ $cmd->delivery_address }} - Appelle 01 45 20 19 08</p>
                @endif
                @if($cmd->statut == 'livree')
                <p class="mt-2 text- text-lime-300">✅ Commande livrée ! Merci, laisse un avis sur tes mèches ⭐</p>
                @endif

                <div class="mt-4 border-t border-zinc-800 pt-4">
                    @foreach($cmd->produits as $prod)
                    <p class="text-zinc-300 text-">{{ $prod->nom }} x {{ $prod->pivot->quantite }} - {{ number_format($prod->pivot->prix_unitaire,0,' ',' ') }} FCFA</p>
                    @endforeach
                </div>
            </div>
            @empty
            <div class="bg-zinc-900 border border-zinc-800 rounded- p-12 text-center">
                <p class="text-zinc-500">Tu n'as pas encore commandé.</p>
                <a href="/#produits" class="inline-block mt-4 bg-white text-black px-6 py-3 rounded-full text- font-bold uppercase">Voir les mèches</a>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection