@extends('layouts.admin')
@section('title', 'Edit Alumni')
@section('content')
<div class="card border-0 shadow-sm"><div class="card-body p-4"><h2 class="h4 mb-3">Edit Alumni</h2><form action="{{ route('admin.alumni.update', $alumni) }}" method="POST" class="row g-3">@csrf @method('PUT') @include('admin.alumni.partials.form', ['data' => $alumni])<div class="col-12"><button class="btn btn-primary">Update</button> <a href="{{ route('admin.alumni.index') }}" class="btn btn-outline-secondary">Kembali</a></div></form></div></div>
@endsection
