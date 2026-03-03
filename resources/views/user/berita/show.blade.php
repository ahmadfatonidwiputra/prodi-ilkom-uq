@extends('layouts.user')

@section('title', $berita->judul)

@section('content')
<a href="{{ route('berita') }}" class="btn btn-outline-secondary btn-sm mb-4">&larr; Kembali ke Berita</a>
<div class="card border-0 shadow-sm">
    @if ($berita->gambar)
        <img src="{{ $berita->gambar }}" class="card-img-top" alt="{{ $berita->judul }}" style="max-height: 440px; object-fit: cover;">
    @endif
    <div class="card-body p-4">
        <p class="text-muted">{{ $berita->created_at?->format('d-m-Y') }}</p>
        <h1 class="h3">{{ $berita->judul }}</h1>
        <div>{!! nl2br(e($berita->isi)) !!}</div>
    </div>
</div>
@endsection
