@extends('layouts.admin')

@section('title', 'Manajemen Pengumuman')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Data Pengumuman</h1>
        <p class="text-muted mb-0">Kelola seluruh pengumuman resmi program studi.</p>
    </div>
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary">+ Tambah Pengumuman</a>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th style="width: 70px;" class="text-center">No</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Tanggal</th>
                        <th>File</th>
                        <th style="width: 170px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pengumumans as $index => $pengumuman)
                        <tr>
                            <td class="text-center">{{ $pengumumans->firstItem() + $index }}</td>
                            <td>{{ $pengumuman->judul }}</td>
                            <td><code>{{ $pengumuman->slug }}</code></td>
                            <td>{{ $pengumuman->tanggal ? \Illuminate\Support\Carbon::parse($pengumuman->tanggal)->format('d-m-Y') : '-' }}</td>
                            <td>
                                @if ($pengumuman->file_url)
                                    <a href="{{ $pengumuman->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">Lihat PDF</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.pengumuman.edit', $pengumuman) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('admin.pengumuman.destroy', $pengumuman) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus pengumuman ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">Belum ada data pengumuman.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $pengumumans->links() }}
</div>
@endsection
