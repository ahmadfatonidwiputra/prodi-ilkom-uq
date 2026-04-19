@extends('layouts.user')

@section('title', 'Beranda — Prodi D4 Teknologi Rekayasa Perangkat Lunak UNBIM')
@section('description', 'Program Studi D4 TRPL UNBIM — kurikulum terapan berfokus health technopreneurship, rekayasa perangkat lunak modern, dan pengembangan produk digital siap pakai.')

@section('content')

    {{-- ===== HERO ===== --}}
    <section class="hero">
        <div class="hero-bg"></div>
        <div class="container hero-content">
            <div class="tag" style="margin-bottom: 24px;">
                <span class="dot"></span> Akreditasi Baik · Pendaftaran 2026 dibuka
            </div>
            <h1>
                Bangun perangkat lunak <span class="accent serif">yang berarti</span>,<br>
                di prodi berorientasi industri.
            </h1>
            <p class="lede">
                Program Studi D4 Teknologi Rekayasa Perangkat Lunak UNBIM — kurikulum
                terapan berfokus pada <em>health technopreneurship</em>, rekayasa
                perangkat lunak modern, dan pengembangan produk digital siap pakai.
            </p>
            <div class="hero-actions">
                <a href="{{ route('pendaftaran') }}" class="btn-primary-lg">Daftar Sekarang →</a>
                <a href="{{ route('tentang-prodi.profil-program-studi') }}" class="btn-ghost-lg">Pelajari Program</a>
            </div>
        </div>
    </section>

    {{-- ===== STATS ROW ===== --}}
    <section class="container" style="margin-top: -20px;">
        <div class="stats-row">
            <div class="stat-cell">
                <div class="num">{{ $statistik['dosen'] }}<span class="plus">+</span></div>
                <div class="label">Dosen Aktif</div>
            </div>
            <div class="stat-cell">
                <div class="num">{{ $statistik['prestasi_mahasiswa'] }}<span class="plus">+</span></div>
                <div class="label">Prestasi Mahasiswa</div>
            </div>
            <div class="stat-cell">
                <div class="num">{{ $statistik['mahasiswa_aktif'] }}<span class="plus">+</span></div>
                <div class="label">Mahasiswa Aktif</div>
            </div>
            <div class="stat-cell">
                <div class="num">12<span class="plus">+</span></div>
                <div class="label">Laboratorium &amp; Fasilitas</div>
            </div>
        </div>
    </section>

    {{-- ===== PROFIL PRODI + KEUNGGULAN ===== --}}
    <section class="section">
        <div class="container">
            <div class="grid g-3" style="align-items: stretch; gap: 24px;">
                {{-- Profil card (wide) --}}
                <div class="card card-pad-lg" style="grid-column: span 2;">
                    <span class="eyebrow">Profil Program Studi</span>
                    <h2 style="font-size: 34px; margin: 14px 0 18px;">
                        <span class="serif">Menjadi program studi</span> unggul dan
                        inovatif di bidang teknologi rekayasa perangkat lunak.
                    </h2>
                    @if (!empty($profilSection['excerpt']))
                        <p style="color: var(--ink-soft); font-size: 15.5px; line-height: 1.65; margin-bottom: 24px;">
                            {{ $profilSection['excerpt'] }}
                        </p>
                    @else
                        <p style="color: var(--ink-soft); font-size: 15.5px; line-height: 1.65; margin-bottom: 24px;">
                            D4 TRPL UNBIM mempersiapkan lulusan siap kerja sebagai
                            software engineer, full-stack developer, dan product specialist —
                            dengan fokus khusus pada solusi teknologi kesehatan yang relevan
                            dengan kebutuhan industri di Indonesia Timur.
                        </p>
                    @endif
                    <div class="flex gap-3">
                        <a href="{{ route('tentang-prodi.profil-program-studi') }}" class="btn-ghost">Profil lengkap →</a>
                        <a href="{{ route('kurikulum.matakuliah') }}" class="btn-ghost">Kurikulum →</a>
                    </div>
                </div>

                {{-- Keunggulan card (dark) --}}
                <div class="card card-pad-lg" style="background: var(--purple-900); color: #fff; border: none;">
                    <span class="eyebrow" style="color: var(--purple-300);">Keunggulan</span>
                    <h3 style="font-size: 22px; margin: 14px 0 20px; color: #fff;">
                        Kenapa memilih D4 TRPL?
                    </h3>
                    <ul style="list-style: none; padding: 0; margin: 0; display: grid; gap: 14px;">
                        @foreach (['Kurikulum 60% praktik, 40% teori', 'Sertifikasi industri (AWS, Alibaba Cloud)', 'Magang di startup & RS partner', 'Health-tech as a specialty track'] as $i => $t)
                            <li style="display: flex; gap: 12px; font-size: 14px; color: #efe4ff;">
                                <span class="mono"
                                    style="color: var(--purple-300); font-size: 11px; padding-top: 2px;">0{{ $i + 1 }}</span>
                                {{ $t }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== FASILITAS PREVIEW ===== --}}
    <section class="section" style="padding-top: 24px;">
        <div class="container">
            <div class="flex justify-between items-center" style="margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
                <div>
                    <span class="eyebrow">Fasilitas unggulan</span>
                    <h2 style="font-size: 32px; margin-top: 10px;">
                        Ruang untuk <span class="serif">belajar, bereksperimen, dan membangun.</span>
                    </h2>
                </div>
                <a href="{{ route('fasilitas.lab-pemrograman') }}" class="btn-ghost">Lihat semua →</a>
            </div>

            <div class="grid g-3">

                @php
                    $defaultFasilitas = [
                        ['name' => 'Lab Pemrograman', 'desc' => 'Lab khusus pemrograman dengan 40 workstation iMac & PC, dilengkapi IDE profesional dan akses GPU untuk ML.', 'tag' => 'LAB/PROG', 'route' => 'fasilitas.lab-pemrograman'],
                        ['name' => 'Lab Jaringan Komputer', 'desc' => 'Lab simulasi jaringan dengan Cisco rack, perangkat switch/router enterprise, dan sandbox untuk eksperimen keamanan.', 'tag' => 'LAB/NET', 'route' => 'fasilitas.lab-jaringan-komputer'],
                        ['name' => 'Coding Learn Center', 'desc' => 'Ruang kolaboratif 24/7 untuk mahasiswa berdiskusi, mengerjakan proyek, dan mengikuti bootcamp internal.', 'tag' => 'COWORK', 'route' => 'fasilitas.coding-learn'],
                    ];
                @endphp

                @foreach ($defaultFasilitas as $f)
                    <a href="{{ route($f['route']) }}" class="fasilitas-card" style="text-decoration: none;">
                        <div class="fasilitas-image">
                            <div class="tile-pattern"></div>
                            <div class="label">{{ $f['tag'] }}</div>
                        </div>
                        <div class="fasilitas-body">
                            <h4>{{ $f['name'] }}</h4>
                            <p>{{ $f['desc'] }}</p>
                        </div>
                    </a>
                @endforeach

            </div>
        </div>
    </section>

    {{-- ===== DOSEN PREVIEW ===== --}}
    <section class="section" style="padding-top: 24px;">
        <div class="container">
            <div class="flex justify-between items-center" style="margin-bottom: 28px; flex-wrap: wrap; gap: 16px;">
                <div>
                    <span class="eyebrow">Dosen unggulan</span>
                    <h2 style="font-size: 32px; margin-top: 10px;">
                        Diajar <span class="serif">praktisi &amp; peneliti</span> aktif.
                    </h2>
                </div>
                <a href="{{ route('dosen') }}" class="btn-ghost">Semua dosen →</a>
            </div>

            <div class="grid g-4">
                @forelse ($dosenUnggulan as $dosen)
                    <div class="dosen-card">
                        <div class="dosen-photo">
                            @if ($dosen->foto_url)
                                <img src="{{ $dosen->foto_url }}" alt="{{ $dosen->nama }}"
                                    style="width: 52%; aspect-ratio: 1; border-radius: 50%; object-fit: cover;">
                            @else
                                <div class="dosen-avatar"></div>
                            @endif
                            <div class="mono-label">FOTO/DOSEN</div>
                        </div>
                        <div class="dosen-body">
                            <div class="name">{{ $dosen->nama }}</div>
                            <div class="role">{{ $dosen->jabatan_fungsional ?: $dosen->jabatan }}</div>
                            @if ($dosen->nidn)
                                <div class="nidn">NIDN {{ $dosen->nidn }}</div>
                            @endif
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 4; text-align: center; padding: 40px; color: var(--ink-mute);">
                        Data dosen belum tersedia.
                    </div>
                @endforelse
            </div>
        </div>
    </section>

@endsection