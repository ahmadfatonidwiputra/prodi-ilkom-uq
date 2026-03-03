@extends('layouts.app')

@section('title', $pengumuman->judul)

@section('content')
<div class="mb-4">
    <a href="{{ route('pengumuman') }}" class="btn btn-outline-secondary btn-sm">&larr; Kembali ke daftar pengumuman</a>
</div>

<article class="card border-0 shadow-sm">
    <div class="card-body p-4 p-lg-5">
        <p class="text-muted mb-2">Tanggal: {{ $pengumuman->tanggal?->format('d-m-Y') }}</p>
        <h1 class="h2 fw-bold mb-3">{{ $pengumuman->judul }}</h1>
        <div class="text-muted">{!! nl2br(e($pengumuman->isi)) !!}</div>
    </div>
</article>
@endsection
