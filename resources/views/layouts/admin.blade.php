<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Prodi D4 Rekayasa Perangkat Lunak')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --admin-bg: #061126;
            --admin-bg-soft: #0b1e3f;
            --admin-surface: rgba(20, 47, 95, 0.55);
            --admin-line: rgba(255, 255, 255, 0.08);
            --admin-text: #dce9ff;
            --admin-accent: #22a3ff;
        }

        body {
            background: radial-gradient(circle at 18% 15%, rgba(27, 79, 164, 0.38), transparent 35%),
                        radial-gradient(circle at 82% 80%, rgba(7, 51, 122, 0.5), transparent 34%),
                        var(--admin-bg);
            color: var(--admin-text);
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .admin-shell {
            min-height: 100vh;
        }

        .sidebar {
            width: 290px;
            background: linear-gradient(180deg, rgba(3, 16, 40, 0.95), rgba(9, 36, 77, 0.92));
            border-right: 1px solid var(--admin-line);
            backdrop-filter: blur(10px);
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: .65rem;
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.7rem;
        }

        .sidebar .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(145deg, #12c2ff, #0066ff);
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar .nav-link {
            color: #c9ddff;
            border-radius: 12px;
            padding: .7rem .8rem;
            display: flex;
            align-items: center;
            gap: .7rem;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: linear-gradient(120deg, rgba(34, 163, 255, 0.34), rgba(34, 163, 255, 0.18));
            color: #fff;
        }

        .content-area {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .topbar {
            background: linear-gradient(100deg, rgba(11, 30, 63, 0.8), rgba(11, 43, 93, 0.6));
            border-bottom: 1px solid var(--admin-line);
            min-height: 74px;
            backdrop-filter: blur(8px);
        }

        .panel-card {
            background: var(--admin-surface);
            border: 1px solid var(--admin-line);
            border-radius: 18px;
            box-shadow: 0 18px 36px rgba(2, 9, 26, 0.35);
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
            background: linear-gradient(130deg, #1d7feb, #47c0ff);
        }

        .btn-quick {
            border: 1px solid rgba(97, 185, 255, 0.52);
            color: #e4f3ff;
            background: linear-gradient(120deg, rgba(24, 116, 201, 0.76), rgba(24, 116, 201, 0.45));
            border-radius: 12px;
            text-align: left;
            padding: .75rem .95rem;
        }

        .btn-quick:hover {
            color: #fff;
            border-color: rgba(97, 185, 255, 0.9);
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
<div class="d-flex admin-shell">
    <aside class="sidebar p-3 p-lg-4 d-flex flex-column">
        <a href="{{ route('admin.dashboard') }}" class="brand mb-4">
            <span class="brand-logo"><i class="bi bi-shield-check"></i></span>
            <span>UNBIM RPL Admin</span>
        </a>

        <nav class="nav flex-column gap-1">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-grid"></i> Dashboard</a>
            <a class="nav-link" href="{{ route('home') }}" target="_blank"><i class="bi bi-house"></i> Halaman Utama</a>
            <a class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}" href="{{ route('admin.profil.edit') }}"><i class="bi bi-info-circle"></i> Tentang Prodi</a>
            <a class="nav-link {{ request()->routeIs('admin.kurikulum.*') ? 'active' : '' }}" href="{{ route('admin.kurikulum.index') }}"><i class="bi bi-journal-text"></i> Kurikulum & Silabus</a>
            <a class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}"><i class="bi bi-people"></i> Manajemen Dosen</a>
            <a class="nav-link {{ request()->routeIs('admin.fasilitas.*') ? 'active' : '' }}" href="{{ route('admin.fasilitas.index') }}"><i class="bi bi-building"></i> Fasilitas & Lab</a>
            <a class="nav-link {{ request()->routeIs('admin.mahasiswa.*') ? 'active' : '' }}" href="{{ route('admin.mahasiswa.index') }}"><i class="bi bi-person-vcard"></i> Informasi Mahasiswa</a>
            <a class="nav-link {{ request()->routeIs('admin.alumni.*') ? 'active' : '' }}" href="{{ route('admin.alumni.index') }}"><i class="bi bi-person-check"></i> Database Alumni</a>
            <a class="nav-link {{ request()->routeIs('admin.pengumuman.*') || request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.pengumuman.index') }}"><i class="bi bi-megaphone"></i> Pengumuman & Berita</a>
            <a class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}"><i class="bi bi-images"></i> Galeri</a>
            <a class="nav-link {{ request()->routeIs('admin.pendaftaran.*') ? 'active' : '' }}" href="{{ route('admin.pendaftaran.index') }}"><i class="bi bi-inboxes"></i> Pendaftaran Masuk</a>
        </nav>

        <div class="mt-auto pt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light w-100 rounded-3"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </aside>

    <section class="content-area">
        <header class="topbar px-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-0">@yield('title', 'Dashboard')</h1>
                <small class="text-info-emphasis">Panel Administrator Program Studi D4 Rekayasa Perangkat Lunak</small>
            </div>
            <div class="d-flex align-items-center gap-3 text-light">
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
