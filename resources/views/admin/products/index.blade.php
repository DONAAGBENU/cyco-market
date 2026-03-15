@extends('layouts.app')

@section('title', 'Gestion des produits — CYCO MARKET')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ═══════════════════════════════
   TOKENS
═══════════════════════════════ */
:root {
    --gold:     #f5a623;
    --gold-lt:  #ffd280;
    --gold-dk:  #c47d0e;
    --bg:       #07090f;
    --card:     #101624;
    --card2:    #141c2c;
    --rim:      rgba(255,255,255,.06);
    --rim-gold: rgba(245,166,35,.20);
    --txt:      #dde1ec;
    --txt2:     #6b7591;
    --teal:     #00d2a8;
    --blue:     #1a6cff;
    --red:      #ef4444;
}

@keyframes shimmer { 0%{background-position:-220% center}100%{background-position:220% center} }
@keyframes fadeUp  { from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)} }
@keyframes glow    { 0%,100%{opacity:.5}50%{opacity:1} }
@keyframes pulse-r { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.4)}65%{box-shadow:0 0 0 9px transparent} }

.au { animation: fadeUp .6s cubic-bezier(.22,.6,.36,1) both; }
.d1 { animation-delay:.07s; } .d2 { animation-delay:.14s; }

/* ── PAGE WRAP ── */
.index-wrap { max-width: 1200px; margin: 0 auto; }

/* ── PAGE HERO ── */
.page-hero {
    position: relative; overflow: hidden;
    border-radius: 18px; margin-bottom: 28px;
    min-height: 140px; display: flex; align-items: center;
    padding: 32px 40px; border: 1px solid var(--rim);
}
.page-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background:
        linear-gradient(110deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.80) 55%, rgba(7,9,15,.94) 100%),
        url('https://images.unsplash.com/photo-1512909006721-3d6018887383?w=1400&q=75&auto=format&fit=crop')
        center / cover no-repeat;
}
.page-hero-bg::after {
    content:''; position:absolute; inset:0;
    background-image:
        linear-gradient(rgba(245,166,35,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(245,166,35,.035) 1px, transparent 1px);
    background-size: 50px 50px;
}
.hero-orb {
    position: absolute; border-radius: 50%; filter: blur(80px);
    pointer-events: none; z-index: 1;
}
.hero-orb-1 { width:350px;height:350px; background:rgba(26,108,255,.10); top:-80px; right:-40px; }
.hero-orb-2 { width:200px;height:200px; background:rgba(245,166,35,.07); bottom:-40px; left:30%; }
.page-hero-content { position: relative; z-index: 2; flex: 1; }
.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 8px;
    border: 1px solid rgba(245,166,35,.28); background: rgba(245,166,35,.07);
    color: var(--gold-lt); padding: 4px 14px; border-radius: 100px;
    font-size: 10px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase;
    margin-bottom: 12px;
}
.hero-eyebrow .dot { width:7px;height:7px;border-radius:50%;background:var(--gold);display:inline-block;animation:pulse-r 2s infinite; }
.page-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.6rem, 2.8vw, 2.2rem); font-weight: 900;
    color: var(--txt); line-height: 1.1; letter-spacing: -.4px;
}
.page-title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800);
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3.5s linear infinite;
}
.page-sub { color: rgba(221,225,236,.45); font-size: .875rem; font-weight: 300; margin-top: 6px; }

/* hero right — stats strip */
.hero-stats { display: flex; gap: 28px; flex-shrink: 0; margin-left: 40px; }
.hero-stat { text-align: center; }
.hero-stat-num {
    font-family: 'Playfair Display', serif; font-size: 1.8rem; font-weight: 900; line-height: 1;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3.5s linear infinite;
}
.hero-stat-lbl { font-size: .68rem; color: var(--txt2); text-transform: uppercase; letter-spacing: .8px; font-weight: 600; margin-top: 3px; }

/* ── TOOLBAR ── */
.toolbar {
    display: flex; align-items: center; justify-content: space-between; gap: 14px;
    margin-bottom: 20px; flex-wrap: wrap;
}
.toolbar-left  { display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }
.toolbar-right { display: flex; align-items: center; gap: 10px; }

