@extends('layouts.user')

@section('title', 'Prestasi Mahasiswa')

@section('content')
<h1 class="h3 mb-4">Prestasi Mahasiswa</h1>
<div class="row g-4">
    @forelse ($prestasis as $prestasi)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                @if ($prestasi->gambar_url)
                    <img src="{{ $prestasi->gambar_url }}" class="card-img-top" alt="{{ $prestasi->judul_prestasi }}" style="height: 210px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h2 class="h5 fw-semibold">{{ $prestasi->judul_prestasi }}</h2>
                    <p class="mb-1 text-muted">{{ $prestasi->nama_mahasiswa }} • {{ $prestasi->tahun }}</p>
                    <p class="text-muted mb-0">{{ \Illuminate\Support\Str::limit($prestasi->deskripsi, 140) }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info mb-0">Data prestasi mahasiswa belum tersedia.</div>
        </div>
    @endforelse
</div>

<div class="mt-4">{{ $prestasis->links() }}</div>
@endsection
