<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Azalea') }}</title>
    <style>@import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap');</style>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; }

        /* Navbar */
        #navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 50;
            background-color: #f7e4ee;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        #navbar.scrolled {
            background-color: #ffffff;
            box-shadow: 0 1px 12px rgba(0, 0, 0, 0.08);
        }
        .nav-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .nav-logo {
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            text-decoration: none;
            letter-spacing: -0.02em;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 1.75rem;
        }
        .nav-right a:not(.btn-login):not(.btn-register) {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            transition: color 0.2s;
        }
        .nav-right a:not(.btn-login):not(.btn-register):hover { color: #111827; }
        .btn-login {
            font-size: 0.875rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            padding: 0.45rem 1.1rem;
            border-radius: 9999px;
            transition: color 0.2s;
        }
        .btn-login:hover { color: #111827; }
        .btn-register {
            font-size: 0.875rem;
            font-weight: 500;
            color: #ffffff;
            background-color: #1f2937;
            text-decoration: none;
            padding: 0.45rem 1.25rem;
            border-radius: 9999px;
            transition: background-color 0.2s;
        }
        .btn-register:hover { background-color: #111827; }

        /* Hamburger button */
        .hamburger {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            background: none;
            border: none;
            cursor: pointer;
            padding: 4px;
        }
        .hamburger span {
            display: block;
            width: 22px;
            height: 2px;
            background-color: #374151;
            border-radius: 2px;
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
        .hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
        .hamburger.open span:nth-child(2) { opacity: 0; }
        .hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

        /* Mobile drawer */
        .mobile-menu {
            display: none;
            flex-direction: column;
            padding: 1rem 2rem 1.25rem;
            border-top: 1px solid #f0d4e2;
            gap: 0.25rem;
        }
        .mobile-menu.open { display: flex; }
        .mobile-menu a {
            font-size: 0.9rem;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            padding: 0.6rem 0;
            border-bottom: 1px solid #f9edf4;
            transition: color 0.2s;
        }
        .mobile-menu a:last-child { border-bottom: none; }
        .mobile-menu a:hover { color: #111827; }
        .mobile-menu .mobile-auth {
            display: flex;
            gap: 0.75rem;
            padding-top: 0.75rem;
        }
        .mobile-menu .mobile-auth a {
            flex: 1;
            text-align: center;
            padding: 0.55rem 1rem;
            border-bottom: none;
        }
        .mobile-menu .mobile-auth .btn-login {
            border: 1px solid #d1d5db;
            color: #374151;
            border-radius: 9999px;
        }
        .mobile-menu .mobile-auth .btn-register {
            background-color: #1f2937;
            color: #ffffff !important;
            border-radius: 9999px;
        }
        .mobile-menu .mobile-auth .btn-register:hover {
            background-color: #111827;
            color: #ffffff !important;
        }

        @media (max-width: 768px) {
            .nav-right { display: none; }
            .hamburger { display: flex; }
        }

        /* Page content */
        .hero {
            padding-top: 64px;
            min-height: 100vh;
            background: linear-gradient(160deg, #f7e4ee 0%, #fdf0f6 60%, #fff 100%);
            display: flex;
            align-items: center;
            padding-bottom: 4rem;
        }
        .hero-inner {
            max-width: 1280px;
            margin: 0 auto;
            padding: 0 2rem;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 3rem;
        }
        .hero-text {
            flex: 1;
            max-width: 560px;
        }
        .hero h1 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 3.5rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.01em;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }
        .hero p {
            font-size: 1.1rem;
            color: #6b7280;
            line-height: 1.75;
        }
        .hero-buttons {
            display: flex;
            gap: 0.75rem;
            margin-top: 2rem;
        }
        .btn-invitation {
            font-size: 0.9rem;
            font-weight: 600;
            color: #ffffff;
            background-color: #e02424;
            text-decoration: none;
            padding: 0.65rem 1.5rem;
            border-radius: 9999px;
            transition: background-color 0.2s;
            border: 2px solid #e02424;
        }
        .btn-invitation:hover { background-color: #c81e1e; }
        .btn-demo {
            font-size: 0.9rem;
            font-weight: 600;
            color: #e02424;
            background-color: #ffffff;
            text-decoration: none;
            padding: 0.65rem 1.5rem;
            border-radius: 9999px;
            border: 2px solid #e02424;
            transition: background-color 0.2s, color 0.2s;
        }
        .btn-demo:hover { background-color: #fff5f5; }

        /* Phone mockup */
        .hero-mockup {
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1.25rem;
            margin-right: 4rem;
        }
        .phone-frame {
            width: 240px;
            height: 490px;
            background: #ffffff;
            border-radius: 36px;
            border: 8px solid #1a1a1a;
            box-shadow: 0 30px 60px rgba(0,0,0,0.18), inset 0 0 0 2px #333;
            overflow: hidden;
            position: relative;
            animation: float 4s ease-in-out infinite;
        }
        /* Notch */
        .phone-frame::before {
            content: '';
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 18px;
            background: #1a1a1a;
            border-radius: 20px;
            z-index: 10;
        }
        .phone-screen {
            width: 100%;
            height: 100%;
            background: #f0ede8;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }
        /* Placeholder image slot â€” backend: replace src with dynamic image */
        .phone-screen img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        /* Shown when no image is set â€” backend developer sign */
        .phone-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            color: #9ca3af;
            font-size: 0.75rem;
            text-align: center;
            padding: 1rem;
        }
        .phone-placeholder svg {
            width: 40px;
            height: 40px;
            color: #d1d5db;
        }

        /* Float animation */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50%       { transform: translateY(-14px); }
        }

        /* Dot indicators */
        .mockup-dots {
            display: flex;
            gap: 6px;
            align-items: center;
        }
        .mockup-dots span {
            display: block;
            width: 8px;
            height: 8px;
            border-radius: 9999px;
            background: #e02424;
            opacity: 0.3;
            transition: opacity 0.3s;
        }
        .mockup-dots span.active {
            opacity: 1;
            width: 22px;
        }

        @media (max-width: 768px) {
            .hero {
                min-height: auto;
                padding-top: 72px;
                padding-bottom: 2.5rem;
            }
            .hero-inner {
                flex-direction: column;
                text-align: center;
                gap: 1.75rem;
            }
            .hero-text { max-width: 100%; }
            .hero h1 {
                font-size: 1.75rem;
                margin-bottom: 0.85rem;
            }
            .hero p {
                font-size: 0.9rem;
                line-height: 1.65;
            }
            .hero-buttons {
                justify-content: center;
            }
            .phone-frame {
                width: 150px;
                height: 306px;
            }
            .hero-mockup {
                margin-right: 0;
                align-self: center;
            }
        }
        @media (max-width: 480px) {
            .hero h1 { font-size: 1.6rem; }
            .phone-frame {
                width: 150px;
                height: 306px;
            }
        }
        .extra-section {
            min-height: 100vh;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .extra-section p {
            font-size: 1.25rem;
            color: #9ca3af;
        }

        /* Why Choose Section */
        .why-section {
            background: #fafafa;
            padding: 5rem 2rem;
        }
        .why-inner {
            max-width: 1100px;
            margin: 0 auto;
        }
        .why-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.5rem;
            font-weight: 700;
            color: #1a1a1a;
            text-align: center;
            margin-bottom: 0.75rem;
            line-height: 1.25;
        }
        .why-subtitle {
            text-align: center;
            color: #6b7280;
            font-size: 1rem;
            margin-bottom: 3.5rem;
        }
        .why-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }
        .why-card {
            background: #fff;
            border: 1px solid #f3e8f0;
            border-radius: 1.25rem;
            padding: 2rem 1.75rem;
            text-align: center;
            box-shadow: 0 4px 24px rgba(224, 36, 36, 0.05);
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease, transform 0.6s ease, box-shadow 0.3s;
        }
        .why-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .why-card:hover {
            box-shadow: 0 8px 32px rgba(224, 36, 36, 0.12);
            transform: translateY(-4px);
        }
        .why-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 9999px;
            background: #fff1f1;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.25rem;
            font-size: 1.75rem;
        }
        .why-card h3 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.2rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.75rem;
        }
        .why-card p {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.7;
        }
        .why-card .why-stat {
            display: inline-block;
            margin-top: 1.25rem;
            font-size: 1.5rem;
            font-weight: 700;
            color: #e02424;
        }
        .why-card .why-stat-label {
            display: block;
            font-size: 0.8rem;
            color: #9ca3af;
            margin-top: 0.1rem;
        }
        @media (max-width: 900px) {
            .why-grid { grid-template-columns: repeat(2, 1fr); }
            .why-title { font-size: 1.9rem; }
        }
        @media (max-width: 600px) {
            .why-grid { grid-template-columns: 1fr; }
            .why-title { font-size: 1.5rem; }
            .why-section { padding: 3rem 1.25rem; }
            .why-subtitle { margin-bottom: 2rem; }
            .why-card { padding: 1.5rem 1.25rem; }
        }

        /* Features Illustration Section */
        .features-section {
            background: #fafafa;
            padding: 5rem 2rem;
        }
        .features-inner {
            max-width: 1100px;
            margin: 0 auto;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
        }
        .feature-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1rem;
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .feature-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .feature-img-wrap {
            width: 100%;
            max-width: 280px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
        }
        .feature-img-wrap img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        /* Placeholder when no image uploaded */
        .feature-img-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            gap: 0.4rem;
            color: #d1d5db;
            font-size: 0.7rem;
        }
        .feature-img-placeholder .illus-svg {
            width: 160px;
            height: 160px;
            opacity: 0.35;
        }
        .feature-item h3 {
            font-size: 1rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.6rem;
        }
        .feature-item p {
            font-size: 0.875rem;
            color: #6b7280;
            line-height: 1.75;
            max-width: 260px;
        }
        /* Mobile carousel for features */
        .features-carousel-wrap {
            display: none;
        }
        .features-carousel {
            overflow: hidden;
            position: relative;
        }
        .features-carousel-track {
            display: flex;
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .features-carousel-track .feature-item {
            min-width: 100%;
            opacity: 1;
            transform: none;
            padding: 0.5rem 1rem;
        }
        .carousel-dots {
            display: flex;
            justify-content: center;
            gap: 6px;
            margin-top: 1.25rem;
        }
        .carousel-dots button {
            width: 8px;
            height: 8px;
            border-radius: 9999px;
            border: none;
            background: #e02424;
            opacity: 0.3;
            cursor: pointer;
            padding: 0;
            transition: opacity 0.3s, width 0.3s;
        }
        .carousel-dots button.active {
            opacity: 1;
            width: 22px;
        }
        @media (max-width: 768px) {
            .features-grid { display: none; }
            .features-carousel-wrap { display: block; }
        }

        /* How It Works Steps */
        .steps-section {
            background: #fff9fb;
            padding: 5rem 2rem;
        }
        .steps-inner {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }
        .steps-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 2.25rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
            margin-bottom: 0.75rem;
        }
        .steps-subtitle {
            font-size: 0.95rem;
            color: #9ca3af;
            margin-bottom: 3.5rem;
        }
        .steps-row {
            display: flex;
            align-items: flex-start;
            justify-content: center;
        }
        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.85rem;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .step-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .step-circle {
            width: 52px;
            height: 52px;
            border-radius: 9999px;
            border: 2px solid #e02424;
            color: #e02424;
            font-size: 1.1rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #fff;
            flex-shrink: 0;
        }
        .step-label {
            font-size: 0.85rem;
            color: #374151;
            font-weight: 500;
            line-height: 1.5;
            text-align: center;
        }
        .step-optional {
            font-size: 0.75rem;
            color: #9ca3af;
            font-weight: 400;
        }
        .step-line {
            flex: 1;
            height: 2px;
            border-top: 2px dashed #f0b8cc;
            margin-top: 26px;
            min-width: 30px;
        }

        /* ── Mobile 2×2 grid steps ── */
        .steps-zigzag {
            display: none;
            position: relative;
            max-width: 340px;
            margin: 0 auto;
        }
        .steps-zigzag-svg {
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            pointer-events: none;
            overflow: visible;
        }
        .steps-grid-2x2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: auto auto;
            gap: 2.5rem 1rem;
        }
        .sgrid-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 0.6rem;
            text-align: center;
            opacity: 0;
            transform: translateY(16px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }
        .sgrid-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .sgrid-item .step-circle {
            width: 52px;
            height: 52px;
        }
        .sgrid-item .step-label {
            font-size: 0.8rem;
        }

        @media (max-width: 640px) {
            .steps-row { display: none; }
            .steps-zigzag { display: block; }
            .steps-title { font-size: 1.5rem; }
            .steps-section { padding: 3rem 1.25rem; }
            .steps-subtitle { margin-bottom: 2rem; }
        }

        /* Complete Features Section */
        .feat-section {
            background: #fff;
            padding: 6rem 5rem;
        }
        .feat-inner {
            max-width: 1280px;
            margin: 0 auto;
        }
        .feat-header {
            text-align: center;
            margin-bottom: 4rem;
        }
        .feat-header h2 {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 1.85rem;
            font-weight: 700;
            color: #1a1a1a;
            line-height: 1.3;
            margin-bottom: 0.6rem;
        }
        .feat-header p {
            font-size: 0.85rem;
            color: #9ca3af;
            max-width: 500px;
            margin: 0 auto;
            line-height: 1.7;
        }
        .feat-grid {
            display: grid;
            grid-template-columns: 1fr 1px 1fr;
            gap: 0;
        }
        .feat-col {
            display: flex;
            flex-direction: column;
        }
        .feat-divider {
            background: #f3e8f0;
            width: 1px;
            margin: 0 2rem;
        }
        /* Left column: text right-aligned, icon on the right */
        .feat-row {
            display: contents;
        }
        .feat-left {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 1rem;
            padding: 1rem 2.5rem 1rem 1rem;
            opacity: 0;
            transform: translateX(-16px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            border-bottom: 1px solid #fdf0f6;
        }
        .feat-left:last-of-type { border-bottom: none; }
        .feat-right {
            display: flex;
            align-items: center;
            justify-content: flex-start;
            gap: 1rem;
            padding: 1rem 1rem 1rem 2.5rem;
            opacity: 0;
            transform: translateX(16px);
            transition: opacity 0.5s ease, transform 0.5s ease;
            border-bottom: 1px solid #fdf0f6;
        }
        .feat-right:last-of-type { border-bottom: none; }
        .feat-left.visible, .feat-right.visible {
            opacity: 1;
            transform: translateX(0);
        }
        .feat-text-left {
            text-align: right;
        }
        .feat-text-right {
            text-align: left;
        }
        .feat-text-left h3,
        .feat-text-right h3 {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.2rem;
        }
        .feat-text-left p,
        .feat-text-right p {
            font-size: 0.75rem;
            color: #9ca3af;
            line-height: 1.6;
        }
        .feat-icon-circle {
            width: 42px;
            height: 42px;
            border-radius: 9999px;
            border: 1.5px solid #f472b6;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            color: #7c0a3e;
            background: #fff;
            box-shadow: 0 2px 6px rgba(244, 114, 182, 0.12);
        }
        .feat-icon-circle svg { width: 18px; height: 18px; }
        @media (max-width: 640px) {
            .feat-section { padding: 3rem 1.25rem; }
            .feat-header { margin-bottom: 2rem; }
            .feat-header h2 { font-size: 1.5rem; }
            .feat-header p { font-size: 0.85rem; }

            /* 2-column card grid on mobile, interleaved */
            .feat-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 0.875rem;
            }
            .feat-divider { display: none; }
            /* Flatten both columns into the grid flow */
            .feat-col { display: contents; }

            /* Interleave: left-col items get odd slots, right-col items get even slots */
            .feat-col:first-child .feat-left:nth-child(1) { order: 1; }
            .feat-col:last-child  .feat-right:nth-child(1) { order: 2; }
            .feat-col:first-child .feat-left:nth-child(2) { order: 3; }
            .feat-col:last-child  .feat-right:nth-child(2) { order: 4; }
            .feat-col:first-child .feat-left:nth-child(3) { order: 5; }
            .feat-col:last-child  .feat-right:nth-child(3) { order: 6; }
            .feat-col:first-child .feat-left:nth-child(4) { order: 7; }
            .feat-col:last-child  .feat-right:nth-child(4) { order: 8; }

            /* Card appearance */
            .feat-left,
            .feat-right {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                text-align: center;
                gap: 0.5rem;
                padding: 1rem 0.75rem;
                border: 1px solid #f3e8f0;
                border-radius: 1rem;
                transform: translateY(10px);
                opacity: 0;
                transition: opacity 0.5s ease, transform 0.5s ease;
            }
            /* Left cards: text is before icon in HTML — reverse so icon appears on top */
            .feat-left { flex-direction: column-reverse; justify-content: flex-end; }

            .feat-left.visible,
            .feat-right.visible {
                opacity: 1;
                transform: translateY(0);
            }
            .feat-text-left,
            .feat-text-right { text-align: center; }
            .feat-text-left h3,
            .feat-text-right h3 { font-size: 0.8rem; margin-bottom: 0.2rem; font-weight: 700; }
            .feat-text-left p,
            .feat-text-right p { font-size: 0.7rem; line-height: 1.5; color: #9ca3af; }
            .feat-icon-circle { width: 44px; height: 44px; }
            .feat-icon-circle svg { width: 20px; height: 20px; }
        }
    </style>
</head>
<body>

    <!-- Navbar -->
    <nav id="navbar">
        <div class="nav-inner">
            <!-- Left: Logo only -->
            <a href="/" class="nav-logo">Azalea</a>

            <!-- Right: Nav links + Auth (desktop) -->
            <div class="nav-right">
                <a href="/">Home</a>
                <a href="/products">Product</a>
                <a href="/templates">Template</a>
                <a href="/blog">Blog</a>
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
            </div>

            <!-- Hamburger (mobile only) -->
            <button class="hamburger" id="hamburger" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>

        <!-- Mobile Drawer -->
        <div class="mobile-menu" id="mobile-menu">
            <a href="/">Home</a>
            <a href="/products">Product</a>
            <a href="/templates">Template</a>
            <a href="/blog">Blog</a>
            <div class="mobile-auth">
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-inner">

            <!-- Left: Text & Buttons -->
            <div class="hero-text">
                <h1>Modern & Elegant Digital Invitation, Ready to Share in Minutes</h1>
                <p>Create beautiful, fast, and easy-to-edit digital invitations â€“ complete with Online RSVP, Photo Gallery, Music, Event Planner, and the most comprehensive gifting system.</p>
                <div class="hero-buttons">
                    <a href="/invitation" class="btn-invitation">Create Invitation</a>
                    <a href="/demo" class="btn-demo">View Demo</a>
                </div>
            </div>

            <!-- Right: Phone Mockup -->
            {{--
                BACKEND DEVELOPER NOTE:
                To show a real invitation preview image, set the `$heroImage` variable
                from your controller (e.g. $heroImage = asset('images/invitation-preview.png')).
                The placeholder below will automatically hide when an image is provided.
                Recommended image size: 480Ã—980px (2:1 portrait ratio), transparent background preferred.
            --}}
            <div class="hero-mockup">
                <div class="phone-frame">
                    <div class="phone-screen">
                        @if(!empty($heroImage))
                            <img src="{{ $heroImage }}" alt="Invitation Preview">
                        @else
                            {{-- Placeholder shown until admin uploads an image --}}
                            <div class="phone-placeholder">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 9.75h18M3 6.75A2.25 2.25 0 015.25 4.5h13.5A2.25 2.25 0 0121 6.75v10.5A2.25 2.25 0 0118.75 19.5H5.25A2.25 2.25 0 013 17.25V6.75z"/>
                                </svg>
                                <span>Upload invitation<br>preview image<br>in admin panel</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Dot indicators -->
                <div class="mockup-dots">
                    <span class="active"></span>
                    <span></span>
                    <span></span>
                </div>
            </div>

        </div>
    </section>

    <!-- Why Choose Azalea Section -->
    <section class="why-section">
        <div class="why-inner">
            <h2 class="why-title">Why Do Hundreds of Thousands of<br>Couples Choose Azalea?</h2>
            <p class="why-subtitle">Trusted by couples across the country â€” here's what makes Azalea different.</p>

            <div class="features-grid">

                <!-- Feature 1 -->
                {{-- BACKEND: swap SVG for <img src="{{ asset('images/feature-design.png') }}" alt=""> --}}
                <div class="feature-item">
                    <div class="feature-img-wrap">
                        <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                            <rect x="80" y="40" width="140" height="110" rx="10" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                            <rect x="90" y="50" width="120" height="90" rx="6" fill="#fff"/>
                            <line x1="102" y1="68" x2="198" y2="68" stroke="#e02424" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="102" y1="80" x2="185" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="102" y1="90" x2="190" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="102" y1="100" x2="178" y2="100" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <rect x="102" y="112" width="40" height="14" rx="7" fill="#e02424" opacity="0.8"/>
                            <rect x="143" y="150" width="14" height="14" rx="2" fill="#e0a0bc"/>
                            <rect x="128" y="162" width="44" height="6" rx="3" fill="#e0a0bc"/>
                            <circle cx="58" cy="108" r="14" fill="#f9d4e4"/>
                            <path d="M38 148 Q58 132 78 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                            <rect x="50" y="122" width="16" height="22" rx="4" fill="#f0b8cc"/>
                            <line x1="66" y1="130" x2="88" y2="118" stroke="#f9d4e4" stroke-width="5" stroke-linecap="round"/>
                            <path d="M230 55 C230 51 225 49 225 53 C225 57 230 61 230 61 C230 61 235 57 235 53 C235 49 230 51 230 55Z" fill="#e02424" opacity="0.7"/>
                            <path d="M60 70 C60 67 56 65 56 68 C56 71 60 74 60 74 C60 74 64 71 64 68 C64 65 60 67 60 70Z" fill="#e02424" opacity="0.5"/>
                            <text x="232" y="45" font-size="12" fill="#e02424" opacity="0.6">âœ¦</text>
                            <text x="55" y="52" font-size="10" fill="#e02424" opacity="0.5">âœ¦</text>
                            <circle cx="100" cy="38" r="7" fill="#f9d4e4"/>
                            <circle cx="113" cy="30" r="5" fill="#f9d4e4"/>
                            <circle cx="88" cy="30" r="5" fill="#f9d4e4"/>
                            <circle cx="100" cy="38" r="3" fill="#e02424" opacity="0.6"/>
                        </svg>
                    </div>
                    <h3>Exclusive & Modern Design</h3>
                    <p>Lots of exclusive theme choices that always follow trends, suitable for various event concepts: minimalist, floral, elegant, and traditional Nusantara.</p>
                </div>

                <!-- Feature 2 -->
                {{-- BACKEND: swap SVG for <img src="{{ asset('images/feature-edit.png') }}" alt=""> --}}
                <div class="feature-item">
                    <div class="feature-img-wrap">
                        <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                            <rect x="105" y="25" width="90" height="155" rx="14" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                            <rect x="113" y="40" width="74" height="120" rx="6" fill="#fff"/>
                            <rect x="133" y="28" width="34" height="8" rx="4" fill="#e0a0bc"/>
                            <line x1="122" y1="58" x2="178" y2="58" stroke="#e02424" stroke-width="2" stroke-linecap="round"/>
                            <line x1="122" y1="70" x2="172" y2="70" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="122" y1="80" x2="175" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="122" y1="90" x2="168" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <rect x="122" y="105" width="32" height="10" rx="5" fill="#e02424" opacity="0.7"/>
                            <circle cx="228" cy="105" r="14" fill="#f9d4e4"/>
                            <path d="M208 148 Q228 132 248 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                            <rect x="220" y="119" width="16" height="22" rx="4" fill="#f0b8cc"/>
                            <line x1="220" y1="128" x2="200" y2="115" stroke="#f9d4e4" stroke-width="5" stroke-linecap="round"/>
                            <rect x="196" y="88" width="6" height="22" rx="2" fill="#e02424" transform="rotate(-30 196 88)"/>
                            <polygon points="188,107 194,102 192,109" fill="#333"/>
                            <path d="M75 65 C75 61 70 59 70 63 C70 67 75 71 75 71 C75 71 80 67 80 63 C80 59 75 61 75 65Z" fill="#e02424" opacity="0.6"/>
                            <text x="68" y="48" font-size="12" fill="#e02424" opacity="0.6">âœ¦</text>
                            <text x="255" y="52" font-size="10" fill="#e02424" opacity="0.5">âœ¦</text>
                            <circle cx="150" cy="22" r="7" fill="#f9d4e4"/>
                            <circle cx="163" cy="14" r="5" fill="#f9d4e4"/>
                            <circle cx="137" cy="14" r="5" fill="#f9d4e4"/>
                            <circle cx="150" cy="22" r="3" fill="#e02424" opacity="0.6"/>
                        </svg>
                    </div>
                    <h3>Easy Edit Without Skills</h3>
                    <p>Change text, photos, music, and event details in just a few clicks. No complicated software or special design skills required.</p>
                </div>

                <!-- Feature 3 -->
                {{-- BACKEND: swap SVG for <img src="{{ asset('images/feature-guest.png') }}" alt=""> --}}
                <div class="feature-item">
                    <div class="feature-img-wrap">
                        <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                            <rect x="80" y="40" width="140" height="110" rx="10" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                            <rect x="90" y="50" width="120" height="90" rx="6" fill="#fff"/>
                            <line x1="102" y1="68" x2="160" y2="68" stroke="#e02424" stroke-width="2.5" stroke-linecap="round"/>
                            <line x1="102" y1="80" x2="185" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <line x1="102" y1="90" x2="178" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                            <rect x="170" y="100" width="28" height="28" rx="3" fill="#f9e4ef" stroke="#e02424" stroke-width="1"/>
                            <rect x="174" y="104" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                            <rect x="186" y="104" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                            <rect x="174" y="116" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                            <rect x="143" y="150" width="14" height="14" rx="2" fill="#e0a0bc"/>
                            <rect x="128" y="162" width="44" height="6" rx="3" fill="#e0a0bc"/>
                            <circle cx="50" cy="108" r="12" fill="#f9d4e4"/>
                            <path d="M32 148 Q50 134 68 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                            <rect x="43" y="120" width="14" height="20" rx="4" fill="#f0b8cc"/>
                            <circle cx="252" cy="112" r="12" fill="#f9d4e4"/>
                            <path d="M234 148 Q252 136 270 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                            <rect x="245" y="124" width="14" height="20" rx="4" fill="#f0b8cc"/>
                            <path d="M150 30 C150 26 145 24 145 28 C145 32 150 36 150 36 C150 36 155 32 155 28 C155 24 150 26 150 30Z" fill="#e02424" opacity="0.7"/>
                            <path d="M62 62 C62 59 58 57 58 60 C58 63 62 66 62 66 C62 66 66 63 66 60 C66 57 62 59 62 62Z" fill="#e02424" opacity="0.5"/>
                            <text x="240" y="42" font-size="12" fill="#e02424" opacity="0.6">âœ¦</text>
                            <text x="52" y="46" font-size="10" fill="#e02424" opacity="0.5">âœ¦</text>
                            <circle cx="200" cy="38" r="7" fill="#f9d4e4"/>
                            <circle cx="213" cy="30" r="5" fill="#f9d4e4"/>
                            <circle cx="187" cy="30" r="5" fill="#f9d4e4"/>
                            <circle cx="200" cy="38" r="3" fill="#e02424" opacity="0.6"/>
                        </svg>
                    </div>
                    <h3>Guest Personalization</h3>
                    <p>Every guest can be greeted by name directly on the invitation + a unique QR Code, making them feel more appreciated and special.</p>
                </div>

            </div>

            <!-- Mobile carousel (shown ≤768px, hidden on desktop via CSS) -->
            <div class="features-carousel-wrap">
                <div class="features-carousel">
                    <div class="features-carousel-track" id="featCarouselTrack">

                        <!-- Slide 1 -->
                        <div class="feature-item">
                            <div class="feature-img-wrap">
                                <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                                    <rect x="80" y="40" width="140" height="110" rx="10" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                                    <rect x="90" y="50" width="120" height="90" rx="6" fill="#fff"/>
                                    <line x1="102" y1="68" x2="198" y2="68" stroke="#e02424" stroke-width="2.5" stroke-linecap="round"/>
                                    <line x1="102" y1="80" x2="185" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="102" y1="90" x2="190" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="102" y1="100" x2="178" y2="100" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <rect x="102" y="112" width="40" height="14" rx="7" fill="#e02424" opacity="0.8"/>
                                    <rect x="143" y="150" width="14" height="14" rx="2" fill="#e0a0bc"/>
                                    <rect x="128" y="162" width="44" height="6" rx="3" fill="#e0a0bc"/>
                                    <circle cx="58" cy="108" r="14" fill="#f9d4e4"/>
                                    <path d="M38 148 Q58 132 78 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                                    <rect x="50" y="122" width="16" height="22" rx="4" fill="#f0b8cc"/>
                                    <line x1="66" y1="130" x2="88" y2="118" stroke="#f9d4e4" stroke-width="5" stroke-linecap="round"/>
                                    <path d="M230 55 C230 51 225 49 225 53 C225 57 230 61 230 61 C230 61 235 57 235 53 C235 49 230 51 230 55Z" fill="#e02424" opacity="0.7"/>
                                    <circle cx="100" cy="38" r="7" fill="#f9d4e4"/>
                                    <circle cx="100" cy="38" r="3" fill="#e02424" opacity="0.6"/>
                                </svg>
                            </div>
                            <h3>Exclusive & Modern Design</h3>
                            <p>Lots of exclusive theme choices that always follow trends, suitable for various event concepts: minimalist, floral, elegant, and traditional Nusantara.</p>
                        </div>

                        <!-- Slide 2 -->
                        <div class="feature-item">
                            <div class="feature-img-wrap">
                                <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                                    <rect x="105" y="25" width="90" height="155" rx="14" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                                    <rect x="113" y="40" width="74" height="120" rx="6" fill="#fff"/>
                                    <rect x="133" y="28" width="34" height="8" rx="4" fill="#e0a0bc"/>
                                    <line x1="122" y1="58" x2="178" y2="58" stroke="#e02424" stroke-width="2" stroke-linecap="round"/>
                                    <line x1="122" y1="70" x2="172" y2="70" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="122" y1="80" x2="175" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="122" y1="90" x2="168" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <rect x="122" y="105" width="32" height="10" rx="5" fill="#e02424" opacity="0.7"/>
                                    <circle cx="228" cy="105" r="14" fill="#f9d4e4"/>
                                    <path d="M208 148 Q228 132 248 148" fill="#f0b8cc" stroke="#e0a0bc" stroke-width="1"/>
                                    <rect x="220" y="119" width="16" height="22" rx="4" fill="#f0b8cc"/>
                                    <rect x="196" y="88" width="6" height="22" rx="2" fill="#e02424" transform="rotate(-30 196 88)"/>
                                    <circle cx="150" cy="22" r="7" fill="#f9d4e4"/>
                                    <circle cx="150" cy="22" r="3" fill="#e02424" opacity="0.6"/>
                                </svg>
                            </div>
                            <h3>Easy Edit Without Skills</h3>
                            <p>Change text, photos, music, and event details in just a few clicks. No complicated software or special design skills required.</p>
                        </div>

                        <!-- Slide 3 -->
                        <div class="feature-item">
                            <div class="feature-img-wrap">
                                <svg viewBox="0 0 300 220" fill="none" xmlns="http://www.w3.org/2000/svg" style="width:100%;height:100%;">
                                    <rect x="80" y="40" width="140" height="110" rx="10" fill="#f9e4ef" stroke="#e0a0bc" stroke-width="2"/>
                                    <rect x="90" y="50" width="120" height="90" rx="6" fill="#fff"/>
                                    <line x1="102" y1="68" x2="160" y2="68" stroke="#e02424" stroke-width="2.5" stroke-linecap="round"/>
                                    <line x1="102" y1="80" x2="185" y2="80" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <line x1="102" y1="90" x2="178" y2="90" stroke="#f0b8cc" stroke-width="1.5" stroke-linecap="round"/>
                                    <rect x="170" y="100" width="28" height="28" rx="3" fill="#f9e4ef" stroke="#e02424" stroke-width="1"/>
                                    <rect x="174" y="104" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                                    <rect x="186" y="104" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                                    <rect x="174" y="116" width="8" height="8" rx="1" fill="#e02424" opacity="0.7"/>
                                    <circle cx="50" cy="108" r="12" fill="#f9d4e4"/>
                                    <rect x="43" y="120" width="14" height="20" rx="4" fill="#f0b8cc"/>
                                    <circle cx="252" cy="112" r="12" fill="#f9d4e4"/>
                                    <rect x="245" y="124" width="14" height="20" rx="4" fill="#f0b8cc"/>
                                    <circle cx="200" cy="38" r="7" fill="#f9d4e4"/>
                                    <circle cx="200" cy="38" r="3" fill="#e02424" opacity="0.6"/>
                                </svg>
                            </div>
                            <h3>Guest Personalization</h3>
                            <p>Every guest can be greeted by name directly on the invitation + a unique QR Code, making them feel more appreciated and special.</p>
                        </div>

                    </div>
                </div>
                <!-- Dot indicators -->
                <div class="carousel-dots" id="featCarouselDots">
                    <button class="active" data-index="0" aria-label="Slide 1"></button>
                    <button data-index="1" aria-label="Slide 2"></button>
                    <button data-index="2" aria-label="Slide 3"></button>
                </div>
            </div>

        </div>
    </section>

    <!-- How It Works Section -->
    <section class="steps-section">
        <div class="steps-inner">
            <h2 class="steps-title">How Azalea Works in<br>4 Easy Steps</h2>
            <p class="steps-subtitle">Create a beautiful digital invitation in just a few minutes.</p>

            <!-- Desktop: horizontal row -->
            <div class="steps-row">
                <div class="step-item">
                    <div class="step-circle">1</div>
                    <div class="step-label">Choose a<br>Template</div>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">2</div>
                    <div class="step-label">Edit Your<br>Details</div>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">3</div>
                    <div class="step-label">Pay &amp;<br>Publish</div>
                </div>
                <div class="step-line"></div>
                <div class="step-item">
                    <div class="step-circle">4</div>
                    <div class="step-label">Login or Register<br><span class="step-optional">(optional)</span></div>
                </div>
            </div>

            <!-- Mobile: zigzag layout -->
            <!-- Mobile: 2×2 grid with SVG connectors -->
            <div class="steps-zigzag" id="stepsZigzag">
                <svg class="steps-zigzag-svg" id="zigzagSvg" aria-hidden="true"></svg>

                <div class="steps-grid-2x2">
                    <!-- Top-left: Step 1 -->
                    <div class="sgrid-item" id="zstep1">
                        <div class="step-circle">1</div>
                        <div class="step-label">Choose a Template</div>
                    </div>
                    <!-- Top-right: Step 2 -->
                    <div class="sgrid-item" id="zstep2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Edit Your Details</div>
                    </div>
                    <!-- Bottom-left: Step 3 -->
                    <div class="sgrid-item" id="zstep3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Pay &amp; Publish</div>
                    </div>
                    <!-- Bottom-right: Step 4 -->
                    <div class="sgrid-item" id="zstep4">
                        <div class="step-circle">4</div>
                        <div class="step-label">Login or Register<br><span class="step-optional">(optional)</span></div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Complete Features Section -->
    <section class="feat-section">
        <div class="feat-inner">
            <div class="feat-header">
                <h2>Complete Features for All<br>Your Invitation Needs</h2>
                <p>Complete features that are practical, modern, and interactive — ready to help you create attractive invitations and share them anytime.</p>
            </div>

            <div class="feat-grid">

                <!-- Left column -->
                <div class="feat-col">
                    <div class="feat-left">
                        <div class="feat-text-left">
                            <h3>Active Forever</h3>
                            <p>Your digital invitation website remains active indefinitely. Guests can access it anytime.</p>
                        </div>
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="3" width="20" height="14" rx="2"/>
                                <line x1="8" y1="21" x2="16" y2="21"/>
                                <line x1="12" y1="17" x2="12" y2="21"/>
                            </svg>
                        </div>
                    </div>
                    <div class="feat-left">
                        <div class="feat-text-left">
                            <h3>Music</h3>
                            <p>Add background music to make your digital invitation feel more lively and memorable.</p>
                        </div>
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 18V5l12-2v13"/>
                                <circle cx="6" cy="18" r="3"/>
                                <circle cx="18" cy="16" r="3"/>
                            </svg>
                        </div>
                    </div>
                    <div class="feat-left">
                        <div class="feat-text-left">
                            <h3>Gifts</h3>
                            <p>Receive cashless gifts or other presents easily through the digital gift-giving feature.</p>
                        </div>
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <polyline points="20 12 20 22 4 22 4 12"/>
                                <rect x="2" y="7" width="20" height="5"/>
                                <line x1="12" y1="22" x2="12" y2="7"/>
                                <path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"/>
                                <path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="feat-left">
                        <div class="feat-text-left">
                            <h3>Live Streaming</h3>
                            <p>Share a live streaming link so guests who can't attend can still follow your wedding.</p>
                        </div>
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="2"/>
                                <path d="M16.24 7.76a6 6 0 0 1 0 8.49"/>
                                <path d="M7.76 7.76a6 6 0 0 0 0 8.49"/>
                                <path d="M20.07 4.93a10 10 0 0 1 0 14.14"/>
                                <path d="M3.93 4.93a10 10 0 0 0 0 14.14"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Centre divider -->
                <div class="feat-divider"></div>

                <!-- Right column -->
                <div class="feat-col">
                    <div class="feat-right">
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"/>
                            </svg>
                        </div>
                        <div class="feat-text-right">
                            <h3>Customize Invitation Appearance</h3>
                            <p>Edit the appearance of your online invitation to suit your wedding style and theme, directly from the dashboard.</p>
                        </div>
                    </div>
                    <div class="feat-right">
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                <line x1="9" y1="10" x2="15" y2="10"/>
                                <line x1="9" y1="13" x2="13" y2="13"/>
                            </svg>
                        </div>
                        <div class="feat-text-right">
                            <h3>Greetings & Prayers</h3>
                            <p>Receive greetings and prayers from guests directly through your online invitation page.</p>
                        </div>
                    </div>
                    <div class="feat-right">
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="14" rx="2"/>
                                <path d="m3 13 4-4a2 2 0 0 1 2.8 0L14 13"/>
                                <path d="m13 12 2-2a2 2 0 0 1 2.8 0L21 13"/>
                                <circle cx="8.5" cy="7.5" r="1.5"/>
                                <polyline points="7 21 12 21 17 21"/>
                            </svg>
                        </div>
                        <div class="feat-text-right">
                            <h3>Photo & Video Gallery</h3>
                            <p>Display your best pre-wedding photos and memorable videos directly on your digital invitation page.</p>
                        </div>
                    </div>
                    <div class="feat-right">
                        <div class="feat-icon-circle">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="22" y1="2" x2="11" y2="13"/>
                                <polygon points="22 2 15 22 11 13 2 9 22 2"/>
                            </svg>
                        </div>
                        <div class="feat-text-right">
                            <h3>Send WhatsApp</h3>
                            <p>Send your digital invitation to guests on WhatsApp for a more personal and engaging experience.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 10) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');
        hamburger.addEventListener('click', () => {
            hamburger.classList.toggle('open');
            mobileMenu.classList.toggle('open');
        });

        // Animate feature items and steps on scroll
        const items = document.querySelectorAll('.feature-item, .step-item, .feat-left, .feat-right');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 150);
                }
            });
        }, { threshold: 0.15 });
        items.forEach(item => observer.observe(item));

        // 2×2 steps SVG connector (1→2 top, curve 2↓3, 3→4 bottom)
        (function () {
            function drawConnectors() {
                const svg = document.getElementById('zigzagSvg');
                const container = document.getElementById('stepsZigzag');
                if (!svg || !container) return;
                if (window.getComputedStyle(container).display === 'none') return;

                const ids = ['zstep1','zstep2','zstep3','zstep4'];
                const els = ids.map(id => document.getElementById(id));
                if (els.some(e => !e)) return;

                const cr = container.getBoundingClientRect();
                // Centre of each step's circle
                const pts = els.map(el => {
                    const c = el.querySelector('.step-circle').getBoundingClientRect();
                    return { x: c.left + c.width / 2 - cr.left, y: c.top + c.height / 2 - cr.top };
                });

                const [p1, p2, p3, p4] = pts;
                const r = 22; // circle radius approx

                // 1 → 2: horizontal dashed line between circles
                const line12 = `M ${p1.x + r} ${p1.y} L ${p2.x - r} ${p2.y}`;

                // 2 ↓ 3: curved U-turn from right side of 2, down and across to top of 3
                // Exit right of p2, sweep down then left to top of p3
                const curve23 = `M ${p2.x} ${p2.y + r}
                    C ${p2.x} ${p3.y},
                      ${p3.x} ${p2.y + r},
                      ${p3.x} ${p3.y - r}`;

                // 3 → 4: horizontal dashed line between circles
                const line34 = `M ${p3.x + r} ${p3.y} L ${p4.x - r} ${p4.y}`;

                const w = cr.width, h = cr.height;
                svg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                svg.setAttribute('width', w);
                svg.setAttribute('height', h);

                const dash = 'stroke="#f0b8cc" stroke-width="2" stroke-dasharray="6 5" stroke-linecap="round" fill="none"';
                svg.innerHTML = `
                    <path d="${line12}" ${dash}/>
                    <path d="${curve23}" ${dash}/>
                    <path d="${line34}" ${dash}/>
                `;
            }

            window.addEventListener('load', drawConnectors);
            window.addEventListener('resize', drawConnectors);
            setTimeout(drawConnectors, 200);

            // Animate + redraw on scroll-in
            const items = document.querySelectorAll('.sgrid-item');
            const obs = new IntersectionObserver((entries) => {
                let any = false;
                entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('visible'); any = true; } });
                if (any) setTimeout(drawConnectors, 50);
            }, { threshold: 0.2 });
            items.forEach(i => obs.observe(i));
        })();

        // Auto-sliding carousel for mobile features section
        (function () {
            const track = document.getElementById('featCarouselTrack');
            const dots  = document.querySelectorAll('#featCarouselDots button');
            if (!track || !dots.length) return;

            const total = dots.length;
            let current = 0;
            let timer;

            function goTo(index) {
                current = (index + total) % total;
                track.style.transform = 'translateX(-' + (current * 100) + '%)';
                dots.forEach((d, i) => d.classList.toggle('active', i === current));
            }

            function next() { goTo(current + 1); }

            function startAuto() {
                clearInterval(timer);
                timer = setInterval(next, 3000);
            }

            // Dot click / tap
            dots.forEach((dot, i) => {
                dot.addEventListener('click', () => { goTo(i); startAuto(); });
            });

            // Touch swipe support
            let touchStartX = 0;
            track.addEventListener('touchstart', e => { touchStartX = e.touches[0].clientX; }, { passive: true });
            track.addEventListener('touchend', e => {
                const diff = touchStartX - e.changedTouches[0].clientX;
                if (Math.abs(diff) > 40) { goTo(current + (diff > 0 ? 1 : -1)); startAuto(); }
            }, { passive: true });

            // Pause on hover/focus (desktop fallback)
            track.closest('.features-carousel-wrap').addEventListener('mouseenter', () => clearInterval(timer));
            track.closest('.features-carousel-wrap').addEventListener('mouseleave', startAuto);

            startAuto();
        })();
    </script>

    <!-- ═══════════════════════════════════════════════ FOOTER ═══ -->
    <style>
        .footer {
            background: #fff;
            border-top: 1px solid #f0e4ec;
            padding: 3.5rem 2rem 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }
        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 2.5rem;
            padding-bottom: 3rem;
            border-bottom: 1px solid #f0e4ec;
        }

        /* Brand column */
        .footer-brand-logo {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.85rem;
            text-decoration: none;
        }
        .footer-brand-logo svg {
            width: 32px;
            height: 32px;
            flex-shrink: 0;
        }
        .footer-brand-name {
            font-size: 1.1rem;
            font-weight: 700;
            color: #1a1a1a;
            letter-spacing: -0.01em;
        }
        .footer-brand-name sup {
            font-size: 0.5rem;
            vertical-align: super;
            color: #e02424;
            font-weight: 400;
            letter-spacing: 0;
        }
        .footer-tagline {
            font-size: 0.8rem;
            color: #6b7280;
            line-height: 1.7;
            margin-bottom: 1.25rem;
            max-width: 300px;
        }
        .footer-tagline strong {
            color: #1a1a1a;
        }
        .footer-social {
            display: flex;
            gap: 0.6rem;
            margin-bottom: 1.5rem;
        }
        .footer-social a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            height: 30px;
            padding: 0 0.85rem;
            border: 1px solid #e5d0e0;
            border-radius: 9999px;
            font-size: 0.75rem;
            color: #374151;
            text-decoration: none;
            transition: border-color 0.2s, color 0.2s;
            gap: 0.35rem;
        }
        .footer-social a:hover { border-color: #e02424; color: #e02424; }

        /* Link columns */
        .footer-col h4 {
            font-size: 0.82rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 1rem;
            letter-spacing: 0.01em;
        }
        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.55rem;
        }
        .footer-col ul li a {
            font-size: 0.8rem;
            color: #6b7280;
            text-decoration: none;
            transition: color 0.2s;
        }
        .footer-col ul li a:hover { color: #e02424; }

        /* Bottom bar */
        .footer-bottom {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1.1rem 0 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 0.75rem;
        }
        .footer-copy {
            font-size: 0.75rem;
            color: #9ca3af;
        }
        .footer-links-bottom {
            display: flex;
            align-items: center;
            gap: 0;
            flex-wrap: wrap;
        }
        .footer-links-bottom a {
            font-size: 0.75rem;
            color: #9ca3af;
            text-decoration: none;
            padding: 0 0.75rem;
            border-right: 1px solid #d1d5db;
            transition: color 0.2s;
            white-space: nowrap;
        }
        .footer-links-bottom a:last-child { border-right: none; }
        .footer-links-bottom a:hover { color: #e02424; }
        .footer-cta {
            font-size: 0.8rem;
            font-weight: 600;
            color: #fff;
            background-color: #e02424;
            text-decoration: none;
            padding: 0.5rem 1.25rem;
            border-radius: 9999px;
            transition: background-color 0.2s;
            white-space: nowrap;
        }
        .footer-cta:hover { background-color: #c81e1e; }

        @media (max-width: 900px) {
            .footer-inner {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
            }
        }
        @media (max-width: 560px) {
            .footer { padding: 2.5rem 1.25rem 0; }
            .footer-inner {
                grid-template-columns: 1fr 1fr;
                gap: 1.5rem;
            }
            .footer-bottom {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.75rem;
            }
            .footer-links-bottom { gap: 0; }
        }
    </style>

    <footer class="footer">
        <div class="footer-inner">

            <!-- Brand column -->
            <div>
                <a href="/" class="footer-brand-logo">
                    <!-- Azalea flower icon -->
                    <svg viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="16" cy="16" r="3.5" fill="#e02424" opacity="0.9"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f472b6" opacity="0.75" transform="rotate(0   16 16)"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f472b6" opacity="0.75" transform="rotate(60  16 16)"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f472b6" opacity="0.75" transform="rotate(120 16 16)"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f9a8d4" opacity="0.65" transform="rotate(180 16 16)"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f9a8d4" opacity="0.65" transform="rotate(240 16 16)"/>
                        <ellipse cx="16" cy="8"  rx="3" ry="5" fill="#f9a8d4" opacity="0.65" transform="rotate(300 16 16)"/>
                    </svg>
                    <span class="footer-brand-name">Azalea<sup>®</sup></span>
                </a>
                <p class="footer-tagline">
                    Azalea is a platform for <strong>digital wedding & event invitations</strong> with modern templates, real-time RSVP, photo &amp; video gallery, and a comprehensive cashless gifting system. Easy to make, interactive, and ready to share anytime.
                </p>
                <div class="footer-social">
                    <a href="#">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r="1" fill="currentColor" stroke="none"/>
                        </svg>
                        @azalea
                    </a>
                    <a href="#">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53A4.48 4.48 0 0 0 22.43.36a9 9 0 0 1-2.88 1.1A4.52 4.52 0 0 0 11.07 8 12.82 12.82 0 0 1 1.64 3.16a4.52 4.52 0 0 0 1.4 6.03A4.41 4.41 0 0 1 1 8.68v.06a4.52 4.52 0 0 0 3.63 4.43 4.5 4.5 0 0 1-2.04.08 4.53 4.53 0 0 0 4.22 3.14A9.06 9.06 0 0 1 0 18.54a12.8 12.8 0 0 0 6.92 2.03c8.3 0 12.85-6.88 12.85-12.85l-.01-.58A9.16 9.16 0 0 0 22 4.93z"/>
                        </svg>
                        Azalea
                    </a>
                </div>
            </div>

            <!-- Products column -->
            <div class="footer-col">
                <h4>Products</h4>
                <ul>
                    <li><a href="#">Digital Invitation</a></li>
                    <li><a href="#">Digital Guest Book</a></li>
                    <li><a href="#">All Features</a></li>
                    <li><a href="#">Pricing &amp; Packages</a></li>
                </ul>
            </div>

            <!-- Help column -->
            <div class="footer-col">
                <h4>Help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Partnerships</a></li>
                </ul>
            </div>

            <!-- Resources column -->
            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li><a href="#">Template Design</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>

        </div>

        <!-- Bottom bar -->
        <div class="footer-bottom">
            <span class="footer-copy">© 2024 – {{ date('Y') }} Azalea. All rights reserved.</span>
            <div class="footer-links-bottom">
                <a href="#">Terms &amp; Conditions</a>
                <a href="#">Privacy Policy</a>
                <a href="#">Partnerships</a>
                <a href="#">Contact Us</a>
            </div>
            <a href="/invitation" class="footer-cta">Create Free Invitation</a>
        </div>
    </footer>

</body>
</html>
