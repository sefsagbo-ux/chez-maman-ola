@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-20">
    <div class="max-w-2xl mx-auto px-6 text-center">
        <div class="w-20 h-20 bg-lime-300 rounded-full flex items-center justify-center mx-auto text-black text-3xl">✓</div>
        <h1 class="text- font-black mt-6">Commande confirmée !</h1>
        <p class="text-zinc-400 mt-2">Commande #{{ $order->id }} - {{ number_format($order->total,0,' ',' ') }} FCFA</p>
        
        <div class="mt-8 bg-zinc-900 border border-zinc-800 rounded- p-6 text-left">
            <p class="text-"><span class="text-zinc-500">Paiement:</span> <span class="font-bold uppercase">{{ $order->payment_method }} - {{ $order->phone_momo }}</span></p>
            <p class="text- mt-2"><span class="text-zinc-500">Livraison:</span> {{ $order->delivery_address }}</p>
            <p class="text- mt-2"><span class="text-zinc-500">Statut:</span> <span class="bg-yellow-300 text-black px-3 py-1 rounded-full text- font-bold">{{ $order->statut }}</span></p>
        </div>

        <a href="{{ route('commande.facture', $order->id) }}" class="inline-block mt-4 bg-lime-300 text-black px-8 py-3 rounded-full text- font-bold uppercase">📄 Télécharger ma facture PDF</a>

        <div class="mt-8 flex gap-3 justify-center">
            <a href="/" class="bg-white text-black px-8 py-3 rounded-full text- font-bold uppercase">Continuer shopping</a>
            <a href="/dashboard/client" class="border border-zinc-700 px-8 py-3 rounded-full text- uppercase">Voir mes commandes</a>
        </div>

        <a href="https://wa.me/2290145201908?text=J'ai%20commandé%20{{ $order->id }}%20par%20{{ $order->payment_method }}" class="inline-block mt-6 text-lime-300 text- underline">Confirmer sur WhatsApp 01 45 20 19 08</a>
    </div>
</section>
@endsection