@extends('layouts.user')

@section('title', 'Pendaftaran Mahasiswa Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 p-lg-5">
                <h1 class="h3 fw-bold mb-2">Formulir Pendaftaran</h1>
                <p class="text-muted mb-4">Isi data berikut untuk mendaftar Program Studi D4 Rekayasa Perangkat Lunak.</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form action="{{ route('pendaftaran.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" class="form-control @error('nama_lengkap') is-invalid @enderror">
                        @error('nama_lengkap') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">No. HP</label>
                        <input type="text" name="no_hp" value="{{ old('no_hp') }}" class="form-control @error('no_hp') is-invalid @enderror">
                        @error('no_hp') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Asal Sekolah</label>
                        <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" class="form-control @error('asal_sekolah') is-invalid @enderror">
                        @error('asal_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label">Pesan</label>
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
