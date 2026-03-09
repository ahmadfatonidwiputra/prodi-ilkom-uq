@extends('layouts.admin')

@section('title', 'Tambah Kurikulum')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h2 class="h4 mb-3">Tambah Mata Kuliah</h2>
        <form action="{{ route('admin.kurikulum.store') }}" method="POST" class="row g-3">
            @csrf
            @include('admin.kurikulum.partials.form')
            <div class="col-12 d-flex gap-2">
                <button class="btn btn-primary">Simpan</button>
                <a href="{{ route('admin.kurikulum.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
