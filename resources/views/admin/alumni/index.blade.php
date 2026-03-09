@extends('layouts.admin')
@section('title', 'Database Alumni')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3"><h2 class="h4 mb-0">Data Alumni</h2><a href="{{ route('admin.alumni.create') }}" class="btn btn-primary">+ Tambah Alumni</a></div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card border-0 shadow-sm bg-white"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Nama</th><th>Lulus</th><th>Pekerjaan</th><th>Perusahaan</th><th class="text-end">Aksi</th></tr></thead><tbody>
@forelse($alumnis as $item)
<tr><td>{{ $item->nama }}</td><td>{{ $item->angkatan_lulus }}</td><td>{{ $item->pekerjaan ?: '-' }}</td><td>{{ $item->perusahaan ?: '-' }}</td><td class="text-end"><a href="{{ route('admin.alumni.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a><form action="{{ route('admin.alumni.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td></tr>
@empty<tr><td colspan="5" class="text-center text-muted">Belum ada data.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $alumnis->links() }}</div>
@endsection
