@extends('layouts.main')

@section('content')

{{-- 1. HERO AVEC CARROUSEL 5 PHOTOS --}}
<div class="bg-black text-white">
    <div class="max-w-7xl mx-auto px-6 py-12 md:py-16 grid md:grid-cols-2 gap-10 items-center">
        
        <div>
            <div class="inline-flex border border-zinc-700 rounded-full px-5 py-3 text- uppercase tracking-widest text-zinc-300">
                ✨ CHEZ MAMAN OLA — LE VRAI SHOP DE MÈCHES À CALAVI
            </div>
            <h1 class="text- md:text- font-black leading-[0.9] mt-6">La Qualité<br>Avant<br><span class="text-zinc-500 italic font-light">Tout</span></h1>
            <p class="text-zinc-400 text- mt-6 max-w-">Brésilienne, Péruvienne, Lace Front, X-pression 100% qualité. Livrées gratuitement depuis Abomey-Calavi.</p>
            <div class="flex gap-3 mt-8">
                <a href="#produits" class="bg-white text-black px-6 py-3 rounded-full text- font-bold">VOIR LES MÈCHES</a>
                <a href="https://wa.me/2290145201908" class="border border-zinc-700 px-6 py-3 rounded-full text-">WHATSAPP</a>
            </div>
        </div>

        {{-- CARROUSEL DROITE --}}
        <div class="relative h- bg-zinc-900 rounded- overflow-hidden border border-zinc-800">
            @foreach($produits->take(5) as $key => $p)
                <div class="mySlide absolute inset-0 {{ $key==0?'block':'hidden' }}">
                    <img src="{{ asset('storage/'.$p->image) }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                    <div class="absolute bottom-5 left-5 bg-white text-black px-4 py-2 rounded-full text- font-bold">
                        {{ $p->nom }} - {{ number_format($p->prix,0,' ',' ') }} FCFA
                    </div>
                </div>
            @endforeach
            <div class="absolute top-4 left-4 bg-lime-300 text-black text- font-bold px-3 py-1 rounded-full">Bestseller</div>
            <div class="absolute bottom-5 right-5 flex gap-1.5" id="dots"></div>
        </div>

    </div>
</div>

{{-- 2. PRODUITS FOND NOIR --}}
<section id="produits" class="bg-black text-white py-12">
    <div class="max-w-7xl mx-auto px-6">
        <div class="bg-zinc-900 rounded- p-4 border border-zinc-800 flex gap-2">
            <form method="GET" class="flex flex-1 gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Rechercher: Brésilienne..." class="flex-1 bg-black border border-zinc-700 rounded-full px-5 py-3 text- text-white">
                <select name="category_id" class="bg-black border border-zinc-700 rounded-full px-4 py-3 text- text-white">
                    <option value="">Toutes les catégories</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id')==$cat->id?'selected':'' }}>{{ $cat->nom }}</option>
                    @endforeach
                </select>
                <button class="bg-white text-black px-6 rounded-full text- font-bold">FILTRER</button>
            </form>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-10">
            @foreach($produits as $produit)
            <a href="{{ route('produit.detail', $produit->id) }}" class="bg-zinc-900 rounded- overflow-hidden border border-zinc-800">
                <div class="h- bg-zinc-800 relative overflow-hidden">
                    <img src="{{ asset('storage/'.$produit->image) }}" class="w-full h-full object-cover">
                    <span class="absolute top-3 left-3 bg-lime-300 text-black px-3 py-1 rounded-full text- font-bold">Stock: {{ $produit->stock }}</span>
                </div>
                <div class="p-5">
                    <h3 class="font-bold">{{ $produit->nom }}</h3>
                    <p class="text-zinc-500 text-">{{ $produit->category->nom ?? '' }}</p>
                    <p class="mt-3 font-black text-">{{ number_format($produit->prix,0,' ',' ') }} FCFA</p>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>

<script>
let slideIndex = 0;
const slides = document.getElementsByClassName("mySlide");
const dotsBox = document.getElementById("dots");

for(let i=0;i<slides.length;i++){
    let dot = document.createElement("span");
    dot.className = "w-6 h-1 rounded-full cursor-pointer " + (i==0?"bg-white":"bg-white/30");
    dot.onclick = function(){ show(i); };
    dotsBox.appendChild(dot);
}

function show(n){
    for(let i=0;i<slides.length;i++){
        slides[i].style.display = "none";
        dotsBox.children[i].className = "w-6 h-1 rounded-full cursor-pointer bg-white/30";
    }
    slides[n].style.display = "block";
    dotsBox.children[n].className = "w-6 h-1 rounded-full cursor-pointer bg-white";
    slideIndex = n;
}

function nextSlide(){
    slideIndex = (slideIndex+1) % slides.length;
    show(slideIndex);
}

show(0);
setInterval(nextSlide, 3000);
</script>

@endsection