/* search */
.search-box {
    display: flex; align-items: center;
    background: var(--card); border: 1px solid var(--rim);
    border-radius: 10px; overflow: hidden;
    transition: border-color .3s, box-shadow .3s;
}
.search-box:focus-within { border-color: var(--rim-gold); box-shadow: 0 0 0 3px rgba(245,166,35,.07); }
.search-box input {
    background: transparent; border: none; outline: none;
    padding: 10px 14px; color: var(--txt);
    font-family: 'Outfit', sans-serif; font-size: .875rem; width: 220px;
}
.search-box input::placeholder { color: var(--txt2); }
.search-box button {
    padding: 0 14px; height: 100%; background: rgba(245,166,35,.10);
    border: none; border-left: 1px solid var(--rim);
    color: var(--gold); font-size: 13px; cursor: pointer; transition: background .3s;
}
.search-box button:hover { background: rgba(245,166,35,.20); }

/* filter select */
.filter-select {
    background: var(--card); border: 1px solid var(--rim);
    border-radius: 10px; padding: 10px 14px;
    color: var(--txt2); font-family: 'Outfit', sans-serif; font-size: .875rem;
    outline: none; cursor: pointer; transition: border-color .3s;
}
.filter-select:focus { border-color: var(--rim-gold); }
.filter-select option { background: var(--card2); }

/* new product btn */
.btn-new {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 10px 22px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
    background-size: 200% auto; animation: shimmer 3s linear infinite;
    color: #07090f; font-family: 'Outfit', sans-serif;
    font-size: .875rem; font-weight: 800;
    border: none; cursor: pointer; text-decoration: none;
    transition: all .3s; box-shadow: 0 4px 18px rgba(245,166,35,.25);
    position: relative; overflow: hidden;
}
.btn-new::before {
    content:''; position:absolute; inset:0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.22), transparent);
    transform: translateX(-100%); transition: transform .6s;
}
.btn-new:hover { transform: translateY(-2px); box-shadow: 0 8px 26px rgba(245,166,35,.38); }
.btn-new:hover::before { transform: translateX(100%); }

/* ── TABLE CARD ── */
.table-card {
    background: var(--card);
    border: 1px solid var(--rim);
    border-radius: 18px; overflow: hidden;
    transition: border-color .3s;
}
.table-card:hover { border-color: var(--rim-gold); }

.table-card-accent {
    height: 2px;
    background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
    background-size: 300% auto; animation: shimmer 3s linear infinite;
}

/* ── TABLE ── */
.prod-table { width: 100%; border-collapse: collapse; }

.prod-table thead tr {
    border-bottom: 1px solid var(--rim);
    background: rgba(255,255,255,.02);
}
.prod-table th {
    padding: 14px 18px; text-align: left;
    font-size: .68rem; font-weight: 700;
    letter-spacing: 1.2px; text-transform: uppercase;
    color: var(--txt2); white-space: nowrap;
}
.prod-table th i { color: var(--gold); margin-right: 6px; font-size: 10px; }

.prod-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.04);
    transition: background .2s;
}
.prod-table tbody tr:last-child { border-bottom: none; }
.prod-table tbody tr:hover { background: rgba(245,166,35,.04); }

.prod-table td { padding: 14px 18px; vertical-align: middle; }

/* product image cell */
.prod-img {
    width: 56px; height: 56px; border-radius: 10px; overflow: hidden;
    border: 1px solid var(--rim); flex-shrink: 0;
    background: var(--card2);
}
.prod-img img { width: 100%; height: 100%; object-fit: cover; }
.prod-img .no-img {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: rgba(245,166,35,.18); font-size: 20px;
}

/* product name */
.prod-name { font-size: .875rem; font-weight: 600; color: var(--txt); }
.prod-sku  { font-size: .7rem; color: var(--txt2); margin-top: 2px; font-family: monospace; }

/* category badge */
.cat-badge {
    display: inline-flex; align-items: center; gap: 5px;
    background: rgba(26,108,255,.10); border: 1px solid rgba(26,108,255,.20);
    color: #6ca3ff; font-size: .7rem; font-weight: 700;
    padding: 3px 10px; border-radius: 20px; letter-spacing: .3px;
    white-space: nowrap;
}

/* price */
.prod-price {
    font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 800;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 4s linear infinite; white-space: nowrap;
}

