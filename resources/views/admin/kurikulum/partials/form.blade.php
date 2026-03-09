<div class="col-md-4">
    <label class="form-label">Kode MK</label>
    <input type="text" name="kode_mk" value="{{ old('kode_mk', $data->kode_mk ?? '') }}" class="form-control @error('kode_mk') is-invalid @enderror">
    @error('kode_mk') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="col-md-8">
    <label class="form-label">Nama Mata Kuliah</label>
    <input type="text" name="nama_mk" value="{{ old('nama_mk', $data->nama_mk ?? '') }}" class="form-control @error('nama_mk') is-invalid @enderror">
    @error('nama_mk') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="col-md-3">
    <label class="form-label">Semester</label>
    <input type="number" name="semester" min="1" max="14" value="{{ old('semester', $data->semester ?? 1) }}" class="form-control @error('semester') is-invalid @enderror">
    @error('semester') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="col-md-3">
    <label class="form-label">SKS</label>
    <input type="number" name="sks" min="1" max="8" value="{{ old('sks', $data->sks ?? 2) }}" class="form-control @error('sks') is-invalid @enderror">
    @error('sks') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="col-md-6">
    <label class="form-label">Kategori</label>
    <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
        @foreach (['Wajib', 'Pilihan', 'Praktikum'] as $kategori)
            <option value="{{ $kategori }}" @selected(old('kategori', $data->kategori ?? 'Wajib') === $kategori)>{{ $kategori }}</option>
        @endforeach
    </select>
    @error('kategori') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
<div class="col-12">
    <label class="form-label">Deskripsi</label>
    <textarea name="deskripsi" rows="4" class="form-control @error('deskripsi') is-invalid @enderror">{{ old('deskripsi', $data->deskripsi ?? '') }}</textarea>
    @error('deskripsi') <div class="invalid-feedback">{{ $message }}</div> @enderror
</div>
