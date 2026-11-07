@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-12">
    <div class="max-w-4xl mx-auto px-6">
        <h1 class="text- font-black">Panier</h1>

        @if($paniers->isEmpty())
            <div class="mt-10 bg-zinc-900 border border-zinc-800 rounded- p-12 text-center">
                <p class="text-zinc-500">Ton panier est vide</p>
                <a href="/#produits" class="inline-block mt-4 bg-white text-black px-6 py-3 rounded-full text- font-bold uppercase">Voir les mèches</a>
            </div>
        @else
            <div class="mt-10 space-y-4">
                @php $total = 0; @endphp
                @foreach($paniers as $item)
                    @if($item->produit)
                        @php $total += $item->produit->prix * $item->quantite; @endphp
                        <div class="bg-zinc-900 border border-zinc-800 rounded- p-4 flex gap-4 items-center">
                            <img src="{{ asset('storage/'.$item->produit->image) }}" class="w-20 h-20 object-cover rounded- bg-zinc-800">
                            <div class="flex-1">
                                <p class="font-bold text-">{{ $item->produit->nom }}</p>
                                <p class="text- text-zinc-500">{{ number_format($item->produit->prix,0,' ',' ') }} FCFA x {{ $item->quantite }}</p>
                            </div>
                            <form method="POST" action="{{ route('panier.supprimer', $item->id) }}">
                                @csrf @method('DELETE')
                                <button class="bg-red-500/10 text-red-500 border border-red-500/20 px-4 py-2 rounded-full text- font-bold uppercase">Supprimer</button>
                            </form>
                        </div>
                    @endif
                @endforeach

                <div class="bg-white text-black rounded- p-6 flex justify-between items-center mt-6">
                    <div>
                        <p class="text- uppercase tracking-widest font-bold text-zinc-500">Total à payer</p>
                        <p class="text- font-black">{{ number_format($total,0,' ',' ') }} FCFA</p>
                    </div>
                    <a href="{{ route('checkout') }}" class="bg-black text-white px-10 py-4 rounded-full font-black text- uppercase tracking-widest hover:bg-zinc-800 transition">Aller au paiement MoMo →</a>
                </div>
            </div>
        @endif
    </div>
</section>
@endsection