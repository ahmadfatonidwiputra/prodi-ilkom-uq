@extends('layouts.app')

@section('title', 'Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Pengumuman</h1>
        <p class="text-muted mb-0">Informasi resmi dan pengumuman terbaru Program Studi D4 Teknologi Rekayasa Perangkat Lunak.</p>
    </div>
</div>

<div class="row g-4">
    @forelse ($pengumumans as $pengumuman)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">{{ $pengumuman->tanggal?->format('d-m-Y') }}</p>
                    <h2 class="h5">{{ $pengumuman->judul }}</h2>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 140) }}</p>
                    <a href="{{ route('pengumuman.show', $pengumuman) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Belum ada pengumuman.</div>
        </div>
    @endforelse
</div>

@if ($pengumumans->hasPages())
    <div class="mt-4">{{ $pengumumans->links() }}</div>
@endif
@endsection
