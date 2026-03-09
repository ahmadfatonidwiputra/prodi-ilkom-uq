@extends('layouts.admin')

@section('title', 'Fasilitas & Lab')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Data Fasilitas</h2>
    <a href="{{ route('admin.fasilitas.create') }}" class="btn btn-primary">+ Tambah Fasilitas</a>
</div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card border-0 shadow-sm bg-white">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light"><tr><th>Nama</th><th>Icon</th><th>Urutan</th><th>Deskripsi</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($fasilitas as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->nama }}</td>
                        <td><code>{{ $item->ikon ?: 'bi-building' }}</code></td>
                        <td>{{ $item->urutan }}</td>
                        <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 80) }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.fasilitas.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.fasilitas.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $fasilitas->links() }}</div>
@endsection
