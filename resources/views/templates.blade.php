<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Templates – {{ config('app.name', 'Azalea') }}</title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Playwrite+AU+TAS:wght@100..400&display=swap');</style>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; background: #fff; color: #1a1a1a; }

        /* ── Navbar ── */
        #navbar {
            position: fixed; top: 0; left: 0; right: 0; z-index: 50;
            background-color: #f7e4ee;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        #navbar.scrolled { background-color: #fff; box-shadow: 0 1px 12px rgba(0,0,0,0.08); }
        .nav-inner {
            max-width: 1280px; margin: 0 auto; padding: 0 2rem;
            display: flex; align-items: center; justify-content: space-between; height: 64px;
        }
        .nav-logo { font-size: 1.2rem; font-weight: 400; color: #1a1a1a; text-decoration: none; letter-spacing: 0; font-family: 'Playwrite AU TAS', cursive; }
        .nav-right { display: flex; align-items: center; gap: 1.75rem; }
        .nav-right a:not(.btn-login):not(.btn-register) {
            font-size: 0.875rem; font-weight: 500; color: #374151; text-decoration: none; transition: color 0.2s;
        }
        .nav-right a:not(.btn-login):not(.btn-register):hover { color: #111827; }
        .nav-right a.active { color: #e02424; font-weight: 600; }
        .btn-login {
            font-size: 0.875rem; font-weight: 500; color: #374151; text-decoration: none;
            padding: 0.45rem 1.1rem; border-radius: 9999px; transition: color 0.2s;
        }
        .btn-register {
            font-size: 0.875rem; font-weight: 500; color: #fff; background-color: #1f2937;
            text-decoration: none; padding: 0.45rem 1.25rem; border-radius: 9999px; transition: background-color 0.2s;
        }
        .btn-register:hover { background-color: #111827; }
        .hamburger {
            display: none; flex-direction: column; justify-content: center; gap: 5px;
            background: none; border: none; cursor: pointer; padding: 4px;
        }
        .hamburger span { display: block; width: 22px; height: 2px; background-color: #374151; border-radius: 2px; transition: transform 0.3s, opacity 0.3s; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu { display: none; flex-direction: column; padding: 1rem 2rem 1.25rem; border-top: 1px solid #f0d4e2; gap: 0.25rem; }
        .mobile-menu.open { display: flex; }
        .mobile-menu a { font-size: 0.9rem; font-weight: 500; color: #374151; text-decoration: none; padding: 0.6rem 0; border-bottom: 1px solid #f9edf4; transition: color 0.2s; }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu .mobile-auth { display: flex; gap: 0.75rem; padding-top: 0.75rem; }
        .mobile-menu .mobile-auth a { flex: 1; text-align: center; padding: 0.55rem 1rem; border-bottom: none; border-radius: 9999px; }
        .mobile-menu .mobile-auth .btn-login { border: 1px solid #d1d5db; }
        .mobile-menu .mobile-auth .btn-register { background: #1f2937; color: #fff !important; }
        @media (max-width: 768px) { .nav-right { display: none; } .hamburger { display: flex; } }

        /* ── Hero banner ── */
        .tmpl-hero {
            padding-top: 64px;
            background: linear-gradient(160deg, #f7e4ee 0%, #fdf0f6 60%, #fff 100%);
            padding-bottom: 3rem;
        }
        .tmpl-hero-inner {
            max-width: 1280px; margin: 0 auto; padding: 3.5rem 2rem 0;
            text-align: center;
        }
        .tmpl-hero-inner h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.6rem; font-weight: 700; color: #1a1a1a; line-height: 1.25; margin-bottom: 0.75rem;
        }
        .tmpl-hero-inner p { font-size: 1rem; color: #6b7280; line-height: 1.7; max-width: 520px; margin: 0 auto; }

        /* ── Main content ── */
        .tmpl-main { max-width: 1280px; margin: 0 auto; padding: 2.5rem 2rem 5rem; }

        /* ── Toolbar ── */
        .tmpl-toolbar {
            display: flex; align-items: center; justify-content: space-between;
            gap: 1rem; margin-bottom: 1.25rem; flex-wrap: wrap;
        }
        /* Search */
        .tmpl-search { position: relative; flex: 1; max-width: 380px; }
        .tmpl-search svg {
            position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%);
            width: 15px; height: 15px; color: #9ca3af; pointer-events: none;
        }
        .tmpl-search input {
            width: 100%; padding: 0.6rem 1rem 0.6rem 2.5rem;
            border: 1px solid #e5d0e0; border-radius: 9999px;
            font-size: 0.85rem; color: #374151; background: #fff; outline: none;
            transition: border-color 0.2s, box-shadow 0.2s;
        }
        .tmpl-search input::placeholder { color: #c4b5c0; }
        .tmpl-search input:focus { border-color: #e02424; box-shadow: 0 0 0 3px rgba(224,36,36,0.07); }
        /* Sort */
        .tmpl-sort { position: relative; flex-shrink: 0; }
        .tmpl-sort .ico-sort {
            position: absolute; left: 0.9rem; top: 50%; transform: translateY(-50%);
            width: 14px; height: 14px; color: #9ca3af; pointer-events: none;
        }
        .tmpl-sort .ico-chevron {
            position: absolute; right: 0.9rem; top: 50%; transform: translateY(-50%);
            width: 13px; height: 13px; color: #9ca3af; pointer-events: none;
        }
        .tmpl-sort select {
            appearance: none; -webkit-appearance: none;
            padding: 0.6rem 2.5rem 0.6rem 2.3rem;
            border: 1px solid #e5d0e0; border-radius: 9999px;
            font-size: 0.85rem; color: #374151; background: #fff;
            cursor: pointer; outline: none; transition: border-color 0.2s;
        }
        .tmpl-sort select:focus { border-color: #e02424; }

        /* ── Filters ── */
        .tmpl-filters {
            display: flex; align-items: center; gap: 0.6rem;
            flex-wrap: wrap; margin-bottom: 2rem;
        }
        .filter-label { font-size: 0.78rem; font-weight: 600; color: #6b7280; margin-right: 0.2rem; white-space: nowrap; }
        .filter-chip {
            display: inline-flex; align-items: center;
            padding: 0.38rem 0.95rem; border: 1px solid #e5d0e0; border-radius: 9999px;
            font-size: 0.78rem; color: #6b7280; background: #fff;
            cursor: pointer; transition: border-color 0.2s, background 0.2s, color 0.2s; user-select: none;
        }
        .filter-chip:hover { border-color: #e02424; color: #e02424; }
        .filter-chip.active { background: #e02424; border-color: #e02424; color: #fff; }

        /* ── Results count ── */
        .tmpl-count { font-size: 0.82rem; color: #9ca3af; margin-bottom: 1.5rem; }
        .tmpl-count span { font-weight: 600; color: #374151; }

        /* ── Card grid ── */
        .tmpl-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 1.5rem;
        }
        .inv-card {
            border: 1px solid #f3e8f0; border-radius: 1rem; overflow: hidden;
            background: #fff; transition: box-shadow 0.25s, transform 0.25s; cursor: pointer;
        }
        .inv-card:hover { box-shadow: 0 8px 28px rgba(224,36,36,0.11); transform: translateY(-3px); }
        .inv-card-thumb {
            width: 100%; aspect-ratio: 3/4; background: #f9edf4;
            display: flex; align-items: center; justify-content: center;
            overflow: hidden; position: relative;
        }
        .inv-card-thumb img { width: 100%; height: 100%; object-fit: cover; }
        .inv-thumb-placeholder { width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; }
        .inv-card-badge {
            position: absolute; top: 0.65rem; left: 0.65rem;
            padding: 0.22rem 0.65rem; border-radius: 9999px;
            font-size: 0.68rem; font-weight: 600; color: #fff;
        }
        .badge-popular { background: #e02424; }
        .badge-new     { background: #7c3aed; }
        .badge-free    { background: #059669; }
        .inv-card-body { padding: 0.9rem 1rem 1rem; }
        .inv-card-name { font-size: 0.875rem; font-weight: 700; color: #1a1a1a; margin-bottom: 0.25rem; }
        .inv-card-meta { display: flex; align-items: center; justify-content: space-between; }
        .inv-card-category { font-size: 0.73rem; color: #9ca3af; }
        .inv-card-price { font-size: 0.82rem; font-weight: 700; color: #e02424; }
        .inv-card-price.free-tag { color: #059669; }

        /* Preview overlay on hover */
        .inv-card-thumb::after {
            content: 'Preview';
            position: absolute; inset: 0;
            background: rgba(0,0,0,0.35);
            color: #fff; font-size: 0.82rem; font-weight: 600;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: opacity 0.2s; letter-spacing: 0.04em;
        }
        .inv-card:hover .inv-card-thumb::after { opacity: 1; }

        /* ── Empty state ── */
        .tmpl-empty {
            display: none; text-align: center; padding: 5rem 1rem; color: #9ca3af;
        }
        .tmpl-empty svg { width: 56px; height: 56px; margin: 0 auto 1rem; color: #e5d0e0; display: block; }
        .tmpl-empty p { font-size: 0.9rem; }

        /* ── Pagination ── */
        .tmpl-pagination {
            display: flex; align-items: center; justify-content: center;
            gap: 0.4rem; margin-top: 3rem;
        }
        .pg-btn {
            width: 36px; height: 36px; border-radius: 9999px; border: 1px solid #e5d0e0;
            background: #fff; font-size: 0.82rem; color: #374151;
            cursor: pointer; display: flex; align-items: center; justify-content: center;
            transition: border-color 0.2s, background 0.2s, color 0.2s;
        }
        .pg-btn:hover { border-color: #e02424; color: #e02424; }
        .pg-btn.active { background: #e02424; border-color: #e02424; color: #fff; font-weight: 700; }
        .pg-btn:disabled { opacity: 0.4; cursor: default; pointer-events: none; }
        .pg-dots { font-size: 0.82rem; color: #9ca3af; padding: 0 0.25rem; }

        @media (max-width: 1100px) { .tmpl-grid { grid-template-columns: repeat(3, 1fr); } }
        @media (max-width: 768px) {
            .tmpl-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
            .tmpl-toolbar { flex-wrap: wrap; }
            .tmpl-search { max-width: 100%; flex: 1 1 auto; }
            .tmpl-hero-inner h1 { font-size: 1.8rem; }
        }
        @media (max-width: 480px) {
            .tmpl-grid { grid-template-columns: repeat(2, 1fr); gap: 0.75rem; }
            .tmpl-main { padding: 2rem 1.25rem 4rem; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar">
        <div class="nav-inner">
            <a href="/" class="nav-logo">Azalea</a>
            <div class="nav-right">
                <a href="/">Home</a>
                <a href="/templates" class="active">Template</a>
                <a href="/blog">Blog</a>
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
            </div>
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
        <div class="mobile-menu" id="mobile-menu">
            <a href="/">Home</a>
            <a href="/templates">Template</a>
            <a href="/blog">Blog</a>
            <div class="mobile-auth">
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <section class="tmpl-hero">
        <div class="tmpl-hero-inner">
            <h1>Invitation Templates</h1>
            <p>Browse hundreds of exclusive, modern, and ready-to-personalise invitation designs — find the one that matches your perfect day.</p>
        </div>
    </section>

    <!-- Main -->
    <main class="tmpl-main">

        <!-- Toolbar: search (left) + sort (right) -->
        <div class="tmpl-toolbar">
            <div class="tmpl-search">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                </svg>
                <input type="text" id="tmplSearch" placeholder="Search templates…" autocomplete="off">
            </div>
            <div class="tmpl-sort">
                <svg class="ico-sort" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <line x1="3" y1="6" x2="21" y2="6"/><line x1="6" y1="12" x2="18" y2="12"/><line x1="9" y1="18" x2="15" y2="18"/>
                </svg>
                <select id="tmplSort" aria-label="Sort templates">
                    <option value="newest">Newest</option>
                    <option value="popular">Most Popular</option>
                    <option value="price-asc">Price: Low to High</option>
                    <option value="price-desc">Price: High to Low</option>
                    <option value="az">A – Z</option>
                </select>
                <svg class="ico-chevron" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <polyline points="6 9 12 15 18 9"/>
                </svg>
            </div>
        </div>

        <!-- Filter chips -->
        <div class="tmpl-filters" id="tmplFilters">
            <span class="filter-label">Filter:</span>
            <button class="filter-chip active" data-filter="all">All</button>
            <button class="filter-chip" data-filter="minimalist">Minimalist</button>
            <button class="filter-chip" data-filter="floral">Floral</button>
            <button class="filter-chip" data-filter="elegant">Elegant</button>
            <button class="filter-chip" data-filter="traditional">Traditional</button>
            <button class="filter-chip" data-filter="modern">Modern</button>
            <button class="filter-chip" data-filter="rustic">Rustic</button>
            <button class="filter-chip" data-filter="islamic">Islamic</button>
        </div>

        <!-- Results count -->
        <p class="tmpl-count" id="tmplCount"><span id="countNum">{{ $templates->isNotEmpty() ? $templates->count() : 16 }}</span> templates found</p>

        <!-- Card grid -->
        <div class="tmpl-grid" id="tmplGrid">

            @if ($templates->isNotEmpty())
                @foreach ($templates as $template)
                <div class="inv-card"
                     data-category="{{ $template->category }}"
                     data-name="{{ strtolower($template->name) }}"
                     data-price="{{ $template->price }}"
                     data-order="{{ $template->sort_order }}">
                    <div class="inv-card-thumb">
                        @if ($template->thumbnail_path)
                            <img src="{{ $template->thumbnailUrl() }}" alt="{{ $template->name }}">
                        @else
                            <div class="inv-thumb-placeholder">
                                <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                                    <rect width="180" height="240" fill="#f9edf4"/>
                                    <rect x="60" y="90" width="60" height="6" rx="3" fill="#e0a0bc" opacity=".5"/>
                                    <rect x="70" y="102" width="40" height="4" rx="2" fill="#e0a0bc" opacity=".35"/>
                                    <rect x="52" y="116" width="76" height="2.5" rx="1.25" fill="#e0a0bc" opacity=".25"/>
                                    <rect x="56" y="124" width="68" height="2.5" rx="1.25" fill="#e0a0bc" opacity=".25"/>
                                    <rect x="62" y="160" width="56" height="14" rx="7" fill="#e02424" opacity=".5"/>
                                </svg>
                            </div>
                        @endif
                        @if ($template->badge)
                            <span class="inv-card-badge badge-{{ $template->badge }}">{{ ucfirst($template->badge) }}</span>
                        @endif
                    </div>
                    <div class="inv-card-body">
                        <div class="inv-card-name">{{ $template->name }}</div>
                        <div class="inv-card-meta">
                            <span class="inv-card-category">{{ ucfirst($template->category) }}</span>
                            <span class="inv-card-price {{ $template->price === 0 ? 'free-tag' : '' }}">
                                {{ $template->formattedPrice() }}
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            @else
            {{-- No templates in DB yet: show design-time placeholder cards --}}
            <!-- 1: Rosa Bloom -->
            <div class="inv-card" data-category="floral" data-name="rosa bloom" data-price="149000" data-order="2">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fdf0f7"/>
                            <ellipse cx="90" cy="62" rx="26" ry="30" fill="#f9d4e8" opacity=".7"/>
                            <ellipse cx="90" cy="62" rx="14" ry="18" fill="#f472b6" opacity=".5"/>
                            <circle cx="90" cy="62" r="6" fill="#e02424" opacity=".8"/>
                            <ellipse cx="68" cy="72" rx="14" ry="9" fill="#f9d4e8" opacity=".55" transform="rotate(-30 68 72)"/>
                            <ellipse cx="112" cy="72" rx="14" ry="9" fill="#f9d4e8" opacity=".55" transform="rotate(30 112 72)"/>
                            <rect x="60" y="105" width="60" height="5" rx="2.5" fill="#e0a0bc" opacity=".6"/>
                            <rect x="70" y="116" width="40" height="4" rx="2" fill="#e0a0bc" opacity=".4"/>
                            <rect x="55" y="130" width="70" height="3" rx="1.5" fill="#e0a0bc" opacity=".3"/>
                            <rect x="58" y="140" width="64" height="3" rx="1.5" fill="#e0a0bc" opacity=".3"/>
                            <rect x="62" y="150" width="56" height="3" rx="1.5" fill="#e0a0bc" opacity=".3"/>
                            <rect x="65" y="170" width="50" height="14" rx="7" fill="#e02424" opacity=".75"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-popular">Popular</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Rosa Bloom</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Floral</span>
                        <span class="inv-card-price">Rp 149k</span>
                    </div>
                </div>
            </div>

            <!-- 2: Ivory Serif -->
            <div class="inv-card" data-category="minimalist" data-name="ivory serif" data-price="99000" data-order="1">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f8f6f4"/>
                            <line x1="40" y1="60" x2="140" y2="60" stroke="#c9b9a8" stroke-width="1.2"/>
                            <rect x="60" y="72" width="60" height="7" rx="3.5" fill="#c9b9a8" opacity=".5"/>
                            <rect x="70" y="86" width="40" height="5" rx="2.5" fill="#c9b9a8" opacity=".4"/>
                            <line x1="75" y1="100" x2="105" y2="100" stroke="#c9b9a8" stroke-width="1"/>
                            <rect x="50" y="114" width="80" height="3" rx="1.5" fill="#c9b9a8" opacity=".3"/>
                            <rect x="54" y="122" width="72" height="3" rx="1.5" fill="#c9b9a8" opacity=".3"/>
                            <rect x="58" y="130" width="64" height="3" rx="1.5" fill="#c9b9a8" opacity=".3"/>
                            <rect x="54" y="140" width="72" height="3" rx="1.5" fill="#c9b9a8" opacity=".3"/>
                            <line x1="40" y1="160" x2="140" y2="160" stroke="#c9b9a8" stroke-width="1.2"/>
                            <rect x="62" y="172" width="56" height="14" rx="7" fill="#1a1a1a" opacity=".8"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-new">New</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Ivory Serif</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Minimalist</span>
                        <span class="inv-card-price">Rp 99k</span>
                    </div>
                </div>
            </div>

            <!-- 3: Midnight Gold -->
            <div class="inv-card" data-category="elegant" data-name="midnight gold" data-price="199000" data-order="5">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#1c1c2e"/>
                            <rect x="18" y="18" width="144" height="204" rx="4" fill="none" stroke="#b8976a" stroke-width="1"/>
                            <rect x="24" y="24" width="132" height="192" rx="3" fill="none" stroke="#b8976a" stroke-width=".5" opacity=".5"/>
                            <ellipse cx="90" cy="72" rx="22" ry="24" fill="none" stroke="#b8976a" stroke-width="1.2"/>
                            <rect x="58" y="106" width="64" height="6" rx="3" fill="#b8976a" opacity=".7"/>
                            <rect x="68" y="118" width="44" height="4" rx="2" fill="#b8976a" opacity=".5"/>
                            <rect x="52" y="132" width="76" height="2.5" rx="1.25" fill="#b8976a" opacity=".3"/>
                            <rect x="56" y="140" width="68" height="2.5" rx="1.25" fill="#b8976a" opacity=".3"/>
                            <rect x="52" y="148" width="76" height="2.5" rx="1.25" fill="#b8976a" opacity=".3"/>
                            <rect x="62" y="166" width="56" height="14" rx="7" fill="#b8976a" opacity=".85"/>
                        </svg>
                    </div>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Midnight Gold</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Elegant</span>
                        <span class="inv-card-price">Rp 199k</span>
                    </div>
                </div>
            </div>

            <!-- 4: Batik Nusantara -->
            <div class="inv-card" data-category="traditional" data-name="batik nusantara" data-price="149000" data-order="3">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fffbf0"/>
                            <rect x="10" y="10" width="160" height="220" rx="3" fill="none" stroke="#c8a45a" stroke-width="2"/>
                            <path d="M10 40 Q90 25 170 40" stroke="#c8a45a" stroke-width="1" fill="none"/>
                            <path d="M10 200 Q90 215 170 200" stroke="#c8a45a" stroke-width="1" fill="none"/>
                            <path d="M40 10 Q55 50 40 90" stroke="#8b4513" stroke-width="1.5" fill="none" opacity=".4"/>
                            <path d="M140 10 Q125 50 140 90" stroke="#8b4513" stroke-width="1.5" fill="none" opacity=".4"/>
                            <rect x="58" y="100" width="64" height="6" rx="3" fill="#8b4513" opacity=".5"/>
                            <rect x="68" y="112" width="44" height="4" rx="2" fill="#8b4513" opacity=".4"/>
                            <rect x="52" y="126" width="76" height="2.5" rx="1.25" fill="#8b4513" opacity=".25"/>
                            <rect x="56" y="134" width="68" height="2.5" rx="1.25" fill="#8b4513" opacity=".25"/>
                            <rect x="62" y="158" width="56" height="14" rx="7" fill="#c8a45a" opacity=".85"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-popular">Popular</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Batik Nusantara</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Traditional</span>
                        <span class="inv-card-price">Rp 149k</span>
                    </div>
                </div>
            </div>

            <!-- 5: Indigo Modern -->
            <div class="inv-card" data-category="modern" data-name="indigo modern" data-price="129000" data-order="1">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f0f4ff"/>
                            <rect x="0" y="0" width="180" height="70" fill="#4f46e5" opacity=".85"/>
                            <rect x="50" y="20" width="80" height="8" rx="4" fill="#fff" opacity=".9"/>
                            <rect x="65" y="34" width="50" height="5" rx="2.5" fill="#fff" opacity=".6"/>
                            <rect x="55" y="90" width="70" height="6" rx="3" fill="#4f46e5" opacity=".6"/>
                            <rect x="62" y="102" width="56" height="4" rx="2" fill="#4f46e5" opacity=".4"/>
                            <rect x="48" y="118" width="84" height="2.5" rx="1.25" fill="#4f46e5" opacity=".2"/>
                            <rect x="52" y="126" width="76" height="2.5" rx="1.25" fill="#4f46e5" opacity=".2"/>
                            <rect x="48" y="134" width="84" height="2.5" rx="1.25" fill="#4f46e5" opacity=".2"/>
                            <rect x="58" y="158" width="64" height="14" rx="7" fill="#4f46e5" opacity=".85"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-new">New</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Indigo Modern</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Modern</span>
                        <span class="inv-card-price">Rp 129k</span>
                    </div>
                </div>
            </div>

            <!-- 6: Sakura Blush -->
            <div class="inv-card" data-category="floral" data-name="sakura blush" data-price="0" data-order="4">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fff9f5"/>
                            <circle cx="30" cy="30" r="22" fill="#f9d4e4" opacity=".5"/>
                            <circle cx="150" cy="210" r="28" fill="#f9d4e4" opacity=".5"/>
                            <circle cx="155" cy="35" r="14" fill="#f472b6" opacity=".3"/>
                            <circle cx="25" cy="205" r="18" fill="#f472b6" opacity=".3"/>
                            <rect x="55" y="95" width="70" height="6" rx="3" fill="#e02424" opacity=".55"/>
                            <rect x="65" y="108" width="50" height="4" rx="2" fill="#e02424" opacity=".4"/>
                            <rect x="50" y="122" width="80" height="2.5" rx="1.25" fill="#c9a0b0" opacity=".4"/>
                            <rect x="54" y="130" width="72" height="2.5" rx="1.25" fill="#c9a0b0" opacity=".4"/>
                            <rect x="50" y="138" width="80" height="2.5" rx="1.25" fill="#c9a0b0" opacity=".4"/>
                            <rect x="54" y="146" width="72" height="2.5" rx="1.25" fill="#c9a0b0" opacity=".4"/>
                            <rect x="62" y="168" width="56" height="14" rx="7" fill="#e02424" opacity=".75"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-free">Free</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Sakura Blush</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Floral</span>
                        <span class="inv-card-price free-tag">Free</span>
                    </div>
                </div>
            </div>

            <!-- 7: Clean Linen -->
            <div class="inv-card" data-category="minimalist" data-name="clean linen" data-price="99000" data-order="6">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fafafa"/>
                            <rect x="36" y="36" width="108" height="168" rx="2" fill="none" stroke="#d1d5db" stroke-width="1.5"/>
                            <rect x="58" y="60" width="64" height="5" rx="2.5" fill="#374151" opacity=".5"/>
                            <rect x="68" y="70" width="44" height="4" rx="2" fill="#374151" opacity=".35"/>
                            <circle cx="90" cy="100" r="18" fill="#f3f4f6"/>
                            <rect x="52" y="128" width="76" height="2.5" rx="1.25" fill="#d1d5db"/>
                            <rect x="56" y="136" width="68" height="2.5" rx="1.25" fill="#d1d5db"/>
                            <rect x="52" y="144" width="76" height="2.5" rx="1.25" fill="#d1d5db"/>
                            <rect x="62" y="164" width="56" height="14" rx="7" fill="#374151" opacity=".7"/>
                        </svg>
                    </div>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Clean Linen</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Minimalist</span>
                        <span class="inv-card-price">Rp 99k</span>
                    </div>
                </div>
            </div>

            <!-- 8: Golden Frame -->
            <div class="inv-card" data-category="elegant" data-name="golden frame" data-price="199000" data-order="3">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f9f5f0"/>
                            <rect x="0" y="0" width="180" height="240" fill="none" stroke="#d4af72" stroke-width="3"/>
                            <path d="M15 15 L35 15 L35 35" stroke="#d4af72" stroke-width="1.5" fill="none"/>
                            <path d="M165 15 L145 15 L145 35" stroke="#d4af72" stroke-width="1.5" fill="none"/>
                            <path d="M15 225 L35 225 L35 205" stroke="#d4af72" stroke-width="1.5" fill="none"/>
                            <path d="M165 225 L145 225 L145 205" stroke="#d4af72" stroke-width="1.5" fill="none"/>
                            <ellipse cx="90" cy="72" rx="28" ry="32" fill="none" stroke="#d4af72" stroke-width="1"/>
                            <rect x="56" y="114" width="68" height="5" rx="2.5" fill="#d4af72" opacity=".7"/>
                            <rect x="66" y="125" width="48" height="4" rx="2" fill="#d4af72" opacity=".5"/>
                            <rect x="50" y="138" width="80" height="2" rx="1" fill="#d4af72" opacity=".3"/>
                            <rect x="54" y="146" width="72" height="2" rx="1" fill="#d4af72" opacity=".3"/>
                            <rect x="50" y="154" width="80" height="2" rx="1" fill="#d4af72" opacity=".3"/>
                            <rect x="62" y="174" width="56" height="14" rx="7" fill="#d4af72" opacity=".85"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-popular">Popular</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Golden Frame</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Elegant</span>
                        <span class="inv-card-price">Rp 199k</span>
                    </div>
                </div>
            </div>

            <!-- 9: Olive Garden -->
            <div class="inv-card" data-category="rustic" data-name="olive garden" data-price="119000" data-order="2">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f4f7f0"/>
                            <ellipse cx="30" cy="50" rx="20" ry="28" fill="#6b8f47" opacity=".25" transform="rotate(-15 30 50)"/>
                            <ellipse cx="150" cy="190" rx="22" ry="30" fill="#6b8f47" opacity=".25" transform="rotate(20 150 190)"/>
                            <ellipse cx="155" cy="55" rx="14" ry="20" fill="#6b8f47" opacity=".18" transform="rotate(10 155 55)"/>
                            <ellipse cx="25" cy="185" rx="16" ry="22" fill="#6b8f47" opacity=".18" transform="rotate(-10 25 185)"/>
                            <rect x="56" y="92" width="68" height="6" rx="3" fill="#4a6741" opacity=".55"/>
                            <rect x="66" y="104" width="48" height="4" rx="2" fill="#4a6741" opacity=".4"/>
                            <rect x="50" y="118" width="80" height="2.5" rx="1.25" fill="#7a9a6a" opacity=".35"/>
                            <rect x="54" y="126" width="72" height="2.5" rx="1.25" fill="#7a9a6a" opacity=".35"/>
                            <rect x="50" y="134" width="80" height="2.5" rx="1.25" fill="#7a9a6a" opacity=".35"/>
                            <rect x="60" y="158" width="60" height="14" rx="7" fill="#4a6741" opacity=".75"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-new">New</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Olive Garden</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Rustic</span>
                        <span class="inv-card-price">Rp 119k</span>
                    </div>
                </div>
            </div>

            <!-- 10: Crescent Moon (Islamic) -->
            <div class="inv-card" data-category="islamic" data-name="crescent moon" data-price="149000" data-order="1">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f5f0ea"/>
                            <rect x="12" y="12" width="156" height="216" rx="3" fill="none" stroke="#b8976a" stroke-width="1.5"/>
                            <path d="M90 38 C78 38 68 48 68 60 C68 72 78 82 90 82 C82 82 74 72 74 60 C74 48 82 38 90 38Z" fill="#b8976a" opacity=".7"/>
                            <circle cx="96" cy="56" r="3" fill="#b8976a" opacity=".6"/>
                            <circle cx="100" cy="48" r="2" fill="#b8976a" opacity=".5"/>
                            <rect x="56" y="96" width="68" height="5" rx="2.5" fill="#6b4c1e" opacity=".55"/>
                            <rect x="66" y="107" width="48" height="4" rx="2" fill="#6b4c1e" opacity=".4"/>
                            <rect x="50" y="120" width="80" height="2.5" rx="1.25" fill="#b8976a" opacity=".35"/>
                            <rect x="54" y="128" width="72" height="2.5" rx="1.25" fill="#b8976a" opacity=".35"/>
                            <rect x="50" y="136" width="80" height="2.5" rx="1.25" fill="#b8976a" opacity=".35"/>
                            <rect x="54" y="144" width="72" height="2.5" rx="1.25" fill="#b8976a" opacity=".35"/>
                            <rect x="60" y="164" width="60" height="14" rx="7" fill="#6b4c1e" opacity=".75"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-popular">Popular</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Crescent Moon</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Islamic</span>
                        <span class="inv-card-price">Rp 149k</span>
                    </div>
                </div>
            </div>

            <!-- 11: Dusty Rose -->
            <div class="inv-card" data-category="floral" data-name="dusty rose" data-price="129000" data-order="6">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fdf4f6"/>
                            <circle cx="90" cy="70" r="32" fill="#f4c2ce" opacity=".4"/>
                            <circle cx="90" cy="70" r="20" fill="#e8a0b0" opacity=".45"/>
                            <circle cx="90" cy="70" r="10" fill="#e02424" opacity=".3"/>
                            <ellipse cx="60" cy="58" rx="12" ry="8" fill="#f4c2ce" opacity=".45" transform="rotate(-20 60 58)"/>
                            <ellipse cx="120" cy="58" rx="12" ry="8" fill="#f4c2ce" opacity=".45" transform="rotate(20 120 58)"/>
                            <ellipse cx="62" cy="86" rx="10" ry="6" fill="#f4c2ce" opacity=".35" transform="rotate(15 62 86)"/>
                            <ellipse cx="118" cy="86" rx="10" ry="6" fill="#f4c2ce" opacity=".35" transform="rotate(-15 118 86)"/>
                            <rect x="58" y="112" width="64" height="5" rx="2.5" fill="#c8788a" opacity=".5"/>
                            <rect x="68" y="123" width="44" height="4" rx="2" fill="#c8788a" opacity=".4"/>
                            <rect x="52" y="136" width="76" height="2.5" rx="1.25" fill="#d4a0b0" opacity=".35"/>
                            <rect x="56" y="144" width="68" height="2.5" rx="1.25" fill="#d4a0b0" opacity=".35"/>
                            <rect x="52" y="152" width="76" height="2.5" rx="1.25" fill="#d4a0b0" opacity=".35"/>
                            <rect x="62" y="172" width="56" height="14" rx="7" fill="#e02424" opacity=".6"/>
                        </svg>
                    </div>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Dusty Rose</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Floral</span>
                        <span class="inv-card-price">Rp 129k</span>
                    </div>
                </div>
            </div>

            <!-- 12: Obsidian -->
            <div class="inv-card" data-category="modern" data-name="obsidian" data-price="179000" data-order="4">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#111827"/>
                            <rect x="20" y="20" width="140" height="200" rx="6" fill="none" stroke="#e02424" stroke-width=".8" opacity=".6"/>
                            <line x1="20" y1="80" x2="160" y2="80" stroke="#e02424" stroke-width=".5" opacity=".4"/>
                            <rect x="48" y="32" width="84" height="30" rx="3" fill="#1f2937"/>
                            <rect x="58" y="37" width="64" height="6" rx="3" fill="#e02424" opacity=".6"/>
                            <rect x="68" y="50" width="44" height="4" rx="2" fill="#6b7280" opacity=".5"/>
                            <rect x="52" y="92" width="76" height="5" rx="2.5" fill="#e5e7eb" opacity=".5"/>
                            <rect x="60" y="103" width="60" height="4" rx="2" fill="#e5e7eb" opacity=".35"/>
                            <rect x="44" y="116" width="92" height="2" rx="1" fill="#6b7280" opacity=".3"/>
                            <rect x="48" y="124" width="84" height="2" rx="1" fill="#6b7280" opacity=".3"/>
                            <rect x="44" y="132" width="92" height="2" rx="1" fill="#6b7280" opacity=".3"/>
                            <rect x="48" y="140" width="84" height="2" rx="1" fill="#6b7280" opacity=".3"/>
                            <rect x="56" y="162" width="68" height="14" rx="7" fill="#e02424" opacity=".8"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-new">New</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Obsidian</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Modern</span>
                        <span class="inv-card-price">Rp 179k</span>
                    </div>
                </div>
            </div>

            <!-- 13: Javanese Classic -->
            <div class="inv-card" data-category="traditional" data-name="javanese classic" data-price="159000" data-order="5">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#fdf8ee"/>
                            <rect x="8" y="8" width="164" height="224" rx="2" fill="none" stroke="#8b4513" stroke-width="1.5"/>
                            <path d="M8 55 Q50 42 90 50 Q130 42 172 55" stroke="#8b4513" stroke-width="1" fill="none" opacity=".5"/>
                            <path d="M8 185 Q50 198 90 190 Q130 198 172 185" stroke="#8b4513" stroke-width="1" fill="none" opacity=".5"/>
                            <rect x="28" y="15" width="20" height="35" rx="2" fill="#8b4513" opacity=".15"/>
                            <rect x="132" y="15" width="20" height="35" rx="2" fill="#8b4513" opacity=".15"/>
                            <rect x="28" y="190" width="20" height="35" rx="2" fill="#8b4513" opacity=".15"/>
                            <rect x="132" y="190" width="20" height="35" rx="2" fill="#8b4513" opacity=".15"/>
                            <rect x="56" y="72" width="68" height="6" rx="3" fill="#6b4c1e" opacity=".55"/>
                            <rect x="66" y="84" width="48" height="4" rx="2" fill="#6b4c1e" opacity=".4"/>
                            <rect x="50" y="98" width="80" height="2.5" rx="1.25" fill="#8b4513" opacity=".25"/>
                            <rect x="54" y="106" width="72" height="2.5" rx="1.25" fill="#8b4513" opacity=".25"/>
                            <rect x="62" y="158" width="56" height="14" rx="7" fill="#8b4513" opacity=".65"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-popular">Popular</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Javanese Classic</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Traditional</span>
                        <span class="inv-card-price">Rp 159k</span>
                    </div>
                </div>
            </div>

            <!-- 14: Sage & Wood -->
            <div class="inv-card" data-category="rustic" data-name="sage and wood" data-price="0" data-order="4">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f2ede6"/>
                            <rect x="0" y="0" width="180" height="20" fill="#8b6914" opacity=".2"/>
                            <rect x="0" y="220" width="180" height="20" fill="#8b6914" opacity=".2"/>
                            <rect x="0" y="0" width="14" height="240" fill="#8b6914" opacity=".15"/>
                            <rect x="166" y="0" width="14" height="240" fill="#8b6914" opacity=".15"/>
                            <ellipse cx="48" cy="55" rx="18" ry="24" fill="#6b8f47" opacity=".2" transform="rotate(-10 48 55)"/>
                            <ellipse cx="132" cy="55" rx="18" ry="24" fill="#6b8f47" opacity=".2" transform="rotate(10 132 55)"/>
                            <rect x="56" y="90" width="68" height="6" rx="3" fill="#4a3520" opacity=".5"/>
                            <rect x="66" y="102" width="48" height="4" rx="2" fill="#4a3520" opacity=".4"/>
                            <rect x="50" y="116" width="80" height="2.5" rx="1.25" fill="#7a6248" opacity=".35"/>
                            <rect x="54" y="124" width="72" height="2.5" rx="1.25" fill="#7a6248" opacity=".35"/>
                            <rect x="50" y="132" width="80" height="2.5" rx="1.25" fill="#7a6248" opacity=".35"/>
                            <rect x="60" y="158" width="60" height="14" rx="7" fill="#4a3520" opacity=".65"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-free">Free</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Sage & Wood</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Rustic</span>
                        <span class="inv-card-price free-tag">Free</span>
                    </div>
                </div>
            </div>

            <!-- 15: Madinah Pearl -->
            <div class="inv-card" data-category="islamic" data-name="madinah pearl" data-price="169000" data-order="3">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f0ece4"/>
                            <rect x="14" y="14" width="152" height="212" rx="4" fill="none" stroke="#9b8b5a" stroke-width="1"/>
                            <path d="M52 14 L52 50 Q52 56 58 56 L122 56 Q128 56 128 50 L128 14" stroke="#9b8b5a" stroke-width="1" fill="#f5f0e5" opacity=".8"/>
                            <rect x="70" y="22" width="40" height="4" rx="2" fill="#9b8b5a" opacity=".5"/>
                            <rect x="74" y="30" width="32" height="3" rx="1.5" fill="#9b8b5a" opacity=".35"/>
                            <rect x="78" y="40" width="24" height="8" rx="4" fill="none" stroke="#9b8b5a" stroke-width=".8"/>
                            <rect x="54" y="72" width="72" height="5" rx="2.5" fill="#5c4a28" opacity=".55"/>
                            <rect x="64" y="83" width="52" height="4" rx="2" fill="#5c4a28" opacity=".4"/>
                            <rect x="48" y="96" width="84" height="2.5" rx="1.25" fill="#9b8b5a" opacity=".3"/>
                            <rect x="52" y="104" width="76" height="2.5" rx="1.25" fill="#9b8b5a" opacity=".3"/>
                            <rect x="48" y="112" width="84" height="2.5" rx="1.25" fill="#9b8b5a" opacity=".3"/>
                            <rect x="60" y="160" width="60" height="14" rx="7" fill="#5c4a28" opacity=".7"/>
                        </svg>
                    </div>
                    <span class="inv-card-badge badge-new">New</span>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Madinah Pearl</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Islamic</span>
                        <span class="inv-card-price">Rp 169k</span>
                    </div>
                </div>
            </div>

            <!-- 16: Silver Chic -->
            <div class="inv-card" data-category="elegant" data-name="silver chic" data-price="189000" data-order="7">
                <div class="inv-card-thumb">
                    <div class="inv-thumb-placeholder">
                        <svg viewBox="0 0 180 240" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%">
                            <rect width="180" height="240" fill="#f8f8fa"/>
                            <rect x="10" y="10" width="160" height="220" rx="6" fill="none" stroke="#c0c0d0" stroke-width="1.5"/>
                            <rect x="18" y="18" width="144" height="204" rx="4" fill="none" stroke="#c0c0d0" stroke-width=".5" opacity=".5"/>
                            <rect x="0" y="0" width="180" height="50" fill="linear-gradient(180deg,#e8e8f0,transparent)" opacity=".3"/>
                            <circle cx="90" cy="72" r="24" fill="none" stroke="#9090b0" stroke-width="1.2"/>
                            <circle cx="90" cy="72" r="16" fill="#ebebf5" opacity=".6"/>
                            <rect x="58" y="108" width="64" height="5" rx="2.5" fill="#555570" opacity=".5"/>
                            <rect x="68" y="119" width="44" height="4" rx="2" fill="#555570" opacity=".35"/>
                            <rect x="50" y="132" width="80" height="2" rx="1" fill="#9090b0" opacity=".3"/>
                            <rect x="54" y="140" width="72" height="2" rx="1" fill="#9090b0" opacity=".3"/>
                            <rect x="50" y="148" width="80" height="2" rx="1" fill="#9090b0" opacity=".3"/>
                            <rect x="54" y="156" width="72" height="2" rx="1" fill="#9090b0" opacity=".3"/>
                            <rect x="60" y="174" width="60" height="14" rx="7" fill="#555570" opacity=".7"/>
                        </svg>
                    </div>
                </div>
                <div class="inv-card-body">
                    <div class="inv-card-name">Silver Chic</div>
                    <div class="inv-card-meta">
                        <span class="inv-card-category">Elegant</span>
                        <span class="inv-card-price">Rp 189k</span>
                    </div>
                </div>
            </div>

            @endif

        </div><!-- /.tmpl-grid -->

        <!-- Empty state -->
        <div class="tmpl-empty" id="tmplEmpty">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.2">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <p>No templates found. Try adjusting your search or filter.</p>
        </div>

        <!-- Pagination -->
        <div class="tmpl-pagination" id="tmplPagination">
            <button class="pg-btn" id="pgPrev" aria-label="Previous" disabled>
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="15 18 9 12 15 6"/></svg>
            </button>
            <button class="pg-btn active" data-page="1">1</button>
            <button class="pg-btn" data-page="2">2</button>
            <button class="pg-btn" data-page="3">3</button>
            <span class="pg-dots">…</span>
            <button class="pg-btn" data-page="8">8</button>
            <button class="pg-btn" id="pgNext" aria-label="Next">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>

    </main>

    <!-- Confirmation Modal -->
    <div id="useModal" class="use-modal-wrap" role="dialog" aria-modal="true" aria-labelledby="modalHeading">
        <div id="modalOverlay" class="use-modal-overlay"></div>
        <div class="use-modal-box">
            <div class="use-modal-icon">✨</div>
            <h2 class="use-modal-heading" id="modalHeading">Use this template?</h2>
            <p class="use-modal-sub">You selected <strong id="modalTemplateName"></strong>. Would you like to proceed?</p>
            <div class="use-modal-actions">
                <button id="modalNo"  class="use-modal-btn use-modal-btn-no">No</button>
                <button id="modalYes" class="use-modal-btn use-modal-btn-yes">Yes, use it</button>
            </div>
        </div>
    </div>

    <script>
        // Navbar scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 10);
        });

        // Hamburger
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
        });

        // ── Filter / search / sort logic ──
        (function () {
            const chips     = document.querySelectorAll('#tmplFilters .filter-chip');
            const allCards  = Array.from(document.querySelectorAll('#tmplGrid .inv-card'));
            const search    = document.getElementById('tmplSearch');
            const sortSel   = document.getElementById('tmplSort');
            const countEl   = document.getElementById('countNum');
            const emptyEl   = document.getElementById('tmplEmpty');
            const grid      = document.getElementById('tmplGrid');

            let activeFilter = 'all';

            // Chip click: applies immediately
            chips.forEach(chip => {
                chip.addEventListener('click', () => {
                    chips.forEach(c => c.classList.remove('active'));
                    chip.classList.add('active');
                    activeFilter = chip.dataset.filter;
                    applyAll();
                });
            });

            function applyAll() {
                const q = search.value.trim().toLowerCase();

                // Filter
                let visible = allCards.filter(card => {
                    const cat  = card.dataset.category || '';
                    const name = card.dataset.name || '';
                    const matchCat  = activeFilter === 'all' || cat === activeFilter;
                    const matchQ    = !q || name.includes(q) || cat.includes(q);
                    return matchCat && matchQ;
                });

                // Sort
                const val = sortSel.value;
                visible.sort((a, b) => {
                    if (val === 'az')         return a.dataset.name.localeCompare(b.dataset.name);
                    if (val === 'price-asc')  return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                    if (val === 'price-desc') return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                    if (val === 'popular')    return parseInt(a.dataset.order) - parseInt(b.dataset.order);
                    // newest: original DOM order (no change)
                    return 0;
                });

                // Hide all, then show visible in sorted order
                allCards.forEach(c => { c.style.display = 'none'; });
                visible.forEach(c => { c.style.display = ''; grid.appendChild(c); });

                countEl.textContent = visible.length;
                emptyEl.style.display = visible.length === 0 ? 'block' : 'none';
            }

            // Live search
            search.addEventListener('input', applyAll);

            // Sort change applies immediately
            sortSel.addEventListener('change', applyAll);

            // Pagination buttons (visual only — real pagination requires backend)
            document.querySelectorAll('[data-page]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.querySelectorAll('[data-page]').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    document.getElementById('pgPrev').disabled = btn.dataset.page === '1';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            });
            document.getElementById('pgNext').addEventListener('click', () => {
                const active = document.querySelector('[data-page].active');
                const next = active ? active.nextElementSibling : null;
                if (next && next.dataset.page) next.click();
            });
            document.getElementById('pgPrev').addEventListener('click', () => {
                const active = document.querySelector('[data-page].active');
                const prev = active ? active.previousElementSibling : null;
                if (prev && prev.dataset.page) prev.click();
            });
        })();
        // ── Card click → confirmation modal ──
        (function () {
            const modal      = document.getElementById('useModal');
            const modalName  = document.getElementById('modalTemplateName');
            const btnYes     = document.getElementById('modalYes');
            const btnNo      = document.getElementById('modalNo');
            const overlay    = document.getElementById('modalOverlay');
            let pendingCard  = null;

            function openModal(card) {
                pendingCard = card;
                modalName.textContent = card.querySelector('.inv-card-name')?.textContent?.trim() || 'this template';
                modal.classList.add('modal-open');
                document.body.style.overflow = 'hidden';
                btnYes.focus();
            }

            function closeModal() {
                modal.classList.remove('modal-open');
                document.body.style.overflow = '';
                pendingCard = null;
            }

            // Attach click to every card (including dynamically sorted ones via delegation)
            document.getElementById('tmplGrid').addEventListener('click', (e) => {
                const card = e.target.closest('.inv-card');
                if (card) openModal(card);
            });

            btnNo.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);

            btnYes.addEventListener('click', () => {
                // TODO: wire up to actual "use template" action (e.g. redirect or AJAX)
                // For now just close — replace this block when backend is ready.
                closeModal();
            });

            // Close on Escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeModal();
            });
        })();
    </script>

    <style>
        /* ── Confirmation Modal ── */
        .use-modal-wrap {
            position: fixed; inset: 0; z-index: 200;
            display: flex; align-items: center; justify-content: center;
            pointer-events: none; opacity: 0;
            transition: opacity 0.2s ease;
        }
        .use-modal-wrap.modal-open {
            pointer-events: all; opacity: 1;
        }
        .use-modal-overlay {
            position: absolute; inset: 0;
            background: rgba(0, 0, 0, 0.35);
            backdrop-filter: blur(3px);
        }
        .use-modal-box {
            position: relative; z-index: 1;
            background: #fff; border-radius: 1.25rem;
            padding: 2.25rem 2rem 2rem;
            max-width: 380px; width: calc(100% - 2.5rem);
            text-align: center;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
            transform: translateY(16px) scale(0.97);
            transition: transform 0.25s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.2s ease;
            opacity: 0;
        }
        .use-modal-wrap.modal-open .use-modal-box {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        .use-modal-icon {
            font-size: 2.25rem; margin-bottom: 0.85rem; line-height: 1;
        }
        .use-modal-heading {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.35rem; font-weight: 700; color: #1a1a1a;
            margin-bottom: 0.5rem; line-height: 1.3;
        }
        .use-modal-sub {
            font-size: 0.875rem; color: #6b7280; line-height: 1.6;
            margin-bottom: 1.75rem;
        }
        .use-modal-sub strong { color: #1a1a1a; font-weight: 600; }
        .use-modal-actions {
            display: flex; gap: 0.75rem; justify-content: center;
        }
        .use-modal-btn {
            flex: 1; max-width: 150px;
            padding: 0.65rem 1rem; border-radius: 9999px;
            font-size: 0.875rem; font-weight: 600; cursor: pointer;
            border: none; transition: background 0.2s, transform 0.15s;
        }
        .use-modal-btn:active { transform: scale(0.97); }
        .use-modal-btn-no {
            background: #f3f4f6; color: #374151;
            border: 1px solid #e5e7eb;
        }
        .use-modal-btn-no:hover { background: #e5e7eb; }
        .use-modal-btn-yes {
            background: #e02424; color: #fff;
        }
        .use-modal-btn-yes:hover { background: #c81e1e; }
    </style>
</body>
</html>
