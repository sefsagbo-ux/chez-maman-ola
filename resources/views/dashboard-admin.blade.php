@extends('layouts.main')
@section('content')
<section class="bg-black text-white min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex justify-between items-center">
            <h1 class="text- font-black">Dashboard Admin - Gestion Totale</h1>
            <a href="/" class="text- border border-zinc-700 rounded-full px-4 py-2 hover:bg-white hover:text-black">← Boutique</a>
        </div>

        <div class="mt-8 bg-zinc-900 border border-zinc-800 rounded- p-6">
            <h3 class="font-bold mb-4">Ajouter une nouvelle mèche</h3>
            <form method="POST" action="{{ route('admin.produit.ajouter') }}" enctype="multipart/form-data" class="grid md:grid-cols-2 gap-4">
                @csrf
                <input type="text" name="nom" placeholder="Nom: Brésilienne 14 pouces" required class="bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white outline-none">
                <select name="category_id" class="bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white">
                    @foreach($categories as $cat)<option value="{{ $cat->id }}">{{ $cat->nom }}</option>@endforeach
                </select>
                <input type="number" name="prix" placeholder="Prix FCFA" required class="bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white">
                <input type="number" name="stock" placeholder="Stock" required class="bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white">
                <textarea name="description" placeholder="Description" class="md:col-span-2 bg-black border border-zinc-700 rounded- px-4 py-3 text- text-white h-"></textarea>
                <div class="md:col-span-2 bg-black border border-zinc-700 rounded-full px-4 py-2 flex gap-3">
                    <input type="file" name="image" required class="text- text-zinc-400">
                </div>
                <button class="md:col-span-2 bg-white text-black py-3 rounded-full font-bold text- uppercase hover:bg-lime-300">Ajouter la mèche</button>
            </form>
        </div>

        <div class="mt-12">
            <h3 class="font-bold text- mb-4">Modifier + Ajouter photos aux anciens produits</h3>
            <div class="space-y-3">
                @foreach($produits as $p)
                <div class="bg-zinc-900 border border-zinc-800 rounded- p-3 flex gap-3 items-center">
                    <img src="{{ $p->image ? asset('storage/'.$p->image) : 'https://via.placeholder.com/80' }}" class="w-16 h-16 object-cover rounded-">
                    <form method="POST" action="{{ route('admin.produit.modifier', $p->id) }}" enctype="multipart/form-data" class="flex-1 grid grid-cols-2 md:grid-cols-6 gap-2 items-center">
                        @csrf
                        <input type="text" name="nom" value="{{ $p->nom }}" class="bg-black border border-zinc-700 rounded-full px-3 py-2 text-white text- col-span-2 md:col-span-1">
                        <input type="number" name="prix" value="{{ $p->prix }}" class="bg-black border border-zinc-700 rounded-full px-3 py-2 text-white text-">
                        <input type="number" name="stock" value="{{ $p->stock }}" class="bg-black border border-zinc-700 rounded-full px-3 py-2 text-white text-">
                        <input type="file" name="image" class="text- text-zinc-400 col-span-2 md:col-span-1">
                        <button class="bg-lime-300 text-black px-3 py-2 rounded-full text- font-bold">MODIFIER</button>
                        <a href="{{ route('admin.produit.supprimer', $p->id) }}" onclick="return confirm('Vraiment supprimer {{ $p->nom }} ?')" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-full text- font-bold text-center">Supprimer</a>                    </form>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endsection