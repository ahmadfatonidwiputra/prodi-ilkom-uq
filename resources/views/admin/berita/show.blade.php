@extends('layouts.admin')

@section('title', 'Detail Berita')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body">
        <h1 class="h3">{{ $berita->judul }}</h1>
        <p class="text-muted"><code>{{ $berita->slug }}</code></p>
        <div>{!! nl2br(e($berita->isi)) !!}</div>
        <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-warning mt-3">Edit</a>
        <a href="{{ route('admin.berita.index') }}" class="btn btn-outline-secondary mt-3">Kembali</a>
    </div>
</div>
@endsection
