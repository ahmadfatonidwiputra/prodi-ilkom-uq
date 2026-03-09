@extends('layouts.admin')
@section('title', 'Pendaftaran Masuk')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Data Pendaftaran</h2>
    <a href="{{ route('admin.pendaftaran.export') }}" class="btn btn-success">
        <i class="bi bi-download me-1"></i> Export CSV
    </a>
</div>
@if (session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
<div class="card border-0 shadow-sm bg-white"><div class="table-responsive"><table class="table align-middle mb-0"><thead class="table-light"><tr><th>Nama</th><th>Email</th><th>No HP</th><th>Asal Sekolah</th><th>Status</th><th class="text-end">Aksi</th></tr></thead><tbody>
@forelse($pendaftarans as $item)
<tr>
<td>{{ $item->nama_lengkap }}</td>
<td>{{ $item->email }}</td>
<td>{{ $item->no_hp }}</td>
<td>{{ $item->asal_sekolah ?: '-' }}</td>
<td><span class="badge {{ $item->status === 'pending' ? 'text-bg-warning' : ($item->status === 'diterima' ? 'text-bg-success' : 'text-bg-danger') }}">{{ ucfirst($item->status) }}</span></td>
<td class="text-end"><a href="{{ route('admin.pendaftaran.edit', $item) }}" class="btn btn-sm btn-warning">Update Status</a><form action="{{ route('admin.pendaftaran.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">@csrf @method('DELETE')<button class="btn btn-sm btn-danger">Hapus</button></form></td>
</tr>
@empty<tr><td colspan="6" class="text-center text-muted">Belum ada pendaftaran.</td></tr>@endforelse
</tbody></table></div></div><div class="mt-3">{{ $pendaftarans->links() }}</div>
@endsection
