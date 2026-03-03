@extends('layouts.app')

@section('title', 'Berita Prodi Ilmu Komputer')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Berita Prodi</h1>
        <p class="text-muted mb-0">Informasi terbaru Program Studi Ilmu Komputer.</p>
    </div>
</div>

<div class="row g-4">
    @forelse ($beritas as $berita)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                @if ($berita->gambar)
                    <img src="{{ $berita->gambar }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light text-muted" style="height: 200px;">
                        Tidak ada gambar
                    </div>
                @endif

                <div class="card-body d-flex flex-column">
                    <small class="text-muted mb-2">{{ $berita->created_at?->translatedFormat('d F Y') }}</small>
                    <h2 class="h5 card-title">{{ $berita->judul }}</h2>
                    <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}</p>
                    <a href="{{ route('berita.show', $berita->slug) }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Belum ada berita yang dipublikasikan.</div>
        </div>
    @endforelse
</div>

@if ($beritas->hasPages())
    <div class="mt-4">
        {{ $beritas->links() }}
    </div>
@endif
@endsection
