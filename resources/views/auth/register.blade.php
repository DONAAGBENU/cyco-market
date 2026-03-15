<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription — CYCO MARKET</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;800;900&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
    /* ═══════════════════════════
       TOKENS
    ═══════════════════════════ */
    :root {
        --gold:     #f5a623;
        --gold-lt:  #ffd280;
        --gold-dk:  #c47d0e;
        --bg:       #07090f;
        --card:     #101624;
        --card2:    #141c2c;
        --rim:      rgba(255,255,255,.06);
        --rim-gold: rgba(245,166,35,.22);
        --txt:      #dde1ec;
        --txt2:     #6b7591;
        --teal:     #00d2a8;
        --blue:     #1a6cff;
        --red:      #ef4444;
    }

    /* ═══════════════════════════
       RESET + BASE
    ═══════════════════════════ */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }

    body {
        min-height: 100vh;
        font-family: 'Outfit', sans-serif;
        color: var(--txt);
        overflow-x: hidden;
        display: flex;
        align-items: flex-start;
        justify-content: center;
        padding: 40px 20px 60px;
    }

    /* ═══════════════════════════
       BACKGROUND
    ═══════════════════════════ */
    .page-bg {
        position: fixed; inset: 0; z-index: 0;
        background:
            linear-gradient(150deg, rgba(7,9,15,.97) 0%, rgba(12,17,32,.82) 50%, rgba(7,9,15,.96) 100%),
            url('https://images.unsplash.com/photo-1483985988355-763728e1935b?w=1800&q=80&auto=format&fit=crop')
            center / cover no-repeat;
    }
    .page-bg::after {
        content: '';
        position: absolute; inset: 0;
        background-image:
            linear-gradient(rgba(245,166,35,.033) 1px, transparent 1px),
            linear-gradient(90deg, rgba(245,166,35,.033) 1px, transparent 1px);
        background-size: 55px 55px;
    }
    .page-mesh {
        position: fixed; inset: 0; z-index: 1; pointer-events: none;
        background:
            radial-gradient(ellipse 60% 50% at  5% 15%,  rgba(26,108,255,.09) 0%, transparent 55%),
            radial-gradient(ellipse 50% 45% at 95% 85%,  rgba(245,166,35,.08) 0%, transparent 55%),
            radial-gradient(ellipse 40% 30% at 50% 50%,  rgba(0,210,168,.04)  0%, transparent 60%);
    }

    /* ═══════════════════════════
       KEYFRAMES
    ═══════════════════════════ */
    @keyframes shimmer { 0%{background-position:-220% center}100%{background-position:220% center} }
    @keyframes fadeUp  { from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)} }
    @keyframes scan    { 0%{transform:translateY(-100%)}100%{transform:translateY(200vh)} }
    @keyframes drift   { 0%,100%{transform:translate(0,0) scale(1)} 40%{transform:translate(18px,-14px) scale(1.04)} 70%{transform:translate(-12px,10px) scale(.97)} }
    @keyframes glow    { 0%,100%{opacity:.5}50%{opacity:1} }
    @keyframes floatY  { 0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)} }

    .scan-line {
        position: fixed; left: 0; right: 0; height: 1px; z-index: 2; pointer-events: none;
        background: linear-gradient(90deg, transparent 0%, rgba(245,166,35,.28) 50%, transparent 100%);
        animation: scan 9s linear infinite;
    }
    .orb { position: fixed; border-radius: 50%; filter: blur(90px); pointer-events: none; z-index: 1; }
    .orb-1 { width:500px;height:500px; background:rgba(26,108,255,.09);  top:-80px;  right:-60px;  animation:drift 14s ease-in-out infinite; }
    .orb-2 { width:380px;height:380px; background:rgba(245,166,35,.07);  bottom:-60px; left:-40px; animation:drift 18s ease-in-out infinite reverse; }
    .orb-3 { width:260px;height:260px; background:rgba(0,210,168,.05);   top:40%; left:45%;       animation:drift 11s ease-in-out infinite 3s; }

    /* ═══════════════════════════
       WRAPPER
    ═══════════════════════════ */
    .wrap {
        position: relative; z-index: 10;
        width: 100%; max-width: 640px;
        animation: fadeUp .7s cubic-bezier(.22,.6,.36,1) both;
    }

    /* ── TOP LOGO ── */
    .top-logo { text-align: center; margin-bottom: 32px; }
    .logo-link { text-decoration: none; display: inline-block; animation: floatY 4s ease-in-out infinite; }
    .logo-text {
        font-family: 'Playfair Display', serif;
        font-size: clamp(2.4rem, 5.5vw, 3.4rem);
        font-weight: 900; letter-spacing: -.5px; line-height: 1;
        background: linear-gradient(90deg, var(--gold-lt), var(--gold), #ff9800, var(--gold-lt));
        background-size: 300% auto;
        -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
        animation: shimmer 3.5s linear infinite;
        display: block;
    }
    .logo-sub { color: rgba(221,225,236,.48); font-size: .92rem; font-weight: 300; letter-spacing: .5px; margin-top: 10px; display: block; }
    .logo-divider { display: flex; justify-content: center; gap: 8px; margin-top: 14px; }
    .logo-divider span {
        height: 3px; border-radius: 3px; display: block;
        background: linear-gradient(90deg, var(--gold-dk), var(--gold));
        background-size: 200% auto; animation: shimmer 3s linear infinite;
    }

    /* ── CARD ── */
    .auth-card {
        background: rgba(16,22,36,.91);
        backdrop-filter: blur(28px) saturate(160%);
        border: 1px solid var(--rim-gold);
        border-radius: 22px; overflow: hidden;
        box-shadow: 0 40px 80px rgba(0,0,0,.60), 0 0 0 1px rgba(245,166,35,.05);
    }
    .card-accent {
        height: 3px;
        background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
        background-size: 300% auto; animation: shimmer 3s linear infinite;
    }
    .card-body { padding: 36px 40px 42px; }

    /* card header */
    .card-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 28px; }
    .card-title { font-family: 'Playfair Display', serif; font-size: 1.75rem; font-weight: 800; color: var(--txt); letter-spacing: -.3px; }
    .card-dots  { display: flex; gap: 7px; }
    .card-dot   { width: 10px; height: 10px; border-radius: 50%; animation: glow 2s infinite; }
    .card-dot:nth-child(1){ background: var(--teal);  animation-delay:0s; }
    .card-dot:nth-child(2){ background: var(--gold);  animation-delay:.4s; }
    .card-dot:nth-child(3){ background: #f87171;      animation-delay:.8s; }

    /* ── STEP INDICATOR ── */
    .step-bar {
        display: flex; align-items: center; gap: 0;
        margin-bottom: 30px; padding: 0 4px;
    }
    .step-item { display: flex; align-items: center; gap: 8px; flex: 1; }
    .step-circle {
        width: 30px; height: 30px; border-radius: 50%; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700;
        border: 1.5px solid var(--rim);
        color: var(--txt2); background: rgba(255,255,255,.03);
        transition: all .3s;
    }
    .step-circle.active {
        background: linear-gradient(135deg, var(--gold-dk), var(--gold));
        border-color: transparent; color: #07090f;
        box-shadow: 0 4px 14px rgba(245,166,35,.35);
    }
    .step-label { font-size: .72rem; font-weight: 600; letter-spacing: .4px; text-transform: uppercase; color: var(--txt2); }
    .step-line { flex: 1; height: 1px; background: var(--rim); margin: 0 8px; }

    /* ── ALERTS ── */
    .alert {
        display: flex; align-items: flex-start; gap: 12px;
        padding: 14px 16px; border-radius: 12px; margin-bottom: 24px;
        font-size: .875rem; font-weight: 500; animation: fadeUp .35s ease both;
    }
    .alert i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
    .alert-error { background: rgba(239,68,68,.10); border: 1px solid rgba(239,68,68,.25); color: #f87171; }
    .alert ul { list-style: none; }
    .alert ul li::before { content: '· '; }

    /* ── FORM GRID ── */
    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
    .col-full  { grid-column: 1 / -1; }

    .form-group { display: flex; flex-direction: column; gap: 8px; }

    .form-label {
        display: flex; align-items: center; gap: 8px;
        font-size: .75rem; font-weight: 700; letter-spacing: .6px;
        text-transform: uppercase; color: var(--txt2);
    }
    .form-label i { color: var(--gold); font-size: 12px; }
    .form-label .req { color: #f87171; margin-left: 2px; }

    .form-input, .form-textarea {
        background: rgba(255,255,255,.04);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 11px;
        padding: 13px 46px 13px 16px;
        color: var(--txt); font-family: 'Outfit', sans-serif; font-size: .9rem;
        transition: all .3s; outline: none; width: 100%;
    }
    .form-textarea { padding: 13px 16px; resize: none; }
    .form-input::placeholder, .form-textarea::placeholder { color: var(--txt2); }
    .form-input:focus, .form-textarea:focus {
        border-color: rgba(245,166,35,.45);
        background: rgba(255,255,255,.06);
        box-shadow: 0 0 0 3px rgba(245,166,35,.09);
    }
    .form-input.is-error { border-color: rgba(239,68,68,.45); }

    .field-wrap { position: relative; }
    .field-icon {
        position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
        color: var(--txt2); font-size: 13px; cursor: pointer;
        background: none; border: none; padding: 0; transition: color .2s;
    }
    .field-icon:hover { color: var(--gold); }

    /* password strength */
    .pw-strength { margin-top: 8px; }
    .pw-bars { display: flex; gap: 4px; margin-bottom: 5px; }
    .pw-bar  { height: 3px; flex: 1; border-radius: 3px; background: rgba(255,255,255,.08); transition: background .3s; }
    .pw-bar.weak   { background: #ef4444; }
    .pw-bar.medium { background: var(--gold); }
    .pw-bar.strong { background: var(--teal); }
    .pw-label { font-size: .7rem; color: var(--txt2); }

    /* ── TERMS ROW ── */
    .terms-row {
        grid-column: 1 / -1;
        display: flex; align-items: flex-start; gap: 12px;
        padding: 16px; border-radius: 12px;
        background: rgba(255,255,255,.025); border: 1px solid var(--rim);
        margin-top: 4px;
        transition: border-color .3s;
    }
    .terms-row:focus-within { border-color: var(--rim-gold); }
    .terms-row input[type=checkbox] { width: 17px; height: 17px; accent-color: var(--gold); cursor: pointer; flex-shrink: 0; margin-top: 2px; }
    .terms-txt { font-size: .85rem; color: var(--txt2); line-height: 1.6; }
    .terms-txt a { color: rgba(245,166,35,.75); text-decoration: none; font-weight: 600; transition: color .2s; }
    .terms-txt a:hover { color: var(--gold); }

    /* ── SUBMIT ── */
    .btn-submit {
        grid-column: 1 / -1;
        width: 100%; padding: 16px;
        background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
        background-size: 200% auto; animation: shimmer 3s linear infinite;
        color: #07090f; font-family: 'Outfit', sans-serif;
        font-size: 1rem; font-weight: 800; letter-spacing: .3px;
        border: none; border-radius: 12px; cursor: pointer;
        transition: all .3s;
        display: flex; align-items: center; justify-content: center; gap: 10px;
        position: relative; overflow: hidden;
        box-shadow: 0 6px 24px rgba(245,166,35,.25);
        margin-top: 6px;
    }
    .btn-submit::before {
        content: ''; position: absolute; inset: 0;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,.28), transparent);
        transform: translateX(-100%); transition: transform .7s ease;
    }
    .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 14px 36px rgba(245,166,35,.40); }
    .btn-submit:hover::before { transform: translateX(100%); }

    /* ── SECURITY STRIP ── */
    .security-strip {
        grid-column: 1 / -1;
        display: flex; align-items: center; justify-content: center; gap: 22px;
        padding: 12px; border-radius: 11px;
        background: rgba(255,255,255,.02); border: 1px solid var(--rim);
    }
    .sec-item { display: flex; align-items: center; gap: 7px; font-size: .75rem; color: var(--txt2); }
    .sec-item i { color: var(--teal); font-size: 12px; }

    /* ── DIVIDER ── */
    .divider { display: flex; align-items: center; gap: 14px; margin: 28px 0 22px; }
    .divider::before, .divider::after { content:''; flex:1; height:1px; background:var(--rim); }
    .divider span { font-size: .78rem; color: var(--txt2); white-space: nowrap; font-weight: 500; }

    /* ── LOGIN BTN ── */
    .btn-login {
        display: flex; align-items: center; justify-content: center; gap: 9px;
        width: 100%; padding: 14px;
        background: rgba(255,255,255,.03); border: 1px solid rgba(255,255,255,.10);
        border-radius: 12px; color: var(--txt2);
        font-family: 'Outfit', sans-serif; font-size: .925rem; font-weight: 600;
        text-decoration: none; transition: all .3s;
    }
    .btn-login:hover {
        background: rgba(245,166,35,.07); border-color: var(--rim-gold);
        color: var(--gold-lt); transform: translateY(-2px);
    }

    /* ── CARD FOOTER ── */
    .card-footer-text { text-align: center; margin-top: 28px; color: rgba(221,225,236,.22); font-size: .78rem; font-weight: 300; }

    /* ═══════════════════════════
       RESPONSIVE
    ═══════════════════════════ */
    @media(max-width: 560px) {
        .form-grid { grid-template-columns: 1fr; }
        .col-full, .terms-row, .btn-submit, .security-strip { grid-column: 1; }
        .card-body  { padding: 28px 22px 34px; }
        .step-label { display: none; }
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
    <div class="orb orb-3"></div>

    <div class="wrap">

        <!-- ── LOGO ── -->
        <div class="top-logo">
            <a href="{{ url('/') }}" class="logo-link">
                <span class="logo-text">CYCO MARKET</span>
            </a>
            <span class="logo-sub">Rejoignez l'élite du e-commerce</span>
            <div class="logo-divider">
                <span style="width:36px;"></span>
                <span style="width:18px;animation-delay:.3s;"></span>
                <span style="width:36px;animation-delay:.6s;"></span>
            </div>
        </div>

        <!-- ── CARD ── -->
        <div class="auth-card">
            <div class="card-accent"></div>
            <div class="card-body">

                <!-- header -->
                <div class="card-header">
                    <h1 class="card-title">Inscription</h1>
                    <div class="card-dots">
                        <div class="card-dot"></div>
                        <div class="card-dot"></div>
                        <div class="card-dot"></div>
                    </div>
                </div>

                <!-- step indicator -->
                <div class="step-bar">
                    <div class="step-item">
                        <div class="step-circle active"><i class="fas fa-user" style="font-size:11px;"></i></div>
                        <span class="step-label">Profil</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-item">
                        <div class="step-circle active"><i class="fas fa-envelope" style="font-size:11px;"></i></div>
                        <span class="step-label">Contact</span>
                    </div>
                    <div class="step-line"></div>
                    <div class="step-item">
                        <div class="step-circle active"><i class="fas fa-lock" style="font-size:11px;"></i></div>
                        <span class="step-label">Sécurité</span>
                    </div>
                </div>

                <!-- errors -->
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

                <!-- form -->
                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-grid">

                        <!-- Nom complet -->
                        <div class="form-group col-full">
                            <label class="form-label">
                                <i class="fas fa-user-circle"></i> Nom complet <span class="req">*</span>
                            </label>
                            <div class="field-wrap">
                                <input type="text" name="name" value="{{ old('name') }}" required
                                       placeholder="Jean Marc Dupont"
                                       class="form-input @error('name') is-error @enderror">
                                <i class="fas fa-user field-icon" style="pointer-events:none;"></i>
                            </div>
                        </div>

                        <!-- Email -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i> Email <span class="req">*</span>
                            </label>
                            <div class="field-wrap">
                                <input type="email" name="email" value="{{ old('email') }}" required
                                       placeholder="contact@exemple.com"
                                       class="form-input @error('email') is-error @enderror">
                                <i class="fas fa-at field-icon" style="pointer-events:none;"></i>
                            </div>
                        </div>

                        <!-- Téléphone -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-phone-alt"></i> Téléphone
                            </label>
                            <div class="field-wrap">
                                <input type="tel" name="phone" value="{{ old('phone') }}"
                                       placeholder="+228 07 00 00 00"
                                       class="form-input @error('phone') is-error @enderror">
                                <i class="fas fa-mobile-alt field-icon" style="pointer-events:none;"></i>
                            </div>
                        </div>

                        <!-- Adresse -->
                        <div class="form-group col-full">
                            <label class="form-label">
                                <i class="fas fa-map-marker-alt"></i> Adresse de livraison
                            </label>
                            <textarea name="address" rows="3"
                                      placeholder="Entrez votre adresse complète…"
                                      class="form-textarea @error('address') is-error @enderror">{{ old('address') }}</textarea>
                        </div>

                        <!-- Mot de passe -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-lock"></i> Mot de passe <span class="req">*</span>
                            </label>
                            <div class="field-wrap">
                                <input type="password" name="password" id="pw1" required
                                       placeholder="••••••••"
                                       oninput="checkStrength(this.value)"
                                       class="form-input @error('password') is-error @enderror">
                                <button type="button" class="field-icon" onclick="togglePw('pw1','eye1')">
                                    <i class="fas fa-eye" id="eye1"></i>
                                </button>
                            </div>
                            <div class="pw-strength">
                                <div class="pw-bars">
                                    <div class="pw-bar" id="bar1"></div>
                                    <div class="pw-bar" id="bar2"></div>
                                    <div class="pw-bar" id="bar3"></div>
                                    <div class="pw-bar" id="bar4"></div>
                                </div>
                                <span class="pw-label" id="pwLabel">Entrez un mot de passe</span>
                            </div>
                        </div>

                        <!-- Confirmation -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-check-circle"></i> Confirmation <span class="req">*</span>
                            </label>
                            <div class="field-wrap">
                                <input type="password" name="password_confirmation" id="pw2" required
                                       placeholder="••••••••"
                                       class="form-input">
                                <button type="button" class="field-icon" onclick="togglePw('pw2','eye2')">
                                    <i class="fas fa-eye" id="eye2"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Terms -->
                        <div class="terms-row">
                            <input type="checkbox" name="terms" id="terms" required>
                            <label for="terms" class="terms-txt">
                                J'accepte les <a href="#">conditions générales</a> et la
                                <a href="#">politique de confidentialité</a> de CYCO MARKET.
                            </label>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-user-plus"></i>
                            Créer mon compte maintenant
                        </button>

                        <!-- Security -->
                        <div class="security-strip">
                            <div class="sec-item"><i class="fas fa-shield-alt"></i> Paiement sécurisé</div>
                            <div class="sec-item"><i class="fas fa-lock"></i> Données protégées</div>
                            <div class="sec-item"><i class="fas fa-user-shield"></i> Confidentialité</div>
                        </div>

                    </div><!-- /form-grid -->
                </form>

                <!-- divider + login -->
                <div class="divider"><span>Déjà inscrit ?</span></div>

                <a href="{{ route('login') }}" class="btn-login">
                    <i class="fas fa-sign-in-alt" style="font-size:13px;"></i>
                    Se connecter <i class="fas fa-arrow-right" style="font-size:11px;margin-left:4px;"></i>
                </a>

            </div><!-- /card-body -->
        </div><!-- /auth-card -->

        <p class="card-footer-text">© 2026 CYCO MARKET — Tous droits réservés · by <strong style="color:rgba(245,166,35,.38);">DONA</strong></p>

    </div><!-- /wrap -->

    <script>
        /* toggle password visibility */
        function togglePw(fieldId, iconId) {
            var f = document.getElementById(fieldId);
            var i = document.getElementById(iconId);
            if (f.type === 'password') {
                f.type = 'text';
                i.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                f.type = 'password';
                i.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }

        /* password strength meter */
        function checkStrength(val) {
            var bars  = [document.getElementById('bar1'), document.getElementById('bar2'),
                         document.getElementById('bar3'), document.getElementById('bar4')];
            var label = document.getElementById('pwLabel');
            var score = 0;
            if (val.length >= 8)  score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            bars.forEach(function(b){ b.className = 'pw-bar'; });

            var cls = '', txt = '';
            if (val.length === 0) { txt = 'Entrez un mot de passe'; }
            else if (score <= 1)  { cls = 'weak';   txt = 'Faible'; bars[0].classList.add('weak'); }
            else if (score === 2) { cls = 'medium';  txt = 'Moyen';  bars[0].classList.add('medium'); bars[1].classList.add('medium'); }
            else if (score === 3) { cls = 'medium';  txt = 'Bon';    bars[0].classList.add('medium'); bars[1].classList.add('medium'); bars[2].classList.add('medium'); }
            else                  { cls = 'strong';  txt = 'Excellent'; bars.forEach(function(b){ b.classList.add('strong'); }); }

            label.textContent = txt;
            label.style.color = cls === 'weak' ? '#f87171' : cls === 'medium' ? 'var(--gold)' : cls === 'strong' ? 'var(--teal)' : 'var(--txt2)';
        }
    </script>

</body>
</html>