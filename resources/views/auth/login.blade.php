<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion — CYCO MARKET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,800;0,900;1,800&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* ═══════════════════════════════════
       TOKENS
    ═══════════════════════════════════ */
    :root {
        --gold:     #f5a623;
        --gold-lt:  #ffd280;
        --gold-dk:  #c47d0e;
        --bg:       #07090f;
        --bg2:      #0c1120;
        --card:     #101624;
        --card2:    #141c2c;
        --rim:      rgba(255,255,255,.06);
        --rim-gold: rgba(245,166,35,.22);
        --txt:      #dde1ec;
        --txt2:     #6b7591;
        --teal:     #00d2a8;
        --red:      #ef4444;
        --green:    #22c55e;
    }

    /* ═══════════════════════════════════
       RESET
    ═══════════════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
        font-weight: 400;
        color: var(--txt);
        overflow-x: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }

    /* ═══════════════════════════════════
       FULL-PAGE BACKGROUND
    ═══════════════════════════════════ */
    .page-bg {
        position: fixed; inset: 0; z-index: 0;
        background:
            linear-gradient(150deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.80) 50%, rgba(7,9,15,.95) 100%),
            url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1800&q=80&auto=format&fit=crop')
            center / cover no-repeat;
    }
    /* grid overlay */
    .page-bg::after {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(245,166,35,.035) 1px, transparent 1px),
            linear-gradient(90deg, rgba(245,166,35,.035) 1px, transparent 1px);
        background-size: 55px 55px;
    }
    /* ambient mesh */
    .page-mesh {
        position: fixed; inset: 0; z-index: 1; pointer-events: none;
        background:
            radial-gradient(ellipse 55% 50% at  5% 10%,  rgba(26,108,255,.09) 0%, transparent 55%),
            radial-gradient(ellipse 50% 45% at 95% 90%,  rgba(245,166,35,.08) 0%, transparent 55%),
            radial-gradient(ellipse 40% 35% at 55% 45%,  rgba(0,210,168,.04)  0%, transparent 60%);
    }

    /* ═══════════════════════════════════
       SCAN LINE
    ═══════════════════════════════════ */
    @keyframes scan   { 0%{transform:translateY(-100%)} 100%{transform:translateY(200vh)} }
    @keyframes shimmer{ 0%{background-position:-220% center} 100%{background-position:220% center} }
    @keyframes fadeUp { from{opacity:0;transform:translateY(24px)} to{opacity:1;transform:translateY(0)} }
    @keyframes floatY { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-14px)} }
    @keyframes drift  { 0%,100%{transform:translate(0,0) scale(1)} 40%{transform:translate(20px,-16px) scale(1.04)} 70%{transform:translate(-14px,10px) scale(.97)} }
    @keyframes pulse-r{ 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.40)} 65%{box-shadow:0 0 0 10px transparent} }
    @keyframes glow   { 0%,100%{opacity:.5} 50%{opacity:1} }
    @keyframes spin360{ to{transform:rotate(360deg)} }

    .scan-line {
        position: fixed; left: 0; right: 0; height: 1px; z-index: 2; pointer-events: none;
        background: linear-gradient(90deg, transparent 0%, rgba(245,166,35,.30) 50%, transparent 100%);
        animation: scan 9s linear infinite;
    }

    /* ORBS */
    .orb {
        position: fixed; border-radius: 50%;
        filter: blur(90px); pointer-events: none; z-index: 1;
    }
    .orb-1 { width:500px;height:500px; background:rgba(26,108,255,.10); top:-80px; right:-60px;  animation:drift 14s ease-in-out infinite; }
    .orb-2 { width:380px;height:380px; background:rgba(245,166,35,.08); bottom:-60px; left:-40px; animation:drift 18s ease-in-out infinite reverse; }

    /* ═══════════════════════════════════
       WRAPPER
    ═══════════════════════════════════ */
    .wrap {
        position: relative; z-index: 10;
        width: 100%; max-width: 480px;
        animation: fadeUp .7s cubic-bezier(.22,.6,.36,1) both;
    }

    /* ── TOP LOGO ── */
    .top-logo {
        text-align: center; margin-bottom: 36px;
    }
    .logo-link { text-decoration: none; display: inline-block; }
    .logo-text {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.6rem, 6vw, 3.6rem);
        font-weight: 900; letter-spacing: -.5px; line-height: 1;
        background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800, var(--gold-lt));
        background-size: 300% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: shimmer 3.5s linear infinite;
        display: block;
    }
    .logo-sub {
        color: rgba(221,225,236,.50); font-size: .95rem; font-weight: 300;
        letter-spacing: .5px; margin-top: 10px; display: block;
    }
    .logo-divider {
        display: flex; justify-content: center; gap: 8px; margin-top: 14px;
    }
    .logo-divider span {
        height: 3px; border-radius: 3px; display: block;
        background: linear-gradient(90deg, var(--gold-dk), var(--gold));
        animation: shimmer 3s linear infinite;
        background-size: 200% auto;
    }

    /* ── CARD ── */
    .auth-card {
        background: rgba(16,22,36,.90);
        backdrop-filter: blur(28px) saturate(160%);
        border: 1px solid var(--rim-gold);
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 40px 80px rgba(0,0,0,.6), 0 0 0 1px rgba(245,166,35,.06);
    }

    /* card top accent bar */
    .card-accent {
        height: 3px;
        background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
        background-size: 300% auto;
        animation: shimmer 3s linear infinite;
    }

    .card-body { padding: 36px 40px 40px; }

    /* card header */
    .card-header {
        display: flex; align-items: center; justify-content: space-between;
        margin-bottom: 30px;
    }
    .card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem; font-weight: 800; color: var(--txt);
        letter-spacing: -.3px;
    }
    .card-dots { display: flex; gap: 7px; }
    .card-dot {
        width: 10px; height: 10px; border-radius: 50%;
        animation: glow 2s infinite;
    }
    .card-dot:nth-child(1){ background: var(--gold);  animation-delay: 0s; }
    .card-dot:nth-child(2){ background: var(--teal);  animation-delay: .4s; }
    .card-dot:nth-child(3){ background: #6ca3ff;      animation-delay: .8s; }

    /* ── ALERTS ── */
    .alert {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 14px 16px; border-radius: 12px; margin-bottom: 22px;
        font-size: .875rem; font-weight: 500;
        animation: fadeUp .35s ease both;
    }
    .alert i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
    .alert-error   { background: rgba(239,68,68,.10);  border: 1px solid rgba(239,68,68,.25);  color: #f87171; }
    .alert-success { background: rgba(34,197,94,.10);  border: 1px solid rgba(34,197,94,.25);  color: #4ade80; }
    .alert ul { list-style: none; }
    .alert ul li::before { content: '· '; }

    /* ── FORM ── */
    .form-group { margin-bottom: 20px; }

    .form-label {
        display: flex; align-items: center; gap: 8px;
        font-size: .8rem; font-weight: 700; letter-spacing: .6px;
        text-transform: uppercase; color: var(--txt2); margin-bottom: 9px;
    }
    .form-label i { color: var(--gold); font-size: 12px; }

    .form-field {
        position: relative;
    }
    .form-input {
        width: 100%;
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 11px;
        padding: 13px 46px 13px 16px;
        color: var(--txt); font-family: 'Outfit', sans-serif; font-size: .925rem;
        transition: all .3s;
        outline: none;
    }
    .form-input::placeholder { color: var(--txt2); }
    .form-input:focus {
        border-color: rgba(245,166,35,.45);
        background: rgba(255,255,255,.06);
        box-shadow: 0 0 0 3px rgba(245,166,35,.09);
    }
    .form-input.is-error { border-color: rgba(239,68,68,.45) !important; }

    /* eye / pw toggle */
    .field-icon {
        position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
        color: var(--txt2); font-size: 14px; cursor: pointer; transition: color .2s;
        background: none; border: none; padding: 0;
    }
    .field-icon:hover { color: var(--gold); }

    /* ── CHECKBOX ROW ── */
    .check-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 12px 14px;
        background: rgba(255,255,255,.03);
        border: 1px solid var(--rim);
        border-radius: 11px; margin-bottom: 24px;
    }
    .check-label {
        display: flex; align-items: center; gap: 9px;
        cursor: pointer; font-size: .875rem; color: var(--txt2);
    }
    .check-label input[type=checkbox] {
        width: 17px; height: 17px;
        accent-color: var(--gold); cursor: pointer;
        border-radius: 5px;
    }
    .check-label:hover { color: var(--txt); }
    .forgot-link {
        font-size: .82rem; font-weight: 600; color: rgba(245,166,35,.65);
        text-decoration: none; transition: color .25s;
    }
    .forgot-link:hover { color: var(--gold); }

    /* ── SUBMIT BTN ── */
    .btn-submit {
        width: 100%; padding: 15px;
        background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
        background-size: 200% auto;
        animation: shimmer 3s linear infinite;
        color: #07090f; font-family: 'Outfit', sans-serif;
        font-size: 1rem; font-weight: 800; letter-spacing: .3px;
        border: none; border-radius: 12px; cursor: pointer;
        transition: all .3s;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        position: relative; overflow: hidden;
        box-shadow: 0 6px 24px rgba(245,166,35,.25);
    }
    .btn-submit::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, transparent 0%, rgba(255,255,255,.28) 50%, transparent 100%);
        transform: translateX(-100%); transition: transform .7s ease;
    }
    .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(245,166,35,.40); }
    .btn-submit:hover::before { transform: translateX(100%); }
    .btn-submit:active { transform: translateY(0); }

    /* ── SECURITY BADGES ── */
    .badges {
        display: grid; grid-template-columns: repeat(3,1fr); gap: 10px;
        margin-top: 22px;
    }
    .badge-item {
        background: rgba(255,255,255,.03); border: 1px solid var(--rim);
        border-radius: 11px; padding: 12px 8px; text-align: center;
        transition: all .3s;
    }
    .badge-item:hover { border-color: var(--rim-gold); background: rgba(245,166,35,.04); }
    .badge-item i { font-size: 18px; display: block; margin-bottom: 5px; }
    .badge-item span { font-size: .72rem; font-weight: 600; letter-spacing: .4px; text-transform: uppercase; color: var(--txt2); }
    .badge-item:nth-child(1) i { color: var(--teal); }
    .badge-item:nth-child(2) i { color: #6ca3ff; }
    .badge-item:nth-child(3) i { color: #a78bfa; }

    /* ── DIVIDER ── */
    .divider {
        display: flex; align-items: center; gap: 14px; margin: 28px 0;
    }
    .divider::before, .divider::after {
        content: ''; flex: 1; height: 1px; background: var(--rim);
    }
    .divider span { font-size: .78rem; color: var(--txt2); white-space: nowrap; font-weight: 500; }

    /* ── REGISTER BTN ── */
    .btn-register {
        display: flex; align-items: center; justify-content: center; gap: 9px;
        width: 100%; padding: 14px;
        background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.10);
        border-radius: 12px; color: var(--txt2);
        font-family: 'Outfit', sans-serif; font-size: .925rem; font-weight: 600;
        text-decoration: none; transition: all .3s;
    }
    .btn-register:hover {
        background: rgba(245,166,35,.07); border-color: var(--rim-gold);
        color: var(--gold-lt); transform: translateY(-2px);
    }

    /* ── STATS STRIP ── */
    .stats-strip {
        display: flex; justify-content: center; gap: 28px;
        margin-top: 20px;
    }
    .stats-strip span {
        font-size: .78rem; color: rgba(245,166,35,.55); font-weight: 600;
        display: flex; align-items: center; gap: 6px;
    }
    .stats-strip i { font-size: 11px; }

    /* ── CARD FOOTER ── */
    .card-footer-text {
        text-align: center; margin-top: 28px;
        color: rgba(221,225,236,.25); font-size: .78rem; font-weight: 300;
    }

    /* ═══════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════ */
    @media(max-width: 520px) {
        .card-body { padding: 28px 24px 32px; }
        .logo-text { font-size: 2.4rem; }
    }
    </style>
</head>

<body>

    <!-- backgrounds -->
    <div class="page-bg"></div>
    <div class="page-mesh"></div>
    <div class="scan-line"></div>
    <div class="orb orb-1"></div>
    <div class="orb orb-2"></div>

    <!-- content -->
    <div class="wrap">

        <!-- ── LOGO ── -->
        <div class="top-logo">
            <a href="{{ url('/') }}" class="logo-link">
                <span class="logo-text">CYCO MARKET</span>
            </a>
            <span class="logo-sub">L'excellence du shopping en ligne</span>
            <div class="logo-divider">
                <span style="width:40px;"></span>
                <span style="width:20px;animation-delay:.3s;"></span>
                <span style="width:40px;animation-delay:.6s;"></span>
            </div>
        </div>

        <!-- ── CARD ── -->
        <div class="auth-card">
            <div class="card-accent"></div>
            <div class="card-body">

                <!-- card header -->
                <div class="card-header">
                    <h1 class="card-title">Connexion</h1>
                    <div class="card-dots">
                        <div class="card-dot"></div>
                        <div class="card-dot"></div>
                        <div class="card-dot"></div>
                    </div>
                </div>

                <!-- alerts -->
                @if($errors->any())
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(session('success'))
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                <!-- form -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf

                    <!-- email -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-envelope"></i> Adresse email
                        </label>
                        <div class="form-field">
                            <input type="email" name="email" value="{{ old('email') }}" required
                                   autocomplete="email"
                                   placeholder="votre@email.com"
                                   class="form-input @error('email') is-error @enderror">
                            <i class="fas fa-at field-icon" style="pointer-events:none;"></i>
                        </div>
                    </div>

                    <!-- password -->
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fas fa-lock"></i> Mot de passe
                        </label>
                        <div class="form-field">
                            <input type="password" name="password" id="pwField" required
                                   autocomplete="current-password"
                                   placeholder="••••••••"
                                   class="form-input @error('password') is-error @enderror">
                            <button type="button" class="field-icon" onclick="togglePw()" id="pwEye">
                                <i class="fas fa-eye" id="pwIcon"></i>
                            </button>
                        </div>
                    </div>

                    <!-- remember + forgot -->
                    <div class="check-row">
                        <label class="check-label">
                            <input type="checkbox" name="remember" id="remember">
                            Se souvenir de moi
                        </label>
                        <a href="#" class="forgot-link">Mot de passe oublié ?</a>
                    </div>

                    <!-- submit -->
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-sign-in-alt"></i>
                        Se connecter
                    </button>

                    <!-- security badges -->
                    <div class="badges">
                        <div class="badge-item">
                            <i class="fas fa-shield-alt"></i>
                            <span>Sécurisé</span>
                        </div>
                        <div class="badge-item">
                            <i class="fas fa-lock"></i>
                            <span>Chiffré</span>
                        </div>
                        <div class="badge-item">
                            <i class="fas fa-clock"></i>
                            <span>24 / 7</span>
                        </div>
                    </div>
                </form>

                <!-- divider -->
                <div class="divider">
                    <span>Nouveau sur CYCO MARKET ?</span>
                </div>

                <!-- register btn -->
                <a href="{{ route('register') }}" class="btn-register">
                    <i class="fas fa-user-plus" style="font-size:13px;"></i>
                    Créer un compte
                </a>

                <!-- stats strip -->
                <div class="stats-strip">
                    <span><i class="fas fa-users"></i> 5 000+ clients</span>
                    <span><i class="fas fa-box"></i> 10 000+ produits</span>
                </div>

            </div><!-- /card-body -->
        </div><!-- /auth-card -->

        <!-- card footer -->
        <p class="card-footer-text">© 2026 CYCO MARKET — L'élite du e-commerce · by <strong style="color:rgba(245,166,35,.4);">DONA</strong></p>

    </div><!-- /wrap -->

    <script>
        function togglePw() {
            var f = document.getElementById('pwField');
            var i = document.getElementById('pwIcon');
            if (f.type === 'password') {
                f.type = 'text';
                i.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                f.type = 'password';
                i.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
    </script>

</body>
</html>