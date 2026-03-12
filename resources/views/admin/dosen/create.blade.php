@extends('layouts.admin')

@section('title', 'Tambah Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Tambah Dosen</h1>
        <p class="text-muted mb-0">Isi form berikut untuk menambahkan data dosen baru.</p>
    </div>
    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.dosen.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nidn" class="form-label">NIDN</label>
                <input type="text" name="nidn" id="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn') }}" required>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan') }}" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
                <select name="jabatan_fungsional" id="jabatan_fungsional" class="form-select @error('jabatan_fungsional') is-invalid @enderror" required>
                    <option value="">-- Pilih Jabatan Fungsional --</option>
                    <option value="Asisten Ahli" {{ old('jabatan_fungsional') === 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                    <option value="Lektor" {{ old('jabatan_fungsional') === 'Lektor' ? 'selected' : '' }}>Lektor</option>
                    <option value="Lektor Kepala" {{ old('jabatan_fungsional') === 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
                    <option value="Guru Besar" {{ old('jabatan_fungsional') === 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
                </select>
                @error('jabatan_fungsional')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="bidang_keahlian" class="form-label">Bidang Keahlian</label>
                <input type="text" name="bidang_keahlian" id="bidang_keahlian" class="form-control @error('bidang_keahlian') is-invalid @enderror" value="{{ old('bidang_keahlian') }}" required>
                @error('bidang_keahlian')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Dosen</label>
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                <div class="form-text">Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</div>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>
@endsection
