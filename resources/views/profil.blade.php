@extends('layouts.app')

@section('title', 'Profil Prodi D4 Teknologi Rekayasa Perangkat Lunak')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 mb-3">Profil Program Studi D4 Teknologi Rekayasa Perangkat Lunak</h1>
        <div class="text-muted">{!! nl2br(e($profil->tentang ?? 'Profil program studi belum diisi.')) !!}</div>
    </div>
</div>
@endsection
