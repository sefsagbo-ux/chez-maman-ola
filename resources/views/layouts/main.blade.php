<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CHEZ Maman OLA - @yield('title', 'Boutique de mèches')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white">

{{-- HEADER STYLE NEUTRA NOIR --}}
<header class="sticky top-0 z-50 bg-black text-white border-b border-zinc-800">
    <div class="max-w-7xl mx-auto px-4 md:px-6 h- flex items-center justify-between">
        
        {{-- LOGO --}}
        <div class="flex items-center gap-8">
            <a href="/" class="text- font-black tracking-tighter">CHEZ Maman OLA<span class="text-lime-300">.</span></a>
            
            {{-- MENU DESKTOP --}}
            <nav class="hidden md:flex items-center gap-6 text- uppercase tracking-widest text-zinc-300">
                <a href="/" class="hover:text-white {{ request()->is('/') ? 'text-white' : '' }}">Accueil</a>
                <a href="/#produits" class="hover:text-white">Nos produits</a>
                <a href="#contact" class="hover:text-white">Contacts</a>
            </nav>
        </div>

        {{-- RIGHT ICONS --}}
        <div class="flex items-center gap-2 md:gap-3">
            {{-- Téléphone pill comme NEUTRA --}}
            <a href="https://wa.me/2290145201908" target="_blank" class="hidden md:flex items-center gap-2 border border-zinc-700 rounded-full px-4 py-2 text- hover:border-white transition">
                <i class="ri-phone-line"></i> 01 45 20 19 08
            </a>

            <a href="/?search={{ request('search') }}" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-zinc-900">
                <i class="ri-search-line text-"></i>
            </a>

            @auth
                @if(Auth::user()->role === 'client')
                    <a href="{{ route('dashboard.client') }}" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-zinc-900"><i class="ri-user-3-line text-"></i></a>
                @elseif(Auth::user()->role === 'responsable')
                    <a href="{{ route('dashboard.responsable') }}" class="hidden md:flex bg-yellow-300 text-black text- font-bold px-3 py-2 rounded-full uppercase">Dashboard Responsable</a>
                @else
                    <a href="{{ route('dashboard.admin') }}" class="hidden md:flex bg-white text-black text- font-bold px-3 py-2 rounded-full uppercase">Dashboard Admin</a>
                @endif
                <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                    @csrf
                    <button class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-zinc-900"><i class="ri-logout-box-r-line"></i></button>
                </form>
            @else
                <a href="/login" class="w-9 h-9 flex items-center justify-center rounded-full hover:bg-zinc-900"><i class="ri-user-3-line text-"></i></a>
            @endauth

            {{-- PANIER AVEC BADGE --}}
            <a href="/panier" class="relative w-9 h-9 flex items-center justify-center rounded-full bg-white text-black">
                <i class="ri-shopping-bag-line text-"></i>
                @php $count = \App\Models\Cart::where('user_id', auth()->id())->sum('quantite'); @endphp
                @if($count > 0)
                    <span class="absolute -top-1 -right-1 bg-lime-300 text-black text- font-bold w-5 h-5 rounded-full flex items-center justify-center">{{ $count }}</span>
                @endif
            </a>

            {{-- MENU MOBILE --}}
            <button id="mobileMenuBtn" class="md:hidden w-9 h-9 flex items-center justify-center"><i class="ri-menu-line text-xl"></i></button>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div id="mobileMenu" class="hidden md:hidden border-t border-zinc-800 px-4 py-4 space-y-3 text-sm uppercase tracking-widest">
        <a href="/" class="block">Accueil</a>
        <a href="/#produits" class="block">Nos produits</a>
        <a href="#contact" class="block">Contacts</a>
        <a href="https://wa.me/2290145201908" class="block border border-zinc-700 rounded-full px-4 py-2 text-center mt-2">01 45 20 19 08</a>
    </div>
</header>

<main>
    @yield('content')
</main>

{{-- FOOTER STYLE NEUTRA --}}
<footer id="contact" class="bg-black text-white mt-0 border-t border-zinc-900">
    <div class="max-w-7xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-4 gap-10">
        
        <div>
            <h3 class="text- font-black tracking-tighter">CHEZ Maman OLA<span class="text-lime-300">.</span></h3>
            <p class="text-zinc-400 text- leading-relaxed mt-4">
                Le shop de mèches de Calavi en version site : Brésilienne, Péruvienne, Lace, X-pression 100% qualité, sélectionnées pièce par pièce.
            </p>
            <div class="mt-5 text- space-y-2">
                <p class="flex gap-2 text-zinc-300"><i class="ri-map-pin-line"></i> Basé à Abomey-Calavi — livraison gratuite partout</p>
                <p class="flex gap-2 font-bold"><i class="ri-whatsapp-line text-lime-300"></i> WhatsApp : 01 45 20 19 08</p>
            </div>
        </div>

        <div>
            <h4 class="text- uppercase tracking-[0.2em] text-zinc-400 font-bold mb-4">Boutique</h4>
            <ul class="space-y-3 text- text-zinc-300">
                <li><a href="/" class="hover:text-white">Nouveautés</a></li>
                <li><a href="/?category_id=1" class="hover:text-white">Brésilienne</a></li>
                <li><a href="/?category_id=2" class="hover:text-white">Péruvienne</a></li>
                <li><a href="/panier" class="hover:text-white">Panier</a></li>
                <li><a href="#" class="hover:text-white">Promotions</a></li>
            </ul>
        </div>

        <div>
            <h4 class="text- uppercase tracking-[0.2em] text-zinc-400 font-bold mb-4">Aide</h4>
            <ul class="space-y-3 text- text-zinc-300">
                <li>Livraison & échanges</li>
                <li>Guide des tailles (pouces)</li>
                <li>Suivi de commande</li>
                <li><a href="https://wa.me/2290145201908" class="hover:text-white">Nous contacter</a></li>
                <li>FAQ</li>
            </ul>
        </div>

        <div>
            <h4 class="text- uppercase tracking-[0.2em] text-zinc-400 font-bold mb-4">Newsletter</h4>
            <p class="text- text-zinc-400">-10% sur votre première commande en rejoignant le club OLA.</p>
            <form class="mt-4 flex items-center bg-zinc-900 rounded-full overflow-hidden border border-zinc-800">
                <input type="email" placeholder="votre@email.com" class="bg-transparent px-4 py-3 text- flex-1 outline-none text-white">
                <button class="bg-white text-black px-6 py-3 text- font-bold uppercase">OK</button>
            </form>
        </div>
    </div>

    <div class="border-t border-zinc-900 px-6 py-4 flex flex-col md:flex-row justify-between text- text-zinc-500">
        <p>© {{ date('Y') }} CHEZ Maman OLA — Calavi · Prix en FCFA · WhatsApp 01 45 20 19 08</p>
        <p class="mt-2 md:mt-0">Basé à Abomey-Calavi — Paiement MoMo / Livraison gratuite</p>
    </div>
</footer>

<script>
document.getElementById('mobileMenuBtn')?.addEventListener('click', () => {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});
</script>

</body>
</html>