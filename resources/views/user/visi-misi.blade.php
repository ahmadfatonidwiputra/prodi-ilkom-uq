@extends('layouts.user')

@section('title', 'Visi Misi')

@section('content')
<div class="row g-4">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
            <h1 class="h4">Visi</h1>
            <div class="text-muted">{!! nl2br(e($profil->visi ?? 'Visi belum diisi.')) !!}</div>
        </div></div>
    </div>
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm h-100"><div class="card-body p-4">
            <h2 class="h4">Misi</h2>
            <div class="text-muted">{!! nl2br(e($profil->misi ?? 'Misi belum diisi.')) !!}</div>
        </div></div>
    </div>
</div>
@endsection
