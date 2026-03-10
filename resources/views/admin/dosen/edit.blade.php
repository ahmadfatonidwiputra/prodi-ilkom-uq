@extends('layouts.admin')

@section('title', 'Edit Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Edit Dosen</h1>
        <p class="text-muted mb-0">Perbarui data dosen berikut.</p>
    </div>
    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.dosen.update', $dosen) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control @error('nama') is-invalid @enderror" value="{{ old('nama', $dosen->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nidn" class="form-label">NIDN</label>
                <input type="text" name="nidn" id="nidn" class="form-control @error('nidn') is-invalid @enderror" value="{{ old('nidn', $dosen->nidn) }}" required>
                @error('nidn')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan" class="form-label">Jabatan</label>
                <input type="text" name="jabatan" id="jabatan" class="form-control @error('jabatan') is-invalid @enderror" value="{{ old('jabatan', $dosen->jabatan) }}" required>
                @error('jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="jabatan_fungsional" class="form-label">Jabatan Fungsional</label>
                <select name="jabatan_fungsional" id="jabatan_fungsional" class="form-select @error('jabatan_fungsional') is-invalid @enderror" required>
                    <option value="">-- Pilih Jabatan Fungsional --</option>
                    <option value="Asisten Ahli" {{ old('jabatan_fungsional', $dosen->jabatan_fungsional) === 'Asisten Ahli' ? 'selected' : '' }}>Asisten Ahli</option>
                    <option value="Lektor" {{ old('jabatan_fungsional', $dosen->jabatan_fungsional) === 'Lektor' ? 'selected' : '' }}>Lektor</option>
                    <option value="Lektor Kepala" {{ old('jabatan_fungsional', $dosen->jabatan_fungsional) === 'Lektor Kepala' ? 'selected' : '' }}>Lektor Kepala</option>
                    <option value="Guru Besar" {{ old('jabatan_fungsional', $dosen->jabatan_fungsional) === 'Guru Besar' ? 'selected' : '' }}>Guru Besar</option>
                </select>
                @error('jabatan_fungsional')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label">Foto Dosen</label>
                @if ($dosen->foto)
                    <div class="mb-2">
                        <img src="{{ Storage::url($dosen->foto) }}" alt="{{ $dosen->nama }}" class="rounded border" style="width: 90px; height: 90px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="foto" id="foto" class="form-control @error('foto') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                <div class="form-text">Kosongkan jika tidak ingin mengganti foto.</div>
                @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
