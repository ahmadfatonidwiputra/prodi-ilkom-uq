<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --admin-bg: #0f172a;
            --admin-bg-2: #1e293b;
            --admin-accent: #2563eb;
        }
        body { background: #f1f5f9; }
        .admin-shell { min-height: 100vh; }
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--admin-bg), var(--admin-bg-2));
            color: #dbeafe;
        }
        .sidebar .nav-link { color: #dbeafe; border-radius: .5rem; }
        .sidebar .nav-link.active, .sidebar .nav-link:hover { background: rgba(37,99,235,.25); color: #fff; }
        .content-area { flex: 1; }
        .topbar { background: #fff; border-bottom: 1px solid #e2e8f0; }
    </style>
    @stack('styles')
</head>
<body>
<div class="d-flex admin-shell">
    <aside class="sidebar p-3 d-flex flex-column">
        <a href="{{ route('admin.dashboard') }}" class="text-white text-decoration-none fw-bold fs-5 mb-4">Admin Prodi</a>
        <nav class="nav nav-pills flex-column gap-1">
            <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">Dashboard</a>
            <a class="nav-link {{ request()->routeIs('admin.dosen.*') ? 'active' : '' }}" href="{{ route('admin.dosen.index') }}">Dosen</a>
            <a class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}" href="{{ route('admin.berita.index') }}">Berita</a>
            <a class="nav-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}" href="{{ route('admin.pengumuman.index') }}">Pengumuman</a>
            <a class="nav-link {{ request()->routeIs('admin.galeri.*') ? 'active' : '' }}" href="{{ route('admin.galeri.index') }}">Galeri</a>
            <a class="nav-link {{ request()->routeIs('admin.profil.*') ? 'active' : '' }}" href="{{ route('admin.profil.edit') }}">Profil Prodi</a>
        </nav>
        <div class="mt-auto pt-3">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm w-100">Logout</button>
            </form>
        </div>
    </aside>

    <section class="content-area d-flex flex-column">
        <header class="topbar px-4 py-3 d-flex justify-content-between align-items-center">
            <h1 class="h5 mb-0">@yield('title', 'Admin Panel')</h1>
            <span class="text-muted small">{{ auth()->user()->email ?? 'Admin' }}</span>
        </header>
        <main class="p-4">
            @yield('content')
        </main>
    </section>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
