@extends('layouts.user')

@section('title', 'Profil Prodi')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h1 class="h3 mb-3">Tentang Prodi</h1>
                <div class="text-muted">{!! nl2br(e($profil->tentang ?? 'Profil program studi belum diisi.')) !!}</div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h5 fw-bold mb-3">Visi</h2>
                <div class="text-muted mb-4">{!! nl2br(e($profil->visi ?? 'Visi belum diisi.')) !!}</div>
                <h2 class="h5 fw-bold mb-3">Misi</h2>
                <div class="text-muted">{!! nl2br(e($profil->misi ?? 'Misi belum diisi.')) !!}</div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm mt-4">
    <div class="card-body p-4">
        <h2 class="h4 mb-3">Sertifikat Akreditasi Terbaru</h2>

        @if (!empty($profil?->sertifikat_akreditasi))
            <div class="row g-3 align-items-center">
                <div class="col-lg-8">
                    <img src="{{ asset('storage/' . $profil->sertifikat_akreditasi) }}" alt="Sertifikat Akreditasi Prodi" class="img-fluid rounded border">
                </div>
                <div class="col-lg-4">
                    <div class="alert alert-success mb-0">
                        <div class="fw-semibold mb-1">Status: Tersedia</div>
                        <small class="text-muted">Dokumen akreditasi terbaru telah diunggah oleh admin prodi.</small>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mb-0">
                Sertifikat akreditasi terbaru belum diunggah.
            </div>
        @endif
    </div>
</div>
@endsection
