<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LibraFlow — Library Management System</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,700;0,900;1,700&family=Instrument+Sans:wght@300;400;500&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg:       #0c0b08;
            --bg2:      #121109;
            --surface:  #1a1914;
            --border:   rgba(255,255,255,0.07);
            --border2:  rgba(255,255,255,0.12);
            --text:     #f0ece0;
            --muted:    #7a7568;
            --dim:      #3d3a30;
            --amber:    #c9942a;
            --amber2:   #e8b84b;
            --cream:    #f5efdc;
            --red:      #c94030;
            --green:    #3a7a52;
        }

        html { scroll-behavior: smooth; }

        body {
            background: var(--bg);
            color: var(--text);
            font-family: 'Instrument Sans', sans-serif;
            font-weight: 300;
            min-height: 100vh;
            overflow-x: hidden;
            cursor: default;
        }

        /* ─── NOISE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
            background-size: 200px;
            pointer-events: none;
            z-index: 1000;
            opacity: 0.5;
        }

        /* ─── BACKGROUND GLOW ─── */
        .bg-glow {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            pointer-events: none;
            z-index: 0;
        }

        .glow-1 {
            width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(201,148,42,0.12), transparent 70%);
            top: -200px; right: -100px;
        }

        .glow-2 {
            width: 400px; height: 400px;
            background: radial-gradient(circle, rgba(201,64,48,0.08), transparent 70%);
            bottom: 100px; left: -100px;
        }

        .glow-3 {
            width: 300px; height: 300px;
            background: radial-gradient(circle, rgba(58,122,82,0.1), transparent 70%);
            top: 50%; left: 40%;
        }

        /* ─── DECORATIVE GRID LINES ─── */
        .grid-lines {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(255,255,255,0.015) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.015) 1px, transparent 1px);
            background-size: 80px 80px;
        }

        /* ─── LAYOUT ─── */
        .page-wrap {
            position: relative;
            z-index: 10;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* ─── NAV ─── */
        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 48px;
            border-bottom: 1px solid var(--border);
            backdrop-filter: blur(12px);
            background: rgba(12,11,8,0.6);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .nav-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .nav-logo-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--amber), var(--amber2));
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .nav-logo-text {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 19px;
            color: var(--cream);
            letter-spacing: -0.3px;
        }

        .nav-logo-tagline {
            font-size: 10px;
            letter-spacing: 2px;
            text-transform: uppercase;
            color: var(--muted);
            margin-top: 1px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-link {
            font-size: 13px;
            color: var(--muted);
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 6px;
            border: 1px solid transparent;
            transition: all 0.2s;
            font-weight: 400;
        }

        .nav-link:hover {
            color: var(--text);
            border-color: var(--border2);
            background: var(--surface);
        }

        .nav-link-primary {
            color: var(--bg);
            background: linear-gradient(135deg, var(--amber), var(--amber2));
            border-color: transparent;
            font-weight: 500;
        }

        .nav-link-primary:hover {
            color: var(--bg);
            background: linear-gradient(135deg, var(--amber2), var(--amber));
            border-color: transparent;
        }

        /* ─── HERO ─── */
        .hero {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 80px 48px 60px;
            text-align: center;
            position: relative;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            border: 1px solid rgba(201,148,42,0.25);
            background: rgba(201,148,42,0.07);
            padding: 6px 16px;
            border-radius: 99px;
            margin-bottom: 36px;
            animation: fadeUp 0.6s ease 0.1s both;
        }

        .eyebrow-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--amber);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(52px, 8vw, 96px);
            font-weight: 900;
            line-height: 0.95;
            letter-spacing: -2px;
            color: var(--cream);
            margin-bottom: 12px;
            animation: fadeUp 0.6s ease 0.2s both;
        }

        .hero-title em {
            font-style: italic;
            color: var(--amber2);
        }

        .hero-title .title-line2 {
            display: block;
            color: var(--muted);
            font-size: 0.65em;
            font-style: normal;
            letter-spacing: -1px;
            margin-top: 4px;
        }

        .hero-sub {
            max-width: 520px;
            font-size: 15px;
            line-height: 1.7;
            color: var(--muted);
            margin: 28px auto 0;
            font-weight: 300;
            animation: fadeUp 0.6s ease 0.3s both;
        }

        .hero-cta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 44px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeUp 0.6s ease 0.4s both;
        }

        .cta-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--amber), var(--amber2));
            color: var(--bg);
            font-family: 'Instrument Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
        }

        .cta-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0;
            transition: opacity 0.2s;
        }

        .cta-primary:hover::before { opacity: 1; }

        .cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 16px 40px rgba(201,148,42,0.3);
        }

        .cta-arrow {
            transition: transform 0.2s;
        }

        .cta-primary:hover .cta-arrow { transform: translateX(3px); }

        .cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            border: 1px solid var(--border2);
            color: var(--muted);
            font-size: 14px;
            font-weight: 400;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .cta-secondary:hover {
            color: var(--text);
            border-color: var(--dim);
            background: var(--surface);
        }

        /* ─── DIVIDER ─── */
        .ornament-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 16px;
            margin: 64px auto 0;
            max-width: 300px;
            animation: fadeUp 0.6s ease 0.5s both;
        }

        .ornament-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--dim));
        }

        .ornament-line.right {
            background: linear-gradient(90deg, var(--dim), transparent);
        }

        .ornament-glyph {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            color: var(--dim);
        }

        /* ─── STATS STRIP ─── */
        .stats-strip {
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            animation: fadeUp 0.6s ease 0.6s both;
        }

        .stat-item {
            padding: 36px 40px;
            border-right: 1px solid var(--border);
            transition: background 0.2s;
        }

        .stat-item:last-child { border-right: none; }
        .stat-item:hover { background: var(--surface); }

        .stat-num {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            font-weight: 900;
            color: var(--cream);
            letter-spacing: -1px;
            line-height: 1;
        }

        .stat-num span {
            font-size: 0.55em;
            color: var(--amber);
            font-style: italic;
        }

        .stat-desc {
            font-size: 12px;
            color: var(--muted);
            margin-top: 6px;
            letter-spacing: 0.5px;
            line-height: 1.5;
        }

        /* ─── FEATURES ─── */
        .features {
            padding: 80px 48px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .features-header {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 48px;
            gap: 20px;
        }

        .features-heading {
            font-family: 'Playfair Display', serif;
            font-size: 38px;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: -1px;
            line-height: 1.15;
            max-width: 340px;
        }

        .features-heading em { font-style: italic; color: var(--amber2); }

        .features-intro {
            font-size: 13.5px;
            color: var(--muted);
            max-width: 320px;
            line-height: 1.7;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .feature-card {
            background: var(--bg2);
            padding: 36px 32px;
            transition: background 0.2s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--amber), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .feature-card:hover { background: var(--surface); }
        .feature-card:hover::before { opacity: 1; }

        .feature-num {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--dim);
            letter-spacing: 2px;
            margin-bottom: 20px;
        }

        .feature-icon-wrap {
            width: 48px;
            height: 48px;
            border-radius: 10px;
            border: 1px solid var(--border2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 18px;
            background: var(--surface);
            transition: border-color 0.2s, background 0.2s;
        }

        .feature-card:hover .feature-icon-wrap {
            border-color: rgba(201,148,42,0.3);
            background: rgba(201,148,42,0.06);
        }

        .feature-title {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--cream);
            margin-bottom: 10px;
            letter-spacing: -0.3px;
        }

        .feature-desc {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.65;
        }

        .feature-tag {
            display: inline-block;
            margin-top: 18px;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--amber);
            opacity: 0.7;
        }

        /* ─── WORKFLOW ─── */
        .workflow {
            padding: 0 48px 80px;
            max-width: 1200px;
            margin: 0 auto;
            width: 100%;
        }

        .workflow-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1px;
            background: var(--border);
            border: 1px solid var(--border);
            border-radius: 14px;
            overflow: hidden;
        }

        .workflow-left {
            background: var(--surface);
            padding: 48px;
        }

        .workflow-label {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 3px;
            text-transform: uppercase;
            color: var(--amber);
            margin-bottom: 20px;
        }

        .workflow-title {
            font-family: 'Playfair Display', serif;
            font-size: 30px;
            font-weight: 700;
            color: var(--cream);
            letter-spacing: -0.5px;
            line-height: 1.2;
            margin-bottom: 16px;
        }

        .workflow-desc {
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.75;
            margin-bottom: 28px;
        }

        .workflow-steps {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .workflow-step {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .step-num {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1px solid var(--amber);
            color: var(--amber);
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .step-text {
            font-size: 13px;
            color: var(--muted);
            line-height: 1.6;
            padding-top: 4px;
        }

        .step-text strong {
            color: var(--text);
            font-weight: 500;
        }

        .workflow-right {
            background: var(--bg2);
            padding: 48px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* ─── MOCK TERMINAL CARD ─── */
        .mock-card {
            background: var(--surface);
            border: 1px solid var(--border2);
            border-radius: 12px;
            overflow: hidden;
        }

        .mock-bar {
            background: #1e1d18;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 6px;
            border-bottom: 1px solid var(--border);
        }

        .mock-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .mock-dot.r { background: #c94030; }
        .mock-dot.y { background: var(--amber); }
        .mock-dot.g { background: var(--green); }

        .mock-title-bar {
            flex: 1;
            text-align: center;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            color: var(--muted);
        }

        .mock-body {
            padding: 20px;
        }

        .mock-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 12px;
            border-radius: 6px;
            font-size: 12px;
            margin-bottom: 4px;
            transition: background 0.15s;
        }

        .mock-row:hover { background: rgba(255,255,255,0.04); }

        .mock-row-left {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
        }

        .mock-avatar {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 600;
            color: var(--bg);
            flex-shrink: 0;
        }

        .mock-name { font-size: 12px; color: var(--text); }
        .mock-id   { font-size: 10px; color: var(--muted); }

        .mock-badge {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            padding: 2px 9px;
            border-radius: 99px;
        }

        .badge-active   { background: rgba(58,122,82,0.2);  color: #5abc85; }
        .badge-overdue  { background: rgba(201,64,48,0.2);  color: #e06050; }
        .badge-returned { background: rgba(255,255,255,0.07); color: var(--muted); }

        .mock-fine {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: #e06050;
        }

        /* ─── FOOTER ─── */
        footer {
            border-top: 1px solid var(--border);
            padding: 28px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .footer-left {
            font-size: 12px;
            color: var(--muted);
        }

        .footer-left strong {
            font-family: 'Playfair Display', serif;
            color: var(--text);
            font-size: 13px;
        }

        .footer-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .footer-tag {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--dim);
        }

        /* ─── ANIMATIONS ─── */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        .features { animation: fadeUp 0.6s ease 0.3s both; }
        .workflow  { animation: fadeUp 0.6s ease 0.4s both; }
        footer     { animation: fadeUp 0.6s ease 0.5s both; }

        /* ─── RESPONSIVE ─── */
        @media (max-width: 900px) {
            nav { padding: 18px 24px; }
            .hero { padding: 60px 24px 40px; }
            .stats-strip { grid-template-columns: repeat(2, 1fr); }
            .stats-strip .stat-item:nth-child(2) { border-right: none; }
            .features { padding: 60px 24px; }
            .features-grid { grid-template-columns: 1fr; }
            .features-header { flex-direction: column; align-items: flex-start; }
            .workflow { padding: 0 24px 60px; }
            .workflow-row { grid-template-columns: 1fr; }
            footer { padding: 24px; flex-direction: column; text-align: center; }
        }

        @media (max-width: 600px) {
            .hero-title { font-size: 44px; }
            .stats-strip { grid-template-columns: repeat(2, 1fr); }
            .stat-item { padding: 24px 20px; }
            .nav-logo-tagline { display: none; }
        }
    </style>
</head>
<body>

    <!-- Background layers -->
    <div class="bg-glow glow-1"></div>
    <div class="bg-glow glow-2"></div>
    <div class="bg-glow glow-3"></div>
    <div class="grid-lines"></div>

    <div class="page-wrap">

        <!-- ══════════════ NAV ══════════════ -->
        <nav>
            <a href="/" class="nav-logo">
                <div class="nav-logo-icon">📚</div>
                <div>
                    <div class="nav-logo-text">LibraFlow</div>
                    <div class="nav-logo-tagline">Library Management</div>
                </div>
            </a>

            <div class="nav-links">
                @auth
                    <a href="{{ url('/dashboard') }}" class="nav-link nav-link-primary">
                        Go to Dashboard &nbsp;→
                    </a>
                @else
                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="nav-link">Sign In</a>
                    @endif
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="nav-link nav-link-primary">
                            Get Started &nbsp;→
                        </a>
                    @endif
                @endauth
            </div>
        </nav>

        <!-- ══════════════ HERO ══════════════ -->
        <section class="hero">
            <div class="hero-eyebrow">
                <div class="eyebrow-dot"></div>
                Mini Library Management System
            </div>

            <h1 class="hero-title">
                <em>Every book</em> has<br>
                <span class="title-line2">a story to track.</span>
            </h1>

            <p class="hero-sub">
                A complete library management platform for tracking books, authors,
                students, and borrowing transactions — with automated fine computation
                built right in.
            </p>

            <div class="hero-cta">
                @auth
                    <a href="{{ url('/dashboard') }}" class="cta-primary">
                        Open Dashboard
                        <svg class="cta-arrow" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="cta-primary">
                        Sign In to System
                        <svg class="cta-arrow" width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                    <a href="#features" class="cta-secondary">
                        Explore Features
                    </a>
                @endauth
            </div>

            <div class="ornament-divider">
                <div class="ornament-line"></div>
                <div class="ornament-glyph">❧</div>
                <div class="ornament-line right"></div>
            </div>
        </section>

        <!-- ══════════════ STATS STRIP ══════════════ -->
        <div class="stats-strip">
            <div class="stat-item">
                <div class="stat-num">∞<span> books</span></div>
                <div class="stat-desc">Track unlimited titles<br>with full inventory control</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">₱10<span>/day</span></div>
                <div class="stat-desc">Auto-computed fines<br>per overdue book</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">M×M<span> rel.</span></div>
                <div class="stat-desc">Books ↔ Authors<br>Many-to-many relationships</div>
            </div>
            <div class="stat-item">
                <div class="stat-num">100<span>%</span></div>
                <div class="stat-desc">Partial returns supported<br>with live fine recalculation</div>
            </div>
        </div>

        <!-- ══════════════ FEATURES ══════════════ -->
        <section class="features" id="features">
            <div class="features-header">
                <h2 class="features-heading">
                    Built for<br><em>real libraries.</em>
                </h2>
                <p class="features-intro">
                    Everything a school librarian needs — from managing the catalog
                    to processing returns and tracking who owes what.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-num">01</div>
                    <div class="feature-icon-wrap">📚</div>
                    <div class="feature-title">Book Catalog</div>
                    <p class="feature-desc">
                        Manage your full book collection with ISBN, descriptions, copy counts,
                        and real-time availability tracking per title.
                    </p>
                    <span class="feature-tag">→ Books Module</span>
                </div>

                <div class="feature-card">
                    <div class="feature-num">02</div>
                    <div class="feature-icon-wrap">✍️</div>
                    <div class="feature-title">Author Registry</div>
                    <p class="feature-desc">
                        Associate multiple authors to any book. Full many-to-many
                        relationships so co-authored works are handled correctly.
                    </p>
                    <span class="feature-tag">→ Authors Module</span>
                </div>

                <div class="feature-card">
                    <div class="feature-num">03</div>
                    <div class="feature-icon-wrap">🎓</div>
                    <div class="feature-title">Student Records</div>
                    <p class="feature-desc">
                        Maintain a registry of borrowers. Students don't need to log in —
                        the librarian manages everything on their behalf.
                    </p>
                    <span class="feature-tag">→ Students Module</span>
                </div>

                <div class="feature-card">
                    <div class="feature-num">04</div>
                    <div class="feature-icon-wrap">📋</div>
                    <div class="feature-title">Borrow Transactions</div>
                    <p class="feature-desc">
                        Record who borrowed what and when, set due dates, and
                        support partial returns at any point in the transaction.
                    </p>
                    <span class="feature-tag">→ Borrows Module</span>
                </div>

                <div class="feature-card">
                    <div class="feature-num">05</div>
                    <div class="feature-icon-wrap">⚠️</div>
                    <div class="feature-title">Fine Computation</div>
                    <p class="feature-desc">
                        Fines are calculated automatically at ₱10 per day per overdue book.
                        Partial returns update fines in real time.
                    </p>
                    <span class="feature-tag">→ Business Logic</span>
                </div>

                <div class="feature-card">
                    <div class="feature-num">06</div>
                    <div class="feature-icon-wrap">🔐</div>
                    <div class="feature-title">Secure Authentication</div>
                    <p class="feature-desc">
                        Laravel Breeze powers the librarian login. Password changes,
                        sessions, and route protection all handled out of the box.
                    </p>
                    <span class="feature-tag">→ Auth via Breeze</span>
                </div>
            </div>
        </section>

        <!-- ══════════════ WORKFLOW ══════════════ -->
        <section class="workflow">
            <div class="workflow-row">
                <div class="workflow-left">
                    <div class="workflow-label">How it works</div>
                    <h3 class="workflow-title">From walk-in to check-out in seconds.</h3>
                    <p class="workflow-desc">
                        The librarian operates the system. Students simply present their ID —
                        no accounts, no passwords, no friction.
                    </p>

                    <div class="workflow-steps">
                        <div class="workflow-step">
                            <div class="step-num">1</div>
                            <div class="step-text"><strong>Librarian logs in</strong> using their secure account via Laravel Breeze authentication.</div>
                        </div>
                        <div class="workflow-step">
                            <div class="step-num">2</div>
                            <div class="step-text"><strong>Find the student</strong> by name or student ID in the registry.</div>
                        </div>
                        <div class="workflow-step">
                            <div class="step-num">3</div>
                            <div class="step-text"><strong>Select available books</strong> and set a due date for the borrow transaction.</div>
                        </div>
                        <div class="workflow-step">
                            <div class="step-num">4</div>
                            <div class="step-text"><strong>Process returns</strong> — fully or partially — and fines are computed automatically.</div>
                        </div>
                    </div>
                </div>

                <div class="workflow-right">
                    <!-- MOCK UI CARD -->
                    <div class="mock-card">
                        <div class="mock-bar">
                            <div class="mock-dot r"></div>
                            <div class="mock-dot y"></div>
                            <div class="mock-dot g"></div>
                            <div class="mock-title-bar">borrows — LibraFlow</div>
                        </div>
                        <div class="mock-body">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:14px;padding:0 4px;">
                                <span style="font-size:11px;color:var(--muted);letter-spacing:1px;text-transform:uppercase;font-family:'DM Mono',monospace;">Recent Transactions</span>
                                <span style="font-size:10px;color:var(--amber);font-family:'DM Mono',monospace;">View all →</span>
                            </div>

                            <div class="mock-row">
                                <div class="mock-row-left">
                                    <div class="mock-avatar" style="background:#c9942a;">JD</div>
                                    <div>
                                        <div class="mock-name">Juan Dela Cruz</div>
                                        <div class="mock-id">2024-0042 · 2 books</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span class="mock-badge badge-active">Active</span>
                                    <span style="font-size:10px;color:var(--muted);font-family:'DM Mono',monospace;">Mar 5</span>
                                </div>
                            </div>

                            <div class="mock-row">
                                <div class="mock-row-left">
                                    <div class="mock-avatar" style="background:#c94030;">MR</div>
                                    <div>
                                        <div class="mock-name">Maria Reyes</div>
                                        <div class="mock-id">2024-0019 · 1 book</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span class="mock-badge badge-overdue">Overdue</span>
                                    <span class="mock-fine">₱30</span>
                                </div>
                            </div>

                            <div class="mock-row">
                                <div class="mock-row-left">
                                    <div class="mock-avatar" style="background:#3a7a52;">KS</div>
                                    <div>
                                        <div class="mock-name">Karl Santos</div>
                                        <div class="mock-id">2024-0031 · 3 books</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span class="mock-badge badge-returned">Returned</span>
                                    <span style="font-size:10px;color:var(--muted);font-family:'DM Mono',monospace;">Feb 28</span>
                                </div>
                            </div>

                            <div class="mock-row">
                                <div class="mock-row-left">
                                    <div class="mock-avatar" style="background:#7c3aed;">AL</div>
                                    <div>
                                        <div class="mock-name">Ana Lim</div>
                                        <div class="mock-id">2024-0055 · 2 books</div>
                                    </div>
                                </div>
                                <div style="display:flex;align-items:center;gap:8px;">
                                    <span class="mock-badge badge-active">Active</span>
                                    <span style="font-size:10px;color:var(--muted);font-family:'DM Mono',monospace;">Mar 8</span>
                                </div>
                            </div>

                            <div style="margin-top:16px;padding:12px;background:rgba(201,148,42,0.07);border:1px solid rgba(201,148,42,0.15);border-radius:8px;display:flex;justify-content:space-between;align-items:center;">
                                <span style="font-size:11px;color:var(--muted);">Total outstanding fines</span>
                                <span style="font-family:'Playfair Display',serif;font-size:18px;color:var(--amber2);font-weight:700;">₱30.00</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ══════════════ FOOTER ══════════════ -->
        <footer>
            <div class="footer-left">
                <strong>LibraFlow</strong> &nbsp;·&nbsp;
                Mini Library Management System &nbsp;·&nbsp;
                Built with Laravel & Breeze
            </div>
            <div class="footer-right">
                <span class="footer-tag">MVC Architecture</span>
                <span style="color:var(--dim);">·</span>
                <span class="footer-tag">Eloquent ORM</span>
                <span style="color:var(--dim);">·</span>
                <span class="footer-tag">Laravel {{ app()->version() }}</span>
            </div>
        </footer>

    </div><!-- /page-wrap -->

</body>
</html>