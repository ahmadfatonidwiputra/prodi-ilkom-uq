@extends('layouts.admin')

@section('title', 'Edit Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Edit Pengumuman</h1>
        <p class="text-muted mb-0">Perbarui data pengumuman.</p>
    </div>
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.pengumuman.update', $pengumuman) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input type="text" name="judul" id="judul" class="form-control @error('judul') is-invalid @enderror" value="{{ old('judul', $pengumuman->judul) }}" required>
                @error('judul')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control @error('tanggal') is-invalid @enderror" value="{{ old('tanggal', $pengumuman->tanggal ? \Illuminate\Support\Carbon::parse($pengumuman->tanggal)->format('Y-m-d') : '') }}" required>
                @error('tanggal')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label">Isi Pengumuman</label>
                <textarea name="isi" id="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                @error('isi')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="file_path" class="form-label">File Pengumuman (PDF, opsional)</label>
                @if ($pengumuman->file_url)
                    <div class="mb-2">
                        <a href="{{ $pengumuman->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat File Saat Ini</a>
                    </div>
                @endif
                <input type="file" name="file_path" id="file_path" class="form-control @error('file_path') is-invalid @enderror" accept=".pdf">
                <div class="form-text">Kosongkan jika tidak mengganti file.</div>
                @error('file_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
