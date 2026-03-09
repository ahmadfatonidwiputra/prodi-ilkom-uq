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
            width: 290px;
            background: #ffffff;
            border-right: 1px solid var(--admin-line);
        }

        .sidebar .brand {
            display: flex;
            align-items: center;
            gap: .65rem;
            color: var(--admin-text);
            text-decoration: none;
            font-weight: 700;
            font-size: 1.7rem;
        }

        .sidebar .brand-logo {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: linear-gradient(145deg, #8b3dff, #bb7cff);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        .sidebar .nav-link {
            color: var(--admin-text);
            border-radius: 12px;
            padding: .7rem .8rem;
            display: flex;
            align-items: center;
            gap: .7rem;
            font-weight: 500;
        }

        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background: #f2ebff;
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
                <button type="submit" class="btn btn-outline-dark w-100 rounded-3"><i class="bi bi-box-arrow-right me-1"></i> Logout</button>
            </form>
        </div>
    </aside>

    <section class="content-area">
        <header class="topbar px-4 d-flex justify-content-between align-items-center">
            <div>
                <h1 class="h4 fw-bold mb-0">@yield('title', 'Dashboard')</h1>
                <small class="text-muted">Panel Administrator Program Studi D4 Rekayasa Perangkat Lunak</small>
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
