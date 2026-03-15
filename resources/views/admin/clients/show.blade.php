@extends('layouts.app')

@section('title', 'Détails client — CYCO MARKET')

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
@keyframes rotate  { to{transform:rotate(360deg)} }

.au { animation: fadeUp .6s cubic-bezier(.22,.6,.36,1) both; }
.d1 { animation-delay:.07s; } .d2 { animation-delay:.14s; } .d3 { animation-delay:.21s; }

/* ── PAGE WRAP ── */
.client-wrap { max-width: 1100px; margin: 0 auto; }

/* ── PAGE HERO ── */
.page-hero {
    position: relative; overflow: hidden;
    border-radius: 18px; margin-bottom: 28px;
    padding: 32px 40px; border: 1px solid var(--rim);
    display: flex; align-items: center; gap: 28px;
    min-height: 140px;
}
.page-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background:
        linear-gradient(110deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.78) 55%, rgba(7,9,15,.94) 100%),
        url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=1400&q=75&auto=format&fit=crop')
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
.hero-orb-1 { width:320px;height:320px; background:rgba(26,108,255,.10); top:-70px; right:-30px; animation:drift 14s ease-in-out infinite; }
.hero-orb-2 { width:200px;height:200px; background:rgba(245,166,35,.07); bottom:-40px; left:25%; animation:drift 18s ease-in-out infinite reverse; }

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
    font-size: clamp(1.5rem, 2.5vw, 2.1rem); font-weight: 900;
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

/* back btn in hero */
.btn-back {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 8px 16px; border-radius: 9px;
    background: rgba(255,255,255,.04); border: 1px solid var(--rim);
    color: var(--txt2); font-size: .8rem; font-weight: 500;
    text-decoration: none; transition: all .3s;
    position: relative; z-index: 2; margin-bottom: 14px; display: inline-flex;
}
.btn-back:hover { background: rgba(255,255,255,.08); color: var(--txt); border-color: rgba(255,255,255,.14); }

/* ── LAYOUT GRID ── */
.client-grid {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: 22px;
    align-items: start;
}

/* ── PANEL (shared card) ── */
.panel {
    background: var(--card);
    border: 1px solid var(--rim);
    border-radius: 18px; overflow: hidden;
    transition: border-color .3s;
}
.panel:hover { border-color: var(--rim-gold); }
.panel-accent {
    height: 2px;
    background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
    background-size: 300% auto; animation: shimmer 3s linear infinite;
}
.panel-head {
    display: flex; align-items: center; gap: 12px;
    padding: 20px 24px 16px; border-bottom: 1px solid var(--rim);
}
.panel-head-icon {
    width: 36px; height: 36px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; background: rgba(245,166,35,.10); color: var(--gold);
}
.panel-head-title {
    font-family: 'Playfair Display', serif;
    font-size: .95rem; font-weight: 800; color: var(--txt);
}
.panel-head-sub { font-size: .7rem; color: var(--txt2); margin-top: 1px; }

/* ── CLIENT PROFILE CARD ── */
.profile-body { padding: 28px 24px; }

