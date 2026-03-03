@extends('layouts.admin')

@section('title', 'Tambah Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Tambah Pengumuman</h1>
        <p class="text-muted mb-0">Isi form berikut untuk menambahkan pengumuman baru.</p>
    </div>
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul') }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Pengumuman</label>
                <textarea name="isi" id="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
