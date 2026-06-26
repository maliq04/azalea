<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $post->title }} – {{ config('app.name', 'Azalea') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
        .nav-logo { font-size: 1.2rem; font-weight: 400; color: #1a1a1a; text-decoration: none; font-family: 'Playwrite AU TAS', cursive; }
        .nav-right { display: flex; align-items: center; gap: 1.75rem; }
        .nav-right a:not(.btn-login):not(.btn-register) {
            font-size: 0.875rem; font-weight: 500; color: #374151; text-decoration: none; transition: color 0.2s;
        }
        .nav-right a:not(.btn-login):not(.btn-register):hover { color: #111827; }
        .nav-right a.active { color: #e02424; font-weight: 600; }
        .btn-login { font-size: 0.875rem; font-weight: 500; color: #374151; text-decoration: none; padding: 0.45rem 1.1rem; border-radius: 9999px; }
        .btn-register { font-size: 0.875rem; font-weight: 500; color: #fff; background-color: #1f2937; text-decoration: none; padding: 0.45rem 1.25rem; border-radius: 9999px; }
        .btn-register:hover { background-color: #111827; }
        .hamburger { display: none; flex-direction: column; justify-content: center; gap: 5px; background: none; border: none; cursor: pointer; padding: 4px; }
        .hamburger span { display: block; width: 22px; height: 2px; background-color: #374151; border-radius: 2px; transition: transform 0.3s, opacity 0.3s; }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }
        .mobile-menu { display: none; flex-direction: column; padding: 1rem 2rem 1.25rem; border-top: 1px solid #f0d4e2; gap: 0.25rem; }
        .mobile-menu.open { display: flex; }
        .mobile-menu a { font-size: 0.9rem; font-weight: 500; color: #374151; text-decoration: none; padding: 0.6rem 0; border-bottom: 1px solid #f9edf4; }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu .mobile-auth { display: flex; gap: 0.75rem; padding-top: 0.75rem; }
        .mobile-menu .mobile-auth a { flex: 1; text-align: center; padding: 0.55rem 1rem; border-bottom: none; border-radius: 9999px; }
        .mobile-menu .mobile-auth .btn-login { border: 1px solid #d1d5db; }
        .mobile-menu .mobile-auth .btn-register { background: #1f2937; color: #fff !important; }
        @media (max-width: 768px) { .nav-right { display: none; } .hamburger { display: flex; } }
    </style>
    <style>
        /* ── Article layout ── */
        .article-wrap { padding-top: 64px; }
        .article-header {
            max-width: 800px; margin: 0 auto; padding: 3rem 2rem 2rem;
            border-bottom: 1px solid #f3e8f0;
        }
        .category-badge {
            display: inline-block; padding: 0.2rem 0.75rem; border-radius: 9999px;
            background: #fce8f3; color: #c0396b; font-size: 0.72rem; font-weight: 600;
            letter-spacing: 0.05em; text-transform: uppercase; margin-bottom: 1rem;
        }
        .article-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.5rem; font-weight: 800; line-height: 1.2; color: #1a1a1a; margin-bottom: 1rem;
        }
        .article-meta {
            display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;
            font-size: 0.82rem; color: #9ca3af; margin-bottom: 1.5rem;
        }
        .article-meta .dot { color: #d1d5db; }
        .article-actions { display: flex; align-items: center; gap: 0.75rem; }
        .like-btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.5rem 1.1rem; border-radius: 9999px; border: 1.5px solid #f3e8f0;
            background: #fff; font-size: 0.83rem; font-weight: 600; color: #6b7280;
            cursor: pointer; text-decoration: none; transition: border-color 0.2s, color 0.2s, background 0.2s;
        }
        .like-btn:hover { border-color: #e02424; color: #e02424; }
        .like-btn.liked { border-color: #e02424; background: #fff0f0; color: #e02424; }
        .like-btn svg { width: 17px; height: 17px; flex-shrink: 0; }
        .share-btn {
            display: inline-flex; align-items: center; gap: 0.4rem;
            padding: 0.5rem 1.1rem; border-radius: 9999px; border: 1.5px solid #f3e8f0;
            background: #fff; font-size: 0.83rem; font-weight: 600; color: #6b7280;
            cursor: pointer; transition: border-color 0.2s, color 0.2s;
        }
        .share-btn:hover { border-color: #374151; color: #374151; }
        .share-btn svg { width: 16px; height: 16px; flex-shrink: 0; }
    </style>
    <style>
        /* ── Article body / prose ── */
        .article-body {
            max-width: 720px; margin: 0 auto; padding: 2.5rem 2rem;
            font-size: 1.05rem; line-height: 1.85; color: #374151;
        }
        .article-body h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.6rem; font-weight: 700; color: #1a1a1a;
            margin: 2.25rem 0 0.75rem;
        }
        .article-body h3 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.2rem; font-weight: 600; color: #1a1a1a;
            margin: 1.75rem 0 0.5rem;
        }
        .article-body p { margin-bottom: 1.25rem; }
        .article-body ul, .article-body ol { padding-left: 1.5rem; margin-bottom: 1.25rem; }
        .article-body li { margin-bottom: 0.5rem; }
        .article-body strong { color: #1a1a1a; }
        .article-body em { color: #374151; }
        .article-body blockquote {
            border-left: 3px solid #e02424; padding-left: 1.25rem;
            color: #6b7280; font-style: italic; margin: 1.5rem 0;
        }

        /* ── Stats bar ── */
        .stats-bar {
            max-width: 720px; margin: 0 auto; padding: 1rem 2rem 1.5rem;
            display: flex; align-items: center; gap: 1.5rem;
            font-size: 0.85rem; color: #6b7280;
            border-top: 1px solid #f3e8f0;
        }
        .stats-bar .stat { display: flex; align-items: center; gap: 0.35rem; }
        .stats-bar svg { width: 16px; height: 16px; }

        /* ── Comments section ── */
        .comments-section {
            max-width: 720px; margin: 0 auto; padding: 2rem 2rem 5rem;
            border-top: 1px solid #f3e8f0;
        }
        .comments-section h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.5rem; font-weight: 700; color: #1a1a1a; margin-bottom: 1.75rem;
        }

        /* Auth prompt */
        .auth-prompt {
            border: 1px solid #f3e8f0; border-radius: 1rem; padding: 1.75rem;
            text-align: center; background: #fff9fb; margin-bottom: 2rem;
        }
        .auth-prompt p { font-size: 0.9rem; color: #6b7280; margin-bottom: 1rem; }
        .auth-prompt .auth-btns { display: flex; align-items: center; justify-content: center; gap: 0.75rem; }
        .auth-btn-login {
            font-size: 0.85rem; font-weight: 600; color: #374151; text-decoration: none;
            padding: 0.55rem 1.5rem; border-radius: 9999px; border: 1.5px solid #d1d5db;
            transition: border-color 0.2s;
        }
        .auth-btn-login:hover { border-color: #9ca3af; }
        .auth-btn-register {
            font-size: 0.85rem; font-weight: 600; color: #fff; text-decoration: none;
            padding: 0.55rem 1.5rem; border-radius: 9999px; background: #1f2937;
            transition: background 0.2s;
        }
        .auth-btn-register:hover { background: #111827; }

        /* Comment form */
        .comment-form { margin-bottom: 2.5rem; }
        .comment-form textarea {
            width: 100%; padding: 0.9rem 1rem; border: 1.5px solid #f3e8f0;
            border-radius: 0.75rem; font-size: 0.9rem; font-family: inherit;
            color: #374151; background: #fff; resize: vertical; min-height: 100px;
            outline: none; transition: border-color 0.2s, box-shadow 0.2s;
        }
        .comment-form textarea:focus { border-color: #e02424; box-shadow: 0 0 0 3px rgba(224,36,36,0.07); }
        .comment-form .form-error { font-size: 0.8rem; color: #e02424; margin: 0.3rem 0 0.75rem; }
        .comment-submit {
            margin-top: 0.75rem; padding: 0.6rem 1.75rem; border-radius: 9999px;
            background: #e02424; color: #fff; border: none; font-size: 0.875rem;
            font-weight: 600; cursor: pointer; transition: background 0.2s;
        }
        .comment-submit:hover { background: #c81e1e; }

        /* Comment list */
        .comment-list { display: flex; flex-direction: column; gap: 1.25rem; }
        .comment-item {
            border: 1px solid #f3e8f0; border-radius: 0.875rem; padding: 1.1rem 1.25rem;
            background: #fff;
        }
        .comment-header { display: flex; align-items: center; justify-content: space-between; margin-bottom: 0.6rem; flex-wrap: wrap; gap: 0.5rem; }
        .comment-author { font-size: 0.85rem; font-weight: 700; color: #1a1a1a; }
        .comment-date { font-size: 0.75rem; color: #9ca3af; }
        .comment-body { font-size: 0.875rem; color: #374151; line-height: 1.65; white-space: pre-wrap; word-break: break-word; }
        .delete-form { display: inline; }
        .delete-btn {
            font-size: 0.75rem; color: #9ca3af; background: none; border: none;
            cursor: pointer; padding: 0.2rem 0.5rem; border-radius: 4px;
            transition: color 0.2s, background 0.2s;
        }
        .delete-btn:hover { color: #e02424; background: #fff0f0; }

        /* Toast */
        .toast {
            position: fixed; bottom: 1.5rem; right: 1.5rem; z-index: 100;
            background: #1f2937; color: #fff; font-size: 0.85rem; font-weight: 500;
            padding: 0.65rem 1.25rem; border-radius: 0.5rem;
            opacity: 0; transform: translateY(8px);
            transition: opacity 0.25s, transform 0.25s;
            pointer-events: none;
        }
        .toast.show { opacity: 1; transform: translateY(0); }

        /* Back link */
        .back-link {
            max-width: 800px; margin: 0 auto; padding: 1.5rem 2rem 0;
            display: block; font-size: 0.82rem; color: #9ca3af; text-decoration: none;
        }
        .back-link:hover { color: #374151; }

        @media (max-width: 640px) {
            .article-title { font-size: 1.75rem; }
            .article-body, .stats-bar, .comments-section { padding-left: 1.25rem; padding-right: 1.25rem; }
            .article-header { padding-left: 1.25rem; padding-right: 1.25rem; }
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

    <!-- Back link -->
    <a href="{{ route('blog.index') }}" class="back-link" style="margin-top:4rem;display:block;">← Back to Blog</a>

    <div class="article-wrap">

        <!-- Article header -->
        <header class="article-header">
            <span class="category-badge">{{ $post->category }}</span>
            <h1 class="article-title">{{ $post->title }}</h1>
            <div class="article-meta">
                <span>{{ $post->author }}</span>
                <span class="dot">·</span>
                <span>{{ $post->read_time }} min read</span>
                <span class="dot">·</span>
                <span>{{ $post->published_at ? $post->published_at->format('d F Y') : $post->created_at->format('d F Y') }}</span>
            </div>
            <div class="article-actions">
                @auth
                    {{-- Logged in: AJAX like button --}}
                    <button
                        class="like-btn {{ $post->isLikedBy(auth()->user()) ? 'liked' : '' }}"
                        id="like-btn"
                        data-post-id="{{ $post->id }}"
                        data-like-url="{{ route('blog.like', $post) }}"
                        type="button"
                        aria-label="Like this post"
                    >
                        <svg id="heart-icon" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="{{ $post->isLikedBy(auth()->user()) ? 'currentColor' : 'none' }}"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                        <span id="like-count">{{ $post->likeCount() }}</span>
                    </button>
                @else
                    {{-- Not logged in: redirect to login --}}
                    <a href="/login" class="like-btn" aria-label="Like this post">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                        </svg>
                        <span>{{ $post->likeCount() }}</span>
                    </a>
                @endauth

                <button class="share-btn" id="share-btn" type="button" aria-label="Share this post">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M7.217 10.907a2.25 2.25 0 1 0 0 2.186m0-2.186c.18.324.283.696.283 1.093s-.103.77-.283 1.093m0-2.186 9.566-5.314m-9.566 7.5 9.566 5.314m0 0a2.25 2.25 0 1 0 3.935 2.186 2.25 2.25 0 0 0-3.935-2.186Zm0-12.814a2.25 2.25 0 1 0 3.933-2.185 2.25 2.25 0 0 0-3.933 2.185Z"/>
                    </svg>
                    Share
                </button>
            </div>
        </header>

        <!-- Article body -->
        <article class="article-body">
            {!! $post->body !!}
        </article>

        <!-- Stats bar -->
        <div class="stats-bar">
            <span class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z"/>
                </svg>
                <span id="stats-like-count">{{ $post->likeCount() }}</span> people liked this
            </span>
            <span class="stat">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 8.25h9m-9 3H12m-9.75 1.51c0 1.6 1.123 2.994 2.707 3.227 1.129.166 2.27.293 3.423.379.35.026.67.21.865.501L12 21l2.755-4.133a1.14 1.14 0 0 1 .865-.501 48.172 48.172 0 0 0 3.423-.379c1.584-.233 2.707-1.626 2.707-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z"/>
                </svg>
                {{ $post->comments->count() }} comments
            </span>
        </div>

        <!-- Comments section -->
        <section class="comments-section" id="comments">
            <h2>Comments ({{ $post->comments->count() }})</h2>

            @guest
                <div class="auth-prompt">
                    <p>Log in or create an account to join the conversation.</p>
                    <div class="auth-btns">
                        <a href="/login" class="auth-btn-login">Login</a>
                        <a href="/register" class="auth-btn-register">Register</a>
                    </div>
                </div>
            @else
                <div class="comment-form">
                    <form action="{{ route('blog.comments.store', $post) }}" method="POST">
                        @csrf
                        <textarea
                            name="body"
                            placeholder="Share your thoughts…"
                            aria-label="Write a comment"
                            rows="3"
                        >{{ old('body') }}</textarea>
                        @error('body')
                            <p class="form-error">{{ $message }}</p>
                        @enderror
                        <button type="submit" class="comment-submit">Post Comment</button>
                    </form>
                </div>
            @endguest

            @if ($post->comments->isNotEmpty())
                <div class="comment-list">
                    @foreach ($post->comments as $comment)
                        <div class="comment-item">
                            <div class="comment-header">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <span class="comment-author">{{ $comment->user->name ?? 'Anonymous' }}</span>
                                    <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                @auth
                                    @if ($comment->user_id === auth()->id())
                                        <form class="delete-form" action="{{ route('blog.comments.destroy', $comment) }}" method="POST"
                                            onsubmit="return confirm('Delete this comment?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" aria-label="Delete comment">Delete</button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                            <p class="comment-body">{{ $comment->body }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <p style="font-size:0.875rem;color:#9ca3af;text-align:center;padding:2rem 0;">No comments yet. Be the first to share your thoughts!</p>
            @endif
        </section>

    </div><!-- end .article-wrap -->

    <!-- Toast notification -->
    <div class="toast" id="toast">Link copied!</div>

    <script>
        // ── Navbar scroll effect ──
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 10);
        });

        // ── Hamburger menu ──
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
        });

        // ── Toast helper ──
        function showToast(msg) {
            const toast = document.getElementById('toast');
            toast.textContent = msg;
            toast.classList.add('show');
            setTimeout(() => toast.classList.remove('show'), 2500);
        }

        // ── Share button ──
        const shareBtn = document.getElementById('share-btn');
        if (shareBtn) {
            shareBtn.addEventListener('click', async () => {
                const url = window.location.href;
                if (navigator.share) {
                    try {
                        await navigator.share({ title: document.title, url });
                    } catch (e) { /* user cancelled */ }
                } else {
                    try {
                        await navigator.clipboard.writeText(url);
                        showToast('Link copied!');
                    } catch (e) {
                        showToast('Could not copy link.');
                    }
                }
            });
        }

        // ── Like button (only when logged in) ──
        const likeBtn = document.getElementById('like-btn');
        if (likeBtn) {
            likeBtn.addEventListener('click', async () => {
                const url = likeBtn.dataset.likeUrl;
                const csrf = document.querySelector('meta[name="csrf-token"]').content;
                likeBtn.disabled = true;
                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json',
                            'Content-Type': 'application/json',
                        },
                    });
                    if (!response.ok) throw new Error('Request failed');
                    const data = await response.json();

                    // Update button state
                    const heartIcon = document.getElementById('heart-icon');
                    const likeCount = document.getElementById('like-count');
                    const statsLikeCount = document.getElementById('stats-like-count');

                    if (data.liked) {
                        likeBtn.classList.add('liked');
                        heartIcon.setAttribute('fill', 'currentColor');
                    } else {
                        likeBtn.classList.remove('liked');
                        heartIcon.setAttribute('fill', 'none');
                    }
                    likeCount.textContent = data.count;
                    if (statsLikeCount) statsLikeCount.textContent = data.count;
                } catch (e) {
                    showToast('Something went wrong. Please try again.');
                } finally {
                    likeBtn.disabled = false;
                }
            });
        }
    </script>
</body>
</html>
