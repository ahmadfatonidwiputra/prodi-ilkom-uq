<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Prodi D4 Teknologi Rekayasa Perangkat Lunak')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/unbim-favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --admin-bg: #ffffff;
            --admin-surface: #ffffff;
            --admin-line: #e6eaf2;
            --admin-text: #111827;
            --admin-muted: #6b7280;
            --admin-accent: #6a2cc6;
        }

        body {
            background: var(--admin-bg);
            color: var(--admin-text);
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-shell {
            min-height: 100vh;
        }

        .sidebar {
            width: 320px;
            background: #ffffff;
            border-right: 1px solid var(--admin-line);
            overflow-y: auto;
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: .65rem;
            color: var(--admin-text);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.35rem;
        }

        .sidebar .brand-logo {
            width: 48px;
            height: 48px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .menu-title {
            font-size: .72rem;
            font-weight: 700;
            color: var(--admin-muted);
            letter-spacing: .08em;
            text-transform: uppercase;
            margin: .85rem 0 .45rem;
        }

        .sidebar .nav-link {
            color: var(--admin-text);
            border-radius: 10px;
            padding: .62rem .78rem;
            display: flex;
            align-items: center;
            gap: .6rem;
            font-weight: 500;
            justify-content: space-between;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #f2ebff;
            color: #4e1f9c;
        }

        .submenu {
            list-style: none;
            margin: .25rem 0 .5rem;
            padding: .15rem 0 .15rem 1.9rem;
            border-left: 2px solid #ece5fb;
        }

        .dropdown-toggle-icon {
            font-size: .85rem;
            transition: transform .2s ease;
        }

        .sidebar .nav-link[aria-expanded="true"] .dropdown-toggle-icon {
            transform: rotate(180deg);
        }

        .submenu a {
            display: block;
            font-size: .94rem;
            color: #374151;
            text-decoration: none;
            border-radius: 8px;
            padding: .42rem .55rem;
            margin: .1rem 0;
        }

        .submenu a:hover,
        .submenu a.active {
            background: #f7f2ff;
            color: #4e1f9c;
        }

        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
            background: #ffffff;
        }

        .topbar {
            background: #ffffff;
            border-bottom: 1px solid var(--admin-line);
            min-height: 74px;
        }

        .panel-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-line);
            border-radius: 18px;
            box-shadow: 0 8px 20px rgba(17, 24, 39, 0.08);
            color: var(--admin-text);
        }

        .metric-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
            color: #fff;
            background: linear-gradient(130deg, #8b3dff, #bb7cff);
        }

        .btn-quick {
            border: 1px solid #d4c2ff;
            color: #4e1f9c;
            background: #f8f4ff;
            border-radius: 12px;
            text-align: left;
            padding: .75rem .95rem;
        }

        .btn-quick:hover {
            color: #3a1580;
            border-color: #b892ff;
            background: #efe5ff;
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 100%;
                position: static;
            }

            .admin-shell {
                flex-direction: column;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
@php
    $currentSection = request()->route('section');
    $isTentangActive = request()->routeIs('admin.site-content.*') && str_starts_with((string) $currentSection, 'tentang-');
    $isKurikulumActive = request()->routeIs('admin.kurikulum.*') || ($currentSection && str_starts_with((string) $currentSection, 'kurikulum-'));
    $isFasilitasActive = request()->routeIs('admin.site-content.*') && str_starts_with((string) $currentSection, 'fasilitas-');
    $isHmpsActive = request()->routeIs('admin.site-content.*') && str_starts_with((string) $currentSection, 'hmps-');
    $isPendaftaranActive = request()->routeIs('admin.pendaftaran.*') || $currentSection === 'pendaftaran-banner';
@endphp
<div class="d-flex admin-shell">
    <aside class="sidebar p-3 p-lg-4 d-flex flex-column">
        <a href="{{ route('admin.dashboard') }}" class="brand mb-4">
            <span class="brand-logo"><img src="{{ asset('images/unbim-icon.png') }}" alt="Logo UNBIM"></span>
            <span>UNBIM TRPL Admin</span>
        </a>

        <nav class="nav flex-column gap-1">
            <div class="menu-title">Utama</div>
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                <span><i class="bi bi-grid"></i> Dashboard</span>
            </a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank">
                <span><i class="bi bi-house"></i> Halaman Utama</span>
            </a>

            <div class="menu-title">Konten Website</div>

            <a class="nav-link {{ $isTentangActive ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#menuTentangProdi"
               role="button"
               aria-expanded="{{ $isTentangActive ? 'true' : 'false' }}"
               aria-controls="menuTentangProdi">
                <span><i class="bi bi-info-circle"></i> Tentang Prodi</span>
                <i class="bi bi-chevron-down dropdown-toggle-icon"></i>
            </a>
            <div class="collapse {{ $isTentangActive ? 'show' : '' }}" id="menuTentangProdi">
                <ul class="submenu">
                    <li><a class="{{ $currentSection === 'tentang-profil-program-studi' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'tentang-profil-program-studi') }}">Profil Program Studi</a></li>
                    <li><a class="{{ $currentSection === 'tentang-visi-misi' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'tentang-visi-misi') }}">Visi Misi</a></li>
                    <li><a class="{{ $currentSection === 'tentang-profil-lulusan' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'tentang-profil-lulusan') }}">Profil Lulusan</a></li>
                    <li><a class="{{ $currentSection === 'tentang-profesi-profil-lulusan' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'tentang-profesi-profil-lulusan') }}">Profesi Profil Lulusan</a></li>
                    <li><a class="{{ $currentSection === 'tentang-struktur-organisasi' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'tentang-struktur-organisasi') }}">Struktur Organisasi</a></li>
                </ul>
            </div>

            <a class="nav-link {{ $isKurikulumActive ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#menuKurikulum"
               role="button"
               aria-expanded="{{ $isKurikulumActive ? 'true' : 'false' }}"
               aria-controls="menuKurikulum">
                <span><i class="bi bi-journal-text"></i> Kurikulum</span>
                <i class="bi bi-chevron-down dropdown-toggle-icon"></i>
            </a>
            <div class="collapse {{ $isKurikulumActive ? 'show' : '' }}" id="menuKurikulum">
                <ul class="submenu">
                    <li><a class="{{ request()->routeIs('admin.kurikulum.*') ? 'active' : '' }}" href="{{ route('admin.kurikulum.index') }}">Matakuliah</a></li>
                    <li><a class="{{ $currentSection === 'kurikulum-rps' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'kurikulum-rps') }}">RPS</a></li>
                    <li><a class="{{ $currentSection === 'kurikulum-jadwal-kuliah' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'kurikulum-jadwal-kuliah') }}">Jadwal Kuliah</a></li>
                </ul>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}">
                <span><i class="bi bi-people"></i> Manajemen Dosen</span>
            </a>

            <a class="nav-link {{ $isFasilitasActive ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#menuFasilitas"
               role="button"
               aria-expanded="{{ $isFasilitasActive ? 'true' : 'false' }}"
               aria-controls="menuFasilitas">
                <span><i class="bi bi-building"></i> Fasilitas & Lab</span>
                <i class="bi bi-chevron-down dropdown-toggle-icon"></i>
            </a>
            <div class="collapse {{ $isFasilitasActive ? 'show' : '' }}" id="menuFasilitas">
                <ul class="submenu">
                    <li><a class="{{ $currentSection === 'fasilitas-lab-pemrograman' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'fasilitas-lab-pemrograman') }}">Lab Pemrograman</a></li>
                    <li><a class="{{ $currentSection === 'fasilitas-lab-jaringan-komputer' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'fasilitas-lab-jaringan-komputer') }}">Lab Jaringan Komputer</a></li>
                    <li><a class="{{ $currentSection === 'fasilitas-ruang-kelas' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'fasilitas-ruang-kelas') }}">Ruang Kelas</a></li>
                    <li><a class="{{ $currentSection === 'fasilitas-perpustakaan' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'fasilitas-perpustakaan') }}">Perpustakaan</a></li>
                    <li><a class="{{ $currentSection === 'fasilitas-coding-learn' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'fasilitas-coding-learn') }}">Coding Learn</a></li>
                </ul>
            </div>

            <a class="nav-link {{ request()->routeIs('admin.prestasi.*') ? 'active' : '' }}" href="{{ route('admin.prestasi.index') }}">
                <span><i class="bi bi-trophy"></i> Prestasi Mahasiswa</span>
            </a>

            <a class="nav-link {{ $isHmpsActive ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#menuHmps"
               role="button"
               aria-expanded="{{ $isHmpsActive ? 'true' : 'false' }}"
               aria-controls="menuHmps">
                <span><i class="bi bi-diagram-3"></i> HMPS</span>
                <i class="bi bi-chevron-down dropdown-toggle-icon"></i>
            </a>
            <div class="collapse {{ $isHmpsActive ? 'show' : '' }}" id="menuHmps">
                <ul class="submenu">
                    <li><a class="{{ $currentSection === 'hmps-profil' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'hmps-profil') }}">Profil HMPS</a></li>
                    <li><a class="{{ $currentSection === 'hmps-struktur-organisasi' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'hmps-struktur-organisasi') }}">Struktur Organisasi</a></li>
                    <li><a class="{{ $currentSection === 'hmps-program-kerja' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'hmps-program-kerja') }}">Program Kerja</a></li>
                    <li><a class="{{ $currentSection === 'hmps-kegiatan' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'hmps-kegiatan') }}">Kegiatan</a></li>
                    <li><a class="{{ $currentSection === 'hmps-rekruitment' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'hmps-rekruitment') }}">Rekruitment</a></li>
                </ul>
            </div>

            <a class="nav-link {{ $isPendaftaranActive ? 'active' : '' }}"
               data-bs-toggle="collapse"
               href="#menuPendaftaran"
               role="button"
               aria-expanded="{{ $isPendaftaranActive ? 'true' : 'false' }}"
               aria-controls="menuPendaftaran">
                <span><i class="bi bi-inboxes"></i> Pendaftaran Masuk</span>
                <i class="bi bi-chevron-down dropdown-toggle-icon"></i>
            </a>
            <div class="collapse {{ $isPendaftaranActive ? 'show' : '' }}" id="menuPendaftaran">
                <ul class="submenu">
                    <li><a class="{{ $currentSection === 'pendaftaran-banner' ? 'active' : '' }}" href="{{ route('admin.site-content.edit', 'pendaftaran-banner') }}">Banner Pendaftaran</a></li>
                    <li><a class="{{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}" href="{{ route('admin.pendaftaran.index') }}">Data Form Pendaftaran</a></li>
                </ul>
            </div>
        </nav>

        <div class="mt-auto pt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-dark w-100 rounded-3"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </aside>

    <section class="content-area">
        <header class="topbar px-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-0">@yield('title', 'Dashboard')</h1>
                <small class="text-muted">Panel Administrator Program Studi D4 Teknologi Rekayasa Perangkat Lunak</small>
            </div>
            <div class="d-flex align-items-center gap-3 text-dark">
                <i class="bi bi-bell"></i>
                <span class="badge rounded-pill bg-danger">{{ data_get($metrics ?? [], 'pendaftaranBaru', 0) }}</span>
                <i class="bi bi-person-circle fs-4"></i>
            </div>
        </header>

        <main class="p-4 p-lg-5">
            @yield('content')
        </main>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
