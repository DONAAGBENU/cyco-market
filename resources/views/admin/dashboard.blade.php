<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — CYCO MARKET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
/* ═══════════════════════════════════════════
   TOKENS
═══════════════════════════════════════════ */
:root {
    --gold:         #f5a623;
    --gold-lt:      #ffd280;
    --gold-dk:      #c47d0e;
    --bg:           #07090f;
    --bg2:          #0c1120;
    --card:         #101624;
    --card2:        #141c2c;
    --rim:          rgba(255,255,255,.055);
    --rim-gold:     rgba(245,166,35,.20);
    --txt:          #dde1ec;
    --txt2:         #6b7591;
    --blue:         #1a6cff;
    --teal:         #00d2a8;
    --purple:       #7c3aed;
    --red:          #ef4444;
}

/* ═══════════════════════════════════════════
   RESET + BASE
═══════════════════════════════════════════ */
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }

body {
    background: var(--bg);
    color: var(--txt);
    font-family: 'Outfit', sans-serif;
    font-weight: 400;
    min-height: 100vh;
    overflow-x: hidden;
}

/* ambient mesh — always behind everything */
body::after {
    content: '';
    position: fixed; inset: 0; z-index: 0; pointer-events: none;
    background:
        radial-gradient(ellipse 60% 50% at  8%  8%,  rgba(26,108,255,.08)  0%, transparent 55%),
        radial-gradient(ellipse 55% 45% at 92% 92%,  rgba(245,166,35,.07)  0%, transparent 55%),
        radial-gradient(ellipse 40% 35% at 55% 40%,  rgba(0,210,168,.04)   0%, transparent 65%);
}

/* ═══════════════════════════════════════════
   KEYFRAMES
═══════════════════════════════════════════ */
@keyframes up      { from{opacity:0;transform:translateY(22px)} to{opacity:1;transform:translateY(0)} }
@keyframes shimmer { 0%{background-position:-220% center} 100%{background-position:220% center} }
@keyframes glow    { 0%,100%{opacity:.5} 50%{opacity:1} }
@keyframes scan    { 0%{transform:translateY(-100%)} 100%{transform:translateY(200%)} }
@keyframes drift   { 0%,100%{transform:translate(0,0) scale(1)} 40%{transform:translate(18px,-14px) scale(1.04)} 70%{transform:translate(-12px,10px) scale(.97)} }
@keyframes spin    { to{transform:rotate(360deg)} }
@keyframes pulse-r { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.40)} 65%{box-shadow:0 0 0 10px transparent} }

.au   { animation: up .65s cubic-bezier(.22,.6,.36,1) both }
.d1   { animation-delay:.07s } .d2{animation-delay:.14s} .d3{animation-delay:.21s} .d4{animation-delay:.28s}
.d5   { animation-delay:.35s } .d6{animation-delay:.42s}

/* ═══════════════════════════════════════════
   SIDEBAR
═══════════════════════════════════════════ */
.sidebar {
    position: fixed; left: 0; top: 0; bottom: 0;
    width: 240px; z-index: 300;
    background: rgba(10,13,22,.92);
    backdrop-filter: blur(24px) saturate(160%);
    border-right: 1px solid var(--rim);
    display: flex; flex-direction: column;
    padding: 0 0 24px;
    transition: transform .3s ease;
}

.sidebar-logo {
    padding: 24px 24px 20px;
    border-bottom: 1px solid var(--rim);
    display: flex; align-items: center; gap: 10px;
}
.sidebar-logo-text {
    font-family: 'Playfair Display', serif;
    font-size: 1.25rem; font-weight: 900;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800);
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 4s linear infinite;
}
.sidebar-badge {
    font-size: 9px; font-weight: 700; letter-spacing: 1px; text-transform: uppercase;
    background: rgba(245,166,35,.12); border: 1px solid rgba(245,166,35,.25);
    color: var(--gold); padding: 3px 8px; border-radius: 6px;
}

.sidebar-section { padding: 16px 16px 6px; font-size: 10px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase; color: rgba(255,255,255,.22); }

.nav-item {
    display: flex; align-items: center; gap: 12px;
    padding: 11px 20px; margin: 2px 10px;
    border-radius: 10px; text-decoration: none;
    color: var(--txt2); font-size: .85rem; font-weight: 500;
    transition: all .25s; position: relative;
}
.nav-item .ni-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    font-size: 14px; flex-shrink: 0; transition: all .25s;
    background: rgba(255,255,255,.04);
    color: var(--txt2);
}
.nav-item:hover { background: rgba(255,255,255,.05); color: var(--txt); }
.nav-item:hover .ni-icon { background: rgba(245,166,35,.12); color: var(--gold); }
.nav-item.active { background: rgba(245,166,35,.10); color: var(--gold-lt); }
.nav-item.active .ni-icon { background: rgba(245,166,35,.20); color: var(--gold); }
.nav-item.active::before {
    content: ''; position: absolute; left: -10px; top: 50%; transform: translateY(-50%);
    width: 3px; height: 60%; background: var(--gold); border-radius: 0 3px 3px 0;
}

