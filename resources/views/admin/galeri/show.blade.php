@extends('layouts.admin')

@section('title', 'Detail Galeri')

@section('content')
<div class="card border-0 shadow-sm">
    <img src="{{ $galeri->gambar }}" class="card-img-top" alt="{{ $galeri->judul }}" style="max-height: 480px; object-fit: cover;">
    <div class="card-body">
        <h1 class="h4">{{ $galeri->judul }}</h1>
        <a href="{{ route('admin.galeri.edit', $galeri) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Kembali</a>
    </div>
</div>
@endsection
