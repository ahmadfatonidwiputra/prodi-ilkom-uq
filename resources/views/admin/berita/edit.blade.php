@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<h1 class="h3 mb-4">Edit Berita</h1>
<div class="card border-0 shadow-sm"><div class="card-body">
<form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Judul</label>
        <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $berita->judul) }}" required>
        @error('judul') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Isi</label>
        <textarea name="isi" rows="7" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi', $berita->isi) }}</textarea>
        @error('isi') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Gambar (opsional)</label>
        @if ($berita->gambar_url)
            <div class="mb-2">
                <img src="{{ $berita->gambar_url }}" alt="{{ $berita->judul }}" class="rounded border" style="width: 140px; height: 90px; object-fit: cover;">
            </div>
        @endif
        <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
        <div class="form-text">Kosongkan jika tidak mengganti gambar.</div>
        @error('gambar') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>
    <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary">Kembali</a>
</form>
</div></div>
@endsection
