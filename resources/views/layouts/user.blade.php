<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Prodi D4 Teknologi Rekayasa Perangkat Lunak UNBIM')</title>
    <meta name="description" content="@yield('description', 'Program Studi D4 Teknologi Rekayasa Perangkat Lunak — UNBIM. Kurikulum terapan berfokus health technopreneurship, rekayasa modern, dan pengembangan produk digital.')">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/unbim-favicon.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
        /* ========== Design tokens ========== */
        :root {
            --purple-50:  #f6f2ff;
            --purple-100: #ede3ff;
            --purple-200: #d9c2ff;
            --purple-300: #bf97ff;
            --purple-400: #9d66ff;
            --purple-500: #7b3fe4;
            --purple-600: #6028c4;
            --purple-700: #481b99;
            --purple-800: #2e125f;
            --purple-900: #1a0a3a;

            --accent-coral: oklch(0.78 0.14 25);
            --accent-sun:   oklch(0.88 0.14 85);
            --accent-mint:  oklch(0.85 0.12 160);

            --ink:       #14112a;
            --ink-soft:  #4a4560;
            --ink-mute:  #8a85a0;
            --line:      #eae5f2;
            --line-soft: #f2eef8;
            --bg:        #fbf9ff;
            --surface:   #ffffff;

            --r-sm: 10px;
            --r-md: 16px;
            --r-lg: 24px;
            --r-xl: 32px;

            --shadow-sm: 0 1px 2px rgba(20,17,42,.04), 0 2px 6px rgba(20,17,42,.04);
            --shadow-md: 0 4px 14px rgba(70,27,153,.08), 0 1px 3px rgba(20,17,42,.04);
            --shadow-lg: 0 24px 60px -20px rgba(70,27,153,.25), 0 6px 18px rgba(20,17,42,.06);
        }

        *, *::before, *::after { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        img { max-width: 100%; height: auto; }
        body {
            font-family: 'Plus Jakarta Sans', -apple-system, system-ui, sans-serif;
            background: var(--bg);
            color: var(--ink);
            font-size: 15px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
        }

        .serif { font-family: 'Instrument Serif', Georgia, serif; font-weight: 400; font-style: italic; letter-spacing: -0.01em; }
        .mono  { font-family: 'JetBrains Mono', ui-monospace, monospace; }

        h1, h2, h3, h4 { font-family: 'Plus Jakarta Sans', sans-serif; letter-spacing: -0.025em; margin: 0; line-height: 1.1; }
        h1 { font-weight: 700; }
        h2 { font-weight: 700; }
        h3 { font-weight: 600; }
        p  { margin: 0; }
        a  { color: inherit; text-decoration: none; }

        /* ========== Layout shell ========== */
        .shell { min-height: 100vh; display: flex; flex-direction: column; }
        .container { max-width: 1240px; margin: 0 auto; padding: 0 28px; width: 100%; }

        /* ========== Top nav ========== */
        .topbar {
            position: sticky; top: 0; z-index: 50;
            background: rgba(255,255,255,.82);
            backdrop-filter: saturate(1.4) blur(14px);
            border-bottom: 1px solid var(--line);
        }
        .topbar-inner {
            display: flex; align-items: center; gap: 36px; height: 68px;
        }
        .brand { display: flex; align-items: center; gap: 10px; cursor: pointer; text-decoration: none; }
        .brand-mark {
            width: 42px; height: 42px; display: grid; place-items: center;
            background: transparent;
            flex-shrink: 0;
        }
        .brand-mark img { width: 100%; height: 100%; object-fit: contain; }
        .brand-text { display: flex; flex-direction: column; line-height: 1.05; white-space: nowrap; }
        .brand-text .name { font-weight: 700; font-size: 14px; letter-spacing: -0.01em; }
        .brand-text .sub  { font-size: 11px; color: var(--ink-mute); font-weight: 500; }
        @media (max-width: 1100px) { .brand-text .sub { display: none; } }

        .topbar-nav { display: flex; align-items: center; gap: 4px; margin-left: auto; }
        .nav-item {
            padding: 8px 14px; border-radius: 10px;
            font-size: 13.5px; font-weight: 500; color: var(--ink-soft);
            cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
            transition: color .15s, background .15s; white-space: nowrap;
            text-decoration: none;
        }
        .nav-item:hover { color: var(--ink); background: var(--line-soft); }
        .nav-item.active { color: var(--purple-700); background: var(--purple-50); }
        .nav-item .caret { font-size: 10px; opacity: .55; }

        .btn-cta {
            background: var(--ink); color: #fff; border: none;
            padding: 9px 16px; border-radius: 999px;
            font-weight: 600; font-size: 13.5px; cursor: pointer;
            display: inline-flex; align-items: center; gap: 6px;
            font-family: inherit; text-decoration: none;
            transition: transform .1s, background .15s;
            white-space: nowrap;
        }
        .btn-cta:hover { background: var(--purple-700); transform: translateY(-1px); color: #fff; }

        /* Dropdown — desktop: hover-based */
        .nav-dropdown { position: relative; }
        .nav-dropdown-menu {
            position: absolute; top: calc(100% + 8px); left: 0;
            background: #fff; border: 1px solid var(--line);
            border-radius: 14px; padding: 8px; min-width: 220px;
            box-shadow: var(--shadow-lg);
            opacity: 0; visibility: hidden; transform: translateY(-4px);
            transition: opacity .15s, visibility .15s, transform .15s;
            z-index: 100;
        }
        .nav-dropdown:hover .nav-dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0); }
        .nav-dropdown-menu a {
            display: block; padding: 9px 12px; border-radius: 8px;
            font-size: 13.5px; color: var(--ink-soft); font-weight: 500;
        }
        .nav-dropdown-menu a:hover { background: var(--purple-50); color: var(--purple-700); }

        /* Mobile hamburger */
        .nav-toggle {
            display: none; margin-left: auto;
            background: none; border: 1px solid var(--line);
            border-radius: 8px; padding: 6px 10px; cursor: pointer;
            color: var(--ink); font-size: 18px; line-height: 1;
        }
        @media (max-width: 1024px) {
            .topbar-nav { display: none; flex-direction: column; align-items: flex-start; gap: 4px; }
            .topbar-nav.open {
                display: flex; position: absolute; top: 68px; left: 0; right: 0;
                background: #fff; border-bottom: 1px solid var(--line);
                padding: 12px 20px 16px; z-index: 49;
            }
            .nav-toggle { display: flex; align-items: center; }
            .nav-dropdown { width: 100%; }
            .nav-item { width: 100%; }

            /* Disable hover on mobile; use click-based .open instead */
            .nav-dropdown:hover .nav-dropdown-menu { opacity: 0; visibility: hidden; }
            .nav-dropdown-menu {
                position: static; transform: none; box-shadow: none;
                border: none; border-radius: 0;
                padding: 0 0 0 18px; min-width: 0;
                max-height: 0; overflow: hidden;
                opacity: 1; visibility: visible;
                transition: max-height .25s ease;
            }
            .nav-dropdown.open > .nav-dropdown-menu {
                max-height: 400px;
            }
            .nav-dropdown.open > .nav-dropdown-menu,
            .nav-dropdown:hover .nav-dropdown-menu { opacity: 1; visibility: visible; }

            /* Rotate caret when open */
            .nav-dropdown .caret { transition: transform .2s; display: inline-block; }
            .nav-dropdown.open .caret { transform: rotate(180deg); }
        }

        /* ========== Utility ========== */
        .eyebrow {
            font-size: 11.5px; font-weight: 600; letter-spacing: 0.12em;
            text-transform: uppercase; color: var(--purple-600);
        }
        .muted { color: var(--ink-mute); }
        .soft  { color: var(--ink-soft); }

        .grid { display: grid; gap: 20px; }
        .g-2 { grid-template-columns: repeat(2, 1fr); }
        .g-3 { grid-template-columns: repeat(3, 1fr); }
        .g-4 { grid-template-columns: repeat(4, 1fr); }
        @media (max-width: 880px) {
            .g-4 { grid-template-columns: repeat(2, 1fr); }
            .g-3 { grid-template-columns: 1fr; }
            .g-2 { grid-template-columns: 1fr; }
        }

        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 8px; } .gap-3 { gap: 12px; } .gap-4 { gap: 16px; } .gap-6 { gap: 24px; }

        /* ========== Cards ========== */
        .card {
            background: var(--surface); border: 1px solid var(--line);
            border-radius: var(--r-lg); padding: 24px;
        }
        .card-pad-lg { padding: 32px; }

        .tag {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 5px 10px; border-radius: 999px;
            font-size: 11.5px; font-weight: 600; letter-spacing: 0.01em;
            background: var(--purple-50); color: var(--purple-700);
        }
        .tag .dot { width: 6px; height: 6px; border-radius: 50%; background: var(--purple-500); }

        /* ========== Buttons ========== */
        .btn-primary-lg {
            background: var(--ink); color: #fff; border: none;
            padding: 14px 22px; border-radius: 12px; font-weight: 600;
            font-size: 14.5px; cursor: pointer;
            display: inline-flex; align-items: center; gap: 8px;
            font-family: inherit; text-decoration: none;
            transition: transform .1s, background .15s;
        }
        .btn-primary-lg:hover { background: var(--purple-700); transform: translateY(-1px); color: #fff; }

        .btn-ghost-lg {
            background: transparent; color: var(--ink);
            border: 1px solid var(--line); padding: 14px 22px;
            border-radius: 12px; font-weight: 500; font-size: 14.5px;
            cursor: pointer; display: inline-flex; align-items: center; gap: 8px;
            font-family: inherit; text-decoration: none;
        }
        .btn-ghost-lg:hover { border-color: var(--purple-400); color: var(--purple-700); background: #fff; }

        .btn-ghost {
            background: transparent; color: var(--ink);
            border: 1px solid var(--line); padding: 9px 16px;
            border-radius: 10px; font-weight: 500; font-size: 13.5px;
            cursor: pointer; display: inline-flex; align-items: center; gap: 6px;
            font-family: inherit; text-decoration: none;
        }
        .btn-ghost:hover { border-color: var(--purple-400); color: var(--purple-700); }

        /* ========== Hero ========== */
        .hero { position: relative; padding: 72px 0 96px; overflow: hidden; }
        .hero-bg { position: absolute; inset: 0; z-index: 0; pointer-events: none;
            background:
                radial-gradient(ellipse 700px 400px at 10% 20%, rgba(123,63,228,.10), transparent 60%),
                radial-gradient(ellipse 500px 300px at 85% 30%, rgba(217,194,255,.25), transparent 70%);
        }
        .hero-content { position: relative; z-index: 1; }
        .hero h1 { font-size: clamp(42px, 5.5vw, 72px); line-height: 1.02; letter-spacing: -0.035em; margin-bottom: 24px; max-width: 18ch; }
        .hero h1 .accent { color: var(--purple-700); }
        .hero .lede { font-size: 17px; max-width: 52ch; color: var(--ink-soft); margin-bottom: 32px; line-height: 1.6; }
        .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }

        /* ========== Stat row ========== */
        .stats-row {
            display: grid; grid-template-columns: repeat(4, 1fr);
            gap: 0; border: 1px solid var(--line);
            border-radius: var(--r-lg); overflow: hidden; background: #fff;
        }
        .stat-cell { padding: 24px 28px; border-right: 1px solid var(--line); }
        .stat-cell:last-child { border-right: none; }
        .stat-cell .num { font-size: 42px; font-weight: 700; letter-spacing: -0.04em; line-height: 1; margin-bottom: 8px; color: var(--ink); }
        .stat-cell .num .plus { color: var(--purple-500); }
        .stat-cell .label { font-size: 12.5px; color: var(--ink-mute); font-weight: 500; }
        @media (max-width: 720px) {
            .stats-row { grid-template-columns: repeat(2, 1fr); }
            .stat-cell:nth-child(2) { border-right: none; }
            .stat-cell:nth-child(1), .stat-cell:nth-child(2) { border-bottom: 1px solid var(--line); }
        }

        /* ========== Section heading ========== */
        .section { padding: 72px 0; }
        .section-head { margin-bottom: 40px; max-width: 720px; }
        .section-head h2 { font-size: clamp(28px, 3.2vw, 42px); line-height: 1.08; margin: 10px 0 14px; }
        .section-head p { color: var(--ink-soft); font-size: 16px; max-width: 52ch; }

        /* ========== Dosen card ========== */
        .dosen-card {
            background: #fff; border: 1px solid var(--line);
            border-radius: var(--r-lg); overflow: hidden;
            transition: transform .2s, box-shadow .2s, border-color .2s; cursor: pointer;
        }
        .dosen-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); border-color: var(--purple-200); }
        .dosen-photo {
            aspect-ratio: 4/5;
            background: linear-gradient(165deg, var(--purple-100), var(--purple-50) 55%, #fff);
            display: grid; place-items: center; position: relative;
        }
        .dosen-photo .mono-label {
            font-family: 'JetBrains Mono', monospace; font-size: 10.5px;
            letter-spacing: 0.12em; color: var(--purple-500); opacity: 0.6;
            position: absolute; bottom: 16px; left: 16px;
        }
        .dosen-avatar {
            width: 52%; aspect-ratio: 1; border-radius: 50%;
            background: radial-gradient(circle at 50% 30%, var(--purple-300), var(--purple-500) 60%, var(--purple-700));
            box-shadow: inset 0 -20px 40px rgba(0,0,0,.15); position: relative;
        }
        .dosen-avatar::before {
            content: ''; position: absolute; inset: 20% 28% 16%;
            background: #fff; opacity: .18; border-radius: 50%; filter: blur(6px);
        }
        .dosen-body { padding: 18px 20px 22px; }
        .dosen-body .name { font-weight: 600; font-size: 15px; letter-spacing: -0.01em; margin-bottom: 4px; }
        .dosen-body .role { font-size: 12.5px; color: var(--ink-mute); }
        .dosen-body .nidn { font-family: 'JetBrains Mono', monospace; font-size: 10.5px; color: var(--purple-600); margin-top: 10px; }

        /* ========== Fasilitas ========== */
        .fasilitas-card {
            background: #fff; border: 1px solid var(--line);
            border-radius: var(--r-lg); overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .fasilitas-card:hover { transform: translateY(-3px); box-shadow: var(--shadow-lg); }
        .fasilitas-image {
            aspect-ratio: 16/10;
            background: linear-gradient(135deg, var(--purple-100), var(--purple-50));
            position: relative;
        }
        .fasilitas-image img {
            width: 100%; height: 100%; object-fit: cover;
        }
        .fasilitas-image .tile-pattern {
            position: absolute; inset: 0;
            background:
                linear-gradient(to right, rgba(123,63,228,.08) 1px, transparent 1px) 0 0 / 32px 32px,
                linear-gradient(to bottom, rgba(123,63,228,.08) 1px, transparent 1px) 0 0 / 32px 32px;
        }
        .fasilitas-image .label {
            position: absolute; bottom: 16px; left: 18px;
            font-family: 'JetBrains Mono', monospace; font-size: 10.5px;
            letter-spacing: 0.1em; color: var(--purple-600);
            text-transform: uppercase; opacity: 0.75;
        }
        .fasilitas-body { padding: 22px; }
        .fasilitas-body h4 { font-size: 17px; font-weight: 600; margin-bottom: 6px; letter-spacing: -0.015em; }
        .fasilitas-body p { font-size: 13.5px; color: var(--ink-soft); line-height: 1.55; }
        .fasilitas-body .meta { display: flex; gap: 16px; margin-top: 16px; font-size: 12px; color: var(--ink-mute); }
        .fasilitas-body .meta span { display: inline-flex; align-items: center; gap: 5px; }

        /* ========== Prestasi card ========== */
        .prestasi-card {
            background: #fff; border: 1px solid var(--line);
            border-radius: var(--r-lg); padding: 28px; position: relative; overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }
        .prestasi-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-lg); }
        .prestasi-medal {
            width: 48px; height: 48px; border-radius: 14px; display: grid; place-items: center;
            background: linear-gradient(135deg, var(--accent-sun), var(--accent-coral));
            color: #fff; font-weight: 700; font-size: 18px; margin-bottom: 20px;
        }
        .prestasi-medal.silver { background: linear-gradient(135deg, #d4d4d8, #a1a1aa); }
        .prestasi-medal.bronze { background: linear-gradient(135deg, #e8a87c, #c38d6a); }
        .prestasi-card h4 { font-size: 18px; font-weight: 600; margin-bottom: 6px; letter-spacing: -0.015em; }
        .prestasi-card .event { font-size: 13px; color: var(--ink-mute); margin-bottom: 16px; }
        .prestasi-card .meta { display: flex; gap: 10px; font-size: 12px; color: var(--ink-soft); padding-top: 16px; border-top: 1px solid var(--line); }

        /* ========== Kurikulum ========== */
        .kurikulum-wrap { background: #fff; border: 1px solid var(--line); border-radius: var(--r-lg); overflow: hidden; }
        .kurikulum-head {
            display: grid; grid-template-columns: 90px 1fr 120px 140px 110px;
            gap: 16px; padding: 14px 24px; background: var(--line-soft);
            font-size: 11.5px; font-weight: 600; color: var(--ink-mute);
            letter-spacing: 0.08em; text-transform: uppercase;
        }
        .kurikulum-row {
            display: grid; grid-template-columns: 90px 1fr 120px 140px 110px;
            gap: 16px; padding: 18px 24px; border-top: 1px solid var(--line);
            align-items: center; font-size: 14px;
            transition: background .15s; cursor: pointer;
        }
        .kurikulum-row:hover { background: var(--purple-50); }
        .kurikulum-row .kode { font-family: 'JetBrains Mono', monospace; font-size: 12px; color: var(--purple-700); font-weight: 600; }
        .kurikulum-row .mk-name { font-weight: 500; }
        .kurikulum-row .sks-pill {
            display: inline-flex; padding: 3px 10px; border-radius: 999px;
            font-size: 11.5px; font-weight: 600; background: var(--purple-50); color: var(--purple-700);
        }
        .kurikulum-row .sem { color: var(--ink-soft); font-weight: 500; }
        .kurikulum-row .type { font-size: 11.5px; color: var(--ink-mute); font-weight: 500; }

        /* ========== Pendaftaran ========== */
        .pendaftaran-grid { display: grid; grid-template-columns: 1fr 1.2fr; gap: 48px; align-items: start; }
        @media (max-width: 960px) { .pendaftaran-grid { grid-template-columns: 1fr; gap: 32px; } }
        .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 18px; }
        @media (max-width: 720px) { .form-grid { grid-template-columns: 1fr; } }
        .field { display: flex; flex-direction: column; gap: 6px; }
        .field label { font-size: 12.5px; font-weight: 600; color: var(--ink-soft); }
        .field input, .field select, .field textarea {
            padding: 12px 14px; border: 1px solid var(--line); border-radius: 10px;
            font-size: 14px; font-family: inherit; background: #fff; color: var(--ink);
            transition: border-color .15s, box-shadow .15s;
        }
        .field input:focus, .field select:focus, .field textarea:focus {
            outline: none; border-color: var(--purple-400);
            box-shadow: 0 0 0 3px rgba(123,63,228,.12);
        }
        .field .hint { font-size: 11.5px; color: var(--ink-mute); }

        /* ========== Footer ========== */
        .footer { margin-top: 80px; background: var(--purple-900); color: #d9c9ff; padding: 56px 0 28px; }
        .footer .name-lg { color: #fff; font-weight: 700; font-size: 18px; margin-bottom: 6px; letter-spacing: -0.02em; }
        .footer a { color: #d9c9ff; font-size: 13.5px; display: block; padding: 4px 0; opacity: 0.85; }
        .footer a:hover { opacity: 1; color: #fff; }
        .footer h6 { color: #fff; font-size: 12px; letter-spacing: 0.12em; text-transform: uppercase; margin-bottom: 12px; font-weight: 600; opacity: 0.75; }
        .footer-bottom { border-top: 1px solid rgba(255,255,255,.08); margin-top: 48px; padding-top: 20px; display: flex; justify-content: space-between; font-size: 12.5px; opacity: 0.65; }
        @media (max-width: 880px) { .footer-bottom { flex-direction: column; gap: 6px; } }

        /* placeholder image */
        .placeholder {
            position: relative;
            background:
                repeating-linear-gradient(135deg, rgba(123,63,228,.06) 0 8px, transparent 8px 16px),
                linear-gradient(135deg, var(--purple-50), #fff);
            border: 1px dashed rgba(123,63,228,.25);
            display: grid; place-items: center;
            color: var(--purple-600);
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px; letter-spacing: 0.05em;
        }

        @stack('extra-styles')
    </style>
    @stack('styles')
</head>
<body>
<div class="shell">

    {{-- ===== TOPBAR ===== --}}
    <header class="topbar">
        <div class="container topbar-inner">
            <a class="brand" href="{{ route('home') }}">
                <div class="brand-mark">
                    <img src="{{ asset('images/unbim-favicon.png') }}" alt="Logo UNBIM">
                </div>
                <div class="brand-text">
                    <span class="name">UNBIM · D4 TRPL</span>
                    <span class="sub">Teknologi Rekayasa Perangkat Lunak</span>
                </div>
            </a>

            <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">☰</button>

            <nav class="topbar-nav" id="topbarNav">
                <a href="{{ route('home') }}" class="nav-item {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>

                <div class="nav-dropdown">
                    <span class="nav-item {{ request()->routeIs('tentang-prodi.*') ? 'active' : '' }}">
                        Tentang Prodi <span class="caret">▾</span>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('tentang-prodi.profil-program-studi') }}">Profil Program Studi</a>
                        <a href="{{ route('tentang-prodi.visi-misi') }}">Visi Misi</a>
                        <a href="{{ route('tentang-prodi.profil-lulusan') }}">Profil Lulusan</a>
                        <a href="{{ route('tentang-prodi.struktur-organisasi') }}">Struktur Organisasi</a>
                    </div>
                </div>

                <div class="nav-dropdown">
                    <span class="nav-item {{ request()->routeIs('kurikulum.*') ? 'active' : '' }}">
                        Kurikulum <span class="caret">▾</span>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('kurikulum.matakuliah') }}">Matakuliah</a>
                        <a href="{{ route('kurikulum.rps') }}">RPS</a>
                        <a href="{{ route('kurikulum.jadwal-kuliah') }}">Jadwal Kuliah</a>
                    </div>
                </div>

                <a href="{{ route('dosen') }}" class="nav-item {{ request()->routeIs('dosen') ? 'active' : '' }}">Dosen</a>

                <div class="nav-dropdown">
                    <span class="nav-item {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}">
                        Fasilitas <span class="caret">▾</span>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('fasilitas.lab-pemrograman') }}">Lab Pemrograman</a>
                        <a href="{{ route('fasilitas.lab-jaringan-komputer') }}">Lab Jaringan Komputer</a>
                        <a href="{{ route('fasilitas.ruang-kelas') }}">Ruang Kelas</a>
                        <a href="{{ route('fasilitas.perpustakaan') }}">Perpustakaan</a>
                        <a href="{{ route('fasilitas.coding-learn') }}">Coding Learn</a>
                    </div>
                </div>

                <a href="{{ route('prestasi-mahasiswa') }}" class="nav-item {{ request()->routeIs('prestasi-mahasiswa') ? 'active' : '' }}">Prestasi</a>

                <div class="nav-dropdown">
                    <span class="nav-item {{ request()->routeIs('hmps.*') ? 'active' : '' }}">
                        HMPS <span class="caret">▾</span>
                    </span>
                    <div class="nav-dropdown-menu">
                        <a href="{{ route('hmps.profil') }}">Profil HMPS</a>
                        <a href="{{ route('hmps.struktur-organisasi') }}">Struktur Organisasi</a>
                        <a href="{{ route('hmps.program-kerja') }}">Program Kerja</a>
                        <a href="{{ route('hmps.kegiatan') }}">Kegiatan</a>
                    </div>
                </div>

                <a href="{{ route('pendaftaran') }}" class="btn-cta">Pendaftaran →</a>
            </nav>
        </div>
    </header>

    {{-- ===== PAGE CONTENT ===== --}}
    <main style="flex: 1;">
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="footer">
        <div class="container">
            <div class="grid g-4" style="gap: 40px;">
                <div style="grid-column: span 2;">
                    <div class="name-lg">D4 Teknologi Rekayasa Perangkat Lunak</div>
                    <p style="font-size: 13.5px; line-height: 1.65; opacity: 0.8; max-width: 42ch;">
                        Universitas Bima Internasional. Menyiapkan pengembang perangkat lunak
                        dengan fokus health technopreneurship.
                    </p>
                    <p style="font-size: 12.5px; opacity: 0.7; margin-top: 18px; line-height: 1.65;">
                        Jl. Medika Farma Husada, Batu Ringgit, Sekarbela,<br>
                        Kota Mataram, Nusa Tenggara Barat
                    </p>
                </div>
                <div>
                    <h6>Program</h6>
                    <a href="{{ route('tentang-prodi.profil-program-studi') }}">Profil Prodi</a>
                    <a href="{{ route('tentang-prodi.visi-misi') }}">Visi &amp; Misi</a>
                    <a href="{{ route('kurikulum.matakuliah') }}">Kurikulum</a>
                    <a href="{{ route('dosen') }}">Dosen</a>
                </div>
                <div>
                    <h6>Mahasiswa</h6>
                    <a href="{{ route('fasilitas.lab-pemrograman') }}">Fasilitas</a>
                    <a href="{{ route('prestasi-mahasiswa') }}">Prestasi</a>
                    <a href="{{ route('hmps.profil') }}">HMPS</a>
                    <a href="{{ route('pendaftaran') }}">Pendaftaran</a>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© {{ date('Y') }} Program Studi D4 TRPL · Universitas Bima Internasional</span>
                <span class="mono">d4trpl.unbim.ac.id</span>
            </div>
        </div>
    </footer>

</div><!-- /.shell -->

<script>
    (function() {
        const toggle = document.getElementById('navToggle');
        const nav = document.getElementById('topbarNav');
        const isMobile = () => window.innerWidth <= 1024;

        // Hamburger toggle
        if (toggle && nav) {
            toggle.addEventListener('click', () => {
                nav.classList.toggle('open');
                toggle.textContent = nav.classList.contains('open') ? '✕' : '☰';
            });
        }

        // Mobile dropdown toggle (click-based)
        document.querySelectorAll('.nav-dropdown > .nav-item').forEach(trigger => {
            trigger.addEventListener('click', (e) => {
                if (!isMobile()) return;           // let hover work on desktop
                e.preventDefault();
                e.stopPropagation();
                const parent = trigger.closest('.nav-dropdown');
                const wasOpen = parent.classList.contains('open');

                // Close all other dropdowns
                document.querySelectorAll('.nav-dropdown.open').forEach(d => d.classList.remove('open'));

                // Toggle the clicked one
                if (!wasOpen) parent.classList.add('open');
            });
        });

        // Close dropdowns when clicking outside
        document.addEventListener('click', (e) => {
            if (!isMobile()) return;
            if (!e.target.closest('.nav-dropdown')) {
                document.querySelectorAll('.nav-dropdown.open').forEach(d => d.classList.remove('open'));
            }
        });
    })();
</script>

@stack('scripts')
</body>
</html>
