<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blog – {{ config('app.name', 'Azalea') }}</title>
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

        /* ── Hero ── */
        .blog-hero {
            padding-top: 64px;
            background: linear-gradient(160deg, #f7e4ee 0%, #fdf0f6 60%, #fff 100%);
            padding-bottom: 3rem;
        }
        .blog-hero-inner {
            max-width: 1280px; margin: 0 auto; padding: 3.5rem 2rem 0;
            text-align: center;
        }
        .blog-hero-inner h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.8rem; font-weight: 700; color: #1a1a1a; line-height: 1.2; margin-bottom: 0.85rem;
        }
        .blog-hero-inner p { font-size: 1rem; color: #6b7280; line-height: 1.7; max-width: 520px; margin: 0 auto; }

        /* ── Main ── */
        .blog-main { max-width: 1280px; margin: 0 auto; padding: 3rem 2rem 5rem; }

        /* ── Grid ── */
        .blog-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        /* ── Card ── */
        .blog-card {
            border: 1px solid #f3e8f0; border-radius: 1rem; overflow: hidden;
            background: #fff; transition: box-shadow 0.25s, transform 0.25s;
            display: flex; flex-direction: column;
        }
        .blog-card:hover { box-shadow: 0 8px 28px rgba(224,36,36,0.11); transform: translateY(-3px); }

        .blog-card-cover {
            width: 100%; aspect-ratio: 16/9; overflow: hidden; position: relative;
            background: #f9edf4;
        }
        .blog-card-cover img { width: 100%; height: 100%; object-fit: cover; }
        .blog-card-cover svg { width: 100%; height: 100%; }

        .blog-card-body { padding: 1.25rem 1.25rem 1rem; flex: 1; display: flex; flex-direction: column; gap: 0.6rem; }

        .category-badge {
            display: inline-block; padding: 0.2rem 0.7rem; border-radius: 9999px;
            background: #fce8f3; color: #c0396b; font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.04em; text-transform: uppercase; width: fit-content;
        }

        .blog-card-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.1rem; font-weight: 700; color: #1a1a1a; line-height: 1.35;
            text-decoration: none; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
        }
        .blog-card-title:hover { color: #e02424; }

        .blog-card-excerpt {
            font-size: 0.875rem; color: #6b7280; line-height: 1.6;
            display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
            flex: 1;
        }

        .blog-card-meta {
            display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;
            font-size: 0.75rem; color: #9ca3af; margin-top: 0.25rem;
        }
        .blog-card-meta .dot { color: #d1d5db; }

        .blog-card-footer {
            padding: 0.75rem 1.25rem 1rem;
            display: flex; align-items: center; justify-content: space-between;
            border-top: 1px solid #f9f0f5;
        }
        .blog-card-stats { display: flex; align-items: center; gap: 1rem; }
        .stat-item { display: flex; align-items: center; gap: 0.3rem; font-size: 0.75rem; color: #9ca3af; }
        .stat-item svg { width: 14px; height: 14px; flex-shrink: 0; }

        .read-more {
            font-size: 0.8rem; font-weight: 600; color: #e02424; text-decoration: none;
            display: flex; align-items: center; gap: 0.25rem; transition: gap 0.2s;
        }
        .read-more:hover { gap: 0.5rem; }

        /* ── Empty state ── */
        .blog-empty { text-align: center; padding: 6rem 1rem; color: #9ca3af; }
        .blog-empty svg { width: 60px; height: 60px; margin: 0 auto 1.25rem; color: #e5d0e0; display: block; }
        .blog-empty h3 { font-family: 'Playfair Display', serif; font-size: 1.4rem; color: #374151; margin-bottom: 0.5rem; }
        .blog-empty p { font-size: 0.9rem; }

        /* ── Footer ── */
        .blog-footer { border-top: 1px solid #f3e8f0; padding: 2rem; text-align: center; font-size: 0.8rem; color: #9ca3af; }

        /* ── Responsive ── */
        @media (max-width: 1024px) { .blog-grid { grid-template-columns: repeat(2, 1fr); } }
        @media (max-width: 640px) {
            .blog-grid { grid-template-columns: 1fr; gap: 1.5rem; }
            .blog-hero-inner h1 { font-size: 2rem; }
            .blog-main { padding: 2rem 1.25rem 4rem; }
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
                <a href="/templates">Template</a>
                <a href="/blog" class="active">Blog</a>
                @auth
                    <span style="font-size:0.875rem;color:#374151;">{{ auth()->user()->name }}</span>
                @else
                    <a href="/login" class="btn-login">Login</a>
                    <a href="/register" class="btn-register">Register</a>
                @endauth
            </div>
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span><span></span><span></span>
            </button>
        </div>
        <div class="mobile-menu" id="mobile-menu">
            <a href="/">Home</a>
            <a href="/templates">Template</a>
            <a href="/blog">Blog</a>
            @auth
                <a href="#">{{ auth()->user()->name }}</a>
            @else
                <div class="mobile-auth">
                    <a href="/login" class="btn-login">Login</a>
                    <a href="/register" class="btn-register">Register</a>
                </div>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <section class="blog-hero">
        <div class="blog-hero-inner">
            <h1>Azalea Blog</h1>
            <p>Tips, inspiration, and guides to help you create the invitation of your dreams.</p>
        </div>
    </section>

    <!-- Main -->
    <main class="blog-main">
        @if ($posts->isEmpty())
            <div class="blog-empty">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25"/>
                </svg>
                <h3>No posts yet</h3>
                <p>Check back soon — we're working on something wonderful.</p>
            </div>
        @else
            <div class="blog-grid">
                @foreach ($posts as $post)
                @php
                    $coverColors = [
                        'Tips'        => ['bg' => '#fff0f5', 'accent' => '#e02424', 'secondary' => '#f9a8c9'],
                        'Inspiration' => ['bg' => '#f0f4ff', 'accent' => '#4f46e5', 'secondary' => '#a5b4fc'],
                        'Guide'       => ['bg' => '#f0fff8', 'accent' => '#059669', 'secondary' => '#6ee7b7'],
                    ];
                    $colors = $coverColors[$post->category] ?? ['bg' => '#f9edf4', 'accent' => '#e02424', 'secondary' => '#f9a8c9'];
                @endphp
                <article class="blog-card">
                    <div class="blog-card-cover">
                        @if ($post->cover_image)
                            <img src="{{ $post->cover_image }}" alt="{{ $post->title }}">
                        @else
                            <svg viewBox="0 0 480 270" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                                <rect width="480" height="270" fill="{{ $colors['bg'] }}"/>
                                <rect x="0" y="0" width="480" height="6" fill="{{ $colors['accent'] }}" opacity=".6"/>
                                <circle cx="60" cy="60" r="50" fill="{{ $colors['secondary'] }}" opacity=".25"/>
                                <circle cx="420" cy="210" r="70" fill="{{ $colors['secondary'] }}" opacity=".2"/>
                                <circle cx="380" cy="50" r="30" fill="{{ $colors['accent'] }}" opacity=".1"/>
                                <rect x="140" y="90" width="200" height="12" rx="6" fill="{{ $colors['accent'] }}" opacity=".45"/>
                                <rect x="160" y="110" width="160" height="8" rx="4" fill="{{ $colors['accent'] }}" opacity=".3"/>
                                <rect x="130" y="130" width="220" height="6" rx="3" fill="{{ $colors['accent'] }}" opacity=".18"/>
                                <rect x="150" y="144" width="180" height="6" rx="3" fill="{{ $colors['accent'] }}" opacity=".18"/>
                                <rect x="170" y="180" width="140" height="28" rx="14" fill="{{ $colors['accent'] }}" opacity=".6"/>
                                <rect x="170" y="180" width="140" height="28" rx="14" fill="none" stroke="{{ $colors['accent'] }}" stroke-width="1" opacity=".3"/>
                            </svg>
                        @endif
                    </div>
                    <div class="blog-card-body">
                        <span class="category-badge">{{ $post->category }}</span>
                        <a href="{{ route('blog.show', $post) }}" class="blog-card-title">{{ $post->title }}</a>
                        <p class="blog-card-excerpt">{{ $post->excerpt }}</p>
                        <div class="blog-card-meta">
                            <span>{{ $post->author }}</span>
                            <span class="dot">·</span>
                            <span>{{ $post->read_time }} min read</span>
                            <span class="dot">·</span>
                            <span>{{ $post->published_at ? $post->published_at->format('d M Y') : $post->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="blog-card-footer">
                        <div class="blog-card-stats">
                            <span class="stat-item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                                </svg>
                                {{ $post->likes->count() }}
                            </span>
                            <span class="stat-item">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                                </svg>
                                {{ $post->comments->count() }}
                            </span>
                        </div>
                        <a href="{{ route('blog.show', $post) }}" class="read-more">Read more →</a>
                    </div>
                </article>
                @endforeach
            </div>
        @endif
    </main>

    <!-- Footer -->
    <footer class="blog-footer">
        <p>© {{ date('Y') }} {{ config('app.name', 'Azalea') }}. All rights reserved.</p>
    </footer>

    <script>
        // Navbar scroll effect
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 10);
        });

        // Hamburger menu
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
        });
    </script>
</body>
</html>
