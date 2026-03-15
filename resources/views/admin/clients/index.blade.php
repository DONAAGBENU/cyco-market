@extends('layouts.app')

@section('title', 'Gestion des clients — CYCO MARKET')

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
    --purple:   #7c3aed;
}

@keyframes shimmer { 0%{background-position:-220% center}100%{background-position:220% center} }
@keyframes fadeUp  { from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)} }
@keyframes glow    { 0%,100%{opacity:.5}50%{opacity:1} }
@keyframes pulse-r { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.4)}65%{box-shadow:0 0 0 9px transparent} }
@keyframes drift   { 0%,100%{transform:translate(0,0)}40%{transform:translate(16px,-12px)}70%{transform:translate(-10px,8px)} }

.au { animation: fadeUp .6s cubic-bezier(.22,.6,.36,1) both; }
.d1 { animation-delay:.07s; } .d2 { animation-delay:.14s; } .d3 { animation-delay:.21s; }

/* ── PAGE WRAP ── */
.clients-wrap { max-width: 1200px; margin: 0 auto; }

/* ── PAGE HERO ── */
.page-hero {
    position: relative; overflow: hidden;
    border-radius: 18px; margin-bottom: 28px;
    min-height: 150px; display: flex; align-items: center;
    padding: 32px 40px; border: 1px solid var(--rim);
}
.page-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background:
        linear-gradient(110deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.78) 55%, rgba(7,9,15,.94) 100%),
        url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=1400&q=75&auto=format&fit=crop')
        center / cover no-repeat;
}
.page-hero-bg::after {
    content:''; position:absolute; inset:0;
    background-image:
        linear-gradient(rgba(245,166,35,.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(245,166,35,.03) 1px, transparent 1px);
    background-size: 50px 50px;
}
.hero-orb {
    position: absolute; border-radius: 50%; filter: blur(80px);
    pointer-events: none; z-index: 1;
}
.hero-orb-1 { width:340px;height:340px; background:rgba(26,108,255,.10); top:-70px; right:-30px; animation:drift 14s ease-in-out infinite; }
.hero-orb-2 { width:200px;height:200px; background:rgba(245,166,35,.07); bottom:-40px; left:30%; animation:drift 18s ease-in-out infinite reverse; }
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
    font-size: clamp(1.6rem,2.8vw,2.2rem); font-weight: 900;
    color: var(--txt); line-height: 1.1; letter-spacing: -.4px;
}
.page-title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800);
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3.5s linear infinite;
}
.page-sub { color: rgba(221,225,236,.42); font-size: .85rem; font-weight: 300; margin-top: 6px; }

/* hero right stats */
.hero-stats { display: flex; gap: 32px; flex-shrink: 0; margin-left: 40px; }
.hero-stat   { text-align: center; }
.hero-stat-num {
    font-family: 'Playfair Display', serif; font-size: 2rem; font-weight: 900; line-height: 1;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3.5s linear infinite;
}
.hero-stat-lbl { font-size: .65rem; color: var(--txt2); text-transform: uppercase; letter-spacing: .8px; font-weight: 600; margin-top: 3px; }

