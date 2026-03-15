<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CYCO MARKET</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold:        #f5a623;
            --gold-light:  #ffd280;
            --gold-dark:   #c47d0e;
            --bg-deep:     #080c14;
            --bg-dark:     #0d1220;
            --bg-card:     #121928;
            --bg-card2:    #161e2e;
            --border:      rgba(245,166,35,0.15);
            --border-dim:  rgba(255,255,255,0.06);
            --text:        #e8eaf0;
            --text-dim:    #7a8299;
            --accent-blue: #1a6cff;
            --accent-teal: #00d4aa;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body {
            background: var(--bg-deep);
            color: var(--text);
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
        }
        body::before {
            content: '';
            position: fixed; inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 10% 10%,  rgba(26,108,255,0.07) 0%, transparent 60%),
                radial-gradient(ellipse 60% 50% at 90% 80%,  rgba(245,166,35,0.06) 0%, transparent 60%),
                radial-gradient(ellipse 50% 40% at 50% 50%,  rgba(0,212,170,0.03) 0%, transparent 70%);
            pointer-events: none; z-index: 0;
        }
        @keyframes fadeUp   { from{opacity:0;transform:translateY(32px);}to{opacity:1;transform:translateY(0);} }
        @keyframes shimmer  { 0%{background-position:-200% center;}100%{background-position:200% center;} }
        @keyframes scanline { 0%{transform:translateY(-100%);}100%{transform:translateY(100vh);} }
        @keyframes floatY   { 0%,100%{transform:translateY(0);}50%{transform:translateY(-18px);} }
        @keyframes pulse2   { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.35);}70%{box-shadow:0 0 0 12px rgba(245,166,35,0);} }
        .au  { animation: fadeUp .7s ease both; }
        .d1  { animation-delay:.1s; } .d2{animation-delay:.2s;} .d3{animation-delay:.3s;} .d4{animation-delay:.4s;} .d5{animation-delay:.5s;}

        /* NAV */
        nav {
            position:sticky; top:0; z-index:200;
            background:rgba(8,12,20,.88);
            backdrop-filter:blur(20px) saturate(160%);
            border-bottom:1px solid rgba(255,255,255,.05);
            padding:0 40px; height:68px;
            display:flex; align-items:center; justify-content:space-between;
        }
        .logo {
            font-family:'Playfair Display',serif; font-weight:900; font-size:1.55rem;
            background:linear-gradient(90deg,var(--gold-light),var(--gold),#ff9d00);
            background-size:200% auto;
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
            animation:shimmer 4s linear infinite; letter-spacing:.5px; text-decoration:none;
        }
        .nav-links { display:flex; align-items:center; gap:36px; }
        .nav-link {
            color:var(--text-dim); font-size:.875rem; font-weight:500;
            text-decoration:none; letter-spacing:.3px; transition:color .3s; position:relative;
        }
        .nav-link::after {
            content:''; position:absolute; bottom:-4px; left:0;
            width:0; height:1px;
            background:linear-gradient(90deg,var(--gold),var(--gold-light));
            transition:width .3s;
        }
        .nav-link:hover { color:var(--gold-light); }
        .nav-link:hover::after { width:100%; }

        /* BUTTONS */
        .btn-gold {
            background:linear-gradient(135deg,var(--gold-dark),var(--gold),var(--gold-light));
            background-size:200% auto;
            color:#080c14; font-weight:700; font-size:.875rem;
            padding:11px 24px; border-radius:8px; border:none; cursor:pointer;
            display:inline-flex; align-items:center; gap:8px;
            text-decoration:none; transition:all .3s;
            animation:shimmer 3s linear infinite; letter-spacing:.3px;
        }
        .btn-gold:hover { transform:translateY(-2px); box-shadow:0 8px 28px rgba(245,166,35,.40); }
        .btn-outline {
            border:1px solid rgba(245,166,35,.4); color:var(--gold-light); background:transparent;
            font-weight:600; font-size:.875rem; padding:10px 22px; border-radius:8px; cursor:pointer;
            display:inline-flex; align-items:center; gap:8px; text-decoration:none; transition:all .3s;
        }
        .btn-outline:hover { background:rgba(245,166,35,.08); border-color:var(--gold); box-shadow:0 0 16px rgba(245,166,35,.15); }
        .btn-ghost {
            color:var(--text-dim); background:rgba(255,255,255,.04); border:1px solid rgba(255,255,255,.08);
            font-weight:500; font-size:.875rem; padding:10px 20px; border-radius:8px; cursor:pointer;
            display:inline-flex; align-items:center; gap:8px; text-decoration:none; transition:all .3s;
        }
        .btn-ghost:hover { background:rgba(255,255,255,.08); color:var(--text); }
        .btn-admin {
            background:linear-gradient(135deg,#f59e0b,#fbbf24); color:#1a1000; font-weight:700;
            font-size:.8rem; padding:9px 18px; border-radius:7px; border:none; cursor:pointer;
            display:inline-flex; align-items:center; gap:6px; text-decoration:none; transition:all .3s;
        }
        .btn-admin:hover { transform:translateY(-1px); box-shadow:0 6px 20px rgba(245,158,11,.35); }

        /* HERO */
        .hero {
            position:relative; min-height:100vh;
            display:flex; align-items:center; overflow:hidden; padding:80px 40px;
        }
        .hero-bg {
            position:absolute; inset:0; z-index:0;
            background:
                linear-gradient(180deg,rgba(8,12,20,.92) 0%,rgba(8,12,20,.65) 50%,rgba(8,12,20,.96) 100%),
                url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1800&q=80&auto=format&fit=crop') center/cover no-repeat;
        }
        .hero-grid {
            position:absolute; inset:0; z-index:1;
            background-image:
                linear-gradient(rgba(245,166,35,.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(245,166,35,.03) 1px, transparent 1px);
            background-size:60px 60px;
        }
        .hero-scan {
            position:absolute; left:0; right:0; height:2px;
            background:linear-gradient(90deg,transparent,rgba(245,166,35,.22),transparent);
            animation:scanline 8s linear infinite; z-index:2; pointer-events:none;
        }
        .orb { position:absolute; border-radius:50%; filter:blur(90px); pointer-events:none; z-index:1; }
        .orb-1 { width:500px;height:500px; background:rgba(26,108,255,.11); top:-100px;right:-80px; animation:floatY 12s ease-in-out infinite; }
        .orb-2 { width:400px;height:400px; background:rgba(245,166,35,.08); bottom:-60px;left:-60px; animation:floatY 16s ease-in-out infinite reverse; }
        .orb-3 { width:280px;height:280px; background:rgba(0,212,170,.06); top:30%;left:42%; animation:floatY 9s ease-in-out infinite 2s; }
        .hero-content { position:relative; z-index:3; max-width:1280px; margin:0 auto; width:100%; }

        .hero-badge {
            display:inline-flex; align-items:center; gap:10px;
            border:1px solid rgba(245,166,35,.28); background:rgba(245,166,35,.06);
            backdrop-filter:blur(10px); color:var(--gold-light);
            padding:7px 18px; border-radius:100px; font-size:12px; font-weight:600;
            letter-spacing:1.5px; text-transform:uppercase; margin-bottom:28px;
        }
        .hero-badge .dot { width:7px;height:7px;border-radius:50%;background:var(--gold);animation:pulse2 2s infinite;display:inline-block; }
        .hero-title {
            font-family:'Playfair Display',serif;
            font-size:clamp(3rem,6vw,5.5rem); font-weight:900;
            line-height:1.05; letter-spacing:-1.5px; color:var(--text); margin-bottom:24px;
        }
        .hero-title em {
            font-style:normal;
            background:linear-gradient(90deg,var(--gold-light),var(--gold),#ff9d00);
            background-size:200% auto;
            -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text;
            animation:shimmer 3s linear infinite;
        }
        .hero-desc { color:rgba(232,234,240,.6); font-size:1.1rem; line-height:1.75; max-width:520px; margin-bottom:40px; font-weight:300; }
        .hero-actions { display:flex; flex-wrap:wrap; gap:12px; margin-bottom:52px; }
        .hero-trust { display:flex; flex-wrap:wrap; gap:28px; padding-top:36px; border-top:1px solid rgba(255,255,255,.06); }
        .trust-pill { display:flex; align-items:center; gap:10px; color:rgba(232,234,240,.5); font-size:.82rem; font-weight:500; }
        .trust-pill .icon {
            width:32px;height:32px; background:rgba(245,166,35,.10); border:1px solid rgba(245,166,35,.20);
            border-radius:8px; display:flex; align-items:center; justify-content:center;
            color:var(--gold); font-size:13px;
        }
        .hero-card {
            background:rgba(18,25,40,.80); border:1px solid rgba(245,166,35,.18);
            backdrop-filter:blur(24px); border-radius:20px; padding:32px;
            animation:floatY 6s ease-in-out infinite;
        }
        .hero-card-title {
            font-family:'Playfair Display',serif; font-size:1rem; color:var(--gold-light);
            letter-spacing:.5px; margin-bottom:20px; display:flex; align-items:center; gap:8px;
        }
        .metric-row {
            display:flex; align-items:center; gap:14px; padding:14px;
            background:rgba(255,255,255,.03); border:1px solid rgba(255,255,255,.06);
            border-radius:12px; margin-bottom:10px; transition:border-color .3s;
        }
        .metric-row:hover { border-color:rgba(245,166,35,.22); }
        .metric-icon { width:40px;height:40px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0; }
        .metric-label { font-size:.82rem; color:var(--text-dim); }
        .metric-val   { font-size:.9rem; color:var(--text); font-weight:600; }
        .metric-badge { margin-left:auto; font-size:11px; font-weight:700; padding:3px 9px; border-radius:20px; }
        .badge-green { background:rgba(0,212,170,.15); color:#00d4aa; }
        .badge-gold  { background:rgba(245,166,35,.15); color:var(--gold); }

        /* SECTIONS */
        section { position:relative; z-index:1; }
        .section-inner { max-width:1280px; margin:0 auto; padding:0 40px; }
        .section-head { text-align:center; margin-bottom:56px; }
        .section-eyebrow {
            display:inline-flex; align-items:center; gap:8px;
            font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
            color:var(--gold); margin-bottom:14px;
        }
        .section-eyebrow::before,.section-eyebrow::after { content:'';display:block;width:28px;height:1px; }
        .section-eyebrow::before { background:linear-gradient(90deg,transparent,var(--gold)); }
        .section-eyebrow::after  { background:linear-gradient(90deg,var(--gold),transparent); }
        .section-title-main {
            font-family:'Playfair Display',serif;
            font-size:clamp(2rem,3.5vw,3rem); font-weight:800; color:var(--text); line-height:1.15;
        }
        .section-sub-text { color:var(--text-dim); font-size:.975rem; margin-top:12px; font-weight:300; }

        /* FEATURES */
        .features-bg { padding:100px 0; background:linear-gradient(180deg,var(--bg-deep) 0%,var(--bg-dark) 100%); }
        .feat-card {
            background:var(--bg-card); border:1px solid rgba(255,255,255,.06);
            border-radius:18px; padding:36px 28px; text-align:center;
            transition:all .4s; position:relative; overflow:hidden;
        }
        .feat-card::before { content:'';position:absolute;inset:0;background:linear-gradient(135deg,rgba(245,166,35,.04) 0%,transparent 60%);opacity:0;transition:opacity .4s; }
        .feat-card:hover { border-color:rgba(245,166,35,.35); transform:translateY(-6px); box-shadow:0 20px 48px rgba(0,0,0,.4); }
        .feat-card:hover::before { opacity:1; }
        .feat-icon {
            width:64px;height:64px;border-radius:16px;
            background:linear-gradient(135deg,rgba(245,166,35,.12),rgba(245,166,35,.05));
            border:1px solid rgba(245,166,35,.2);
            display:flex;align-items:center;justify-content:center;
            margin:0 auto 20px; font-size:26px; color:var(--gold); transition:all .4s;
        }
        .feat-card:hover .feat-icon { background:linear-gradient(135deg,var(--gold-dark),var(--gold)); border-color:transparent; color:#080c14; box-shadow:0 8px 24px rgba(245,166,35,.35); }
        .feat-title { font-family:'Playfair Display',serif; font-size:1.15rem; color:var(--text); margin-bottom:10px; }
        .feat-text  { color:var(--text-dim); font-size:.875rem; line-height:1.7; font-weight:300; }

        /* CATEGORIES */
        .categories-bg { padding:100px 0; background:var(--bg-dark); }
        .cat-card {
            position:relative; overflow:hidden; border-radius:16px; height:220px; display:block;
            border:1px solid rgba(255,255,255,.06); transition:all .4s;
        }
        .cat-card img { width:100%;height:100%;object-fit:cover;transition:transform .5s; }
        .cat-card:hover img { transform:scale(1.1); }
        .cat-card:hover { border-color:rgba(245,166,35,.4); box-shadow:0 16px 40px rgba(0,0,0,.5); }
        .cat-overlay {
            position:absolute;inset:0;
            background:linear-gradient(to top,rgba(5,8,16,.88) 0%,rgba(5,8,16,.2) 55%,transparent 100%);
            display:flex;align-items:flex-end;padding:20px;
        }
        .cat-no-img { width:100%;height:100%;background:linear-gradient(135deg,var(--bg-card),var(--bg-card2));display:flex;align-items:center;justify-content:center;color:rgba(245,166,35,.2);font-size:44px; }
        .cat-name  { font-family:'Playfair Display',serif;font-size:.95rem;color:var(--text);font-weight:700; }
        .cat-count { font-size:11px;color:rgba(245,166,35,.7);margin-top:2px; }

        /* PRODUCTS */
        .products-bg { padding:100px 0; background:linear-gradient(180deg,var(--bg-dark) 0%,var(--bg-deep) 100%); }
        .prod-card {
            background:var(--bg-card); border:1px solid rgba(255,255,255,.06);
            border-radius:16px; overflow:hidden; display:flex; flex-direction:column;
            height:100%; transition:all .4s;
        }
        .prod-card:hover { border-color:rgba(245,166,35,.32); box-shadow:0 20px 50px rgba(0,0,0,.45); transform:translateY(-5px); }
        .prod-img { height:185px;overflow:hidden;background:linear-gradient(135deg,var(--bg-card2),#1a2235);position:relative; }
        .prod-img img { width:100%;height:100%;object-fit:cover;transition:transform .4s; }
        .prod-card:hover .prod-img img { transform:scale(1.07); }
        .prod-placeholder { width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:rgba(245,166,35,.18);font-size:36px; }
        .prod-body { padding:18px;flex:1;display:flex;flex-direction:column; }
        .prod-cat  { font-size:10px;font-weight:700;letter-spacing:1.2px;text-transform:uppercase;color:var(--gold);margin-bottom:6px; }
        .prod-name { font-size:.9rem;font-weight:600;color:var(--text);line-height:1.4;margin-bottom:12px;flex:1; }
        .prod-price { font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:var(--gold-light); }
        .prod-stock { font-size:11px;color:var(--text-dim);background:rgba(255,255,255,.04);border-radius:20px;padding:3px 8px; }
        .prod-add {
            background:linear-gradient(135deg,var(--gold-dark),var(--gold));
            background-size:200% auto; animation:shimmer 4s linear infinite;
            color:#080c14;font-weight:700;font-size:.8rem; border:none;cursor:pointer;
            border-radius:7px;padding:9px 14px;flex:1;
            display:inline-flex;align-items:center;justify-content:center;gap:6px;
            text-decoration:none;transition:all .3s;
        }
        .prod-add:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(245,166,35,.35); }
        .prod-qty {
            width:52px; background:var(--bg-card2); border:1px solid rgba(255,255,255,.08);
            color:var(--text); border-radius:7px; padding:8px 6px; text-align:center; font-size:.82rem; transition:border-color .3s;
        }
        .prod-qty:focus { outline:none; border-color:rgba(245,166,35,.4); }
        .prod-badge { position:absolute;top:10px;right:10px;font-size:10px;font-weight:700;padding:3px 10px;border-radius:20px;letter-spacing:.3px; }
        .badge-warning { background:rgba(255,140,0,.18);color:#ffaa33;border:1px solid rgba(255,140,0,.3); }
        .badge-danger  { background:rgba(255,60,60,.18);color:#ff6060;border:1px solid rgba(255,60,60,.3); }
        .prod-view { font-size:.78rem;color:var(--text-dim);text-align:center;text-decoration:none;display:block;margin-top:8px;transition:color .3s; }
        .prod-view:hover { color:var(--gold-light); }

        /* STATS */
        .stats-bg {
            padding:90px 0;
            background:linear-gradient(135deg,#0a0f1c 0%,#0d1525 50%,#0a1020 100%);
            position:relative;overflow:hidden;
        }
        .stats-bg::before {
            content:'';position:absolute;inset:0;
            background-image:linear-gradient(rgba(245,166,35,.05) 1px,transparent 1px),linear-gradient(90deg,rgba(245,166,35,.05) 1px,transparent 1px);
            background-size:80px 80px;
        }
        .stats-bg::after {
            content:'';position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);
            width:600px;height:300px;
            background:radial-gradient(ellipse,rgba(245,166,35,.08) 0%,transparent 70%);
            pointer-events:none;
        }
        .stat-item { text-align:center;position:relative;z-index:1; }
        .stat-num {
            font-family:'Playfair Display',serif;
            font-size:clamp(2.8rem,4vw,4rem);font-weight:900;line-height:1;
            background:linear-gradient(90deg,var(--gold-light),var(--gold),#ff9d00);
            background-size:200% auto;
            -webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;
            animation:shimmer 3.5s linear infinite;margin-bottom:8px;
        }
        .stat-lbl { font-size:.9rem;color:rgba(232,234,240,.5);font-weight:500;letter-spacing:.5px; }
        .stat-sep { width:1px;background:linear-gradient(180deg,transparent,rgba(245,166,35,.2),transparent);align-self:stretch; }

        /* TESTIMONIALS */
        .testim-bg { padding:100px 0; background:var(--bg-dark); }
        .testim-card {
            background:var(--bg-card); border:1px solid rgba(255,255,255,.06);
            border-radius:18px; padding:32px; position:relative;overflow:hidden; transition:all .4s;
        }
        .testim-card::before {
            content:'"';position:absolute;top:-14px;right:20px;
            font-family:'Playfair Display',serif;font-size:140px;line-height:1;
            color:var(--gold);opacity:.06;pointer-events:none;
        }
        .testim-card:hover { border-color:rgba(245,166,35,.30);box-shadow:0 16px 44px rgba(0,0,0,.4);transform:translateY(-5px); }
        .star-row { display:flex;gap:4px;color:var(--gold);margin-bottom:16px;font-size:13px; }
        .testim-text { color:var(--text-dim);font-size:.9rem;line-height:1.75;margin-bottom:22px;font-weight:300; }
        .testim-avatar { width:44px;height:44px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-size:1.1rem;font-weight:700;color:#080c14;flex-shrink:0; }
        .testim-name  { font-weight:700;font-size:.9rem;color:var(--text); }
        .testim-since { font-size:.75rem;color:var(--text-dim); }

        /* NEWSLETTER */
        .newsletter-bg {
            padding:80px 0;
            background:linear-gradient(135deg,rgba(245,166,35,.06) 0%,transparent 50%),var(--bg-deep);
            border-top:1px solid rgba(245,166,35,.10);border-bottom:1px solid rgba(245,166,35,.10);
        }
        .nl-inner { max-width:580px;margin:0 auto;text-align:center;padding:0 24px; }
        .nl-title { font-family:'Playfair Display',serif;font-size:2.2rem;font-weight:800;color:var(--text);margin-bottom:12px; }
        .nl-sub { color:var(--text-dim);font-size:.95rem;margin-bottom:28px;font-weight:300; }
        .nl-input {
            flex:1;background:rgba(255,255,255,.04);border:1px solid rgba(245,166,35,.2);
            border-radius:9px;padding:13px 18px;color:var(--text);
            font-family:'Outfit',sans-serif;font-size:.9rem;transition:all .3s;
        }
        .nl-input::placeholder { color:var(--text-dim); }
        .nl-input:focus { outline:none;border-color:rgba(245,166,35,.5);box-shadow:0 0 0 3px rgba(245,166,35,.08); }

        /* CONTACT */
        .contact-bg { padding:100px 0;background:linear-gradient(180deg,var(--bg-deep) 0%,var(--bg-dark) 100%); }
        .contact-info-card { display:flex;align-items:center;gap:16px;background:var(--bg-card);border:1px solid rgba(255,255,255,.06);border-radius:14px;padding:20px;transition:all .3s; }
        .contact-info-card:hover { border-color:rgba(245,166,35,.28);transform:translateX(5px); }
        .ci-icon { width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(245,166,35,.12),rgba(245,166,35,.05));border:1px solid rgba(245,166,35,.2);display:flex;align-items:center;justify-content:center;color:var(--gold);font-size:18px;flex-shrink:0; }
        .ci-label { font-size:.75rem;color:var(--text-dim);letter-spacing:.3px;text-transform:uppercase; }
        .ci-val   { font-size:.9rem;color:var(--text);font-weight:500;margin-top:2px; }
        .form-card { background:var(--bg-card);border:1px solid rgba(255,255,255,.06);border-radius:20px;padding:36px; }
        .dark-input {
            width:100%;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
            border-radius:9px;padding:13px 16px;color:var(--text);
            font-family:'Outfit',sans-serif;font-size:.9rem;transition:all .3s;
        }
        .dark-input::placeholder { color:var(--text-dim); }
        .dark-input:focus { outline:none;border-color:rgba(245,166,35,.4);box-shadow:0 0 0 3px rgba(245,166,35,.07);background:rgba(255,255,255,.05); }

        /* FOOTER */
        footer { background:#05070f;border-top:1px solid rgba(245,166,35,.08);padding:60px 40px 30px; }
        .footer-logo { font-family:'Playfair Display',serif;font-size:1.35rem;font-weight:900;background:linear-gradient(90deg,var(--gold-light),var(--gold));background-size:200% auto;-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text;animation:shimmer 4s linear infinite; }
        .footer-link { color:rgba(255,255,255,.3);font-size:.85rem;text-decoration:none;display:block;margin-bottom:10px;transition:color .3s; }
        .footer-link:hover { color:var(--gold-light); }
        .footer-section-title { color:rgba(255,255,255,.55);font-size:.75rem;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;margin-bottom:16px; }
        .social-btn { width:38px;height:38px;background:rgba(255,255,255,.05);border:1px solid rgba(255,255,255,.08);border-radius:9px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.4);font-size:14px;text-decoration:none;transition:all .3s; }
        .social-btn:hover { background:linear-gradient(135deg,var(--gold-dark),var(--gold));border-color:transparent;color:#080c14;transform:translateY(-2px);box-shadow:0 6px 16px rgba(245,166,35,.3); }
        .scroll-top { width:44px;height:44px;background:linear-gradient(135deg,var(--gold-dark),var(--gold));border:none;border-radius:9px;display:flex;align-items:center;justify-content:center;color:#080c14;font-size:16px;cursor:pointer;transition:all .3s;box-shadow:0 4px 14px rgba(245,166,35,.3); }
        .scroll-top:hover { transform:translateY(-2px);box-shadow:0 8px 22px rgba(245,166,35,.4); }

        @media(max-width:1024px) {
            .hero-grid-2col { grid-template-columns:1fr !important; }
            #hero-side-card { display:none !important; }
        }
        @media(max-width:768px) {
            nav { padding:0 20px; }
            .nav-links { display:none; }
            .hero { padding:60px 20px; }
            .section-inner { padding:0 20px; }
            .stat-sep { display:none; }
            footer { padding:48px 20px 24px; }
            .contact-grid { grid-template-columns:1fr !important; }
            .footer-grid  { grid-template-columns:1fr 1fr !important; }
        }
        @media(max-width:480px) {
            .footer-grid { grid-template-columns:1fr !important; }
        }
    </style>
</head>
<body>

    @auth
        <div style="position:fixed;bottom:80px;right:16px;z-index:999;background:rgba(245,166,35,.07);backdrop-filter:blur(12px);border:1px solid rgba(245,166,35,.18);border-radius:10px;padding:8px 14px;font-size:11px;color:var(--gold);letter-spacing:.3px;">
            <i class="fas fa-circle" style="font-size:7px;color:#00d4aa;margin-right:6px;"></i>
            {{ Auth::user()->name }} · {{ Auth::user()->role }}
        </div>
    @endauth

    <!-- ══ NAV ══ -->
    <nav>
        <a href="/" class="logo">CYCO MARKET</a>
        <div class="nav-links">
            <a href="#features"   class="nav-link">Fonctionnalités</a>
            <a href="#categories" class="nav-link">Catégories</a>
            <a href="#products"   class="nav-link">Produits</a>
            <a href="#stats"      class="nav-link">Statistiques</a>
            <a href="#contact"    class="nav-link">Contact</a>
        </div>
        <div style="display:flex;align-items:center;gap:10px;">
            @auth
                @if(Auth::user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="btn-admin">
                        <i class="fas fa-user-shield"></i> Admin
                    </a>
                @endif
                <div style="position:relative;" id="user-dropdown-wrap">
                    <button onclick="toggleDropdown()" id="user-dropdown-btn" class="btn-ghost" style="gap:8px;">
                        <i class="fas fa-user-circle" style="color:var(--gold);"></i>
                        {{ Auth::user()->name }}
                        <i class="fas fa-chevron-down" id="dropdown-chevron" style="font-size:10px;transition:transform .25s;"></i>
                    </button>
                    <div id="user-dropdown-menu"
                         style="display:none;position:absolute;right:0;top:calc(100% + 10px);width:230px;
                                background:var(--bg-card);border:1px solid rgba(245,166,35,.22);
                                border-radius:14px;overflow:hidden;z-index:500;
                                box-shadow:0 24px 56px rgba(0,0,0,.7);
                                animation:fadeUp .2s ease both;">

                        {{-- Header utilisateur --}}
                        <div style="padding:14px 18px 12px;border-bottom:1px solid rgba(255,255,255,.05);display:flex;align-items:center;gap:10px;">
                            <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,var(--gold-dark),var(--gold));display:flex;align-items:center;justify-content:center;font-family:'Playfair Display',serif;font-weight:700;color:#080c14;font-size:.95rem;flex-shrink:0;">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div>
                                <div style="color:var(--text);font-size:.85rem;font-weight:600;">{{ Auth::user()->name }}</div>
                                <div style="color:var(--gold);font-size:.72rem;letter-spacing:.5px;text-transform:uppercase;">{{ Auth::user()->role }}</div>
                            </div>
                        </div>

                        {{-- Liens --}}
                        @if(Auth::user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="dd-item"
                               style="display:flex;align-items:center;gap:12px;padding:13px 18px;color:var(--text-dim);font-size:.85rem;text-decoration:none;transition:background .2s,color .2s;"
                               onmouseover="this.style.background='rgba(245,166,35,.07)';this.style.color='var(--gold-light)'"
                               onmouseout="this.style.background='transparent';this.style.color='var(--text-dim)'">
                                <i class="fas fa-gauge-high" style="color:var(--gold);width:15px;text-align:center;"></i>Dashboard
                            </a>
                        @endif

                        <a href="{{ route('orders.index') }}"
                           class="dd-item"
                           style="display:flex;align-items:center;gap:12px;padding:13px 18px;color:var(--text-dim);font-size:.85rem;text-decoration:none;transition:background .2s,color .2s;"
                           onmouseover="this.style.background='rgba(245,166,35,.07)';this.style.color='var(--gold-light)'"
                           onmouseout="this.style.background='transparent';this.style.color='var(--text-dim)'">
                            <i class="fas fa-box" style="color:var(--gold);width:15px;text-align:center;"></i>Mes commandes
                        </a>

                        <a href="{{ route('cart.index') }}"
                           class="dd-item"
                           style="display:flex;align-items:center;gap:12px;padding:13px 18px;color:var(--text-dim);font-size:.85rem;text-decoration:none;transition:background .2s,color .2s;"
                           onmouseover="this.style.background='rgba(245,166,35,.07)';this.style.color='var(--gold-light)'"
                           onmouseout="this.style.background='transparent';this.style.color='var(--text-dim)'">
                            <i class="fas fa-shopping-cart" style="color:var(--gold);width:15px;text-align:center;"></i>Mon panier
                        </a>

                        <div style="height:1px;background:rgba(255,255,255,.05);margin:4px 0;"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                    style="width:100%;display:flex;align-items:center;gap:12px;padding:13px 18px;
                                           color:#ff6868;font-size:.85rem;background:transparent;border:none;
                                           cursor:pointer;text-align:left;font-family:'Outfit',sans-serif;transition:background .2s;"
                                    onmouseover="this.style.background='rgba(255,60,60,.08)'"
                                    onmouseout="this.style.background='transparent'">
                                <i class="fas fa-sign-out-alt" style="width:15px;text-align:center;"></i>Déconnexion
                            </button>
                        </form>
                    </div>
                </div>

                <script>
                    function toggleDropdown() {
                        var menu     = document.getElementById('user-dropdown-menu');
                        var chevron  = document.getElementById('dropdown-chevron');
                        var isOpen   = menu.style.display === 'block';
                        menu.style.display   = isOpen ? 'none'   : 'block';
                        chevron.style.transform = isOpen ? 'rotate(0deg)' : 'rotate(180deg)';
                    }
                    // Fermer en cliquant en dehors
                    document.addEventListener('click', function(e) {
                        var wrap = document.getElementById('user-dropdown-wrap');
                        if (wrap && !wrap.contains(e.target)) {
                            var menu    = document.getElementById('user-dropdown-menu');
                            var chevron = document.getElementById('dropdown-chevron');
                            if (menu)    menu.style.display = 'none';
                            if (chevron) chevron.style.transform = 'rotate(0deg)';
                        }
                    });
                </script>
            @else
                <a href="{{ route('login') }}"    class="btn-ghost">Connexion</a>
                <a href="{{ route('register') }}" class="btn-gold">Inscription</a>
            @endauth
        </div>
    </nav>

    <!-- ══ HERO ══ -->
    <section class="hero" id="home">
        <div class="hero-bg"></div>
        <div class="hero-grid"></div>
        <div class="hero-scan"></div>
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
        <div class="hero-content">
            <div class="hero-grid-2col" style="display:grid;grid-template-columns:1fr 420px;gap:80px;align-items:center;">
                <div>
                    <div class="hero-badge au">
                        <span class="dot"></span>
                        Plateforme premium · Commerce en ligne
                    </div>
                    <h1 class="hero-title au d1">
                        Votre marché<br>
                        <em>nouvelle génération</em>
                    </h1>
                    <p class="hero-desc au d2">
                        Découvrez des milliers de produits de qualité aux meilleurs prix.
                        Paiements sécurisés et livraison rapide partout dans le monde.
                    </p>
                    <div class="hero-actions au d3">
                        <a href="{{ route('products.index') }}" class="btn-gold">
                            <i class="fas fa-store"></i> Découvrir les produits
                        </a>
                        @auth
                            @if(Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}" class="btn-admin" style="font-size:.875rem;">
                                    <i class="fas fa-user-shield"></i> Espace admin
                                </a>
                            @endif
                        @endauth
                        <a href="#features" class="btn-outline">En savoir plus</a>
                    </div>
                    <div class="hero-trust au d4">
                        <div class="trust-pill"><div class="icon"><i class="fas fa-shield-alt"></i></div>Paiement sécurisé</div>
                        <div class="trust-pill"><div class="icon"><i class="fas fa-truck"></i></div>Livraison rapide</div>
                        <div class="trust-pill"><div class="icon"><i class="fas fa-headset"></i></div>Support 24/7</div>
                    </div>
                </div>
                <div id="hero-side-card" class="hero-card au d5">
                    <div class="hero-card-title">
                        <i class="fas fa-chart-line" style="color:var(--gold);"></i> Tableau de bord live
                    </div>
                    <div class="metric-row">
                        <div class="metric-icon" style="background:linear-gradient(135deg,rgba(26,108,255,.2),rgba(26,108,255,.08));color:#5a9aff;"><i class="fas fa-box"></i></div>
                        <div><div class="metric-label">Nouveaux produits</div><div class="metric-val">Cette semaine</div></div>
                        <span class="metric-badge badge-green">+24</span>
                    </div>
                    <div class="metric-row">
                        <div class="metric-icon" style="background:linear-gradient(135deg,rgba(0,212,170,.2),rgba(0,212,170,.08));color:#00d4aa;"><i class="fas fa-users"></i></div>
                        <div><div class="metric-label">Clients satisfaits</div><div class="metric-val">Satisfaction 98%</div></div>
                        <span class="metric-badge badge-gold">5 000+</span>
                    </div>
                    <div class="metric-row">
                        <div class="metric-icon" style="background:linear-gradient(135deg,rgba(245,166,35,.2),rgba(245,166,35,.08));color:var(--gold);"><i class="fas fa-shopping-bag"></i></div>
                        <div><div class="metric-label">Commandes livrées</div><div class="metric-val">Délai moyen 48h</div></div>
                        <span class="metric-badge badge-green">✓</span>
                    </div>
                    <div style="margin-top:18px;padding:14px;background:rgba(0,212,170,.06);border:1px solid rgba(0,212,170,.14);border-radius:10px;display:flex;align-items:center;gap:10px;">
                        <span style="width:8px;height:8px;background:#00d4aa;border-radius:50%;animation:pulse2 2s infinite;display:inline-block;flex-shrink:0;"></span>
                        <span style="font-size:.8rem;color:rgba(0,212,170,.8);">Boutique active · Mise à jour en temps réel</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FEATURES ══ -->
    <section class="features-bg" id="features">
        <div class="section-inner">
            <div class="section-head au">
                <div class="section-eyebrow">Avantages exclusifs</div>
                <h2 class="section-title-main">Pourquoi nous choisir</h2>
                <p class="section-sub-text">Une plateforme conçue pour votre confort et sécurité</p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">
                <div class="feat-card au d1">
                    <div class="feat-icon"><i class="fas fa-shield-alt"></i></div>
                    <div class="feat-title">Paiement sécurisé</div>
                    <p class="feat-text">Transactions 100% protégées avec les meilleures méthodes de paiement du marché</p>
                </div>
                <div class="feat-card au d2">
                    <div class="feat-icon"><i class="fas fa-truck"></i></div>
                    <div class="feat-title">Livraison express</div>
                    <p class="feat-text">Service de livraison rapide avec suivi en temps réel de vos commandes</p>
                </div>
                <div class="feat-card au d3">
                    <div class="feat-icon"><i class="fas fa-headset"></i></div>
                    <div class="feat-title">Support 24/7</div>
                    <p class="feat-text">Une équipe dédiée toujours disponible pour répondre à vos questions</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ CATEGORIES ══ -->
    <section class="categories-bg" id="categories">
        <div class="section-inner">
            <div class="section-head au">
                <div class="section-eyebrow">Explorer</div>
                <h2 class="section-title-main">Catégories populaires</h2>
                <p class="section-sub-text">Explorez notre large sélection de produits</p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                @php $categories = App\Models\Category::withCount('products')->get(); @endphp
                @forelse($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="cat-card">
                    @if($category->image)
                        <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="cat-no-img"><i class="fas fa-tag"></i></div>
                    @endif
                    <div class="cat-overlay">
                        <div>
                            <div class="cat-name">{{ $category->name }}</div>
                            <div class="cat-count"><i class="fas fa-cube" style="margin-right:4px;"></i>{{ $category->products_count }} produits</div>
                        </div>
                    </div>
                </a>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:48px;color:var(--text-dim);">
                        <i class="fas fa-folder-open" style="font-size:2.5rem;opacity:.2;display:block;margin-bottom:12px;"></i>
                        Aucune catégorie disponible.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- ══ PRODUCTS ══ -->
    <section class="products-bg" id="products">
        <div class="section-inner">
            <div class="section-head au">
                <div class="section-eyebrow">Sélection premium</div>
                <h2 class="section-title-main">Produits en vedette</h2>
                <p class="section-sub-text">Les meilleures offres du moment</p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:20px;">
                @php
                    $featuredProducts = App\Models\Product::where('is_active', true)
                                        ->with('category')->latest()->take(8)->get();
                @endphp
                @forelse($featuredProducts as $product)
                <div class="prod-card">
                    <a href="{{ route('products.show', $product->slug) }}">
                        <div class="prod-img">
                            @if($product->images && count($product->images) > 0)
                                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}">
                            @else
                                <div class="prod-placeholder"><i class="fas fa-image"></i></div>
                            @endif
                            @if($product->quantity < 10 && $product->quantity > 0)
                                <span class="prod-badge badge-warning">Plus que {{ $product->quantity }}</span>
                            @endif
                            @if($product->quantity == 0)
                                <span class="prod-badge badge-danger">Rupture</span>
                            @endif
                        </div>
                    </a>
                    <div class="prod-body">
                        <div class="prod-cat">{{ $product->category->name }}</div>
                        <div class="prod-name">{{ $product->name }}</div>
                        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                            <span class="prod-price">{{ number_format($product->price, 0, ',', ' ') }} F</span>
                            <span class="prod-stock">{{ $product->quantity }} dispo</span>
                        </div>
                        @if($product->quantity > 0)
                            <form action="{{ route('cart.add') }}" method="POST" style="display:flex;gap:8px;">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="number" name="quantity" value="{{ $product->min_order_quantity }}"
                                       min="{{ $product->min_order_quantity }}" max="{{ $product->quantity }}"
                                       class="prod-qty">
                                <button type="submit" class="prod-add">
                                    <i class="fas fa-cart-plus"></i> Ajouter
                                </button>
                            </form>
                            <a href="{{ route('products.show', $product->slug) }}" class="prod-view">
                                Voir / Contacter <i class="fas fa-arrow-right" style="font-size:10px;"></i>
                            </a>
                        @else
                            <button disabled style="width:100%;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.06);color:var(--text-dim);padding:10px;border-radius:7px;font-size:.82rem;cursor:not-allowed;font-family:'Outfit',sans-serif;">
                                Indisponible
                            </button>
                        @endif
                    </div>
                </div>
                @empty
                    <div style="grid-column:1/-1;text-align:center;padding:48px;color:var(--text-dim);">
                        <i class="fas fa-box-open" style="font-size:2.5rem;opacity:.2;display:block;margin-bottom:12px;"></i>
                        Aucun produit disponible.
                    </div>
                @endforelse
            </div>
            <div style="text-align:center;margin-top:48px;">
                <a href="{{ route('products.index') }}" class="btn-gold">
                    Voir tous les produits <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- ══ STATS ══ -->
    <section class="stats-bg" id="stats">
        <div class="section-inner">
            @php
                $productsCount   = App\Models\Product::count();
                $usersCount      = App\Models\User::count();
                $ordersCount     = App\Models\Order::count();
                $categoriesCount = App\Models\Category::count();
            @endphp
            <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-around;gap:40px;">
                <div class="stat-item au"><div class="stat-num">{{ $productsCount }}+</div><div class="stat-lbl"><i class="fas fa-box" style="margin-right:6px;"></i>Produits</div></div>
                <div class="stat-sep"></div>
                <div class="stat-item au d1"><div class="stat-num">{{ $usersCount }}+</div><div class="stat-lbl"><i class="fas fa-users" style="margin-right:6px;"></i>Clients</div></div>
                <div class="stat-sep"></div>
                <div class="stat-item au d2"><div class="stat-num">{{ $ordersCount }}+</div><div class="stat-lbl"><i class="fas fa-shopping-bag" style="margin-right:6px;"></i>Commandes</div></div>
                <div class="stat-sep"></div>
                <div class="stat-item au d3"><div class="stat-num">{{ $categoriesCount }}+</div><div class="stat-lbl"><i class="fas fa-tags" style="margin-right:6px;"></i>Catégories</div></div>
            </div>
        </div>
    </section>

    <!-- ══ TESTIMONIALS ══ -->
    <section class="testim-bg" id="testimonials">
        <div class="section-inner">
            <div class="section-head au">
                <div class="section-eyebrow">Avis clients</div>
                <h2 class="section-title-main">Témoignages clients</h2>
                <p class="section-sub-text">Découvrez ce que pensent nos clients</p>
            </div>
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:24px;">
                <div class="testim-card au d1">
                    <div class="star-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="testim-text">"Excellent site ! Produits de qualité et livraison rapide. Je recommande vivement CYCO MARKET."</p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="testim-avatar" style="background:linear-gradient(135deg,#1a6cff,#00c6ff);">J</div>
                        <div><div class="testim-name">Jean Kouassi</div><div class="testim-since">Client depuis 2023</div></div>
                    </div>
                </div>
                <div class="testim-card au d2">
                    <div class="star-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="testim-text">"Service client exceptionnel ! Ils ont répondu rapidement et m'ont aidé à choisir les meilleurs produits."</p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="testim-avatar" style="background:linear-gradient(135deg,#00a86b,#00e676);">M</div>
                        <div><div class="testim-name">Marie Konan</div><div class="testim-since">Client depuis 2024</div></div>
                    </div>
                </div>
                <div class="testim-card au d3">
                    <div class="star-row"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></div>
                    <p class="testim-text">"Large choix, prix compétitifs et interface facile à utiliser. Je fais tous mes achats ici maintenant !"</p>
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div class="testim-avatar" style="background:linear-gradient(135deg,var(--gold-dark),var(--gold));">P</div>
                        <div><div class="testim-name">Paul Yao</div><div class="testim-since">Client depuis 2023</div></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ NEWSLETTER ══ -->
    <section class="newsletter-bg">
        <div class="nl-inner au">
            <div class="section-eyebrow" style="justify-content:center;margin-bottom:14px;">Newsletter</div>
            <div class="nl-title">Restez informé</div>
            <p class="nl-sub">Inscrivez-vous pour recevoir nos offres exclusives et actualités</p>
            <div style="display:flex;gap:10px;max-width:440px;margin:0 auto;">
                <input type="email" placeholder="Votre adresse email" class="nl-input">
                <button class="btn-gold" style="flex-shrink:0;white-space:nowrap;">S'inscrire</button>
            </div>
        </div>
    </section>

    <!-- ══ CONTACT ══ -->
    <section class="contact-bg" id="contact">
        <div class="section-inner">
            <div class="section-head au">
                <div class="section-eyebrow">Nous joindre</div>
                <h2 class="section-title-main">Contactez-nous</h2>
                <p class="section-sub-text">Une question ? Besoin d'aide ? Nous sommes là pour vous</p>
            </div>
            <div class="contact-grid" style="display:grid;grid-template-columns:1fr 1.4fr;gap:48px;align-items:start;">
                <div style="display:flex;flex-direction:column;gap:14px;" class="au d1">
                    <div class="contact-info-card">
                        <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div><div class="ci-label">Adresse</div><div class="ci-val">LOME, TOGO</div></div>
                    </div>
                    <div class="contact-info-card">
                        <div class="ci-icon"><i class="fas fa-phone"></i></div>
                        <div><div class="ci-label">Téléphone</div><div class="ci-val">+228 70197898</div></div>
                    </div>
                    <div class="contact-info-card">
                        <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                        <div><div class="ci-label">Email</div><div class="ci-val">guedeyiborcyrille3@gmail.com</div></div>
                    </div>
                </div>
                <div class="form-card au d2">
                    <div style="display:flex;flex-direction:column;gap:14px;">
                        <input type="text"  placeholder="Votre nom"   class="dark-input">
                        <input type="email" placeholder="Votre email" class="dark-input">
                        <textarea placeholder="Votre message" rows="4" class="dark-input" style="resize:none;"></textarea>
                        <button type="button" class="btn-gold" style="justify-content:center;">
                            <i class="fas fa-paper-plane"></i> Envoyer le message
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ══ FOOTER ══ -->
    <footer>
        <div style="max-width:1280px;margin:0 auto;">
            <div class="footer-grid" style="display:grid;grid-template-columns:1.5fr 1fr 1fr 1fr;gap:40px;margin-bottom:48px;">
                <div>
                    <div class="footer-logo" style="margin-bottom:14px;">CYCO MARKET</div>
                    <p style="color:rgba(255,255,255,.25);font-size:.83rem;line-height:1.75;font-weight:300;">Votre plateforme de commerce en ligne de confiance</p>
                </div>
                <div>
                    <div class="footer-section-title">Liens rapides</div>
                    <a href="#features"   class="footer-link">Fonctionnalités</a>
                    <a href="#categories" class="footer-link">Catégories</a>
                    <a href="#products"   class="footer-link">Produits</a>
                    <a href="#contact"    class="footer-link">Contact</a>
                </div>
                <div>
                    <div class="footer-section-title">Légal</div>
                    <a href="#" class="footer-link">Conditions générales</a>
                    <a href="#" class="footer-link">Politique de confidentialité</a>
                    <a href="#" class="footer-link">Mentions légales</a>
                </div>
                <div>
                    <div class="footer-section-title">Suivez-nous</div>
                    <div style="display:flex;gap:8px;flex-wrap:wrap;">
                        <a href="#" class="social-btn"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-btn"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div style="border-top:1px solid rgba(255,255,255,.05);padding-top:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;">
                <p style="color:rgba(255,255,255,.2);font-size:.8rem;">© 2026 CYCO MARKET. Tous droits réservés .Made by DONA</p>
                <button onclick="window.scrollTo({top:0,behavior:'smooth'})" class="scroll-top">
                    <i class="fas fa-arrow-up"></i>
                </button>
            </div>
        </div>
    </footer>

</body>
</html>