<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Program Studi D4 Teknologi Rekayasa Perangkat Lunak')</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="64x64" href="{{ asset('images/unbim-favicon.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --academic-blue: #0b3a8f;
            --academic-blue-dark: #072966;
            --academic-blue-soft: #eaf1ff;
            --text-main: #1f2a44;
        }

        body {
            color: var(--text-main);
            background: #f7f9fc;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .2px;
        }

        .navbar-custom {
            background: linear-gradient(90deg, var(--academic-blue-dark), var(--academic-blue));
        }

        .nav-link.active {
            font-weight: 600;
            text-decoration: underline;
            text-underline-offset: 6px;
        }

        .hero-home {
            background:
                linear-gradient(120deg, rgba(7, 41, 102, 0.95), rgba(11, 58, 143, 0.88)),
                radial-gradient(circle at 15% 15%, rgba(255, 255, 255, 0.15), transparent 38%);
            color: #fff;
            border-radius: 0 0 1.25rem 1.25rem;
        }

        .hero-home .lead {
            max-width: 760px;
            opacity: .95;
        }

        .page-wrapper {
            min-height: calc(100vh - 250px);
        }

        .footer-custom {
            background: #091a3f;
            color: #d6def4;
        }

        .footer-custom a {
            color: #ffffff;
            text-decoration: none;
        }

        .footer-custom a:hover {
            text-decoration: underline;
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom sticky-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Prodi D4 Teknologi Rekayasa Perangkat Lunak</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Profil</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('visi-misi') ? 'active' : '' }}" href="{{ route('visi-misi') }}">Visi &amp; Misi</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('dosen') ? 'active' : '' }}" href="{{ route('dosen') }}">Dosen</a></li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle {{ request()->routeIs('admin.*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Admin
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.dosen.index') }}">Kelola Dosen</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.profil.edit') }}">Profil Prodi</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="px-3">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-outline-danger w-100">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    @if (request()->routeIs('home'))
        <section class="hero-home py-5 mb-4">
            <div class="container py-3 py-md-5">
                <h1 class="display-5 fw-bold mb-3">Program Studi D4 Teknologi Rekayasa Perangkat Lunak</h1>
                <p class="lead mb-4">
                    Universitas Bima Internasional (UNBIM) membangun ekosistem pembelajaran teknologi yang adaptif,
                    inovatif, dan berorientasi pada dampak nyata untuk masyarakat.
                </p>
                <a href="{{ route('profil') }}" class="btn btn-light btn-lg px-4">Lihat Profil Prodi</a>
            </div>
        </section>
    @endif

    @isset($header)
        <header class="container mb-3">
            <div class="bg-white rounded-3 shadow-sm p-3 p-md-4">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="page-wrapper">
        <div class="container py-4">
            @yield('content')
            {{ $slot ?? '' }}
        </div>
    </main>

    <footer class="footer-custom mt-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="text-white fw-semibold">Program Studi D4 Teknologi Rekayasa Perangkat Lunak</h5>
                    <p class="mb-0">Universitas Bima Internasional (UNBIM)</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white fw-semibold">Alamat</h6>
                    <p class="mb-0">Jl. Medika Farma Husada, Batu Ringgit, Sekarbela, Kota Mataram, NTB.</p>
                </div>
                <div class="col-md-4">
                    <h6 class="text-white fw-semibold">Sosial Media</h6>
                    <div class="d-flex gap-3">
                        <a href="#" aria-label="Instagram">Instagram</a>
                        <a href="#" aria-label="Facebook">Facebook</a>
                        <a href="#" aria-label="YouTube">YouTube</a>
                    </div>
                </div>
            </div>
            <hr class="border-secondary my-4">
            <p class="mb-0 small">&copy; {{ date('Y') }} Prodi D4 Teknologi Rekayasa Perangkat Lunak - Universitas Bima Internasional (UNBIM)</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
