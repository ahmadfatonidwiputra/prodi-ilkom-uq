@extends('layouts.admin')
@section('title', 'Tambah Alumni')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body p-4"><h2 class="h4 mb-3">Tambah Alumni</h2><form action="{{ route('admin.alumni.store') }}" method="POST" class="row g-3">@csrf @include('admin.alumni.partials.form')<div class="col-12"><button class="btn btn-primary">Simpan</button> <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-secondary">Kembali</a></div></form></div></div>
@endsection
