@extends('layouts.user')

@section('title', 'Berita')

@section('content')
<h1 class="h3 mb-4">Berita Prodi</h1>
<div class="row g-4">
    @forelse ($beritas as $berita)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                @if ($berita->gambar)
                    <img src="{{ $berita->gambar }}" class="card-img-top" alt="{{ $berita->judul }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <small class="text-muted mb-2">{{ $berita->created_at?->format('d-m-Y') }}</small>
                    <h2 class="h5">{{ $berita->judul }}</h2>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($berita->isi), 120) }}</p>
                    <a href="{{ route('berita.show', $berita) }}" class="btn btn-outline-primary mt-auto">Baca Selengkapnya</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info mb-0">Belum ada berita.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $beritas->links() }}</div>
@endsection
