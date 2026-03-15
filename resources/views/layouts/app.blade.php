<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CYCO MARKET')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* ═══════════════════════════════════
       TOKENS — identiques au welcome
    ═══════════════════════════════════ */
    :root {
        --gold:      #f5a623;
        --gold-lt:   #ffd280;
        --gold-dk:   #c47d0e;
        --bg:        #07090f;
        --bg2:       #0c1120;
        --card:      #101624;
        --card2:     #141c2c;
        --rim:       rgba(255,255,255,.055);
        --rim-gold:  rgba(245,166,35,.20);
        --txt:       #dde1ec;
        --txt2:      #6b7591;
        --blue:      #1a6cff;
        --teal:      #00d2a8;
        --red:       #ef4444;
        --green:     #22c55e;
    }

    /* ── RESET ── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
        background: var(--bg) !important;
        color: var(--txt);
        font-family: 'Outfit', sans-serif;
        font-weight: 400;
        min-height: 100vh;
        overflow-x: hidden;
    }

    /* ambient mesh */
    body::before {
        content: '';
        position: fixed; inset: 0; z-index: 0; pointer-events: none;
        background:
            radial-gradient(ellipse 60% 50% at  8%  8%,  rgba(26,108,255,.07)  0%, transparent 55%),
            radial-gradient(ellipse 55% 45% at 92% 90%,  rgba(245,166,35,.06)  0%, transparent 55%),
            radial-gradient(ellipse 40% 35% at 55% 40%,  rgba(0,210,168,.04)   0%, transparent 65%);
    }

    /* ── KEYFRAMES ── */
    @keyframes shimmer { 0%{background-position:-220% center} 100%{background-position:220% center} }
    @keyframes fadeUp  { from{opacity:0;transform:translateY(18px)} to{opacity:1;transform:translateY(0)} }
    @keyframes glow    { 0%,100%{opacity:.5} 50%{opacity:1} }
    @keyframes pulse-r { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.4)} 65%{box-shadow:0 0 0 9px transparent} }

    /* ══════════════════════════════════
       NAVBAR
    ══════════════════════════════════ */
    .app-nav {
        position: sticky; top: 0; z-index: 200;
        height: 66px;
        background: rgba(7,9,15,.88);
        backdrop-filter: blur(22px) saturate(170%);
        border-bottom: 1px solid var(--rim);
        display: flex; align-items: center;
        padding: 0 40px;
        gap: 32px;
    }

    /* logo */
    .nav-logo {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem; font-weight: 900;
        background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800);
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: shimmer 4s linear infinite;
        text-decoration: none; white-space: nowrap; letter-spacing: .4px;
        flex-shrink: 0;
    }

    /* nav links */
    .nav-links { display: flex; align-items: center; gap: 28px; }
    .nav-link {
        color: var(--txt2); font-size: .875rem; font-weight: 500;
        text-decoration: none; letter-spacing: .3px; transition: color .25s;
        position: relative; white-space: nowrap;
    }
    .nav-link::after {
        content: ''; position: absolute; bottom: -4px; left: 0;
        width: 0; height: 1px;
        background: linear-gradient(90deg, var(--gold), var(--gold-lt));
        transition: width .3s;
    }
    .nav-link:hover { color: var(--gold-lt); }
    .nav-link:hover::after { width: 100%; }

    /* search bar */
    .nav-search {
        flex: 1; max-width: 400px;
        display: flex; align-items: center;
        background: rgba(255,255,255,.04);
        border: 1px solid var(--rim);
        border-radius: 10px; overflow: hidden;
        transition: border-color .3s, box-shadow .3s;
    }
    .nav-search:focus-within {
        border-color: rgba(245,166,35,.35);
        box-shadow: 0 0 0 3px rgba(245,166,35,.07);
    }
    .nav-search input {
        flex: 1; background: transparent;
        border: none; outline: none;
        padding: 10px 14px;
        color: var(--txt); font-family: 'Outfit', sans-serif; font-size: .875rem;
    }
    .nav-search input::placeholder { color: var(--txt2); }
    .nav-search button {
        padding: 0 16px; height: 100%;
        background: rgba(245,166,35,.12); border: none;
        color: var(--gold); font-size: 14px; cursor: pointer;
        transition: background .3s; border-left: 1px solid var(--rim);
    }
    .nav-search button:hover { background: rgba(245,166,35,.22); }

    /* nav right zone */
    .nav-right { display: flex; align-items: center; gap: 10px; margin-left: auto; flex-shrink: 0; }

    /* cart icon */
    .cart-btn {
        position: relative;
        width: 40px; height: 40px; border-radius: 10px;
        background: rgba(255,255,255,.04); border: 1px solid var(--rim);
        display: flex; align-items: center; justify-content: center;
        color: var(--txt2); font-size: 16px; text-decoration: none;
        transition: all .3s;
    }
    .cart-btn:hover { background: rgba(245,166,35,.10); border-color: var(--rim-gold); color: var(--gold); }
    .cart-count {
        position: absolute; top: -5px; right: -5px;
        background: var(--gold); color: #07090f;
        font-size: 9px; font-weight: 800;
        width: 18px; height: 18px; border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        border: 2px solid var(--bg);
        animation: pulse-r 2.5s infinite;
    }

    /* ghost btn */
    .btn-ghost-nav {
        color: var(--txt2); font-size: .85rem; font-weight: 500;
        background: rgba(255,255,255,.04); border: 1px solid var(--rim);
        padding: 9px 18px; border-radius: 9px; text-decoration: none;
        transition: all .3s; white-space: nowrap;
        display: inline-flex; align-items: center; gap: 7px;
    }
    .btn-ghost-nav:hover { background: rgba(255,255,255,.08); color: var(--txt); }

    /* gold btn */
    .btn-gold-nav {
        background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
        background-size: 200% auto;
        color: #07090f; font-size: .85rem; font-weight: 700;
        padding: 9px 20px; border-radius: 9px; text-decoration: none;
        transition: all .3s; white-space: nowrap;
        display: inline-flex; align-items: center; gap: 7px;
        animation: shimmer 3.5s linear infinite;
        border: none;
    }
    .btn-gold-nav:hover { transform: translateY(-2px); box-shadow: 0 7px 22px rgba(245,166,35,.35); }

    /* admin badge btn */
    .btn-admin-nav {
        background: linear-gradient(135deg, #92400e, #f59e0b, #fbbf24);
        background-size: 200% auto; animation: shimmer 3.5s linear infinite;
        color: #1a0e00; font-size: .8rem; font-weight: 800;
        padding: 8px 16px; border-radius: 8px; text-decoration: none;
        display: inline-flex; align-items: center; gap: 6px; transition: all .3s;
        border: none; white-space: nowrap;
    }
    .btn-admin-nav:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(245,158,11,.40); }

    /* ── user dropdown ── */
    .user-wrap { position: relative; }

    .user-trigger {
        display: flex; align-items: center; gap: 9px;
        padding: 7px 14px 7px 8px;
        background: rgba(255,255,255,.04); border: 1px solid var(--rim);
        border-radius: 10px; cursor: pointer;
        transition: all .3s; font-family: 'Outfit', sans-serif;
        color: var(--txt); font-size: .85rem; font-weight: 500;
        white-space: nowrap;
    }
    .user-trigger:hover { background: rgba(255,255,255,.08); border-color: var(--rim-gold); }

    .user-avatar {
        width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, var(--gold-dk), var(--gold));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif; font-size: .82rem; font-weight: 800; color: #07090f;
    }
    .chevron-icon { font-size: 10px; color: var(--txt2); transition: transform .25s; }
    .user-wrap.open .chevron-icon { transform: rotate(180deg); }

    .user-menu {
        display: none;
        position: absolute; right: 0; top: calc(100% + 10px);
        width: 238px;
        background: var(--card);
        border: 1px solid rgba(245,166,35,.20);
        border-radius: 14px; overflow: hidden;
        box-shadow: 0 24px 60px rgba(0,0,0,.7);
        z-index: 500;
        animation: fadeUp .2s ease both;
    }
    .user-wrap.open .user-menu { display: block; }

    .menu-profile {
        padding: 14px 18px 12px;
        border-bottom: 1px solid var(--rim);
        display: flex; align-items: center; gap: 11px;
    }
    .menu-avatar {
        width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
        background: linear-gradient(135deg, var(--gold-dk), var(--gold));
        display: flex; align-items: center; justify-content: center;
        font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 800; color: #07090f;
    }
    .menu-name  { font-size: .875rem; font-weight: 700; color: var(--txt); }
    .menu-role  { font-size: .7rem; color: var(--gold); letter-spacing: .5px; text-transform: uppercase; margin-top: 1px; }

    .menu-item {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 18px; color: var(--txt2); font-size: .855rem;
        text-decoration: none; transition: background .2s, color .2s;
        cursor: pointer; background: transparent; border: none;
        width: 100%; text-align: left; font-family: 'Outfit', sans-serif;
    }
    .menu-item .mi-icon { width: 15px; text-align: center; color: var(--gold); }
    .menu-item:hover { background: rgba(245,166,35,.07); color: var(--gold-lt); }
    .menu-item.danger { color: #f87171; }
    .menu-item.danger .mi-icon { color: #f87171; }
    .menu-item.danger:hover { background: rgba(239,68,68,.08); }

    .menu-sep { height: 1px; background: var(--rim); margin: 4px 0; }

    /* ══════════════════════════════════
       FLASH MESSAGES
    ══════════════════════════════════ */
    .flash-wrap {
        position: relative; z-index: 10;
        max-width: 1280px; margin: 20px auto 0; padding: 0 32px;
    }
    .flash {
        display: flex; align-items: center; gap: 12px;
        padding: 13px 18px; border-radius: 12px;
        font-size: .875rem; font-weight: 500; margin-bottom: 10px;
        animation: fadeUp .4s ease both;
    }
    .flash-success {
        background: rgba(34,197,94,.10); border: 1px solid rgba(34,197,94,.25); color: #4ade80;
    }
    .flash-error {
        background: rgba(239,68,68,.10); border: 1px solid rgba(239,68,68,.25); color: #f87171;
    }
    .flash i { font-size: 15px; flex-shrink: 0; }

    /* back button */
    .back-btn {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 7px 14px; border-radius: 8px;
        background: rgba(255,255,255,.04); border: 1px solid var(--rim);
        color: var(--txt2); font-size: .8rem; font-weight: 500;
        text-decoration: none; transition: all .3s; cursor: pointer;
        font-family: 'Outfit', sans-serif;
    }
    .back-btn:hover { background: rgba(255,255,255,.08); color: var(--txt); border-color: rgba(255,255,255,.12); }

    /* ══════════════════════════════════
       MAIN CONTENT
    ══════════════════════════════════ */
    .app-main {
        position: relative; z-index: 1;
        padding: 32px 0 80px;
    }
    .app-main-inner {
        max-width: 1280px; margin: 0 auto; padding: 0 32px;
    }

    /* ══════════════════════════════════
       FOOTER
    ══════════════════════════════════ */
    .app-footer {
        position: relative; z-index: 1;
        background: #05070f;
        border-top: 1px solid rgba(245,166,35,.08);
        padding: 32px 40px;
        text-align: center;
    }
    .app-footer-text {
        color: rgba(255,255,255,.22); font-size: .82rem; font-weight: 300;
    }
    .app-footer-logo {
        font-family: 'Playfair Display', serif; font-weight: 900;
        background: linear-gradient(90deg, var(--gold-lt), var(--gold));
        background-size: 200% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: shimmer 5s linear infinite;
        font-size: .95rem;
    }

    /* ══════════════════════════════════
       MOBILE NAV
    ══════════════════════════════════ */
    @media(max-width: 900px) {
        .app-nav { padding: 0 20px; gap: 16px; }
        .nav-links { display: none; }
        .nav-search { max-width: 240px; }
    }
    @media(max-width: 600px) {
        .nav-search { display: none; }
        .app-main-inner { padding: 0 16px; }
        .flash-wrap { padding: 0 16px; }
    }

    /* ══════════════════════════════════
       OVERRIDE: pages enfants peuvent
       ajouter leurs propres styles via
       @push('styles')
    ══════════════════════════════════ */
    @stack('styles-inline');
    </style>

    {{-- styles supplémentaires injectés par les pages enfants --}}
    @stack('styles')

    <style>
        /* empêche Tailwind d'écraser les couleurs des pages enfants */
        .app-main * { color: inherit; }
    </style>
</head>

<body>

<!-- ════════════════════════════════════════
     NAVBAR
════════════════════════════════════════ -->
<nav class="app-nav">

    {{-- Logo --}}
    <a href="{{ route('home') }}" class="nav-logo">CYCO MARKET</a>

    {{-- Nav links --}}
    <div class="nav-links">
        <a href="{{ route('products.index') }}" class="nav-link">
            <i class="fas fa-store" style="margin-right:5px;font-size:12px;"></i>Produits
        </a>
    </div>

    {{-- Search --}}
    <form action="{{ route('products.index') }}" method="GET" class="nav-search">
        <input type="text" name="search" placeholder="Rechercher un produit…"
               value="{{ request('search') }}">
        <button type="submit"><i class="fas fa-search"></i></button>
    </form>

    {{-- Right zone --}}
    <div class="nav-right">

        {{-- Panier --}}
        <a href="{{ route('cart.index') }}" class="cart-btn" title="Mon panier">
            <i class="fas fa-shopping-cart"></i>
            @if(session()->has('cart') && count(session('cart')) > 0)
                <span class="cart-count">{{ count(session('cart')) }}</span>
            @endif
        </a>

        @auth

            {{-- Bouton admin --}}
            @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="btn-admin-nav">
                    <i class="fas fa-user-shield"></i> Admin
                </a>
            @endif

            {{-- User dropdown --}}
            <div class="user-wrap" id="userWrap">
                <button class="user-trigger" onclick="toggleUserMenu()" type="button">
                    <div class="user-avatar">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>
                    {{ Auth::user()->name }}
                    <i class="fas fa-chevron-down chevron-icon"></i>
                </button>

                <div class="user-menu" id="userMenu">

                    {{-- Profile header --}}
                    <div class="menu-profile">
                        <div class="menu-avatar">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="menu-name">{{ Auth::user()->name }}</div>
                            <div class="menu-role">{{ Auth::user()->role }}</div>
                        </div>
                    </div>

                    {{-- Links --}}
                    @if(Auth::user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="menu-item">
                            <i class="fas fa-gauge-high mi-icon"></i> Dashboard
                        </a>
                    @endif

                    <a href="{{ route('orders.index') }}" class="menu-item">
                        <i class="fas fa-box mi-icon"></i> Mes commandes
                    </a>

                    <a href="{{ route('cart.index') }}" class="menu-item">
                        <i class="fas fa-shopping-cart mi-icon"></i> Mon panier
                    </a>

                    <div class="menu-sep"></div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="menu-item danger">
                            <i class="fas fa-sign-out-alt mi-icon"></i> Déconnexion
                        </button>
                    </form>

                </div>
            </div>

        @else

            <a href="{{ route('login') }}"    class="btn-ghost-nav">Connexion</a>
            <a href="{{ route('register') }}" class="btn-gold-nav">
                <i class="fas fa-user-plus" style="font-size:12px;"></i> Inscription
            </a>

        @endauth

    </div>
</nav>

<!-- ════════════════════════════════════════
     FLASH MESSAGES
════════════════════════════════════════ -->
@if(session('success') || session('error'))
<div class="flash-wrap">
    @if(session('success'))
        <div class="flash flash-success">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="flash flash-error">
            <i class="fas fa-exclamation-circle"></i>
            {{ session('error') }}
        </div>
    @endif
</div>
@endif

<!-- ════════════════════════════════════════
     MAIN
════════════════════════════════════════ -->
<main class="app-main">
    <div class="app-main-inner">

        {{-- Bouton retour --}}
        <div style="margin-bottom: 20px;">
            <button onclick="history.back()" class="back-btn">
                <i class="fas fa-arrow-left" style="font-size:11px;"></i> Retour
            </button>
        </div>

        @yield('content')

    </div>
</main>

<!-- ════════════════════════════════════════
     FOOTER
════════════════════════════════════════ -->
<footer class="app-footer">
    <div style="margin-bottom:8px;">
        <span class="app-footer-logo">CYCO MARKET</span>
    </div>
    <p class="app-footer-text">© 2026 CYCO MARKET. Tous droits réservés. Made by <strong style="color:rgba(245,166,35,.5);">DONA</strong>.</p>
</footer>

<!-- ════════════════════════════════════════
     JS : dropdown vanilla
════════════════════════════════════════ -->
<script>
    function toggleUserMenu() {
        var wrap = document.getElementById('userWrap');
        wrap.classList.toggle('open');
    }
    // ferme en cliquant ailleurs
    document.addEventListener('click', function(e) {
        var wrap = document.getElementById('userWrap');
        if (wrap && !wrap.contains(e.target)) {
            wrap.classList.remove('open');
        }
    });
</script>

@stack('scripts')

</body>
</html>