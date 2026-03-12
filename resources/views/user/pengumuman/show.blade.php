@extends('layouts.user')

@section('title', $pengumuman->judul)

@section('content')
<a href="{{ route('pengumuman') }}" class="btn btn-outline-secondary btn-sm mb-4">&larr; Kembali ke Pengumuman</a>
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <p class="text-muted">{{ $pengumuman->tanggal ? \Illuminate\Support\Carbon::parse($pengumuman->tanggal)->format('d-m-Y') : '-' }}</p>
        <h1 class="h3">{{ $pengumuman->judul }}</h1>
        <div class="mb-3">{!! nl2br(e($pengumuman->isi)) !!}</div>

        @if ($pengumuman->file_url)
            <a href="{{ $pengumuman->file_url }}" target="_blank" class="btn btn-primary">
                <i class="bi bi-download me-1"></i> Unduh File Pengumuman
            </a>
        @endif
    </div>
</div>
@endsection
