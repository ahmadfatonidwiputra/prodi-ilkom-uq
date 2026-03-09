@extends('layouts.user')

@section('title', 'Alumni')

@section('content')
<div class="row g-4">
    @forelse ($alumnis as $item)
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">{{ $item->nama }}</h5>
                    <p class="text-muted mb-2">Lulusan {{ $item->angkatan_lulus }}</p>
                    <p class="mb-1"><strong>Pekerjaan:</strong> {{ $item->pekerjaan ?: '-' }}</p>
                    <p class="mb-2"><strong>Perusahaan:</strong> {{ $item->perusahaan ?: '-' }}</p>
                    <p class="text-muted mb-0">{{ $item->testimoni ?: 'Alumni berkontribusi di berbagai sektor industri dan teknologi.' }}</p>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-light border">Data alumni belum tersedia.</div></div>
    @endforelse
</div>
<div class="mt-3">{{ $alumnis->links() }}</div>
@endsection
