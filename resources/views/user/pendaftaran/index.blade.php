@extends('layouts.user')

@section('title', 'Pendaftaran Mahasiswa Baru')

@section('content')
<div class="row g-4 justify-content-center">
    @if ($banner?->image_url)
        <div class="col-12">
            <div class="card border-0 shadow-sm overflow-hidden">
                <img src="{{ $banner->image_url }}" alt="Banner Pendaftaran" class="img-fluid" style="max-height: 360px; object-fit: cover; width: 100%;">
            </div>
        </div>
    @endif

    <div class="col-lg-9">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">
                <h1 class="h3 fw-bold mb-2">Formulir Pendaftaran</h1>
                <p class="text-muted mb-4">Lengkapi data berikut untuk pendaftaran Program Studi D4 Teknologi Rekayasa Perangkat Lunak.</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data" class="row g-3">
                    @csrf

                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control @error('nama_lengkap') is-invalid @enderror" required>
                        @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" required>
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror" required>
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="form-control @error('asal_sekolah') is-invalid @enderror">
                        @error('asal_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Pilihan Program Studi</label>
                        <select name="pilihan_program_studi" class="form-select @error('pilihan_program_studi') is-invalid @enderror" required>
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="D4 Teknologi Rekayasa Perangkat Lunak" @selected(old('pilihan_program_studi') === 'D4 Teknologi Rekayasa Perangkat Lunak')>D4 Teknologi Rekayasa Perangkat Lunak</option>
                        </select>
                        @error('pilihan_program_studi') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Upload Dokumen (Opsional)</label>
                        <input type="file" name="dokumen" class="form-control @error('dokumen') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                        <div class="form-text">Format: PDF/JPG/PNG. Maksimal 10MB.</div>
                        @error('dokumen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">Pesan (Opsional)</label>
                        <textarea name="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror">{{ old('pesan') }}</textarea>
                        @error('pesan') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="col-12 d-grid">
                        <button type="submit" class="btn btn-primary btn-lg">Kirim Pendaftaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
