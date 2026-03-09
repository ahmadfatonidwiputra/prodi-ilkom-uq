@extends('layouts.user')

@section('title', 'Fasilitas')

@section('content')
<div class="row g-4">
    @forelse ($fasilitas as $item)
        <div class="col-md-6 col-xl-4">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <span class="icon-circle mb-3"><i class="bi {{ $item->ikon ?: 'bi-building' }}"></i></span>
                    <h5 class="fw-bold">{{ $item->nama }}</h5>
                    <p class="text-muted mb-0">{{ $item->deskripsi ?: 'Fasilitas pendukung pembelajaran modern.' }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-light border">Data fasilitas belum tersedia.</div></div>
    @endforelse
</div>
<div class="mt-3">{{ $fasilitas->links() }}</div>
@endsection
