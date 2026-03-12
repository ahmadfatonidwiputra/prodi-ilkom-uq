@extends('layouts.user')

@section('title', 'Pengumuman')

@section('content')
<h1 class="h3 mb-4">Pengumuman</h1>
<div class="row g-4">
    @forelse ($pengumumans as $pengumuman)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-2">{{ $pengumuman->tanggal ? \Illuminate\Support\Carbon::parse($pengumuman->tanggal)->format('d-m-Y') : '-' }}</p>
                    <h2 class="h5">{{ $pengumuman->judul }}</h2>
                    <p class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($pengumuman->isi), 140) }}</p>
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('pengumuman.show', $pengumuman) }}" class="btn btn-outline-primary btn-sm">Lihat Detail</a>
                        @if ($pengumuman->file_url)
                            <a href="{{ $pengumuman->file_url }}" target="_blank" class="btn btn-primary btn-sm">Unduh PDF</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info mb-0">Belum ada pengumuman.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $pengumumans->links() }}</div>
@endsection
