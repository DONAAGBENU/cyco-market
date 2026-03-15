@extends('layouts.app')

@section('title', 'Nouveau produit — CYCO MARKET')

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

/* ═══════════════════════════════
   KEYFRAMES
═══════════════════════════════ */
@keyframes shimmer { 0%{background-position:-220% center}100%{background-position:220% center} }
@keyframes fadeUp  { from{opacity:0;transform:translateY(18px)}to{opacity:1;transform:translateY(0)} }
@keyframes glow    { 0%,100%{opacity:.5}50%{opacity:1} }
@keyframes pulse-r { 0%,100%{box-shadow:0 0 0 0 rgba(245,166,35,.4)}65%{box-shadow:0 0 0 9px transparent} }

.au  { animation: fadeUp .6s cubic-bezier(.22,.6,.36,1) both; }
.d1  { animation-delay:.07s; } .d2{animation-delay:.14s;} .d3{animation-delay:.21s;}

/* ═══════════════════════════════
   PAGE WRAPPER
═══════════════════════════════ */
.create-wrap {
    max-width: 1000px;
    margin: 0 auto;
}

/* ═══════════════════════════════
   PAGE HERO BANNER
═══════════════════════════════ */
.page-hero {
    position: relative; overflow: hidden;
    border-radius: 18px; margin-bottom: 28px;
    min-height: 140px; display: flex; align-items: center;
    padding: 32px 40px;
    border: 1px solid var(--rim);
}
.page-hero-bg {
    position: absolute; inset: 0; z-index: 0;
    background:
        linear-gradient(110deg, rgba(7,9,15,.96) 0%, rgba(12,17,32,.80) 55%, rgba(7,9,15,.94) 100%),
        url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1400&q=75&auto=format&fit=crop')
        center / cover no-repeat;
}
.page-hero-bg::after {
    content: ''; position: absolute; inset: 0;
    background-image:
        linear-gradient(rgba(245,166,35,.035) 1px, transparent 1px),
        linear-gradient(90deg, rgba(245,166,35,.035) 1px, transparent 1px);
    background-size: 50px 50px;
}
.hero-orb-1 {
    position: absolute; width:350px;height:350px;border-radius:50%;
    background:rgba(26,108,255,.10); filter:blur(80px);
    top:-80px; right:-40px; z-index:1; pointer-events:none;
}
.page-hero-content { position: relative; z-index: 2; }

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

/* ═══════════════════════════════
   FORM CARD
═══════════════════════════════ */
.form-card {
    background: var(--card);
    border: 1px solid var(--rim);
    border-radius: 18px; overflow: hidden;
    margin-bottom: 20px;
    transition: border-color .3s;
}
.form-card:hover { border-color: var(--rim-gold); }

/* gold top bar */
.form-card-accent {
    height: 2px;
    background: linear-gradient(90deg, var(--gold-dk), var(--gold), var(--gold-lt), var(--gold));
    background-size: 300% auto; animation: shimmer 3s linear infinite;
}

.form-card-header {
    display: flex; align-items: center; gap: 12px;
    padding: 20px 28px 16px;
    border-bottom: 1px solid var(--rim);
}
.form-card-icon {
    width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; background: rgba(245,166,35,.10); color: var(--gold);
}
.form-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1rem; font-weight: 800; color: var(--txt);
}
.form-card-sub { font-size: .72rem; color: var(--txt2); margin-top: 1px; }

.form-card-body { padding: 24px 28px 28px; }

