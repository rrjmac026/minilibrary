<x-app-layout>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Sans:ital,wght@0,300;0,400;0,500;1,300&display=swap" rel="stylesheet">
</head>

<style>
    :root {
        --ink: #0f0e17;
        --paper: #f5f2eb;
        --cream: #fffcf5;
        --accent: #e8572a;
        --accent2: #2a7ae8;
        --gold: #c9a84c;
        --muted: #8a8578;
        --border: #e2ddd4;
        --card: #ffffff;
        --success: #2a9e6e;
        --danger: #d9362e;
        --warn: #d97706;
    }

    * { box-sizing: border-box; }

    body {
        font-family: 'DM Sans', sans-serif;
        background: var(--paper);
        color: var(--ink);
        margin: 0;
    }

    .lib-shell {
        display: flex;
        min-height: 100vh;
    }

    /* ── SIDEBAR ── */
    .sidebar {
        width: 260px;
        min-width: 260px;
        background: var(--ink);
        display: flex;
        flex-direction: column;
        padding: 0;
        position: sticky;
        top: 0;
        height: 100vh;
        overflow: hidden;
    }

    .sidebar-logo {
        padding: 28px 28px 20px;
        border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .sidebar-logo .logo-mark {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo-icon {
        width: 38px;
        height: 38px;
        background: var(--accent);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .logo-text {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 17px;
        color: #fff;
        letter-spacing: -0.3px;
        line-height: 1.1;
    }

    .logo-sub {
        font-size: 10px;
        color: rgba(255,255,255,0.35);
        font-weight: 400;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        margin-top: 2px;
    }

    .sidebar-nav {
        padding: 20px 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .nav-section-label {
        font-size: 9px;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.25);
        font-weight: 500;
        padding: 10px 12px 6px;
        margin-top: 8px;
    }

    .nav-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 12px;
        border-radius: 8px;
        color: rgba(255,255,255,0.55);
        font-size: 13.5px;
        font-weight: 400;
        text-decoration: none;
        transition: all 0.15s ease;
        cursor: pointer;
        position: relative;
    }

    .nav-item:hover {
        background: rgba(255,255,255,0.07);
        color: #fff;
    }

    .nav-item.active {
        background: var(--accent);
        color: #fff;
        font-weight: 500;
    }

    .nav-item .nav-icon {
        width: 18px;
        height: 18px;
        opacity: 0.8;
        flex-shrink: 0;
    }

    .nav-badge {
        margin-left: auto;
        background: var(--danger);
        color: #fff;
        font-size: 10px;
        font-weight: 600;
        padding: 1px 7px;
        border-radius: 20px;
        min-width: 20px;
        text-align: center;
    }

    .sidebar-user {
        padding: 16px;
        border-top: 1px solid rgba(255,255,255,0.08);
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .user-avatar {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), var(--gold));
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 13px;
        color: #fff;
        flex-shrink: 0;
    }

    .user-info .user-name {
        font-size: 12.5px;
        font-weight: 500;
        color: #fff;
    }

    .user-info .user-role {
        font-size: 11px;
        color: rgba(255,255,255,0.35);
    }

    .user-logout {
        margin-left: auto;
        color: rgba(255,255,255,0.25);
        cursor: pointer;
        transition: color 0.15s;
    }

    .user-logout:hover { color: var(--accent); }

    /* ── MAIN ── */
    .main-area {
        flex: 1;
        display: flex;
        flex-direction: column;
        min-width: 0;
    }

    .topbar {
        background: var(--cream);
        border-bottom: 1px solid var(--border);
        padding: 0 32px;
        height: 64px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        position: sticky;
        top: 0;
        z-index: 10;
    }

    .topbar-left h1 {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 20px;
        color: var(--ink);
        margin: 0;
        letter-spacing: -0.5px;
    }

    .topbar-left .breadcrumb {
        font-size: 12px;
        color: var(--muted);
        margin-top: 1px;
    }

    .topbar-right {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .topbar-date {
        font-size: 12px;
        color: var(--muted);
        padding: 6px 14px;
        background: var(--paper);
        border: 1px solid var(--border);
        border-radius: 6px;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 18px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 500;
        font-family: 'DM Sans', sans-serif;
        cursor: pointer;
        text-decoration: none;
        border: none;
        transition: all 0.15s;
    }

    .btn-primary {
        background: var(--accent);
        color: #fff;
    }

    .btn-primary:hover { background: #c94620; }

    .btn-outline {
        background: transparent;
        color: var(--ink);
        border: 1px solid var(--border);
    }

    .btn-outline:hover { border-color: var(--ink); }

    /* ── CONTENT ── */
    .content {
        padding: 32px;
        flex: 1;
    }

    /* ── STAT CARDS ── */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 28px;
    }

    .stat-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 22px 22px 18px;
        position: relative;
        overflow: hidden;
        transition: transform 0.2s, box-shadow 0.2s;
        cursor: default;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 28px rgba(15,14,23,0.08);
    }

    .stat-card::after {
        content: '';
        position: absolute;
        top: 0; right: 0;
        width: 90px; height: 90px;
        border-radius: 50%;
        transform: translate(30%, -30%);
        opacity: 0.06;
    }

    .stat-card.orange::after { background: var(--accent); }
    .stat-card.blue::after   { background: var(--accent2); }
    .stat-card.green::after  { background: var(--success); }
    .stat-card.gold::after   { background: var(--gold); }

    .stat-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        margin-bottom: 14px;
    }

    .stat-card.orange .stat-icon { background: #fdf0ec; }
    .stat-card.blue .stat-icon   { background: #eaf0fd; }
    .stat-card.green .stat-icon  { background: #e8f5ef; }
    .stat-card.gold .stat-icon   { background: #fdf7ea; }

    .stat-value {
        font-family: 'Syne', sans-serif;
        font-size: 32px;
        font-weight: 800;
        letter-spacing: -1px;
        line-height: 1;
        margin-bottom: 4px;
    }

    .stat-label {
        font-size: 12.5px;
        color: var(--muted);
        font-weight: 400;
    }

    .stat-trend {
        position: absolute;
        bottom: 18px;
        right: 20px;
        font-size: 11px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 3px;
    }

    .trend-up   { color: var(--success); }
    .trend-warn { color: var(--warn); }
    .trend-down { color: var(--danger); }

    /* ── TWO-COL LAYOUT ── */
    .row-grid {
        display: grid;
        grid-template-columns: 1fr 340px;
        gap: 20px;
        margin-bottom: 20px;
    }

    /* ── SECTION CARD ── */
    .section-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 14px;
        overflow: hidden;
    }

    .section-header {
        padding: 18px 22px;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .section-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        letter-spacing: -0.2px;
    }

    .section-action {
        font-size: 12px;
        color: var(--accent);
        text-decoration: none;
        font-weight: 500;
    }

    .section-action:hover { text-decoration: underline; }

    /* ── TABLE ── */
    .lib-table {
        width: 100%;
        border-collapse: collapse;
    }

    .lib-table th {
        font-size: 10.5px;
        font-weight: 500;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: var(--muted);
        padding: 10px 16px;
        text-align: left;
        background: #faf9f7;
        border-bottom: 1px solid var(--border);
    }

    .lib-table td {
        padding: 13px 16px;
        font-size: 13px;
        border-bottom: 1px solid var(--border);
        vertical-align: middle;
    }

    .lib-table tr:last-child td { border-bottom: none; }

    .lib-table tbody tr {
        transition: background 0.12s;
    }

    .lib-table tbody tr:hover { background: #faf9f7; }

    .student-chip {
        display: inline-flex;
        align-items: center;
        gap: 7px;
    }

    .student-dot {
        width: 28px;
        height: 28px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 11px;
        font-weight: 700;
        color: #fff;
        flex-shrink: 0;
    }

    .student-name { font-weight: 500; font-size: 13px; }
    .student-id   { font-size: 11px; color: var(--muted); }

    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 11.5px;
        font-weight: 500;
    }

    .status-pill::before {
        content: '';
        width: 5px;
        height: 5px;
        border-radius: 50%;
    }

    .pill-active  { background: #e8f5ef; color: var(--success); }
    .pill-active::before  { background: var(--success); }
    .pill-overdue { background: #fdecea; color: var(--danger); }
    .pill-overdue::before { background: var(--danger); }
    .pill-returned { background: #f0f0f0; color: #666; }
    .pill-returned::before { background: #aaa; }

    .fine-tag {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        color: var(--danger);
        font-size: 13px;
    }

    /* ── ACTIVITY FEED ── */
    .activity-list {
        padding: 6px 0;
    }

    .activity-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        padding: 13px 20px;
        border-bottom: 1px solid var(--border);
        transition: background 0.12s;
    }

    .activity-item:last-child { border-bottom: none; }
    .activity-item:hover { background: #faf9f7; }

    .activity-dot {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 14px;
    }

    .dot-borrow   { background: #eaf0fd; }
    .dot-return   { background: #e8f5ef; }
    .dot-overdue  { background: #fdecea; }

    .activity-text {
        flex: 1;
        min-width: 0;
    }

    .activity-desc {
        font-size: 12.5px;
        color: var(--ink);
        line-height: 1.45;
    }

    .activity-desc strong { font-weight: 600; }

    .activity-time {
        font-size: 11px;
        color: var(--muted);
        margin-top: 2px;
    }

    /* ── INVENTORY BARS ── */
    .inventory-list {
        padding: 8px 0;
    }

    .inventory-item {
        padding: 12px 20px;
        border-bottom: 1px solid var(--border);
    }

    .inventory-item:last-child { border-bottom: none; }

    .inventory-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 7px;
    }

    .inventory-title {
        font-size: 12.5px;
        font-weight: 500;
        color: var(--ink);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 180px;
    }

    .inventory-count {
        font-size: 11px;
        color: var(--muted);
        flex-shrink: 0;
        font-weight: 500;
    }

    .inv-bar-track {
        height: 5px;
        background: var(--border);
        border-radius: 99px;
        overflow: hidden;
    }

    .inv-bar-fill {
        height: 100%;
        border-radius: 99px;
        transition: width 0.6s cubic-bezier(.4,0,.2,1);
    }

    .fill-high   { background: var(--success); }
    .fill-mid    { background: var(--warn); }
    .fill-low    { background: var(--danger); }

    /* ── OVERDUE ALERT ── */
    .overdue-banner {
        background: linear-gradient(135deg, #2d1e1e, #3d2020);
        border-radius: 14px;
        padding: 20px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        margin-bottom: 20px;
        border: 1px solid rgba(217,54,46,0.3);
    }

    .overdue-banner-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .overdue-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        background: rgba(217,54,46,0.2);
        border: 1px solid rgba(217,54,46,0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        flex-shrink: 0;
    }

    .overdue-text h3 {
        font-family: 'Syne', sans-serif;
        font-size: 14px;
        font-weight: 700;
        color: #fff;
        margin: 0 0 3px;
    }

    .overdue-text p {
        font-size: 12px;
        color: rgba(255,255,255,0.5);
        margin: 0;
    }

    .btn-danger {
        background: var(--danger);
        color: #fff;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-danger:hover { background: #b82c24; }

    /* ── QUICK STATS ROW ── */
    .quick-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 12px;
        padding: 16px 20px;
        background: #faf9f7;
        border-top: 1px solid var(--border);
    }

    .qs-item { text-align: center; }

    .qs-num {
        font-family: 'Syne', sans-serif;
        font-size: 22px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .qs-label {
        font-size: 10.5px;
        color: var(--muted);
        letter-spacing: 0.5px;
    }

    /* ── SCROLL STYLE ── */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: var(--border); border-radius: 99px; }

    /* ── ANIMATIONS ── */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(16px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .stat-card { animation: fadeUp 0.4s ease both; }
    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.10s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.20s; }

    .section-card { animation: fadeUp 0.4s ease 0.25s both; }
    .overdue-banner { animation: fadeUp 0.4s ease 0.10s both; }

    /* ── RESPONSIVE ── */
    @media (max-width: 1100px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .row-grid   { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .sidebar { display: none; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .content { padding: 20px; }
    }
</style>

<div class="lib-shell">

    <!-- ═══════════════════════ SIDEBAR ═══════════════════════ -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-mark">
                <div class="logo-icon">📚</div>
                <div>
                    <div class="logo-text">LibraFlow</div>
                    <div class="logo-sub">Management System</div>
                </div>
            </div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Main</div>

            <a href="{{ route('dashboard') }}" class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h5a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm9 0a1 1 0 011-1h3a1 1 0 011 1v2a1 1 0 01-1 1h-3a1 1 0 01-1-1v-2zm0 6a1 1 0 011-1h3a1 1 0 011 1v2a1 1 0 01-1 1h-3a1 1 0 01-1-1v-2z"/>
                </svg>
                Dashboard
            </a>

            <div class="nav-section-label">Library</div>

            <a href="{{ route('books.index') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                </svg>
                Books
            </a>

            <a href="{{ route('authors.index') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zm-2.207 2.207L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"/>
                </svg>
                Authors
            </a>

            <a href="{{ route('students.index') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"/>
                </svg>
                Students
            </a>

            <div class="nav-section-label">Transactions</div>

            <a href="{{ route('borrows.index') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                </svg>
                Borrowings
                @if(isset($overdueBorrows) && $overdueBorrows > 0)
                    <span class="nav-badge">{{ $overdueBorrows }}</span>
                @endif
            </a>

            <a href="{{ route('borrows.create') }}" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/>
                </svg>
                New Borrow
            </a>
        </nav>

        <div class="sidebar-user">
            <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 2)) }}</div>
            <div class="user-info">
                <div class="user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="user-role">Librarian</div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="user-logout" title="Logout" style="background:none;border:none;cursor:pointer;padding:0;">
                    <svg width="16" height="16" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- ═══════════════════════ MAIN ═══════════════════════ -->
    <div class="main-area">

        <!-- TOP BAR -->
        <header class="topbar">
            <div class="topbar-left">
                <h1>Dashboard</h1>
                <div class="breadcrumb">Welcome back, {{ auth()->user()->name ?? 'Admin' }}</div>
            </div>
            <div class="topbar-right">
                <div class="topbar-date">📅 {{ now()->format('M d, Y') }}</div>
                <a href="{{ route('borrows.create') }}" class="btn btn-primary">
                    <svg width="13" height="13" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"/></svg>
                    New Borrow
                </a>
            </div>
        </header>

        <!-- CONTENT -->
        <div class="content">

            <!-- OVERDUE ALERT (show only if overdue > 0) -->
            @if(isset($overdueBorrows) && $overdueBorrows > 0)
            <div class="overdue-banner">
                <div class="overdue-banner-left">
                    <div class="overdue-icon">⚠️</div>
                    <div class="overdue-text">
                        <h3>{{ $overdueBorrows }} Overdue Borrowing{{ $overdueBorrows > 1 ? 's' : '' }} Detected</h3>
                        <p>Books are past their due date. Fines are being accumulated at ₱10/day per book.</p>
                    </div>
                </div>
                <a href="{{ route('borrows.index') }}" class="btn btn-danger">View Overdue →</a>
            </div>
            @endif

            <!-- STAT CARDS -->
            <div class="stats-grid">

                <div class="stat-card orange">
                    <div class="stat-icon">📚</div>
                    <div class="stat-value">{{ $totalBooks ?? 0 }}</div>
                    <div class="stat-label">Total Book Copies</div>
                    <div class="stat-trend trend-up">↑ In collection</div>
                </div>

                <div class="stat-card blue">
                    <div class="stat-icon">🎓</div>
                    <div class="stat-value">{{ $totalStudents ?? 0 }}</div>
                    <div class="stat-label">Registered Students</div>
                    <div class="stat-trend trend-up">↑ Active borrowers</div>
                </div>

                <div class="stat-card green">
                    <div class="stat-icon">✍️</div>
                    <div class="stat-value">{{ $totalAuthors ?? 0 }}</div>
                    <div class="stat-label">Authors on Record</div>
                    <div class="stat-trend trend-up">↑ In the system</div>
                </div>

                <div class="stat-card gold">
                    <div class="stat-icon">📋</div>
                    <div class="stat-value">{{ $activeBorrows ?? 0 }}</div>
                    <div class="stat-label">Active Borrowings</div>
                    @if(isset($overdueBorrows) && $overdueBorrows > 0)
                        <div class="stat-trend trend-down">⚠ {{ $overdueBorrows }} overdue</div>
                    @else
                        <div class="stat-trend trend-up">✓ All on time</div>
                    @endif
                </div>

            </div>

            <!-- MAIN ROW -->
            <div class="row-grid">

                <!-- RECENT BORROWINGS TABLE -->
                <div class="section-card">
                    <div class="section-header">
                        <span class="section-title">Recent Borrowings</span>
                        <a href="{{ route('borrows.index') }}" class="section-action">View all →</a>
                    </div>
                    <div style="overflow-x:auto;">
                        <table class="lib-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Books</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Fine</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentBorrows ?? [] as $borrow)
                                @php
                                    $colors = ['#e8572a','#2a7ae8','#2a9e6e','#c9a84c','#7c3aed'];
                                    $color  = $colors[$loop->index % count($colors)];
                                    $fine   = $borrow->computeFine();
                                    $status = $borrow->status;
                                    if ($status === 'active' && \Carbon\Carbon::today()->gt($borrow->due_date)) {
                                        $status = 'overdue';
                                    }
                                @endphp
                                <tr>
                                    <td>
                                        <div class="student-chip">
                                            <div class="student-dot" style="background:{{ $color }}">
                                                {{ strtoupper(substr($borrow->student->name, 0, 2)) }}
                                            </div>
                                            <div>
                                                <div class="student-name">{{ $borrow->student->name }}</div>
                                                <div class="student-id">{{ $borrow->student->student_id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td style="font-size:12px; color:var(--muted);">
                                        {{ $borrow->borrowItems->count() }} book{{ $borrow->borrowItems->count() > 1 ? 's' : '' }}
                                    </td>
                                    <td style="font-size:12px;">
                                        {{ $borrow->due_date->format('M d, Y') }}
                                    </td>
                                    <td>
                                        @if($status === 'overdue')
                                            <span class="status-pill pill-overdue">Overdue</span>
                                        @elseif($status === 'returned')
                                            <span class="status-pill pill-returned">Returned</span>
                                        @else
                                            <span class="status-pill pill-active">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($fine > 0)
                                            <span class="fine-tag">₱{{ number_format($fine, 2) }}</span>
                                        @else
                                            <span style="color:var(--muted);font-size:12px;">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('borrows.show', $borrow) }}" class="btn btn-outline" style="padding:5px 12px;font-size:11px;">View</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" style="text-align:center;padding:40px;color:var(--muted);font-size:13px;">
                                        No borrowing records yet.<br>
                                        <a href="{{ route('borrows.create') }}" style="color:var(--accent);text-decoration:none;font-weight:500;">+ Create first borrow</a>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- RIGHT COLUMN -->
                <div style="display:flex;flex-direction:column;gap:20px;">

                    <!-- BOOK INVENTORY -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">Book Inventory</span>
                            <a href="{{ route('books.index') }}" class="section-action">Manage →</a>
                        </div>
                        <div class="inventory-list">
                            @php
                                $books = \App\Models\Book::with('authors')->orderBy('title')->take(5)->get();
                            @endphp
                            @forelse($books as $book)
                            @php
                                $pct = $book->total_copies > 0
                                    ? ($book->available_copies / $book->total_copies) * 100
                                    : 0;
                                $fillClass = $pct >= 60 ? 'fill-high' : ($pct >= 30 ? 'fill-mid' : 'fill-low');
                            @endphp
                            <div class="inventory-item">
                                <div class="inventory-row">
                                    <div class="inventory-title" title="{{ $book->title }}">{{ $book->title }}</div>
                                    <div class="inventory-count">{{ $book->available_copies }}/{{ $book->total_copies }}</div>
                                </div>
                                <div class="inv-bar-track">
                                    <div class="inv-bar-fill {{ $fillClass }}" style="width:{{ $pct }}%"></div>
                                </div>
                            </div>
                            @empty
                            <div style="padding:30px;text-align:center;color:var(--muted);font-size:12px;">
                                No books yet. <a href="{{ route('books.create') }}" style="color:var(--accent);text-decoration:none;">Add books</a>
                            </div>
                            @endforelse
                        </div>
                        <div class="quick-stats">
                            @php
                                $bookStats = \App\Models\Book::selectRaw('
                                    COUNT(*) as titles,
                                    SUM(total_copies) as total,
                                    SUM(available_copies) as available
                                ')->first();
                            @endphp
                            <div class="qs-item">
                                <div class="qs-num">{{ $bookStats->titles ?? 0 }}</div>
                                <div class="qs-label">Titles</div>
                            </div>
                            <div class="qs-item">
                                <div class="qs-num" style="color:var(--success);">{{ $bookStats->available ?? 0 }}</div>
                                <div class="qs-label">Available</div>
                            </div>
                            <div class="qs-item">
                                <div class="qs-num" style="color:var(--accent);">{{ ($bookStats->total - $bookStats->available) ?? 0 }}</div>
                                <div class="qs-label">Borrowed</div>
                            </div>
                        </div>
                    </div>

                    <!-- QUICK ACTIONS -->
                    <div class="section-card">
                        <div class="section-header">
                            <span class="section-title">Quick Actions</span>
                        </div>
                        <div style="padding:16px;display:flex;flex-direction:column;gap:8px;">
                            <a href="{{ route('borrows.create') }}" class="btn btn-primary" style="justify-content:center;width:100%;">
                                📋 &nbsp;Record New Borrow
                            </a>
                            <a href="{{ route('books.create') }}" class="btn btn-outline" style="justify-content:center;width:100%;">
                                📚 &nbsp;Add New Book
                            </a>
                            <a href="{{ route('students.create') }}" class="btn btn-outline" style="justify-content:center;width:100%;">
                                🎓 &nbsp;Register Student
                            </a>
                            <a href="{{ route('authors.create') }}" class="btn btn-outline" style="justify-content:center;width:100%;">
                                ✍️ &nbsp;Add Author
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div><!-- /content -->
    </div><!-- /main-area -->
</div><!-- /lib-shell -->

</x-app-layout>