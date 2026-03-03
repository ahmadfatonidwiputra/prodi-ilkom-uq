@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Jumlah Dosen</p>
                <h2 class="display-6 fw-bold text-primary mb-0">{{ $totalDosen }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Jumlah Berita</p>
                <h2 class="display-6 fw-bold text-success mb-0">{{ $totalBerita }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Jumlah Pengumuman</p>
                <h2 class="display-6 fw-bold text-info mb-0">{{ $totalPengumuman }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <p class="text-muted mb-2">Jumlah Galeri</p>
                <h2 class="display-6 fw-bold text-warning mb-0">{{ $totalGaleri }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h3 class="h5 mb-3">Statistik Konten</h3>
        @php
            $totalKonten = $totalBerita + $totalPengumuman + $totalGaleri;
            $persenBerita = $totalKonten > 0 ? round(($totalBerita / $totalKonten) * 100) : 0;
            $persenPengumuman = $totalKonten > 0 ? round(($totalPengumuman / $totalKonten) * 100) : 0;
            $persenGaleri = $totalKonten > 0 ? round(($totalGaleri / $totalKonten) * 100) : 0;
        @endphp

        <p class="mb-2">Proporsi Konten (Berita, Pengumuman, Galeri)</p>
        <div class="progress mb-3" role="progressbar" aria-label="Statistik Konten" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: {{ $persenBerita }}%">{{ $persenBerita }}% Berita</div>
            <div class="progress-bar bg-info text-dark" style="width: {{ $persenPengumuman }}%">{{ $persenPengumuman }}% Pengumuman</div>
            <div class="progress-bar bg-warning text-dark" style="width: {{ $persenGaleri }}%">{{ $persenGaleri }}% Galeri</div>
        </div>

        <p class="text-muted mb-0">
            Total konten publik saat ini: <strong>{{ $totalKonten }}</strong> item.
        </p>
    </div>
</div>
@endsection