/* ═══════════════════════════════
   FORM GRID
═══════════════════════════════ */
.f-grid   { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
.f-full   { grid-column: 1 / -1; }

/* ═══════════════════════════════
   FORM ELEMENTS
═══════════════════════════════ */
.f-group { display: flex; flex-direction: column; gap: 8px; }

.f-label {
    display: flex; align-items: center; gap: 8px;
    font-size: .72rem; font-weight: 700; letter-spacing: .7px;
    text-transform: uppercase; color: var(--txt2);
}
.f-label i { color: var(--gold); font-size: 11px; }
.f-label .req { color: #f87171; margin-left: 1px; }

.f-input, .f-select, .f-textarea {
    width: 100%;
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 10px;
    padding: 12px 16px;
    color: var(--txt); font-family: 'Outfit', sans-serif; font-size: .9rem;
    transition: all .3s; outline: none;
}
.f-select { cursor: pointer; }
.f-textarea { resize: vertical; min-height: 110px; }
.f-input::placeholder, .f-textarea::placeholder { color: var(--txt2); }

.f-input:focus, .f-select:focus, .f-textarea:focus {
    border-color: rgba(245,166,35,.45);
    background: rgba(255,255,255,.06);
    box-shadow: 0 0 0 3px rgba(245,166,35,.09);
}
.f-input.is-error, .f-select.is-error, .f-textarea.is-error {
    border-color: rgba(239,68,68,.45);
}
.f-error { font-size: .75rem; color: #f87171; margin-top: 2px; }

/* select options */
.f-select option { background: #141c2c; color: var(--txt); }

/* hint text */
.f-hint { font-size: .72rem; color: var(--txt2); margin-top: 4px; display: flex; align-items: center; gap: 5px; }
.f-hint i { font-size: 10px; color: var(--gold); opacity: .6; }

/* prefix input (prix) */
.f-input-wrap { position: relative; display: flex; align-items: center; }
.f-prefix {
    position: absolute; left: 14px;
    font-size: .82rem; font-weight: 700; color: var(--gold); pointer-events: none;
}
.f-input.with-prefix { padding-left: 56px; }

/* ─── JSON textarea ─── */
.f-mono { font-family: 'Courier New', monospace; font-size: .82rem; }

/* ─── Checkbox toggle ─── */
.toggle-row {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 18px; border-radius: 11px;
    background: rgba(255,255,255,.03); border: 1px solid var(--rim);
    transition: border-color .3s;
}
.toggle-row:hover { border-color: var(--rim-gold); }
.toggle-label { font-size: .875rem; font-weight: 500; color: var(--txt); display: flex; align-items: center; gap: 10px; }
.toggle-label i { color: var(--gold); }
.toggle-sub { font-size: .72rem; color: var(--txt2); margin-top: 2px; }

/* custom toggle switch */
.toggle-switch { position: relative; width: 44px; height: 24px; flex-shrink: 0; }
.toggle-switch input { opacity: 0; width: 0; height: 0; }
.toggle-slider {
    position: absolute; inset: 0; cursor: pointer;
    background: rgba(255,255,255,.10); border: 1px solid rgba(255,255,255,.12);
    border-radius: 24px; transition: all .3s;
}
.toggle-slider::before {
    content: ''; position: absolute;
    width: 18px; height: 18px; border-radius: 50%;
    left: 2px; top: 50%; transform: translateY(-50%);
    background: var(--txt2); transition: all .3s;
}
.toggle-switch input:checked + .toggle-slider { background: rgba(245,166,35,.25); border-color: rgba(245,166,35,.4); }
.toggle-switch input:checked + .toggle-slider::before { left: 22px; background: var(--gold); box-shadow: 0 0 8px rgba(245,166,35,.5); }

/* ═══════════════════════════════
   IMAGE UPLOAD ZONE
═══════════════════════════════ */
.upload-zone {
    border: 2px dashed rgba(245,166,35,.25);
    border-radius: 12px; padding: 28px 20px;
    text-align: center; cursor: pointer;
    background: rgba(245,166,35,.03);
    transition: all .3s; position: relative;
}
.upload-zone:hover, .upload-zone.dragover {
    border-color: rgba(245,166,35,.55);
    background: rgba(245,166,35,.07);
}
.upload-zone input[type=file] {
    position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
}
.upload-icon {
    width: 52px; height: 52px; border-radius: 14px; margin: 0 auto 14px;
    background: rgba(245,166,35,.10); border: 1px solid rgba(245,166,35,.22);
    display: flex; align-items: center; justify-content: center;
    color: var(--gold); font-size: 22px;
}
.upload-title { font-size: .95rem; font-weight: 600; color: var(--txt); margin-bottom: 5px; }
.upload-sub   { font-size: .78rem; color: var(--txt2); }
.upload-sub span { color: var(--gold); font-weight: 600; }

/* image previews */
.preview-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
    gap: 12px; margin-top: 18px;
}
.preview-item {
    position: relative; border-radius: 10px; overflow: hidden;
    border: 1px solid var(--rim); aspect-ratio: 1;
    animation: fadeUp .3s ease both;
}
.preview-item img { width: 100%; height: 100%; object-fit: cover; }
.preview-remove {
    position: absolute; top: 5px; right: 5px;
    width: 22px; height: 22px; border-radius: 50%;
    background: rgba(239,68,68,.85); border: 1px solid rgba(239,68,68,.5);
    color: white; font-size: 11px; font-weight: 800;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; transition: all .2s;
    border: none;
}
.preview-remove:hover { background: var(--red); transform: scale(1.15); }
.preview-badge {
    position: absolute; bottom: 5px; left: 5px;
    background: rgba(7,9,15,.75); color: var(--gold-lt);
    font-size: 9px; font-weight: 700; padding: 2px 7px; border-radius: 20px;
    letter-spacing: .3px;
}

/* ═══════════════════════════════
   FORM ACTIONS
═══════════════════════════════ */
.form-actions {
    display: flex; align-items: center; justify-content: flex-end; gap: 12px;
    padding: 20px 28px;
    border-top: 1px solid var(--rim);
    background: rgba(255,255,255,.015);
}

.btn-cancel {
    display: inline-flex; align-items: center; gap: 8px;
    padding: 11px 22px; border-radius: 10px;
    background: rgba(255,255,255,.04); border: 1px solid var(--rim);
    color: var(--txt2); font-family: 'Outfit', sans-serif;
    font-size: .875rem; font-weight: 600; text-decoration: none;
    transition: all .3s;
}
.btn-cancel:hover { background: rgba(255,255,255,.08); color: var(--txt); border-color: rgba(255,255,255,.14); }

.btn-save {
    display: inline-flex; align-items: center; gap: 9px;
    padding: 12px 28px; border-radius: 10px;
    background: linear-gradient(135deg, var(--gold-dk), var(--gold), var(--gold-lt));
    background-size: 200% auto; animation: shimmer 3s linear infinite;
    color: #07090f; font-family: 'Outfit', sans-serif;
    font-size: .9rem; font-weight: 800; letter-spacing: .3px;
    border: none; cursor: pointer;
    transition: all .3s;
    box-shadow: 0 5px 20px rgba(245,166,35,.25);
    position: relative; overflow: hidden;
}
.btn-save::before {
    content: ''; position: absolute; inset: 0;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,.25), transparent);
    transform: translateX(-100%); transition: transform .6s;
}
.btn-save:hover { transform: translateY(-2px); box-shadow: 0 10px 28px rgba(245,166,35,.38); }
.btn-save:hover::before { transform: translateX(100%); }

/* ═══════════════════════════════
   RESPONSIVE
═══════════════════════════════ */
@media(max-width: 700px) {
    .f-grid { grid-template-columns: 1fr; }
    .f-full { grid-column: 1; }
    .page-hero { padding: 24px 22px; }
    .form-card-body { padding: 20px 20px 24px; }
    .form-card-header { padding: 18px 20px 14px; }
    .form-actions { padding: 16px 20px; flex-direction: column-reverse; }
    .btn-cancel, .btn-save { width: 100%; justify-content: center; }
}
</style>
@endpush

@section('content')
<div class="create-wrap">

    <!-- ── PAGE HERO ── -->
    <div class="page-hero au">
        <div class="page-hero-bg"></div>
        <div class="hero-orb-1"></div>
        <div class="page-hero-content">
            <div class="hero-eyebrow">
                <span class="dot"></span> Admin · Catalogue
            </div>
            <h1 class="page-title">Ajouter un <em>nouveau produit</em></h1>
            <p class="page-sub">Remplissez les informations ci-dessous pour créer une nouvelle fiche produit.</p>
        </div>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- ══ BLOC 1 : Informations principales ══ -->
        <div class="form-card au d1">
            <div class="form-card-accent"></div>
            <div class="form-card-header">
                <div class="form-card-icon"><i class="fas fa-tag"></i></div>
                <div>
                    <div class="form-card-title">Informations principales</div>
                    <div class="form-card-sub">Nom, catégorie, prix et stock</div>
                </div>
            </div>
            <div class="form-card-body">
                <div class="f-grid">

                    <!-- Nom -->
                    <div class="f-group f-full">
                        <label class="f-label"><i class="fas fa-box"></i> Nom du produit <span class="req">*</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" required
                               placeholder="Ex: Smartphone Samsung Galaxy A54"
                               class="f-input @error('name') is-error @enderror">
                        @error('name')<p class="f-error"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>@enderror
                    </div>

                    <!-- Catégorie -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-folder"></i> Catégorie <span class="req">*</span></label>
                        <select name="category_id" required class="f-select @error('category_id') is-error @enderror">
                            <option value="">— Sélectionner —</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                    <!-- SKU -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-barcode"></i> SKU <span class="req">*</span></label>
                        <input type="text" name="sku" value="{{ old('sku') }}" required
                               placeholder="Ex: SKU-00123"
                               class="f-input @error('sku') is-error @enderror">
                        @error('sku')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                    <!-- Prix -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-coins"></i> Prix <span class="req">*</span></label>
                        <div class="f-input-wrap">
                            <span class="f-prefix">FCFA</span>
                            <input type="number" name="price" value="{{ old('price') }}" step="0.01" required
                                   placeholder="0"
                                   class="f-input with-prefix @error('price') is-error @enderror">
                        </div>
                        @error('price')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                    <!-- Quantité stock -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-warehouse"></i> Quantité en stock <span class="req">*</span></label>
                        <input type="number" name="quantity" value="{{ old('quantity') }}" required
                               placeholder="0"
                               class="f-input @error('quantity') is-error @enderror">
                        @error('quantity')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                    <!-- Qté min commande -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-shopping-basket"></i> Qté min. de commande <span class="req">*</span></label>
                        <input type="number" name="min_order_quantity" value="{{ old('min_order_quantity', 1) }}" required
                               placeholder="1"
                               class="f-input @error('min_order_quantity') is-error @enderror">
                        @error('min_order_quantity')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                </div>
            </div>
        </div>

        <!-- ══ BLOC 2 : Description ══ -->
        <div class="form-card au d2">
            <div class="form-card-accent"></div>
            <div class="form-card-header">
                <div class="form-card-icon" style="background:rgba(26,108,255,.12);color:#6ca3ff;"><i class="fas fa-align-left"></i></div>
                <div>
                    <div class="form-card-title">Description & Détails</div>
                    <div class="form-card-sub">Fournisseur, origine et description complète</div>
                </div>
            </div>
            <div class="form-card-body">
                <div class="f-grid">

                    <!-- Fournisseur -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-truck"></i> Fournisseur</label>
                        <input type="text" name="supplier" value="{{ old('supplier') }}"
                               placeholder="Nom du fournisseur"
                               class="f-input @error('supplier') is-error @enderror">
                    </div>

                    <!-- Origine -->
                    <div class="f-group">
                        <label class="f-label"><i class="fas fa-globe-africa"></i> Origine</label>
                        <input type="text" name="origin" value="{{ old('origin') }}"
                               placeholder="Ex: Chine, France…"
                               class="f-input @error('origin') is-error @enderror">
                    </div>

                    <!-- Description -->
                    <div class="f-group f-full">
                        <label class="f-label"><i class="fas fa-file-alt"></i> Description <span class="req">*</span></label>
                        <textarea name="description" rows="5" required
                                  placeholder="Décrivez le produit en détail…"
                                  class="f-textarea @error('description') is-error @enderror">{{ old('description') }}</textarea>
                        @error('description')<p class="f-error">{{ $message }}</p>@enderror
                    </div>

                    <!-- Spécifications JSON -->
                    <div class="f-group f-full">
                        <label class="f-label"><i class="fas fa-code"></i> Spécifications <span style="color:var(--txt2);font-weight:400;text-transform:none;letter-spacing:0;">(JSON)</span></label>
                        <textarea name="specifications" rows="4"
                                  placeholder='{"Couleur": "Rouge", "Taille": "M", "Matière": "Coton"}'
                                  class="f-textarea f-mono @error('specifications') is-error @enderror">{{ old('specifications') }}</textarea>
                        <p class="f-hint"><i class="fas fa-info-circle"></i> Format JSON — ex: {"Couleur": "Rouge", "Taille": "M"}</p>
                    </div>

                </div>
            </div>
        </div>

        <!-- ══ BLOC 3 : Images ══ -->
        <div class="form-card au d3">
            <div class="form-card-accent"></div>
            <div class="form-card-header">
                <div class="form-card-icon" style="background:rgba(0,210,168,.12);color:var(--teal);"><i class="fas fa-images"></i></div>
                <div>
                    <div class="form-card-title">Images du produit</div>
                    <div class="form-card-sub">Sélectionnez une ou plusieurs photos</div>
                </div>
            </div>
            <div class="form-card-body">

                <div class="upload-zone" id="uploadZone">
                    <input id="image-input" type="file" name="images[]" multiple accept="image/*">
                    <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                    <div class="upload-title">Glissez vos images ici</div>
                    <p class="upload-sub">ou <span>cliquez pour parcourir</span> · JPG, PNG, WEBP</p>
                </div>

                <div id="image-preview" class="preview-grid"></div>

            </div>
        </div>

        <!-- ══ BLOC 4 : Statut ══ -->
        <div class="form-card au d3">
            <div class="form-card-accent"></div>
            <div class="form-card-header">
                <div class="form-card-icon" style="background:rgba(124,58,237,.12);color:#a78bfa;"><i class="fas fa-toggle-on"></i></div>
                <div>
                    <div class="form-card-title">Statut du produit</div>
                    <div class="form-card-sub">Visibilité sur la boutique</div>
                </div>
            </div>
            <div class="form-card-body">
                <div class="toggle-row">
                    <div>
                        <div class="toggle-label"><i class="fas fa-eye"></i> Produit actif</div>
                        <div class="toggle-sub">Le produit sera visible et disponible à l'achat</div>
                    </div>
                    <label class="toggle-switch">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>

        <!-- ══ ACTIONS ══ -->
        <div class="form-card au d3" style="overflow:hidden;">
            <div class="form-actions">
                <a href="{{ route('admin.products.index') }}" class="btn-cancel">
                    <i class="fas fa-times" style="font-size:12px;"></i> Annuler
                </a>
                <button type="submit" class="btn-save">
                    <i class="fas fa-check"></i> Créer le produit
                </button>
            </div>
        </div>

    </form>

</div>
@endsection

@push('scripts')
<script>
    /* ── IMAGE PREVIEW ── */
    const input   = document.getElementById('image-input');
    const preview = document.getElementById('image-preview');
    const zone    = document.getElementById('uploadZone');

    function updatePreview(files) {
        preview.innerHTML = '';
        Array.from(files).forEach(function(file, index) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var item = document.createElement('div');
                item.className = 'preview-item';

                var img = document.createElement('img');
                img.src = e.target.result;
                img.alt = file.name;

                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'preview-remove';
                btn.innerHTML = '<i class="fas fa-times"></i>';
                btn.onclick = function(){ removeFile(index); };

                var badge = document.createElement('div');
                badge.className = 'preview-badge';
                badge.textContent = index === 0 ? 'Principal' : '#' + (index + 1);

                item.appendChild(img);
                item.appendChild(btn);
                item.appendChild(badge);
                preview.appendChild(item);
            };
            reader.readAsDataURL(file);
        });
    }

    function removeFile(index) {
        var dt = new DataTransfer();
        Array.from(input.files).forEach(function(file, i) {
            if (i !== index) dt.items.add(file);
        });
        input.files = dt.files;
        updatePreview(input.files);
    }

    input.addEventListener('change', function() {
        updatePreview(this.files);
    });

    /* drag & drop */
    zone.addEventListener('dragover',  function(e){ e.preventDefault(); zone.classList.add('dragover'); });
    zone.addEventListener('dragleave', function(){ zone.classList.remove('dragover'); });
    zone.addEventListener('drop', function(e) {
        e.preventDefault(); zone.classList.remove('dragover');
        var dt = new DataTransfer();
        Array.from(e.dataTransfer.files).forEach(function(f){ dt.items.add(f); });
        input.files = dt.files;
        updatePreview(input.files);
    });
</script>
@endpush