.sidebar-footer {
    margin-top: auto; padding: 16px;
    border-top: 1px solid var(--rim);
}
.sidebar-user {
    display: flex; align-items: center; gap: 10px;
    padding: 12px 14px; border-radius: 12px;
    background: rgba(255,255,255,.03); border: 1px solid var(--rim);
    transition: all .3s; cursor: pointer;
}
.sidebar-user:hover { background: rgba(245,166,35,.06); border-color: var(--rim-gold); }
.sidebar-avatar {
    width: 36px; height: 36px; border-radius: 50%; flex-shrink: 0;
    background: linear-gradient(135deg, var(--gold-dk), var(--gold));
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 800; color: #07090f;
}
.sidebar-uname { font-size: .82rem; font-weight: 600; color: var(--txt); }
.sidebar-urole { font-size: .7rem; color: var(--gold); letter-spacing: .4px; text-transform: uppercase; }

/* logout button in sidebar */
.logout-btn {
    display: flex; align-items: center; gap: 10px; width: 100%;
    padding: 10px 14px; margin-top: 8px;
    border-radius: 10px; border: 1px solid rgba(239,68,68,.18);
    background: rgba(239,68,68,.06); color: #f87171;
    font-size: .82rem; font-weight: 600; cursor: pointer;
    font-family: 'Outfit', sans-serif;
    transition: all .3s; text-decoration: none;
}
.logout-btn:hover { background: rgba(239,68,68,.12); border-color: rgba(239,68,68,.35); }

/* ═══════════════════════════════════════════
   TOPBAR
═══════════════════════════════════════════ */
.topbar {
    position: fixed; top: 0; left: 240px; right: 0; height: 64px; z-index: 200;
    background: rgba(7,9,15,.82);
    backdrop-filter: blur(20px) saturate(180%);
    border-bottom: 1px solid var(--rim);
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 32px;
}
.topbar-left { display: flex; align-items: center; gap: 8px; }
.breadcrumb  { font-size: .78rem; color: var(--txt2); display: flex; align-items: center; gap: 6px; }
.breadcrumb .sep { opacity: .3; }
.breadcrumb .current { color: var(--gold-lt); font-weight: 600; }

.topbar-right { display: flex; align-items: center; gap: 12px; }
.topbar-btn {
    width: 36px; height: 36px; border-radius: 9px;
    background: rgba(255,255,255,.04); border: 1px solid var(--rim);
    display: flex; align-items: center; justify-content: center;
    color: var(--txt2); font-size: 14px; text-decoration: none;
    transition: all .3s; cursor: pointer;
}
.topbar-btn:hover { background: rgba(245,166,35,.10); border-color: var(--rim-gold); color: var(--gold); }
.notif-dot {
    position: absolute; top: 6px; right: 6px;
    width: 7px; height: 7px; border-radius: 50%;
    background: var(--gold); animation: glow 2s infinite;
    border: 1.5px solid var(--bg);
}

/* ═══════════════════════════════════════════
   MAIN CONTENT AREA
═══════════════════════════════════════════ */
.main {
    margin-left: 240px;
    padding-top: 64px;
    min-height: 100vh;
    position: relative; z-index: 1;
}
.content {
    padding: 36px 32px 60px;
    max-width: 1280px;
}

/* ═══════════════════════════════════════════
   PAGE HERO BANNER
═══════════════════════════════════════════ */
.page-hero {
    position: relative; overflow: hidden;
    border-radius: 20px; margin-bottom: 32px;
    min-height: 200px; display: flex; align-items: center;
    padding: 40px 48px;
    border: 1px solid var(--rim);
}
.page-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background:
        linear-gradient(105deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.80) 55%, rgba(7,9,15,.92) 100%),
        url('https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=1600&q=75&auto=format&fit=crop')
        center / cover no-repeat;
}
/* grid lines */
.page-hero-bg::after {
    content: '';
    position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(245,166,35,.04) 1px, transparent 1px),
        linear-gradient(90deg, rgba(245,166,35,.04) 1px, transparent 1px);
    background-size: 52px 52px;
}
/* scan line */
.page-hero::before {
    content: ''; position: absolute; left: 0; right: 0; height: 1px; z-index: 3;
    background: linear-gradient(90deg, transparent 0%, rgba(245,166,35,.35) 50%, transparent 100%);
    animation: scan 7s linear infinite;
    pointer-events: none;
}
/* orbs */
.hero-orb {
    position: absolute; border-radius: 50%; filter: blur(80px);
    pointer-events: none; z-index: 1;
}
.orb-hero-1 { width: 420px; height: 420px; background: rgba(26,108,255,.10); top: -100px; right: -60px; animation: drift 14s ease-in-out infinite; }
.orb-hero-2 { width: 260px; height: 260px; background: rgba(245,166,35,.08); bottom: -60px; left: 20%; animation: drift 18s ease-in-out infinite reverse; }