/* stock indicator */
.stock-wrap { display: flex; align-items: center; gap: 8px; }
.stock-bar  {
    width: 50px; height: 4px; border-radius: 4px;
    background: rgba(255,255,255,.08); overflow: hidden;
}
.stock-fill { height: 100%; border-radius: 4px; transition: width .3s; }
.stock-num  { font-size: .82rem; font-weight: 600; }
.stock-ok   .stock-fill { background: var(--teal); }
.stock-ok   .stock-num  { color: var(--teal); }
.stock-low  .stock-fill { background: var(--gold); }
.stock-low  .stock-num  { color: var(--gold); }
.stock-out  .stock-fill { background: var(--red); }
.stock-out  .stock-num  { color: #f87171; }

/* status badge */
.status-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .7rem; font-weight: 700; padding: 4px 11px;
    border-radius: 20px; letter-spacing: .4px; text-transform: uppercase;
}
.status-badge .sdot { width: 6px; height: 6px; border-radius: 50%; animation: glow 2s infinite; }
.status-active   { background: rgba(0,210,168,.12); border: 1px solid rgba(0,210,168,.25); color: var(--teal); }
.status-active   .sdot { background: var(--teal); }
.status-inactive { background: rgba(239,68,68,.10);  border: 1px solid rgba(239,68,68,.22);  color: #f87171; }
.status-inactive .sdot { background: var(--red); animation-delay: .5s; }

/* action buttons */
.action-cell { display: flex; align-items: center; gap: 7px; }
.act-btn {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; cursor: pointer; transition: all .25s;
    text-decoration: none; border: none;
}
.act-edit {
    background: rgba(26,108,255,.10); border: 1px solid rgba(26,108,255,.20);
    color: #6ca3ff;
}
.act-edit:hover { background: rgba(26,108,255,.22); transform: scale(1.1); color: #5a9aff; }
.act-del {
    background: rgba(239,68,68,.10); border: 1px solid rgba(239,68,68,.20);
    color: #f87171;
}
.act-del:hover { background: rgba(239,68,68,.22); transform: scale(1.1); }

/* ── EMPTY STATE ── */
.empty-state {
    text-align: center; padding: 64px 24px;
}
.empty-icon {
    width: 72px; height: 72px; border-radius: 18px; margin: 0 auto 20px;
    background: rgba(245,166,35,.08); border: 1px solid rgba(245,166,35,.16);
    display: flex; align-items: center; justify-content: center;
    font-size: 28px; color: rgba(245,166,35,.35);
}
.empty-title { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 700; color: var(--txt); margin-bottom: 8px; }
.empty-sub   { color: var(--txt2); font-size: .875rem; font-weight: 300; }

/* ── PAGINATION ── */
.pagination-wrap {
    padding: 16px 22px;
    border-top: 1px solid var(--rim);
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 10px;
}
.pagination-info { font-size: .78rem; color: var(--txt2); }

/* override Laravel pagination links */
.pagination-wrap nav { display: flex; align-items: center; }
.pagination-wrap .pagination { display: flex; gap: 4px; list-style: none; }
.pagination-wrap .pagination li a,
.pagination-wrap .pagination li span {
    display: flex; align-items: center; justify-content: center;
    width: 34px; height: 34px; border-radius: 8px;
    font-size: .8rem; font-weight: 600; text-decoration: none;
    background: rgba(255,255,255,.04); border: 1px solid var(--rim);
    color: var(--txt2); transition: all .25s;
}
.pagination-wrap .pagination li a:hover {
    background: rgba(245,166,35,.10); border-color: var(--rim-gold); color: var(--gold-lt);
}
.pagination-wrap .pagination li.active span,
.pagination-wrap .pagination li span[aria-current="page"] {
    background: linear-gradient(135deg, var(--gold-dk), var(--gold));
    border-color: transparent; color: #07090f;
    box-shadow: 0 4px 12px rgba(245,166,35,.30);
}
.pagination-wrap .pagination li span.disabled { opacity: .3; cursor: not-allowed; }

/* ── RESPONSIVE ── */
@media(max-width:900px) {
    .hero-stats { display: none; }
    .page-hero  { padding: 24px 22px; }
    .search-box input { width: 160px; }
}
@media(max-width:640px) {
    .toolbar { flex-direction: column; align-items: stretch; }
    .toolbar-left, .toolbar-right { width: 100%; justify-content: space-between; }
    /* hide some table cols on mobile */
    .col-cat, .col-supplier { display: none; }
}
</style>
@endpush

@section('content')
<div class="index-wrap">

    <!-- ── HERO ── -->
    <div class="page-hero au">
        <div class="page-hero-bg"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="page-hero-content">
            <div class="hero-eyebrow"><span class="dot"></span> Admin · Catalogue</div>
            <h1 class="page-title">Gestion des <em>produits</em></h1>
            <p class="page-sub">Gérez l'ensemble de votre catalogue — ajout, modification, suppression.</p>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">{{ $products->total() }}</div>
                <div class="hero-stat-lbl">Total</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num" style="color:var(--teal);-webkit-text-fill-color:var(--teal);">
                    {{ $products->where('is_active', true)->count() }}
                </div>
                <div class="hero-stat-lbl">Actifs</div>
            </div>
        </div>
    </div>

    <!-- ── TOOLBAR ── -->
    <div class="toolbar au d1">
        <div class="toolbar-left">
            {{-- Search --}}
            <form method="GET" action="{{ route('admin.products.index') }}" class="search-box">
                <input type="text" name="search" placeholder="Rechercher…" value="{{ request('search') }}">
                <button type="submit"><i class="fas fa-search"></i></button>
            </form>
            {{-- Category filter --}}
            <form method="GET" action="{{ route('admin.products.index') }}">
                <select name="category" class="filter-select" onchange="this.form.submit()">
                    <option value="">Toutes catégories</option>
                    @foreach(\App\Models\Category::all() as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
        <div class="toolbar-right">
            <a href="{{ route('admin.products.create') }}" class="btn-new">
                <i class="fas fa-plus" style="font-size:12px;"></i> Nouveau produit
            </a>
        </div>
    </div>

    <!-- ── TABLE CARD ── -->
    <div class="table-card au d2">
        <div class="table-card-accent"></div>

        <div style="overflow-x:auto;">
            <table class="prod-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-image"></i>Image</th>
                        <th><i class="fas fa-box"></i>Produit</th>
                        <th class="col-cat"><i class="fas fa-folder"></i>Catégorie</th>
                        <th><i class="fas fa-coins"></i>Prix</th>
                        <th><i class="fas fa-warehouse"></i>Stock</th>
                        <th><i class="fas fa-toggle-on"></i>Statut</th>
                        <th><i class="fas fa-cog"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        {{-- Image --}}
                        <td>
                            <div class="prod-img">
                                @if($product->images && count($product->images) > 0)
                                    <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                                @else
                                    <div class="no-img"><i class="fas fa-image"></i></div>
                                @endif
                            </div>
                        </td>

                        {{-- Nom + SKU --}}
                        <td>
                            <div class="prod-name">{{ $product->name }}</div>
                            @if($product->sku)
                                <div class="prod-sku">{{ $product->sku }}</div>
                            @endif
                        </td>

                        {{-- Catégorie --}}
                        <td class="col-cat">
                            <span class="cat-badge">
                                <i class="fas fa-tag" style="font-size:9px;"></i>
                                {{ $product->category->name }}
                            </span>
                        </td>

                        {{-- Prix --}}
                        <td>
                            <span class="prod-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</span>
                        </td>

                        {{-- Stock --}}
                        <td>
                            @php
                                $qty     = $product->quantity;
                                $cls     = $qty == 0 ? 'stock-out' : ($qty < 10 ? 'stock-low' : 'stock-ok');
                                $maxBar  = 100;
                                $barPct  = min(100, ($qty / max(1,$maxBar)) * 100);
                            @endphp
                            <div class="stock-wrap {{ $cls }}">
                                <div class="stock-bar">
                                    <div class="stock-fill" style="width:{{ $barPct }}%;"></div>
                                </div>
                                <span class="stock-num">{{ $qty }}</span>
                            </div>
                        </td>

                        {{-- Statut --}}
                        <td>
                            @if($product->is_active)
                                <span class="status-badge status-active">
                                    <span class="sdot"></span> Actif
                                </span>
                            @else
                                <span class="status-badge status-inactive">
                                    <span class="sdot"></span> Inactif
                                </span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.products.edit', $product) }}" class="act-btn act-edit" title="Modifier">
                                    <i class="fas fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                                      onsubmit="return confirm('Supprimer ce produit définitivement ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="act-btn act-del" title="Supprimer">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-box-open"></i></div>
                                <div class="empty-title">Aucun produit trouvé</div>
                                <p class="empty-sub">Commencez par ajouter votre premier produit au catalogue.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($products->hasPages())
        <div class="pagination-wrap">
            <span class="pagination-info">
                Affichage {{ $products->firstItem() }}–{{ $products->lastItem() }} sur {{ $products->total() }} produits
            </span>
            {{ $products->links() }}
        </div>
        @endif

    </div>

</div>
@endsection