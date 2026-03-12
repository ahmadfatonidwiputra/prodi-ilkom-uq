@extends('layouts.admin')

@section('title', 'Prestasi Mahasiswa')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Data Prestasi Mahasiswa</h2>
    <a href="{{ route('admin.prestasi.create') }}" class="btn btn-primary">+ Tambah Prestasi</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm bg-white">
    <div class="table-responsive">
        <table class="table align-middle mb-0">
            <thead class="table-light">
                <tr>
                    <th>Judul Prestasi</th>
                    <th>Mahasiswa</th>
                    <th>Tahun</th>
                    <th>Dokumentasi</th>
                    <th class="text-end">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($prestasis as $item)
                    <tr>
                        <td class="fw-semibold">{{ $item->judul_prestasi }}</td>
                        <td>{{ $item->nama_mahasiswa }}</td>
                        <td>{{ $item->tahun }}</td>
                        <td>
                            @if ($item->gambar_url)
                                <img src="{{ $item->gambar_url }}" alt="{{ $item->judul_prestasi }}" class="rounded border" style="width: 72px; height: 48px; object-fit: cover;">
                            @else
                                <span class="text-muted small">-</span>
                            @endif
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.prestasi.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.prestasi.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-center text-muted">Belum ada data prestasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div class="mt-3">{{ $prestasis->links() }}</div>
@endsection