.page-hero-content { position: relative; z-index: 2; }

.hero-eyebrow {
    display: inline-flex; align-items: center; gap: 9px;
    border: 1px solid rgba(245,166,35,.28); background: rgba(245,166,35,.07);
    color: var(--gold-lt); padding: 5px 14px; border-radius: 100px;
    font-size: 11px; font-weight: 700; letter-spacing: 1.8px; text-transform: uppercase;
    margin-bottom: 16px;
}
.hero-eyebrow .dot { width: 7px; height: 7px; border-radius: 50%; background: var(--gold); display: inline-block; animation: pulse-r 2.2s infinite; }

.page-title {
    font-family: 'Playfair Display', serif;
    font-size: clamp(1.9rem, 3.2vw, 2.8rem); font-weight: 900;
    color: var(--txt); line-height: 1.1; letter-spacing: -.6px; margin-bottom: 10px;
}
.page-title em {
    font-style: normal;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800);
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 3.5s linear infinite;
}
.page-sub { color: rgba(221,225,236,.50); font-size: .95rem; font-weight: 300; max-width: 500px; }

/* hero right — live indicator */
.hero-live {
    margin-left: auto; flex-shrink: 0;
    background: rgba(7,9,15,.65); backdrop-filter: blur(16px);
    border: 1px solid rgba(245,166,35,.20); border-radius: 16px;
    padding: 20px 24px; min-width: 200px; display: none;
}
@media(min-width:900px){ .hero-live { display: block; } }
.hero-live-title { font-size: .7rem; font-weight: 700; letter-spacing: 1.5px; text-transform: uppercase; color: var(--gold); margin-bottom: 14px; display: flex; align-items: center; gap: 7px; }
.live-row { display: flex; align-items: center; justify-content: space-between; padding: 9px 0; border-bottom: 1px solid var(--rim); }
.live-row:last-child { border: none; padding-bottom: 0; }
.live-lbl { font-size: .78rem; color: var(--txt2); }
.live-val { font-size: .85rem; font-weight: 700; }
.live-val.gold   { color: var(--gold-lt); }
.live-val.teal   { color: var(--teal); }
.live-val.blue   { color: #6ca3ff; }

/* ═══════════════════════════════════════════
   STAT CARDS
═══════════════════════════════════════════ */
.stats-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
    margin-bottom: 28px;
}

.scard {
    position: relative; overflow: hidden;
    border-radius: 18px; padding: 26px 22px 20px;
    border: 1px solid var(--rim);
    display: flex; flex-direction: column; justify-content: space-between;
    min-height: 150px;
    transition: transform .35s, box-shadow .35s, border-color .35s;
    cursor: default;
}
.scard:hover { transform: translateY(-6px); box-shadow: 0 24px 52px rgba(0,0,0,.5); }

