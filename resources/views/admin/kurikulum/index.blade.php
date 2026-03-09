@extends('layouts.admin')

@section('title', 'Kurikulum & Silabus')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Data Kurikulum</h2>
    <a href="{{ route('admin.kurikulum.create') }}" class="btn btn-primary">+ Tambah Mata Kuliah</a>
</div>

@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif

<div class="card border-0 shadow-sm bg-white">
    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead class="table-light">
                <tr><th>Kode</th><th>Mata Kuliah</th><th>Semester</th><th>SKS</th><th>Kategori</th><th class="text-end">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($kurikulums as $item)
                    <tr>
                        <td>{{ $item->kode_mk }}</td>
                        <td>
                            <div class="fw-semibold">{{ $item->nama_mk }}</div>
                            <small class="text-muted">{{ $item->deskripsi }}</small>
                        </td>
                        <td>{{ $item->semester }}</td>
                        <td>{{ $item->sks }}</td>
                        <td>{{ $item->kategori }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.kurikulum.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.kurikulum.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="text-center text-muted">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $kurikulums->links() }}</div>
@endsection
