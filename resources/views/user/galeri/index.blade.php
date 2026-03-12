@extends('layouts.user')

@section('title', 'Galeri')

@section('content')
<h1 class="h3 mb-4">Galeri Kegiatan</h1>
<div class="row g-4">
    @forelse ($galeris as $galeri)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                @if ($galeri->gambar_url)
                    <img src="{{ $galeri->gambar_url }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height:220px;object-fit:cover;">
                @endif
                <div class="card-body"><h2 class="h5 mb-0">{{ $galeri->judul }}</h2></div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info mb-0">Belum ada galeri.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $galeris->links() }}</div>
@endsection