/* individual themes */
.scard-blue   { background: linear-gradient(145deg, #091535 0%, #0b1b42 100%); }
.scard-blue:hover   { border-color: rgba(26,108,255,.45); box-shadow: 0 24px 52px rgba(26,108,255,.12); }
.scard-green  { background: linear-gradient(145deg, #071e14 0%, #092418 100%); }
.scard-green:hover  { border-color: rgba(0,210,168,.40); box-shadow: 0 24px 52px rgba(0,210,168,.10); }
.scard-purple { background: linear-gradient(145deg, #130a28 0%, #180d32 100%); }
.scard-purple:hover { border-color: rgba(124,58,237,.45); box-shadow: 0 24px 52px rgba(124,58,237,.12); }
.scard-gold   { background: linear-gradient(145deg, #1e1200 0%, #251600 100%); }
.scard-gold:hover   { border-color: rgba(245,166,35,.45); box-shadow: 0 24px 52px rgba(245,166,35,.12); }

/* photo overlay per card */
.scard::before {
    content: ''; position: absolute; inset: 0;
    background-size: cover; background-position: center;
    opacity: .06; transition: opacity .35s;
}
.scard:hover::before { opacity: .11; }
.scard-blue::before   { background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=500&q=60&auto=format&fit=crop'); }
.scard-green::before  { background-image: url('https://images.unsplash.com/photo-1512909006721-3d6018887383?w=500&q=60&auto=format&fit=crop'); }
.scard-purple::before { background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=500&q=60&auto=format&fit=crop'); }
.scard-gold::before   { background-image: url('https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=500&q=60&auto=format&fit=crop'); }

.scard-top { display: flex; align-items: flex-start; justify-content: space-between; position: relative; z-index: 1; margin-bottom: 18px; }

.scard-label {
    font-size: .7rem; font-weight: 700; letter-spacing: 1.2px;
    text-transform: uppercase; margin-bottom: 10px; display: block;
}
.scard-blue   .scard-label   { color: rgba(108,163,255,.8); }
.scard-green  .scard-label   { color: rgba(0,210,168,.8); }
.scard-purple .scard-label   { color: rgba(167,139,250,.8); }
.scard-gold   .scard-label   { color: var(--gold); }

.scard-value {
    font-family: 'Playfair Display', serif;
    font-size: clamp(2rem, 2.8vw, 2.6rem); font-weight: 900; line-height: 1;
    color: var(--txt);
}

.scard-icon {
    width: 46px; height: 46px; border-radius: 12px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 19px;
    position: relative; z-index: 1;
}
.scard-blue   .scard-icon { background: rgba(26,108,255,.16);  color: #6ca3ff; }
.scard-green  .scard-icon { background: rgba(0,210,168,.16);   color: var(--teal); }
.scard-purple .scard-icon { background: rgba(124,58,237,.16);  color: #a78bfa; }
.scard-gold   .scard-icon { background: rgba(245,166,35,.16);  color: var(--gold); }

.scard-footer { position: relative; z-index: 1; padding-top: 14px; border-top: 1px solid rgba(255,255,255,.06); }
.scard-link {
    font-size: .75rem; font-weight: 600; text-decoration: none;
    display: inline-flex; align-items: center; gap: 6px; transition: gap .2s, opacity .2s;
    opacity: .65;
}
.scard-link:hover { opacity: 1; gap: 10px; }
.scard-blue   .scard-link { color: #6ca3ff; }
.scard-green  .scard-link { color: var(--teal); }
.scard-purple .scard-link { color: #a78bfa; }
.scard-gold   .scard-link { color: var(--gold); }

/* ═══════════════════════════════════════════
   SECTION GRID LAYOUTS
═══════════════════════════════════════════ */
.row-2-1 { display: grid; grid-template-columns: 1.55fr 1fr; gap: 20px; margin-bottom: 20px; }
.row-2   { display: grid; grid-template-columns: 1fr 1fr;    gap: 20px; margin-bottom: 20px; }
.row-1   { margin-bottom: 20px; }

/* ═══════════════════════════════════════════
   GLASS PANEL  (shared card wrapper)
═══════════════════════════════════════════ */
.panel {
    position: relative; overflow: hidden;
    border-radius: 18px; border: 1px solid var(--rim);
    background: var(--card);
    transition: border-color .3s, box-shadow .3s;
}
.panel:hover { border-color: var(--rim-gold); }

/* each panel can have a muted photo bg */
.panel-photo-bg {
    position: absolute; inset: 0; z-index: 0;
    background-size: cover; background-position: center;
    opacity: 0;
    transition: opacity .4s;
}
.panel:hover .panel-photo-bg { opacity: .045; }

.panel-inner { position: relative; z-index: 1; }

/* ── panel header ── */
.panel-head {
    display: flex; align-items: center; gap: 12px;
    padding: 22px 24px 18px;
    border-bottom: 1px solid var(--rim);
}
.panel-head-icon {
    width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
    background: rgba(245,166,35,.10); color: var(--gold);
}
.panel-head-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem; font-weight: 800; color: var(--txt);
}
.panel-head-sub { font-size: .75rem; color: var(--txt2); margin-top: 1px; }

/* ── panel footer ── */
.panel-foot {
    padding: 14px 24px;
    border-top: 1px solid var(--rim);
}
.panel-foot a {
    font-size: .78rem; font-weight: 600; color: rgba(245,166,35,.6);
    text-decoration: none; display: inline-flex; align-items: center; gap: 6px;
    transition: color .25s, gap .25s;
}
.panel-foot a:hover { color: var(--gold); gap: 10px; }

/* ═══════════════════════════════════════════
   ORDER STATUS TILES
═══════════════════════════════════════════ */
.status-grid {
    display: grid; grid-template-columns: 1fr 1fr; gap: 12px;
    padding: 20px 24px;
}
.status-tile {
    padding: 20px 16px; border-radius: 14px; text-align: center;
    border: 1px solid transparent; transition: transform .3s, border-color .3s;
}
.status-tile:hover { transform: translateY(-3px); }
.st-pending   { background: rgba(245,166,35,.07); border-color: rgba(245,166,35,.18); }
.st-process   { background: rgba(26,108,255,.07);  border-color: rgba(26,108,255,.18); }
.st-done      { background: rgba(0,210,168,.07);   border-color: rgba(0,210,168,.18); }
.st-cancel    { background: rgba(239,68,68,.07);   border-color: rgba(239,68,68,.18); }

.st-num {
    font-family: 'Playfair Display', serif;
    font-size: 2.1rem; font-weight: 900; line-height: 1; margin-bottom: 5px;
}
.st-pending .st-num  { color: var(--gold); }
.st-process .st-num  { color: #6ca3ff; }
.st-done    .st-num  { color: var(--teal); }
.st-cancel  .st-num  { color: #f87171; }

.st-lbl { font-size: .7rem; font-weight: 700; letter-spacing: .8px; text-transform: uppercase; color: var(--txt2); }

/* ═══════════════════════════════════════════
   QUICK ACTIONS
═══════════════════════════════════════════ */
.quick-list { padding: 18px 20px; display: flex; flex-direction: column; gap: 10px; }

.qa-btn {
    display: flex; align-items: center; gap: 14px;
    padding: 14px 16px; border-radius: 13px;
    text-decoration: none; color: var(--txt);
    font-size: .875rem; font-weight: 600;
    border: 1px solid transparent;
    transition: all .28s;
}
.qa-btn .qa-icon {
    width: 40px; height: 40px; border-radius: 11px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center; font-size: 16px;
    transition: transform .28s;
}
.qa-btn:hover .qa-icon { transform: scale(1.12); }
.qa-btn .qa-arrow { margin-left: auto; opacity: .3; font-size: 11px; transition: all .28s; }
.qa-btn:hover .qa-arrow { opacity: .8; transform: translateX(4px); }

.qa-blue   { background: rgba(26,108,255,.07);  border-color: rgba(26,108,255,.16); }
.qa-blue   .qa-icon { background: rgba(26,108,255,.18); color: #6ca3ff; }
.qa-blue:hover   { background: rgba(26,108,255,.13); border-color: rgba(26,108,255,.35); }

.qa-green  { background: rgba(0,210,168,.07);   border-color: rgba(0,210,168,.16); }
.qa-green  .qa-icon { background: rgba(0,210,168,.18); color: var(--teal); }
.qa-green:hover  { background: rgba(0,210,168,.13); border-color: rgba(0,210,168,.35); }

.qa-purple { background: rgba(124,58,237,.07);  border-color: rgba(124,58,237,.16); }
.qa-purple .qa-icon { background: rgba(124,58,237,.18); color: #a78bfa; }
.qa-purple:hover { background: rgba(124,58,237,.13); border-color: rgba(124,58,237,.35); }

/* ═══════════════════════════════════════════
   LIST ITEMS  (users / orders)
═══════════════════════════════════════════ */
.item-list { padding: 16px 24px; display: flex; flex-direction: column; gap: 10px; }

.item-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 13px 16px; border-radius: 12px;
    background: rgba(255,255,255,.028);
    border: 1px solid var(--rim);
    transition: all .28s;
}
.item-row:hover { background: rgba(245,166,35,.05); border-color: rgba(245,166,35,.18); }

.item-left  { display: flex; align-items: center; gap: 12px; }
.item-right { display: flex; align-items: center; gap: 8px; }

.avatar {
    width: 40px; height: 40px; border-radius: 50%; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 800;
    color: #07090f;
}

.item-name { font-size: .85rem; font-weight: 600; color: var(--txt); }
.item-meta { font-size: .72rem; color: var(--txt2); margin-top: 2px; }

.eye-btn {
    width: 32px; height: 32px; border-radius: 8px; flex-shrink: 0;
    background: rgba(245,166,35,.08); border: 1px solid rgba(245,166,35,.18);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 12px; text-decoration: none;
    transition: all .25s;
}
.eye-btn:hover { background: rgba(245,166,35,.18); transform: scale(1.1); }

/* order status badges */
.obadge {
    font-size: 10px; font-weight: 700; padding: 3px 10px;
    border-radius: 20px; letter-spacing: .4px; text-transform: uppercase;
}
.ob-pending   { background: rgba(245,166,35,.14); color: var(--gold);  border: 1px solid rgba(245,166,35,.28); }
.ob-processing{ background: rgba(26,108,255,.14);  color: #6ca3ff;      border: 1px solid rgba(26,108,255,.28); }
.ob-completed { background: rgba(0,210,168,.14);   color: var(--teal);  border: 1px solid rgba(0,210,168,.28); }
.ob-cancelled { background: rgba(239,68,68,.14);   color: #f87171;      border: 1px solid rgba(239,68,68,.28); }

/* ═══════════════════════════════════════════
   PRODUCT MINI CARDS
═══════════════════════════════════════════ */
.prod-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(185px,1fr)); gap: 16px; padding: 20px 24px; }

.pcard {
    background: var(--card2); border: 1px solid var(--rim);
    border-radius: 14px; overflow: hidden; transition: all .35s;
}
.pcard:hover { border-color: rgba(245,166,35,.30); transform: translateY(-5px); box-shadow: 0 18px 40px rgba(0,0,0,.45); }

.pcard-img {
    height: 110px; overflow: hidden;
    background: linear-gradient(135deg, #0e1626, #131e30);
    position: relative;
}
.pcard-img img { width:100%; height:100%; object-fit:cover; transition:transform .4s; }
.pcard:hover .pcard-img img { transform: scale(1.08); }
.pcard-img .no-img { width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(245,166,35,.15);font-size:2rem; }

.pcard-body { padding: 13px 14px; }
.pcard-cat  { font-size: .65rem; font-weight: 700; letter-spacing: 1px; text-transform: uppercase; color: var(--gold); margin-bottom: 4px; }
.pcard-name { font-size: .82rem; font-weight: 600; color: var(--txt); line-height: 1.35; margin-bottom: 10px; }
.pcard-price {
    font-family: 'Playfair Display', serif; font-size: .95rem; font-weight: 800;
    background: linear-gradient(90deg, var(--gold-lt), var(--gold));
    background-size: 200% auto;
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
    animation: shimmer 4.5s linear infinite;
}

/* ═══════════════════════════════════════════
   RESPONSIVE
═══════════════════════════════════════════ */
@media(max-width: 1100px) {
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .row-2-1, .row-2 { grid-template-columns: 1fr; }
}
@media(max-width: 768px) {
    .sidebar { transform: translateX(-100%); }
    .main    { margin-left: 0; }
    .topbar  { left: 0; }
    .content { padding: 24px 16px 48px; }
    .stats-row { grid-template-columns: 1fr 1fr; }
    .page-hero { padding: 28px 24px; min-height: auto; }
}
@media(max-width: 480px) {
    .stats-row  { grid-template-columns: 1fr; }
    .status-grid{ grid-template-columns: 1fr 1fr; }
}
</style>
</head>

<body>

<!-- ══════════════════════════════════════════
     SIDEBAR
══════════════════════════════════════════ -->
<aside class="sidebar">

    <div class="sidebar-logo">
        <span class="sidebar-logo-text">CYCO</span>
        <span class="sidebar-badge">ADMIN</span>
    </div>

    <div class="sidebar-section">Principal</div>

    <a href="{{ route('admin.dashboard') }}" class="nav-item active">
        <div class="ni-icon"><i class="fas fa-gauge-high"></i></div>
        Dashboard
    </a>
    <a href="{{ route('admin.products.index') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-box"></i></div>
        Produits
    </a>
    <a href="{{ route('admin.categories.index') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-tags"></i></div>
        Catégories
    </a>
    <a href="{{ route('admin.orders.index') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-shopping-bag"></i></div>
        Commandes
    </a>

    <div class="sidebar-section">Gestion</div>

    <a href="{{ route('admin.users.index') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-users"></i></div>
        Clients
    </a>
    <a href="{{ route('admin.products.create') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-plus-circle"></i></div>
        Ajouter produit
    </a>
    <a href="{{ route('admin.categories.create') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-folder-plus"></i></div>
        Ajouter catégorie
    </a>

    <div class="sidebar-section">Site</div>

    <a href="{{ route('home') }}" class="nav-item">
        <div class="ni-icon"><i class="fas fa-store"></i></div>
        Voir le site
    </a>

    <!-- user footer -->
    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-uname">{{ Auth::user()->name }}</div>
                <div class="sidebar-urole">{{ Auth::user()->role }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">
                <i class="fas fa-sign-out-alt" style="width:14px;text-align:center;"></i>
                Déconnexion
            </button>
        </form>
    </div>

</aside>

<!-- ══════════════════════════════════════════
     TOPBAR
══════════════════════════════════════════ -->
<header class="topbar">
    <div class="topbar-left">
        <div class="breadcrumb">
            <span>CYCO MARKET</span>
            <span class="sep">/</span>
            <span>Admin</span>
            <span class="sep">/</span>
            <span class="current">Dashboard</span>
        </div>
    </div>
    <div class="topbar-right">
        <div style="position:relative;">
            <div class="topbar-btn"><i class="fas fa-bell"></i></div>
            <div class="notif-dot"></div>
        </div>
        <a href="{{ route('home') }}" class="topbar-btn" title="Voir le site"><i class="fas fa-external-link-alt"></i></a>
        <div style="width:1px;height:22px;background:var(--rim);margin:0 4px;"></div>
        <div style="display:flex;align-items:center;gap:9px;cursor:default;">
            <div class="sidebar-avatar" style="width:32px;height:32px;font-size:.82rem;">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</div>
            <span style="font-size:.82rem;font-weight:600;color:var(--txt);">{{ Auth::user()->name }}</span>
        </div>
    </div>
</header>

<!-- ══════════════════════════════════════════
     MAIN
══════════════════════════════════════════ -->
<main class="main">
<div class="content">

    <!-- ── PAGE HERO ── -->
    <div class="page-hero au">
        <div class="page-hero-bg"></div>
        <div class="hero-orb orb-hero-1"></div>
        <div class="hero-orb orb-hero-2"></div>

        <div class="page-hero-content" style="flex:1;">
            <div class="hero-eyebrow">
                <span class="dot"></span> Espace Administration · CYCO MARKET
            </div>
            <h1 class="page-title">
                Dashboard <em>Administrateur</em>
            </h1>
            <p class="page-sub">
                Bienvenue, <strong style="color:var(--gold-lt);">{{ Auth::user()->name }}</strong> —
                gérez votre plateforme en temps réel.
            </p>
        </div>

        <div class="hero-live">
            <div class="hero-live-title">
                <span style="width:7px;height:7px;border-radius:50%;background:#00d2a8;display:inline-block;animation:glow 2s infinite;"></span>
                Live
            </div>
            <div class="live-row">
                <span class="live-lbl">Produits actifs</span>
                <span class="live-val gold">{{ $totalProducts }}</span>
            </div>
            <div class="live-row">
                <span class="live-lbl">Commandes</span>
                <span class="live-val teal">{{ $totalOrders }}</span>
            </div>
            <div class="live-row">
                <span class="live-lbl">Clients</span>
                <span class="live-val blue">{{ $totalUsers }}</span>
            </div>
        </div>
    </div>

    <!-- ── STAT CARDS ── -->
    <div class="stats-row">

        <div class="scard scard-blue au d1">
            <div class="scard-top">
                <div>
                    <span class="scard-label">Total Clients</span>
                    <div class="scard-value">{{ $totalUsers }}</div>
                </div>
                <div class="scard-icon"><i class="fas fa-users"></i></div>
            </div>
            <div class="scard-footer">
                <a href="{{ route('admin.users.index') }}" class="scard-link">
                    Voir tous <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                </a>
            </div>
        </div>

        <div class="scard scard-green au d2">
            <div class="scard-top">
                <div>
                    <span class="scard-label">Total Produits</span>
                    <div class="scard-value">{{ $totalProducts }}</div>
                </div>
                <div class="scard-icon"><i class="fas fa-box"></i></div>
            </div>
            <div class="scard-footer">
                <a href="{{ route('admin.products.index') }}" class="scard-link">
                    Gérer <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                </a>
            </div>
        </div>

        <div class="scard scard-purple au d3">
            <div class="scard-top">
                <div>
                    <span class="scard-label">Total Commandes</span>
                    <div class="scard-value">{{ $totalOrders }}</div>
                </div>
                <div class="scard-icon"><i class="fas fa-shopping-cart"></i></div>
            </div>
            <div class="scard-footer">
                <a href="{{ route('admin.orders.index') }}" class="scard-link">
                    Voir commandes <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                </a>
            </div>
        </div>

        <div class="scard scard-gold au d4">
            <div class="scard-top">
                <div>
                    <span class="scard-label">Revenus Totaux</span>
                    <div class="scard-value" style="font-size:clamp(1.3rem,2vw,1.8rem);">
                        {{ number_format($totalRevenue, 0, ',', ' ') }}
                        <span style="font-size:.5em;opacity:.65;font-weight:600;"> FCFA</span>
                    </div>
                </div>
                <div class="scard-icon"><i class="fas fa-chart-line"></i></div>
            </div>
            <div class="scard-footer">
                <span class="scard-link" style="cursor:default;">
                    <i class="fas fa-circle" style="font-size:7px;color:var(--teal);"></i> Actualisé
                </span>
            </div>
        </div>

    </div>

    <!-- ── ROW: statuts + actions rapides ── -->
    <div class="row-2-1">

        <!-- Statuts commandes -->
        <div class="panel au d1">
            <div class="panel-photo-bg" style="background-image:url('https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=900&q=65&auto=format&fit=crop');"></div>
            <div class="panel-inner">
                <div class="panel-head">
                    <div class="panel-head-icon"><i class="fas fa-chart-pie"></i></div>
                    <div>
                        <div class="panel-head-title">Statut des commandes</div>
                        <div class="panel-head-sub">Répartition en temps réel</div>
                    </div>
                </div>
                <div class="status-grid">
                    <div class="status-tile st-pending">
                        <div class="st-num">{{ $pendingOrders }}</div>
                        <div class="st-lbl">En attente</div>
                    </div>
                    <div class="status-tile st-process">
                        <div class="st-num">{{ $processingOrders }}</div>
                        <div class="st-lbl">En cours</div>
                    </div>
                    <div class="status-tile st-done">
                        <div class="st-num">{{ $completedOrders }}</div>
                        <div class="st-lbl">Terminées</div>
                    </div>
                    <div class="status-tile st-cancel">
                        <div class="st-num">{{ $cancelledOrders }}</div>
                        <div class="st-lbl">Annulées</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="panel au d2">
            <div class="panel-photo-bg" style="background-image:url('https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&q=65&auto=format&fit=crop');"></div>
            <div class="panel-inner">
                <div class="panel-head">
                    <div class="panel-head-icon"><i class="fas fa-bolt"></i></div>
                    <div>
                        <div class="panel-head-title">Actions rapides</div>
                        <div class="panel-head-sub">Raccourcis de gestion</div>
                    </div>
                </div>
                <div class="quick-list">
                    <a href="{{ route('admin.products.create') }}" class="qa-btn qa-blue">
                        <div class="qa-icon"><i class="fas fa-plus"></i></div>
                        <span>Nouveau produit</span>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                    <a href="{{ route('admin.categories.create') }}" class="qa-btn qa-green">
                        <div class="qa-icon"><i class="fas fa-folder-plus"></i></div>
                        <span>Nouvelle catégorie</span>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                    <a href="{{ route('admin.users.index') }}" class="qa-btn qa-purple">
                        <div class="qa-icon"><i class="fas fa-users"></i></div>
                        <span>Gérer les clients</span>
                        <i class="fas fa-chevron-right qa-arrow"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ── ROW: clients + commandes ── -->
    <div class="row-2">

        <!-- Nouveaux clients -->
        <div class="panel au d1">
            <div class="panel-photo-bg" style="background-image:url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?w=700&q=65&auto=format&fit=crop');"></div>
            <div class="panel-inner">
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(26,108,255,.14);color:#6ca3ff;"><i class="fas fa-user-plus"></i></div>
                    <div>
                        <div class="panel-head-title">Nouveaux clients</div>
                        <div class="panel-head-sub">Inscriptions récentes</div>
                    </div>
                </div>
                <div class="item-list">
                    @foreach($recentUsers as $user)
                    <div class="item-row">
                        <div class="item-left">
                            <div class="avatar" style="background:linear-gradient(135deg,#1a4fff,#00b4ff);">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="item-name">{{ $user->name }}</div>
                                <div class="item-meta">{{ $user->email }}</div>
                            </div>
                        </div>
                        <a href="{{ route('admin.users.show', $user) }}" class="eye-btn">
                            <i class="fas fa-eye"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
                <div class="panel-foot">
                    <a href="{{ route('admin.users.index') }}">
                        Voir tous les clients <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Dernières commandes -->
        <div class="panel au d2">
            <div class="panel-photo-bg" style="background-image:url('https://images.unsplash.com/photo-1563013544-824ae1b704d3?w=700&q=65&auto=format&fit=crop');"></div>
            <div class="panel-inner">
                <div class="panel-head">
                    <div class="panel-head-icon" style="background:rgba(124,58,237,.14);color:#a78bfa;"><i class="fas fa-shopping-bag"></i></div>
                    <div>
                        <div class="panel-head-title">Dernières commandes</div>
                        <div class="panel-head-sub">Activité récente</div>
                    </div>
                </div>
                <div class="item-list">
                    @foreach($recentOrders as $order)
                    <div class="item-row">
                        <div class="item-left">
                            <div class="avatar" style="background:linear-gradient(135deg,#7c3aed,#a855f7);">
                                #
                            </div>
                            <div>
                                <div class="item-name">#{{ $order->order_number }}</div>
                                <div class="item-meta">{{ $order->user->name }} · {{ number_format($order->total_amount, 0, ',', ' ') }} FCFA</div>
                            </div>
                        </div>
                        <div class="item-right">
                            <span class="obadge ob-{{ $order->status }}">{{ $order->status }}</span>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="eye-btn">
                                <i class="fas fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="panel-foot">
                    <a href="{{ route('admin.orders.index') }}">
                        Voir toutes les commandes <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                    </a>
                </div>
            </div>
        </div>

    </div>

    <!-- ── ROW: derniers produits ── -->
    <div class="row-1">
        <div class="panel au">
            <div class="panel-photo-bg" style="background-image:url('https://images.unsplash.com/photo-1441986300917-64674bd600d8?w=1400&q=65&auto=format&fit=crop');"></div>
            <div class="panel-inner">
                <div class="panel-head">
                    <div class="panel-head-icon"><i class="fas fa-fire"></i></div>
                    <div>
                        <div class="panel-head-title">Derniers produits ajoutés</div>
                        <div class="panel-head-sub">Catalogue récent</div>
                    </div>
                    <a href="{{ route('admin.products.create') }}"
                       style="margin-left:auto;display:inline-flex;align-items:center;gap:7px;
                              background:rgba(245,166,35,.10);border:1px solid rgba(245,166,35,.22);
                              color:var(--gold);font-size:.78rem;font-weight:700;
                              padding:8px 16px;border-radius:9px;text-decoration:none;
                              transition:all .3s;letter-spacing:.3px;"
                       onmouseover="this.style.background='rgba(245,166,35,.18)'"
                       onmouseout="this.style.background='rgba(245,166,35,.10)'">
                        <i class="fas fa-plus" style="font-size:11px;"></i> Ajouter
                    </a>
                </div>
                <div class="prod-grid">
                    @foreach($recentProducts as $product)
                    <div class="pcard">
                        <div class="pcard-img">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                            @else
                                <div class="no-img"><i class="fas fa-image"></i></div>
                            @endif
                        </div>
                        <div class="pcard-body">
                            <div class="pcard-cat">{{ $product->category->name }}</div>
                            <div class="pcard-name">{{ $product->name }}</div>
                            <div class="pcard-price">{{ number_format($product->price, 0, ',', ' ') }} FCFA</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="panel-foot">
                    <a href="{{ route('admin.products.index') }}">
                        Voir tous les produits <i class="fas fa-arrow-right" style="font-size:9px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

</div><!-- /content -->
</main>

</body>
</html>