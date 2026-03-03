@extends('layouts.user')

@section('title', 'Beranda Prodi Ilmu Komputer')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h2 class="h4 mb-3">Selamat Datang</h2>
                <p class="text-muted">Website resmi Program Studi Ilmu Komputer Universitas Qamarul Huda Badaruddin Bagu.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">
                <h3 class="h6 text-uppercase text-muted">Akses Cepat</h3>
                <div class="d-grid gap-2">
                    <a href="{{ route('dosen') }}" class="btn btn-outline-primary">Data Dosen</a>
                    <a href="{{ route('berita') }}" class="btn btn-outline-primary">Berita</a>
                    <a href="{{ route('pengumuman') }}" class="btn btn-outline-primary">Pengumuman</a>
                    <a href="{{ route('galeri') }}" class="btn btn-outline-primary">Galeri</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
