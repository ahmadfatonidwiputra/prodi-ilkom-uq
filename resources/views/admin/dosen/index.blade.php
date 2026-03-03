@extends('layouts.admin')

@section('title', 'Manajemen Dosen')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">Data Dosen</h1>
        <p class="text-muted mb-0">Kelola data dosen Program Studi Ilmu Komputer.</p>
    </div>
    <a href="{{ route('admin.dosen.create') }}" class="btn btn-primary">+ Tambah Dosen</a>
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
                        <th class="text-center" style="width: 70px;">No</th>
                        <th style="width: 90px;">Foto</th>
                        <th>Nama</th>
                        <th>NIDN</th>
                        <th>Jabatan</th>
                        <th>Jabatan Fungsional</th>
                        <th class="text-center" style="width: 170px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($dosens as $index => $dosen)
                        <tr>
                            <td class="text-center">{{ $dosens->firstItem() + $index }}</td>
                            <td>
                                @if ($dosen->foto)
                                    <img src="{{ asset('storage/' . $dosen->foto) }}" alt="{{ $dosen->nama }}" class="rounded" style="width: 56px; height: 56px; object-fit: cover;">
                                @else
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center text-muted" style="width: 56px; height: 56px;">
                                        -
                                    </div>
                                @endif
                            </td>
                            <td class="fw-semibold">{{ $dosen->nama }}</td>
                            <td>{{ $dosen->nidn }}</td>
                            <td>{{ $dosen->jabatan }}</td>
                            <td>{{ $dosen->jabatan_fungsional }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.dosen.edit', $dosen) }}" class="btn btn-sm btn-warning me-1">Edit</a>
                                <form action="{{ route('admin.dosen.destroy', $dosen) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin hapus data dosen ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4 text-muted">Data dosen belum tersedia.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-3">
    {{ $dosens->links() }}
</div>
@endsection
