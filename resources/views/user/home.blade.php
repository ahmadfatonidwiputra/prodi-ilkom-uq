@extends('layouts.user')

@section('title', 'Beranda - Prodi D4 Teknologi Rekayasa Perangkat Lunak UNBIM')

@section('content')
<div class="glass-card p-4 p-lg-5 mb-4">
    <h2 class="fw-bold text-center mb-4">Mengapa D4 Teknologi Rekayasa Perangkat Lunak UNBIM?</h2>

    <div class="row g-4 text-center">
        @forelse ($fasilitasUnggulan as $item)
            <div class="col-md-6 col-lg-3">
                <div class="h-100 px-2">
                    <span class="icon-circle mb-3">
                        <i class="bi {{ $item->ikon ?: 'bi-cpu' }}"></i>
                    </span>
                    <h5 class="fw-bold">{{ $item->nama }}</h5>
                    <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($item->deskripsi, 80, '...') }}</p>
                </div>
            </div>
        @empty
            <div class="col-12 text-muted">Data keunggulan belum tersedia.</div>
        @endforelse
    </div>
</div>

<div class="row g-4 mb-4">
    <div class="col-lg-8">
        <div class="glass-card p-4 h-100">
            <h3 class="fw-bold mb-3">Profil Prodi</h3>
            <p class="text-muted mb-0">{!! nl2br(e(\Illuminate\Support\Str::limit($profil->tentang ?? 'Profil program studi belum diisi.', 520))) !!}</p>
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
                    <span>Mahasiswa Aktif</span>
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

<div class="row g-4">
    <div class="col-lg-6">
        <div class="glass-card p-4 h-100">
            <h4 class="fw-bold mb-3">Dosen Unggulan</h4>
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

    <div class="col-lg-6">
        <div class="glass-card p-4 h-100">
            <h4 class="fw-bold mb-3">Berita Terbaru</h4>
            @forelse ($beritaTerbaru as $berita)
                <div class="py-2 border-bottom">
                    <a class="text-decoration-none fw-semibold" href="{{ route('berita.show', $berita) }}">{{ $berita->judul }}</a>
                    <div class="small text-muted">{{ $berita->created_at->translatedFormat('d M Y') }}</div>
                </div>
            @empty
                <p class="text-muted mb-0">Belum ada berita terbaru.</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
