@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="mb-4">
    <h2 class="display-6 fw-bold mb-1">Selamat Datang, Administrator</h2>
    <p class="text-muted mb-0">Ringkasan aktivitas website Program Studi D4 Teknologi Rekayasa Perangkat Lunak</p>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-6 col-xl-3">
        <div class="panel-card p-3 h-100 d-flex align-items-center gap-3">
            <span class="metric-icon"><i class="bi bi-people"></i></span>
            <div>
                <div class="small text-secondary">Total Prestasi Mahasiswa</div>
                <div class="h4 fw-bold mb-0">{{ $metrics['totalMahasiswaAktif'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="panel-card p-3 h-100 d-flex align-items-center gap-3">
            <span class="metric-icon"><i class="bi bi-arrow-repeat"></i></span>
            <div>
                <div class="small text-secondary">Halaman Diperbarui Hari Ini</div>
                <div class="h4 fw-bold mb-0">{{ $metrics['halamanDiperbaruiHariIni'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="panel-card p-3 h-100 d-flex align-items-center gap-3">
            <span class="metric-icon"><i class="bi bi-person-plus"></i></span>
            <div>
                <div class="small text-secondary">Pendaftaran Baru</div>
                <div class="h4 fw-bold mb-0">{{ $metrics['pendaftaranBaru'] }}</div>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="panel-card p-3 h-100 d-flex align-items-center gap-3">
            <span class="metric-icon"><i class="bi bi-clipboard-check"></i></span>
            <div>
                <div class="small text-secondary">Pendaftaran Pending</div>
                <div class="h4 fw-bold mb-0">{{ $metrics['permintaanUpdateProfil'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="panel-card p-4 h-100">
            <h3 class="h4 fw-bold mb-3">Aktivitas Terbaru</h3>
            <div class="list-group list-group-flush">
                @forelse ($aktivitasTerbaru as $aktivitas)
                    <div class="list-group-item bg-transparent text-dark border-secondary-subtle px-0 py-3">
                        <div class="d-flex justify-content-between gap-3">
                            <div class="d-flex align-items-start gap-2">
                                <i class="bi bi-{{ $aktivitas['ikon'] }} text-info"></i>
                                <div>
                                    <div class="fw-semibold">{{ $aktivitas['judul'] }}</div>
                                    <small class="text-secondary">{{ $aktivitas['waktu']->diffForHumans() }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-secondary mb-0">Belum ada aktivitas terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="panel-card p-4 mb-4">
            <h3 class="h4 fw-bold mb-3">Quick Actions</h3>
            <div class="row g-2">
                <div class="col-6"><a href="{{ route('admin.berita.create') }}" class="btn btn-quick w-100"><i class="bi bi-newspaper me-1"></i> Buat Berita Baru</a></div>
                <div class="col-6"><a href="{{ route('admin.kurikulum.index') }}" class="btn btn-quick w-100"><i class="bi bi-journal-text me-1"></i> Update Kurikulum</a></div>
                <div class="col-6"><a href="{{ route('admin.site-content.edit', 'tentang-profil-program-studi') }}" class="btn btn-quick w-100"><i class="bi bi-pencil-square me-1"></i> Edit Profil Prodi</a></div>
                <div class="col-6"><a href="{{ route('admin.pengumuman.create') }}" class="btn btn-quick w-100"><i class="bi bi-megaphone me-1"></i> Kirim Pengumuman</a></div>
            </div>
        </div>

        <div class="panel-card p-4">
            <h3 class="h5 fw-bold mb-3">Ringkasan Data</h3>
            <div class="small">
                <div class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle"><span>Total Dosen</span><strong>{{ $metrics['totalDosen'] }}</strong></div>
                <div class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle"><span>Total Berita</span><strong>{{ $metrics['totalBerita'] }}</strong></div>
                <div class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle"><span>Total Pengumuman</span><strong>{{ $metrics['totalPengumuman'] }}</strong></div>
                <div class="d-flex justify-content-between py-2 border-bottom border-secondary-subtle"><span>Total Galeri</span><strong>{{ $metrics['totalGaleri'] }}</strong></div>
                <div class="d-flex justify-content-between py-2"><span>Total Prestasi Mahasiswa</span><strong>{{ $metrics['totalPrestasiMahasiswa'] }}</strong></div>
            </div>
        </div>
    </div>
</div>
@endsection
