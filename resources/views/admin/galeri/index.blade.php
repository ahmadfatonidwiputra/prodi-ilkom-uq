@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Data Galeri</h1>
    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Tambah Galeri</a>
</div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="row g-4">
    @forelse($galeris as $galeri)
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm h-100">
                <img src="{{ $galeri->gambar }}" class="card-img-top" alt="{{ $galeri->judul }}" style="height:220px;object-fit:cover;">
                <div class="card-body">
                    <h2 class="h5">{{ $galeri->judul }}</h2>
                    <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.galeri.destroy', $galeri) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus galeri ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12"><div class="alert alert-info">Belum ada data galeri.</div></div>
    @endforelse
</div>
<div class="mt-3">{{ $galeris->links() }}</div>
@endsection
