@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<h1 class="h3 mb-4">Tambah Berita</h1>
<div class="card border-0 shadow-sm"><div class="card-body">
<form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Isi</label>
        <textarea name="isi" rows="7" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Gambar (opsional)</label>
        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
        <div class="form-text">Format: JPG, JPEG, PNG, WEBP. Maksimal 4MB.</div>
        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Simpan</button>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Kembali</a>
</form>
</div></div>
@endsection
