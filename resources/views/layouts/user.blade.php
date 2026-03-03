<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Prodi Ilmu Komputer')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --uq-blue: #0b3a8f;
            --uq-dark: #061f4d;
        }
        body { background: #f6f8fc; color: #1f2a44; }
        .navbar-user { background: linear-gradient(90deg, var(--uq-dark), var(--uq-blue)); }
        .nav-link.active { font-weight: 600; text-decoration: underline; text-underline-offset: 6px; }
        .hero {
            background: linear-gradient(120deg, rgba(6,31,77,.94), rgba(11,58,143,.9));
            color: #fff;
            border-radius: 0 0 1rem 1rem;
        }
        .footer-user { background: #091a3f; color: #d6def4; }
    </style>
    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-user shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">Prodi Ilmu Komputer</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUser" aria-controls="navUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navUser">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('visi-misi') ? 'active' : '' }}" href="{{ route('visi-misi') }}">Visi Misi</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dosen') ? 'active' : '' }}" href="{{ route('dosen') }}">Dosen</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('berita*') ? 'active' : '' }}" href="{{ route('berita') }}">Berita</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('pengumuman*') ? 'active' : '' }}" href="{{ route('pengumuman') }}">Pengumuman</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a></li>
            </ul>
        </div>
    </div>
</nav>

@if (request()->routeIs('home'))
<section class="hero py-5 mb-4">
    <div class="container py-2">
        <h1 class="display-6 fw-bold mb-3">Program Studi Ilmu Komputer</h1>
        <p class="lead mb-0">Universitas Qamarul Huda Badaruddin Bagu</p>
    </div>
</section>
@endif

<main class="container py-4" style="min-height: calc(100vh - 260px);">
    @yield('content')
</main>

<footer class="footer-user mt-4">
    <div class="container py-4">
        <p class="mb-1 fw-semibold">Program Studi Ilmu Komputer</p>
        <p class="mb-1">Universitas Qamarul Huda Badaruddin Bagu</p>
        <p class="mb-0 small">Jl. H. Badaruddin Bagu, Lombok Tengah, Nusa Tenggara Barat</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
