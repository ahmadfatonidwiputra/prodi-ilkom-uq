<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Prodi D4 Rekayasa Perangkat Lunak UNBIM')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --uq-purple: #8b3dff;
            --uq-purple-deep: #4e1f9c;
            --uq-purple-ink: #2e135f;
            --uq-slate: #f4ecff;
        }

        body {
            background: linear-gradient(160deg, #fbf8ff 0%, #f4ecff 45%, #fcf9ff 100%);
            color: #0d1b2d;
            min-height: 100vh;
            font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        }

        .top-nav {
            background: #fff;
            border-bottom: 1px solid rgba(13, 27, 45, 0.08);
            backdrop-filter: blur(6px);
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--uq-purple), #bb7cff);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 700;
        }

        .nav-link {
            font-weight: 600;
            color: #1d3557;
        }

        .nav-link.active,
        .nav-link:hover {
            color: var(--uq-purple);
        }

        .btn-daftar {
            border-radius: 12px;
            padding: 0.55rem 1.05rem;
            background: linear-gradient(120deg, var(--uq-purple-deep), var(--uq-purple));
            border: none;
            color: #fff;
            font-weight: 600;
        }

        .hero-wrap {
            background:
                linear-gradient(110deg, rgba(46, 19, 95, 0.92) 35%, rgba(78, 31, 156, 0.68) 58%, rgba(78, 31, 156, 0.25) 100%),
                url('https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&w=1800&q=80') center/cover;
            border-radius: 0 0 24px 24px;
            color: #fff;
            min-height: 500px;
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
        }

        .hero-wrap::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 10% 20%, rgba(178, 116, 255, 0.38), transparent 38%);
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 22px;
            box-shadow: 0 16px 45px rgba(8, 32, 88, 0.15);
        }

        .section-shell {
            margin-top: -62px;
            position: relative;
            z-index: 3;
        }

        .icon-circle {
            width: 54px;
            height: 54px;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(130deg, #f0e4ff, #fbf5ff);
            color: #6a2cc6;
            font-size: 1.25rem;
        }

        .footer-user {
            margin-top: 3rem;
            background: linear-gradient(120deg, var(--uq-purple-ink), var(--uq-purple-deep));
            color: #efe4ff;
        }

        @media (max-width: 992px) {
            .hero-wrap {
                min-height: 420px;
                border-radius: 0;
            }

            .section-shell {
                margin-top: 1rem;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
<nav class="navbar navbar-expand-lg top-nav sticky-top py-3">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('home') }}">
            <span class="brand-mark"><i class="bi bi-mortarboard"></i></span>
            <span class="fw-bold fs-4" style="color: var(--uq-purple-deep);">UNBIM <span class="text-dark fs-5">D4 RPL</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navUser" aria-controls="navUser" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navUser">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-2">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('profil') ? 'active' : '' }}" href="{{ route('profil') }}">Tentang Prodi</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('kurikulum') ? 'active' : '' }}" href="{{ route('kurikulum') }}">Kurikulum</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('dosen') ? 'active' : '' }}" href="{{ route('dosen') }}">Dosen</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('fasilitas') ? 'active' : '' }}" href="{{ route('fasilitas') }}">Fasilitas</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('mahasiswa') ? 'active' : '' }}" href="{{ route('mahasiswa') }}">Mahasiswa</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('alumni') ? 'active' : '' }}" href="{{ route('alumni') }}">Alumni</a></li>
                <li class="nav-item"><a class="btn btn-daftar ms-lg-2 mt-2 mt-lg-0" href="{{ route('pendaftaran') }}">Pendaftaran</a></li>
            </ul>
        </div>
    </div>
</nav>

@if (request()->routeIs('home'))
    <section class="hero-wrap">
        <div class="container hero-content py-5">
            <div class="row">
                <div class="col-lg-7">
                    <p class="text-uppercase fw-semibold mb-2">Selamat Datang di</p>
                    <h1 class="display-4 fw-bold mb-3">Program Studi D4 Rekayasa Perangkat Lunak UNBIM</h1>
                    <p class="fs-4 mb-4">Mencetak lulusan unggul dan kompeten di bidang teknologi terapan, software engineering, dan inovasi digital.</p>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('profil') }}" class="btn btn-daftar">Pelajari Lebih Lanjut</a>
                        <a href="{{ route('visi-misi') }}" class="btn btn-outline-light rounded-3 px-4">Visi &amp; Misi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<main class="container py-4 {{ request()->routeIs('home') ? 'section-shell' : '' }}" style="min-height: calc(100vh - 340px);">
    @yield('content')
</main>

<footer class="footer-user">
    <div class="container py-4">
        <div class="row g-4">
            <div class="col-md-6">
                <h5 class="fw-bold mb-2">Program Studi D4 Rekayasa Perangkat Lunak</h5>
                <p class="mb-1">Universitas Bima Internasional (UNBIM)</p>
                <small>Jl. Medika Farma Husada, Batu Ringgit, Sekarbela, Kota Mataram, NTB.</small>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-2">Social Media</p>
                <div class="d-flex justify-content-md-end gap-2">
                    <span class="badge text-bg-light"><i class="bi bi-facebook"></i></span>
                    <span class="badge text-bg-light"><i class="bi bi-instagram"></i></span>
                    <span class="badge text-bg-light"><i class="bi bi-youtube"></i></span>
                </div>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
