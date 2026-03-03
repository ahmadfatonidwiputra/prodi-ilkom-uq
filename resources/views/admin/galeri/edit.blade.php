@extends('layouts.admin')

@section('title', 'Edit Galeri')

@section('content')
<h1 class="h3 mb-4">Edit Galeri</h1>
<div class="card border-0 shadow-sm"><div class="card-body">
<form action="{{ route('admin.galeri.update', $galeri) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $galeri->judul) }}" required>
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">URL Gambar</label>
        <input type="text" name="gambar" class="form-control @error('gambar') is-invalid @enderror" value="{{ old('gambar', $galeri->gambar) }}" required>
        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.galeri.index') }}" class="btn btn-outline-secondary">Kembali</a>
</form>
</div></div>
@endsection
