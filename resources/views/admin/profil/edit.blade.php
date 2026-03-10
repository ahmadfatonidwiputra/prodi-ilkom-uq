@extends('layouts.admin')

@section('title', 'Edit Profil Prodi')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Edit Profil Prodi</h1>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

@unless ($hasSertifikatColumn)
    <div class="alert alert-warning">
        Kolom <code>sertifikat_akreditasi</code> belum tersedia di database. Jalankan <code>php artisan migrate</code> agar upload sertifikat aktif.
    </div>
@endunless

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label" for="tentang">Tentang</label>
                <textarea name="tentang" id="tentang" rows="4" class="form-control @error('tentang') is-invalid @enderror" required>{{ old('tentang', $profil->tentang) }}</textarea>
                @error('tentang') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="visi">Visi</label>
                <textarea name="visi" id="visi" rows="4" class="form-control @error('visi') is-invalid @enderror" required>{{ old('visi', $profil->visi) }}</textarea>
                @error('visi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="misi">Misi</label>
                <textarea name="misi" id="misi" rows="5" class="form-control @error('misi') is-invalid @enderror" required>{{ old('misi', $profil->misi) }}</textarea>
                @error('misi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="sertifikat_akreditasi">Gambar Sertifikat Akreditasi Terbaru</label>
                <input type="file" name="sertifikat_akreditasi" id="sertifikat_akreditasi" class="form-control @error('sertifikat_akreditasi') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp" @disabled(!$hasSertifikatColumn)>
                @error('sertifikat_akreditasi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                @if ($profil->sertifikat_akreditasi)
                    <div class="mt-3">
                        <p class="small text-muted mb-2">Gambar saat ini:</p>
                        <img src="{{ Storage::url($profil->sertifikat_akreditasi) }}" alt="Sertifikat Akreditasi" class="img-fluid rounded border" style="max-height: 260px;">
                    </div>
                @endif
            </div>
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