/* ── STAT MINI CARDS ── */
.stat-strip {
    display: grid; grid-template-columns: repeat(3,1fr); gap: 16px;
    margin-bottom: 24px;
}
.stat-mini {
    position: relative; overflow: hidden;
    background: var(--card); border: 1px solid var(--rim);
    border-radius: 14px; padding: 20px 20px 16px;
    transition: all .35s;
}
.stat-mini:hover { transform: translateY(-4px); border-color: var(--rim-gold); box-shadow: 0 16px 36px rgba(0,0,0,.4); }
.stat-mini::before {
    content:''; position:absolute; inset:0;
    background-size:cover; background-position:center; opacity:.06; transition:opacity .35s;
}
.stat-mini:hover::before { opacity:.11; }
.stat-mini:nth-child(1)::before { background-image:url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=400&q=60&auto=format&fit=crop'); }
.stat-mini:nth-child(2)::before { background-image:url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=400&q=60&auto=format&fit=crop'); }
.stat-mini:nth-child(3)::before { background-image:url('https://images.unsplash.com/photo-1523050854058-8df90110c9f1?w=400&q=60&auto=format&fit=crop'); }

.stat-mini-top { display: flex; align-items: flex-start; justify-content: space-between; position: relative; z-index: 1; margin-bottom: 12px; }
.stat-mini-lbl { font-size: .68rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; margin-bottom: 8px; display: block; }
.stat-mini-lbl.blue   { color: rgba(108,163,255,.8); }
.stat-mini-lbl.teal   { color: rgba(0,210,168,.8); }
.stat-mini-lbl.purple { color: rgba(167,139,250,.8); }
.stat-mini-val {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem; font-weight: 900; line-height: 1; color: var(--txt);
}
.stat-mini-icon {
    width: 42px; height: 42px; border-radius: 11px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 18px;
    position: relative; z-index: 1;
}
.stat-mini-icon.blue   { background: rgba(26,108,255,.16);  color: #6ca3ff; }
.stat-mini-icon.teal   { background: rgba(0,210,168,.16);   color: var(--teal); }
.stat-mini-icon.purple { background: rgba(124,58,237,.16);  color: #a78bfa; }

/* ── TOOLBAR ── */
.toolbar {
    display: flex; align-items: center; justify-content: space-between; gap: 12px;
    margin-bottom: 20px; flex-wrap: wrap;
}
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
    padding: 0 14px; height: 100%;
    background: rgba(245,166,35,.10); border: none; border-left: 1px solid var(--rim);
    color: var(--gold); font-size: 13px; cursor: pointer; transition: background .3s;
}
.search-box button:hover { background: rgba(245,166,35,.20); }

.total-badge {
    display: inline-flex; align-items: center; gap: 7px;
    background: rgba(245,166,35,.08); border: 1px solid rgba(245,166,35,.18);
    color: var(--gold-lt); padding: 8px 14px; border-radius: 10px;
    font-size: .8rem; font-weight: 600;
}
.total-badge strong {
    font-family: 'Playfair Display', serif; font-size: 1rem; font-weight: 900;
    color: var(--gold);
}

/* ── TABLE CARD ── */
.table-card {
    background: var(--card); border: 1px solid var(--rim);
    border-radius: 18px; overflow: hidden; transition: border-color .3s;
}
.table-card:hover { border-color: var(--rim-gold); }
.table-card-accent {
    height: 2px;
    background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
    background-size: 300% auto; animation: shimmer 3s linear infinite;
}

/* ── TABLE ── */
.clients-table { width: 100%; border-collapse: collapse; }

.clients-table thead tr {
    border-bottom: 1px solid var(--rim);
    background: rgba(255,255,255,.02);
}
.clients-table th {
    padding: 14px 18px; text-align: left;
    font-size: .68rem; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; color: var(--txt2); white-space: nowrap;
}
.clients-table th i { color: var(--gold); margin-right: 6px; font-size: 10px; }

.clients-table tbody tr {
    border-bottom: 1px solid rgba(255,255,255,.04);
    transition: background .2s;
}
.clients-table tbody tr:last-child { border-bottom: none; }
.clients-table tbody tr:hover { background: rgba(245,166,35,.04); }
.clients-table td { padding: 14px 18px; vertical-align: middle; }

/* id cell */
.id-cell { font-family: monospace; font-size: .78rem; color: rgba(245,166,35,.55); font-weight: 700; }

/* client avatar + info */
.client-cell { display: flex; align-items: center; gap: 12px; }
.cli-avatar {
    width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 800;
    color: #07090f; transition: transform .3s;
}
tr:hover .cli-avatar { transform: scale(1.08); }
.cli-name  { font-size: .875rem; font-weight: 600; color: var(--txt); }
.cli-email { font-size: .72rem; color: var(--txt2); margin-top: 2px; }

/* contact cell */
.cli-phone   { font-size: .82rem; color: var(--txt); font-weight: 500; }
.cli-address { font-size: .72rem; color: var(--txt2); margin-top: 2px; max-width: 180px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }

/* orders badge */
.orders-badge {
    display: inline-flex; align-items: center; gap: 6px;
    font-size: .72rem; font-weight: 700; padding: 4px 11px;
    border-radius: 20px; letter-spacing: .3px; white-space: nowrap;
}
.orders-badge.has-orders   { background: rgba(26,108,255,.12); border: 1px solid rgba(26,108,255,.22); color: #6ca3ff; }
.orders-badge.no-orders    { background: rgba(255,255,255,.04); border: 1px solid var(--rim); color: var(--txt2); }

/* date cell */
.date-main { font-size: .82rem; color: var(--txt); font-weight: 500; }
.date-rel   { font-size: .7rem; color: var(--txt2); margin-top: 2px; }

/* actions */
.action-cell { display: flex; align-items: center; gap: 7px; }
.act-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 7px 13px; border-radius: 8px; font-size: .78rem; font-weight: 600;
    cursor: pointer; transition: all .25s; text-decoration: none; border: none;
    font-family: 'Outfit', sans-serif; white-space: nowrap;
}
.act-view {
    background: rgba(26,108,255,.10); border: 1px solid rgba(26,108,255,.20); color: #6ca3ff;
}
.act-view:hover { background: rgba(26,108,255,.22); transform: translateY(-1px); }
.act-ban {
    background: rgba(239,68,68,.10); border: 1px solid rgba(239,68,68,.20); color: #f87171;
}
.act-ban:hover { background: rgba(239,68,68,.22); transform: translateY(-1px); }

/* ── EMPTY ── */
.empty-state { text-align: center; padding: 60px 24px; }
.empty-icon {
    width: 68px; height: 68px; border-radius: 16px; margin: 0 auto 18px;
    background: rgba(245,166,35,.07); border: 1px solid rgba(245,166,35,.14);
    display: flex; align-items: center; justify-content: center;
    font-size: 26px; color: rgba(245,166,35,.28);
}
.empty-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: var(--txt); margin-bottom: 6px; }
.empty-sub   { color: var(--txt2); font-size: .85rem; font-weight: 300; }

/* ── PAGINATION ── */
.pagination-wrap {
    padding: 16px 22px; border-top: 1px solid var(--rim);
    display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 10px;
}
.pagination-info { font-size: .78rem; color: var(--txt2); }
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

/* ── RESPONSIVE ── */
@media(max-width:900px) {
    .hero-stats  { display: none; }
    .stat-strip  { grid-template-columns: 1fr 1fr; }
    .page-hero   { padding: 24px 22px; }
    .col-address { display: none; }
}
@media(max-width:640px) {
    .stat-strip { grid-template-columns: 1fr; }
    .toolbar    { flex-direction: column; align-items: stretch; }
}
</style>
@endpush

@section('content')
<div class="clients-wrap">

    <!-- ── HERO ── -->
    <div class="page-hero au">
        <div class="page-hero-bg"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="page-hero-content">
            <div class="hero-eyebrow"><span class="dot"></span> Admin · Utilisateurs</div>
            <h1 class="page-title">Gestion des <em>clients</em></h1>
            <p class="page-sub">Consultez, suivez et gérez l'ensemble de votre base clients.</p>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-num">{{ $clients->total() }}</div>
                <div class="hero-stat-lbl">Total clients</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-num" style="color:var(--teal);-webkit-text-fill-color:var(--teal);">
                    {{ $clients->where('orders_count', '>', 0)->count() }}
                </div>
                <div class="hero-stat-lbl">Actifs</div>
            </div>
        </div>
    </div>

    <!-- ── STAT STRIP ── -->
    <div class="stat-strip au d1">

        <div class="stat-mini">
            <div class="stat-mini-top">
                <div>
                    <span class="stat-mini-lbl blue">Clients actifs</span>
                    <div class="stat-mini-val">{{ $clients->total() }}</div>
                </div>
                <div class="stat-mini-icon blue"><i class="fas fa-users"></i></div>
            </div>
        </div>

        <div class="stat-mini">
            <div class="stat-mini-top">
                <div>
                    <span class="stat-mini-lbl teal">Avec commandes</span>
                    <div class="stat-mini-val">{{ $clients->where('orders_count', '>', 0)->count() }}</div>
                </div>
                <div class="stat-mini-icon teal"><i class="fas fa-shopping-bag"></i></div>
            </div>
        </div>

        <div class="stat-mini">
            <div class="stat-mini-top">
                <div>
                    <span class="stat-mini-lbl purple">Nouveaux (30j)</span>
                    <div class="stat-mini-val">{{ $clients->where('created_at', '>=', now()->subDays(30))->count() }}</div>
                </div>
                <div class="stat-mini-icon purple"><i class="fas fa-user-plus"></i></div>
            </div>
        </div>

    </div>

    <!-- ── TOOLBAR ── -->
    <div class="toolbar au d2">
        <form method="GET" action="{{ route('admin.users.index') }}" class="search-box">
            <input type="text" name="search" placeholder="Rechercher un client…" value="{{ request('search') }}">
            <button type="submit"><i class="fas fa-search"></i></button>
        </form>
        <div class="total-badge">
            <i class="fas fa-users" style="font-size:12px;"></i>
            <strong>{{ $clients->total() }}</strong> client{{ $clients->total() > 1 ? 's' : '' }} au total
        </div>
    </div>

    <!-- ── TABLE CARD ── -->
    <div class="table-card au d3">
        <div class="table-card-accent"></div>

        <div style="overflow-x:auto;">
            <table class="clients-table">
                <thead>
                    <tr>
                        <th><i class="fas fa-hashtag"></i>ID</th>
                        <th><i class="fas fa-user"></i>Client</th>
                        <th><i class="fas fa-address-card"></i>Contact</th>
                        <th><i class="fas fa-shopping-bag"></i>Commandes</th>
                        <th><i class="fas fa-calendar-alt"></i>Inscription</th>
                        <th><i class="fas fa-cog"></i>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr>

                        {{-- ID --}}
                        <td><span class="id-cell">#{{ $client->id }}</span></td>

                        {{-- Client --}}
                        <td>
                            <div class="client-cell">
                                <div class="cli-avatar" style="background:linear-gradient(135deg,
                                    {{ ['#1a4fff','#7c3aed','#0f766e','#c47d0e','#b45309'][($client->id % 5)] }},
                                    {{ ['#6ca3ff','#a78bfa','#00d2a8','#f5a623','#fbbf24'][($client->id % 5)] }});">
                                    {{ strtoupper(substr($client->name, 0, 1)) }}
                                </div>
                                <div>
                                    <div class="cli-name">{{ $client->name }}</div>
                                    <div class="cli-email">{{ $client->email }}</div>
                                </div>
                            </div>
                        </td>

                        {{-- Contact --}}
                        <td>
                            <div class="cli-phone">
                                @if($client->phone)
                                    <i class="fas fa-phone" style="color:var(--gold);font-size:10px;margin-right:5px;"></i>{{ $client->phone }}
                                @else
                                    <span style="color:var(--txt2);font-size:.78rem;">Non renseigné</span>
                                @endif
                            </div>
                            <div class="cli-address col-address">
                                <i class="fas fa-map-marker-alt" style="color:var(--txt2);font-size:9px;margin-right:4px;"></i>
                                {{ $client->address ?? 'Adresse non spécifiée' }}
                            </div>
                        </td>

                        {{-- Commandes --}}
                        <td>
                            <span class="orders-badge {{ $client->orders_count > 0 ? 'has-orders' : 'no-orders' }}">
                                <i class="fas fa-{{ $client->orders_count > 0 ? 'shopping-bag' : 'minus' }}" style="font-size:9px;"></i>
                                {{ $client->orders_count }} commande{{ $client->orders_count > 1 ? 's' : '' }}
                            </span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <div class="date-main">{{ $client->created_at->format('d/m/Y') }}</div>
                            <div class="date-rel">{{ $client->created_at->diffForHumans() }}</div>
                        </td>

                        {{-- Actions --}}
                        <td>
                            <div class="action-cell">
                                <a href="{{ route('admin.users.show', $client->id) }}" class="act-btn act-view">
                                    <i class="fas fa-eye" style="font-size:11px;"></i> Voir
                                </a>
                                <form action="{{ route('admin.clients.ban', $client->id) }}" method="POST"
                                      onsubmit="return confirm('Êtes-vous sûr de vouloir bannir ce client ? Cette action est irréversible.')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="act-btn act-ban">
                                        <i class="fas fa-ban" style="font-size:11px;"></i> Bannir
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon"><i class="fas fa-users"></i></div>
                                <div class="empty-title">Aucun client trouvé</div>
                                <p class="empty-sub">Votre base clients est vide pour le moment.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($clients->hasPages())
        <div class="pagination-wrap">
            <span class="pagination-info">
                Affichage {{ $clients->firstItem() }}–{{ $clients->lastItem() }} sur {{ $clients->total() }} clients
            </span>
            {{ $clients->links() }}
        </div>
        @endif

    </div>

</div>
@endsection