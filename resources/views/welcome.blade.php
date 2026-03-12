@extends('layouts.app')

@section('title', 'Beranda Prodi D4 Teknologi Rekayasa Perangkat Lunak')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h1 class="h3 mb-3">Selamat Datang di Website Prodi D4 Teknologi Rekayasa Perangkat Lunak</h1>
                <p class="text-muted mb-4">Gunakan menu navigasi untuk menjelajahi profil, dosen, kurikulum, fasilitas, dan pendaftaran program studi.</p>
                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('profil') }}" class="btn btn-outline-primary">Profil</a>
                    <a href="{{ route('visi-misi') }}" class="btn btn-outline-primary">Visi & Misi</a>
                    <a href="{{ route('dosen') }}" class="btn btn-outline-primary">Dosen</a>
                    <a href="{{ route('kurikulum') }}" class="btn btn-outline-primary">Kurikulum</a>
                    <a href="{{ route('fasilitas') }}" class="btn btn-outline-primary">Fasilitas</a>
                    <a href="{{ route('pendaftaran') }}" class="btn btn-outline-primary">Pendaftaran</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h5 mb-3">Akses Admin</h2>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary w-100 mb-2">Masuk Dashboard Admin</a>
                    <a href="{{ route('admin.dosen.index') }}" class="btn btn-outline-secondary w-100 mb-2">Kelola Dosen</a>
                    <a href="{{ route('admin.kurikulum.index') }}" class="btn btn-outline-secondary w-100 mb-2">Kelola Kurikulum</a>
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-secondary w-100">Kelola Prestasi</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary w-100">Login Admin</a>
                @endauth
            </div>
        </div>
    </div>
</div>
@endsection
