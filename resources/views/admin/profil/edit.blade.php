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

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.profil.update') }}" method="POST">
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
            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
