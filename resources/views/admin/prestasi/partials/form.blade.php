<div class="col-md-6">
    <label class="form-label">Judul Prestasi</label>
    <input type="text" name="judul_prestasi" value="{{ old('judul_prestasi', $prestasi->judul_prestasi ?? '') }}" class="form-control @error('judul_prestasi') is-invalid @enderror" required>
    @error('judul_prestasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-6">
    <label class="form-label">Nama Mahasiswa</label>
    <input type="text" name="nama_mahasiswa" value="{{ old('nama_mahasiswa', $prestasi->nama_mahasiswa ?? '') }}" class="form-control @error('nama_mahasiswa') is-invalid @enderror" required>
    @error('nama_mahasiswa')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-md-4">
    <label class="form-label">Tahun</label>
    <input type="number" name="tahun" value="{{ old('tahun', $prestasi->tahun ?? date('Y')) }}" class="form-control @error('tahun') is-invalid @enderror" required>
    @error('tahun')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $prestasi->deskripsi ?? '') }}</textarea>
    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="col-12">
    <label class="form-label">Gambar Dokumentasi</label>
    @if (!empty($prestasi?->gambar_url))
        <div class="mb-2">
            <img src="{{ $prestasi->gambar_url }}" alt="{{ $prestasi->judul_prestasi }}" class="rounded border" style="width: 140px; height: 90px; object-fit: cover;">
        </div>
    @endif
    <input type="file" name="gambar" class="form-control @error('gambar') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
    @error('gambar')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
