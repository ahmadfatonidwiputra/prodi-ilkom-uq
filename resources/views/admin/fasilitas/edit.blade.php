@extends('layouts.admin')

@section('title', 'Edit Fasilitas')

@section('content')
<div class="card border-0 shadow-sm"><div class="card-body p-4">
    <h2 class="h4 mb-3">Edit Fasilitas</h2>
    <form action="{{ route('admin.fasilitas.update', $fasilitas) }}" method="POST" class="row g-3">@csrf @method('PUT')
        @include('admin.fasilitas.partials.form', ['data' => $fasilitas])
        <div class="col-12"><button class="btn btn-primary">Update</button> <a href="{{ route('admin.fasilitas.index') }}" class="btn btn-outline-secondary">Kembali</a></div>
    </form>
</div></div>
@endsection
