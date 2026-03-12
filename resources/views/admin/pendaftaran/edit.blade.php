@extends('layouts.admin')
@section('title', 'Update Pendaftaran')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h2 class="h4 mb-3">Update Data Pendaftaran</h2>

        <form action="{{ route('admin.pendaftaran.update', $pendaftaran) }}" method="POST" enctype="multipart/form-data" class="row g-3">
            @csrf
            @method('PUT')

            <div class="col-md-6">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pendaftaran->nama_lengkap) }}" class="form-control @error('nama_lengkap') is-invalid @enderror" required>
                @error('nama_lengkap')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email', $pendaftaran->email) }}" class="form-control @error('email') is-invalid @enderror" required>
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">No HP</label>
                <input type="text" name="no_hp" value="{{ old('no_hp', $pendaftaran->no_hp) }}" class="form-control @error('no_hp') is-invalid @enderror" required>
                @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Asal Sekolah</label>
                <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah', $pendaftaran->asal_sekolah) }}" class="form-control @error('asal_sekolah') is-invalid @enderror">
                @error('asal_sekolah')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Pilihan Program Studi</label>
                <input type="text" name="pilihan_program_studi" value="{{ old('pilihan_program_studi', $pendaftaran->pilihan_program_studi) }}" class="form-control @error('pilihan_program_studi') is-invalid @enderror" required>
                @error('pilihan_program_studi')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
                <label class="form-label">Status</label>
                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                    @foreach(['pending','diterima','ditolak'] as $status)
                        <option value="{{ $status }}" @selected(old('status', $pendaftaran->status) === $status)>{{ ucfirst($status) }}</option>
                    @endforeach
                </select>
                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Dokumen (PDF/JPG/PNG)</label>
                @if ($pendaftaran->dokumen_url)
                    <div class="mb-2">
                        <a href="{{ $pendaftaran->dokumen_url }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat Dokumen Saat Ini</a>
                    </div>
                @endif
                <input type="file" name="dokumen" class="form-control @error('dokumen') is-invalid @enderror" accept=".pdf,.jpg,.jpeg,.png">
                <div class="form-text">Kosongkan jika tidak mengganti dokumen.</div>
                @error('dokumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <label class="form-label">Pesan</label>
                <textarea name="pesan" rows="4" class="form-control @error('pesan') is-invalid @enderror">{{ old('pesan', $pendaftaran->pesan) }}</textarea>
                @error('pesan')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
                <button class="btn btn-primary">Update</button>
                <a href="{{ route('admin.pendaftaran.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
