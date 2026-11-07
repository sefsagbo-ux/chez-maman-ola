@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-12">
    <div class="max-w-3xl mx-auto px-6">
        <h1 class="text- font-black">Finaliser la commande</h1>
        <p class="text-zinc-500 text- mt-1">Choisissez votre mode de paiement MoMo</p>

        @php $total = $paniers->sum(fn($i)=> $i->produit->prix * $i->quantite); @endphp

        <div class="mt-8 bg-zinc-900 border border-zinc-800 rounded- p-6">
            <p class="font-bold">Résumé: {{ $paniers->count() }} mèches - Total: {{ number_format($total,0,' ',' ') }} FCFA</p>
        </div>

        <form method="POST" action="{{ route('commander') }}" class="mt-8 bg-zinc-900 border border-zinc-800 rounded- p-8 space-y-6">
            @csrf
            
            <div>
                <p class="text- uppercase tracking-widest text-zinc-400 font-bold mb-3">Mode de paiement</p>
                <div class="grid grid-cols-1 gap-3">
                    <label class="flex items-center gap-4 bg-black border border-zinc-700 rounded- p-4 cursor-pointer has-[:checked]:border-lime-300">
                        <input type="radio" name="payment_method" value="mtn" checked class="accent-lime-300">
                        <div class="flex-1">
                            <p class="font-bold text-">MTN MoMo</p>
                            <p class="text- text-zinc-500">*880*... Paiement instantané</p>
                        </div>
                        <span class="bg-yellow-400 text-black px-3 py-1 rounded-full text- font-bold">MTN</span>
                    </label>

                    <label class="flex items-center gap-4 bg-black border border-zinc-700 rounded- p-4 cursor-pointer has-[:checked]:border-lime-300">
                        <input type="radio" name="payment_method" value="moov" class="accent-lime-300">
                        <div class="flex-1">
                            <p class="font-bold text-">Moov Money</p>
                            <p class="text- text-zinc-500">*855*... Rapide</p>
                        </div>
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text- font-bold">MOOV</span>
                    </label>

                    <label class="flex items-center gap-4 bg-black border border-zinc-700 rounded- p-4 cursor-pointer has-[:checked]:border-lime-300">
                        <input type="radio" name="payment_method" value="cash" class="accent-lime-300">
                        <div class="flex-1">
                            <p class="font-bold text-">Paiement à la livraison</p>
                            <p class="text- text-zinc-500">Vous payez quand on livre à Calavi</p>
                        </div>
                        <span class="bg-white text-black px-3 py-1 rounded-full text- font-bold">CASH</span>
                    </label>
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="text- uppercase text-zinc-400">Numéro MoMo / Téléphone</label>
                    <input type="text" name="phone_momo" placeholder="01 45 20 19 08" required class="mt-2 w-full bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white outline-none focus:border-white">
                </div>
                <div>
                    <label class="text- uppercase text-zinc-400">Adresse livraison Calavi</label>
                    <input type="text" name="delivery_address" placeholder="Ex: Zoca, Calavi, près de..." required class="mt-2 w-full bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white outline-none focus:border-white">
                </div>
            </div>

            <button class="w-full bg-white text-black py-4 rounded-full font-black text- uppercase tracking-widest hover:bg-lime-300 transition">
                Payer {{ number_format($total,0,' ',' ') }} FCFA et commander
            </button>

            <p class="text-center text- text-zinc-500">Paiement 100% sécurisé via Mobile Money Bénin</p>
        </form>
    </div>
</section>
@endsection