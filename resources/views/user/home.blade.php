@extends('layouts.user')

@section('title', 'Beranda - Prodi D4 Teknologi Rekayasa Perangkat Lunak UNBIM')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="glass-card p-4 h-100">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h3 class="fw-bold mb-0">{{ $profilSection['title'] }}</h3>
                <a href="{{ $profilSection['detail_url'] }}" class="btn btn-sm btn-outline-primary">Lihat Selengkapnya</a>
            </div>
            <p class="text-muted mb-0">{!! nl2br(e($profilSection['excerpt'])) !!}</p>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="glass-card p-4 h-100">
            <h4 class="fw-bold mb-3">Statistik Program</h4>
            <div class="d-grid gap-3">
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span>Dosen Aktif</span>
                    <strong>{{ $statistik['dosen'] }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span>Prestasi Mahasiswa</span>
                    <strong>{{ $statistik['prestasi_mahasiswa'] }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
                    <span>Mahasiswa Diterima</span>
                    <strong>{{ $statistik['mahasiswa_aktif'] }}</strong>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <span>Fasilitas</span>
                    <strong>{{ $statistik['fasilitas'] }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

@if ($fasilitasSlides->isNotEmpty())
    <div class="glass-card p-4 mb-4">
        <h3 class="fw-bold mb-3">Fasilitas</h3>
        <div id="fasilitasCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6000">
            <div class="carousel-indicators">
                @foreach ($fasilitasSlides as $slide)
                    <button type="button" data-bs-target="#fasilitasCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" @if ($loop->first) aria-current="true" @endif aria-label="Slide {{ $loop->iteration }}"></button>
                @endforeach
            </div>

            <div class="carousel-inner rounded-4 overflow-hidden">
                @foreach ($fasilitasSlides as $slide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ $slide['image_url'] }}" class="d-block w-100" alt="{{ $slide['title'] }}" style="height: 380px; object-fit: cover;">
                        <div class="carousel-caption text-start p-3 p-md-4 rounded-3" style="background: rgba(13, 27, 45, 0.62);">
                            <h5 class="fw-bold mb-1">{{ $slide['title'] }}</h5>
                            @if (!empty($slide['body']))
                                <p class="mb-3">{{ \Illuminate\Support\Str::limit(strip_tags($slide['body']), 120) }}</p>
                            @endif
                            <a href="{{ $slide['detail_url'] }}" class="btn btn-sm btn-light fw-semibold">Lihat Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($fasilitasSlides->count() > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#fasilitasCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            @endif
        </div>
    </div>
@endif

<div class="row g-4">
    <div class="col-12">
        <div class="glass-card p-4 h-100">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                <h4 class="fw-bold mb-0">Dosen Unggulan</h4>
                <a href="{{ route('dosen') }}" class="btn btn-sm btn-outline-primary">Lihat Semua Dosen</a>
            </div>
            @forelse ($dosenUnggulan as $dosen)
                <div class="d-flex align-items-center gap-3 py-2 border-bottom">
                    <div class="rounded-circle bg-primary-subtle text-primary d-inline-flex align-items-center justify-content-center" style="width: 44px; height: 44px;">
                        <i class="bi bi-person"></i>
                    </div>
                    <div>
                        <div class="fw-semibold">{{ $dosen->nama }}</div>
                        <small class="text-muted">{{ $dosen->jabatan_fungsional ?: $dosen->jabatan }}</small>
                    </div>
                </div>
            @empty
                <p class="text-muted mb-0">Data dosen belum tersedia.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