/* avatar ring */
.avatar-wrap {
    display: flex; flex-direction: column; align-items: center;
    margin-bottom: 24px;
}
.avatar-ring {
    width: 88px; height: 88px; border-radius: 50%;
    padding: 3px;
    background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
    background-size: 200% auto; animation: shimmer 4s linear infinite;
    margin-bottom: 14px;
}
.avatar-inner {
    width: 100%; height: 100%; border-radius: 50%;
    background: linear-gradient(135deg, #1a4fff, #7c3aed);
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif;
    font-size: 2rem; font-weight: 900; color: white;
}
.client-name { font-family: 'Playfair Display', serif; font-size: 1.2rem; font-weight: 800; color: var(--txt); text-align: center; }
.client-since { font-size: .75rem; color: var(--txt2); text-align: center; margin-top: 4px; }

/* info rows */
.info-rows { display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px; }
.info-row {
    display: flex; align-items: flex-start; gap: 12px;
    padding: 13px 16px; border-radius: 11px;
    background: rgba(255,255,255,.03); border: 1px solid var(--rim);
    transition: all .3s;
}
.info-row:hover { border-color: var(--rim-gold); background: rgba(245,166,35,.04); }
.info-icon {
    width: 34px; height: 34px; border-radius: 9px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; background: rgba(245,166,35,.10); color: var(--gold);
}
 .info-label { font-size: .68rem; text-transform: uppercase; letter-spacing: .7px; font-weight: 700; color: #a0aec0 !important; margin-bottom: 3px; }
.info-value { font-size: .875rem; font-weight: 600; color: #e2e8f0 !important; line-height: 1.45; }

/* stats mini row */
.mini-stats {
    display: grid; grid-template-columns: 1fr 1fr; gap: 10px;
    margin-bottom: 22px;
}
.mini-stat {
    padding: 14px 12px; border-radius: 11px; text-align: center;
    background: rgba(255,255,255,.03); border: 1px solid var(--rim);
    transition: all .3s;
}
.mini-stat:hover { border-color: var(--rim-gold); }
.mini-stat-num {
    font-family: 'Playfair Display', serif; font-size: 1.4rem; font-weight: 900;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 4s linear infinite; line-height: 1; margin-bottom: 4px;
}
.mini-stat-lbl { font-size: .65rem; color: var(--txt2); text-transform: uppercase; letter-spacing: .7px; font-weight: 700; }

/* ban button */
.btn-ban {
    width: 100%; padding: 13px; border-radius: 11px;
    background: rgba(239,68,68,.10); border: 1px solid rgba(239,68,68,.22);
    color: #f87171; font-family: 'Outfit', sans-serif;
    font-size: .875rem; font-weight: 700; cursor: pointer;
    display: flex; align-items: center; justify-content: center; gap: 9px;
    transition: all .3s; letter-spacing: .3px;
}
.btn-ban:hover {
    background: rgba(239,68,68,.20); border-color: rgba(239,68,68,.45);
    box-shadow: 0 6px 20px rgba(239,68,68,.18);
    transform: translateY(-1px);
}

/* ── ORDERS PANEL ── */
.orders-body { padding: 20px 24px; }

/* order card */
.order-card {
    background: rgba(255,255,255,.028);
    border: 1px solid var(--rim);
    border-radius: 14px; padding: 18px 20px;
    margin-bottom: 12px; transition: all .3s;
}
.order-card:last-child { margin-bottom: 0; }
.order-card:hover { border-color: var(--rim-gold); background: rgba(245,166,35,.04); }

.order-top {
    display: flex; align-items: flex-start; justify-content: space-between;
    margin-bottom: 14px;
}
.order-num {
    font-family: monospace; font-size: .78rem; color: var(--gold);
    font-weight: 700; letter-spacing: .5px; margin-bottom: 3px;
}
.order-date { font-size: .78rem; color: var(--txt2); font-weight: 400; }

/* status badges */
.obadge {
    font-size: .68rem; font-weight: 700; padding: 4px 11px;
    border-radius: 20px; letter-spacing: .5px; text-transform: uppercase;
    white-space: nowrap;
}
.ob-pending    { background: rgba(245,166,35,.14); color: var(--gold);  border: 1px solid rgba(245,166,35,.28); }
.ob-processing { background: rgba(26,108,255,.14);  color: #6ca3ff;      border: 1px solid rgba(26,108,255,.28); }
.ob-completed  { background: rgba(0,210,168,.14);   color: var(--teal);  border: 1px solid rgba(0,210,168,.28); }
.ob-cancelled  { background: rgba(239,68,68,.14);   color: #f87171;      border: 1px solid rgba(239,68,68,.28); }

/* order items list */
.order-items { display: flex; flex-direction: column; gap: 7px; margin-bottom: 14px; }
.order-item {
    display: flex; align-items: center; justify-content: space-between;
    font-size: .82rem; padding: 7px 10px;
    background: rgba(255,255,255,.02); border-radius: 8px;
}
.order-item-name { color: var(--txt2); }
.order-item-name span { color: rgba(245,166,35,.6); font-weight: 700; margin-left: 4px; }
.order-item-price { color: var(--txt); font-weight: 600; }

/* order total */
.order-total {
    display: flex; align-items: center; justify-content: space-between;
    padding-top: 12px; border-top: 1px solid var(--rim);
}
.order-total-label { font-size: .78rem; color: var(--txt2); font-weight: 500; }
.order-total-val {
    font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 900;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 4s linear infinite;
}

/* empty orders */
.empty-state {
    text-align: center; padding: 52px 24px;
}
.empty-icon {
    width: 68px; height: 68px; border-radius: 16px; margin: 0 auto 18px;
    background: rgba(245,166,35,.07); border: 1px solid rgba(245,166,35,.14);
    display: flex; align-items: center; justify-content: center;
    font-size: 26px; color: rgba(245,166,35,.28);
}
.empty-title { font-family: 'Playfair Display', serif; font-size: 1.1rem; font-weight: 700; color: var(--txt); margin-bottom: 6px; }
.empty-sub   { color: var(--txt2); font-size: .85rem; font-weight: 300; }

/* ── RESPONSIVE ── */
@media(max-width: 860px) {
    .client-grid { grid-template-columns: 1fr; }
    .page-hero   { padding: 24px 22px; flex-direction: column; align-items: flex-start; gap: 0; }
}
@media(max-width: 500px) {
    .mini-stats { grid-template-columns: 1fr 1fr; }
}
</style>
@endpush

@section('content')
<div class="client-wrap">

    <!-- ── PAGE HERO ── -->
    <div class="page-hero au">
        <div class="page-hero-bg"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="page-hero-content">
            <a href="{{ route('admin.users.index') }}" class="btn-back">
                <i class="fas fa-arrow-left" style="font-size:11px;"></i> Retour à la liste
            </a>
            <div class="hero-eyebrow"><span class="dot"></span> Admin · Clients</div>
            <h1 class="page-title">Fiche <em>client</em></h1>
            <p class="page-sub">Informations détaillées et historique des commandes de {{ $client->name }}.</p>
        </div>
    </div>

    <!-- ── GRID ── -->
    <div class="client-grid">

        <!-- ═══ COL GAUCHE : Profil ═══ -->
        <div class="au d1">

            <div class="panel">
                <div class="panel-accent"></div>
                <div class="panel-head">
                    <div class="panel-head-icon"><i class="fas fa-user"></i></div>
                    <div>
                        <div class="panel-head-title">Profil client</div>
                        <div class="panel-head-sub">Informations personnelles</div>
                    </div>
                </div>

                <div class="profile-body">

                    <!-- Avatar + nom -->
                    <div class="avatar-wrap">
                        <div class="avatar-ring">
                            <div class="avatar-inner">
                                {{ strtoupper(substr($client->name, 0, 1)) }}
                            </div>
                        </div>
                        <div class="client-name">{{ $client->name }}</div>
                        <div class="client-since">
                            <i class="fas fa-calendar-alt" style="color:var(--gold);margin-right:5px;font-size:10px;"></i>
                            Client depuis le {{ $client->created_at->format('d/m/Y') }}
                        </div>
                    </div>

                    <!-- Mini stats -->
                    <div class="mini-stats">
                        <div class="mini-stat">
                            <div class="mini-stat-num">{{ $client->orders->count() }}</div>
                            <div class="mini-stat-lbl">Commandes</div>
                        </div>
                        <div class="mini-stat">
                            <div class="mini-stat-num" style="font-size:1.1rem;">
                                {{ number_format($client->orders->sum('total_amount'), 0, ',', ' ') }}
                                <span style="font-size:.5em;opacity:.6;">F</span>
                            </div>
                            <div class="mini-stat-lbl">Dépensé</div>
                        </div>
                    </div>

                    <!-- Info rows -->
                    <div class="info-rows">
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-envelope"></i></div>
                            <div>
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $client->email }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-phone"></i></div>
                            <div>
                                <div class="info-label">Téléphone</div>
                                <div class="info-value">{{ $client->phone ?? 'Non renseigné' }}</div>
                            </div>
                        </div>
                        <div class="info-row">
                            <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div>
                                <div class="info-label">Adresse de livraison</div>
                                <div class="info-value">{{ $client->address ?? 'Non renseignée' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Ban button -->
                    <form action="{{ route('admin.clients.ban', $client->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-ban"
                                onclick="return confirm('Êtes-vous sûr de vouloir bannir ce client ?')">
                            <i class="fas fa-ban"></i> Bannir ce client
                        </button>
                    </form>

                </div>
            </div>

        </div>

        <!-- ═══ COL DROITE : Commandes ═══ -->
        <div class="au d2">

            <div class="panel">
                <div class="panel-accent" style="background:linear-gradient(90deg,#0052a3,#1a6cff,#6ca3ff,#1a6cff);background-size:300% auto;animation:shimmer 3s linear infinite;"></div>
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(26,108,255,.12);color:#6ca3ff;">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div>
                        <div class="panel-head-title">Historique des commandes</div>
                        <div class="panel-head-sub">
                            {{ $client->orders->count() }} commande{{ $client->orders->count() > 1 ? 's' : '' }} au total
                        </div>
                    </div>
                </div>

                <div class="orders-body">

                    @if($client->orders->count() > 0)

                        @foreach($client->orders as $order)
                        <div class="order-card">

                            <!-- top row -->
                            <div class="order-top">
                                <div>
                                    <div class="order-num">#{{ $order->order_number }}</div>
                                    <div class="order-date">
                                        <i class="fas fa-clock" style="margin-right:4px;font-size:10px;"></i>
                                        {{ $order->created_at->format('d/m/Y à H:i') }}
                                    </div>
                                </div>
                                <span class="obadge ob-{{ $order->status }}">
                                    @if($order->status == 'pending')    <i class="fas fa-clock" style="margin-right:4px;"></i>
                                    @elseif($order->status == 'processing') <i class="fas fa-spinner" style="margin-right:4px;animation:rotate 1.5s linear infinite;"></i>
                                    @elseif($order->status == 'completed')  <i class="fas fa-check" style="margin-right:4px;"></i>
                                    @else <i class="fas fa-times" style="margin-right:4px;"></i>
                                    @endif
                                    {{ $order->status }}
                                </span>
                            </div>

                            <!-- items -->
                            <div class="order-items">
                                @foreach($order->items as $item)
                                <div class="order-item">
                                    <span class="order-item-name">
                                        {{ $item->product->name }}
                                        <span>×{{ $item->quantity }}</span>
                                    </span>
                                    <span class="order-item-price">
                                        {{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA
                                    </span>
                                </div>
                                @endforeach
                            </div>

                            <!-- total -->
                            <div class="order-total">
                                <span class="order-total-label">
                                    <i class="fas fa-receipt" style="margin-right:5px;color:var(--gold);font-size:11px;"></i>
                                    Total commande
                                </span>
                                <span class="order-total-val">
                                    {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA
                                </span>
                            </div>

                        </div>
                        @endforeach

                    @else

                        <div class="empty-state">
                            <div class="empty-icon"><i class="fas fa-shopping-bag"></i></div>
                            <div class="empty-title">Aucune commande</div>
                            <p class="empty-sub">Ce client n'a pas encore passé de commande.</p>
                        </div>

                    @endif

                </div>
            </div>

        </div>

    </div><!-- /client-grid -->

</div>
@endsection