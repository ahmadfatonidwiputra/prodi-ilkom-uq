@extends('layouts.admin')

@section('title', 'Informasi Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2 class="h4 mb-0">Data Mahasiswa</h2><a href="{{ route('admin.mahasiswa.create') }}" class="btn btn-primary">+ Tambah Mahasiswa</a></div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card border-0 shadow-sm bg-white"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Nama</th><th>NIM</th><th>Angkatan</th><th>Status</th><th class="text-end">Aksi</th></tr></thead><tbody>
@forelse($mahasiswas as $item)
<tr>
<td>{{ $item->nama }}<div class="small text-muted">{{ $item->konsentrasi ?: '-' }}</div></td>
<td>{{ $item->nim }}</td>
<td>{{ $item->angkatan }}</td>
<td><span class="badge {{ $item->status_aktif ? 'text-bg-success' : 'text-bg-secondary' }}">{{ $item->status_aktif ? 'Aktif' : 'Nonaktif' }}</span></td>
<td class="text-end"><a href="{{ route('admin.mahasiswa.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a><form action="{{ route('admin.mahasiswa.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td>
</tr>
@empty<tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div></div>
<div class="mt-3">{{ $mahasiswas->links() }}</div>
@endsection
