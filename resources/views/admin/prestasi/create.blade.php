@extends('layouts.admin')

@section('title', 'Tambah Prestasi Mahasiswa')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h2 class="h4 mb-3">Tambah Prestasi Mahasiswa</h2>
        <form action="{{ route('admin.prestasi.store') }}" method="POST" class="row g-3" enctype="multipart/form-data">
            @csrf
            @include('admin.prestasi.partials.form')
            <div class="col-12">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection

