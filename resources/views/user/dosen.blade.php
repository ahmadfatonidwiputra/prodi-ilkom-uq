@extends('layouts.user')

@section('title', 'Dosen')

@section('content')
<h1 class="h3 mb-4">Dosen Program Studi D4 Teknologi Rekayasa Perangkat Lunak</h1>
<div class="row g-4">
    @forelse ($dosens as $dosen)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                @if ($dosen->foto)
                    <img src="{{ asset('storage/' . $dosen->foto) }}" class="card-img-top" alt="{{ $dosen->nama }}" style="height: 260px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h2 class="h5 mb-1">{{ $dosen->nama }}</h2>
                    <p class="text-muted mb-1">NIDN: {{ $dosen->nidn }}</p>
                    <p class="mb-1">{{ $dosen->jabatan }}</p>
                    <p class="mb-0 text-primary fw-semibold">{{ $dosen->jabatan_fungsional }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info mb-0">Data dosen belum tersedia.</div></div>
    @endforelse
</div>
<div class="mt-4">{{ $dosens->links() }}</div>
@endsection
