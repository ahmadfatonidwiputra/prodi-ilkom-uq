@extends('layouts.user')

@section('title', $pengumuman->judul)

@section('content')
<a href="{{ route('pengumuman') }}" class="btn btn-outline-secondary btn-sm mb-4">&larr; Kembali ke Pengumuman</a>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <p class="text-muted">{{ $pengumuman->tanggal?->format('d-m-Y') }}</p>
        <h1 class="h3">{{ $pengumuman->judul }}</h1>
        <div>{!! nl2br(e($pengumuman->isi)) !!}</div>
    </div>
</div>
@endsection
