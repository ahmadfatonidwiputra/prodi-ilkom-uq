@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="mb-4">
    <a href="{{ route('berita') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke daftar berita</a>
</div>

<article class="card border-0 shadow-sm">
    @if ($berita->gambar)
        <img src="{{ $berita->gambar }}" class="card-img-top" alt="{{ $berita->judul }}" style="max-height: 440px; object-fit: cover;">
    @endif

    <div class="card-body p-4 p-lg-5">
        <p class="text-muted mb-2">Dipublikasikan: {{ $berita->created_at?->translatedFormat('d F Y') }}</p>
        <h1 class="h2 fw-bold mb-3">{{ $berita->judul }}</h1>
        <div class="text-muted">{!! nl2br(e($berita->isi)) !!}</div>
    </div>
</article>
@endsection
