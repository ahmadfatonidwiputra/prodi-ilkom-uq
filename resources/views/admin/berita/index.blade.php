@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Data Berita</h1>
    <a href="{{ route('admin.berita.create') }}" class="btn btn-primary">+ Tambah Berita</a>
</div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card border-0 shadow-sm"><div class="card-body p-0"><div class="table-responsive">
<table class="table table-hover mb-0 align-middle">
    <thead class="table-primary"><tr><th>Judul</th><th>Slug</th><th>Tanggal</th><th class="text-center">Aksi</th></tr></thead>
    <tbody>
    @forelse($beritas as $berita)
        <tr>
            <td>{{ $berita->judul }}</td>
            <td><code>{{ $berita->slug }}</code></td>
            <td>{{ $berita->created_at?->format('d-m-Y') }}</td>
            <td class="text-center">
                <a href="{{ route('admin.berita.edit', $berita) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus berita ini?')">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </td>
        </tr>
    @empty
        <tr><td colspan="4" class="text-center py-4">Belum ada berita.</td></tr>
    @endforelse
    </tbody>
</table>
</div></div></div>
<div class="mt-3">{{ $beritas->links() }}</div>
@endsection
