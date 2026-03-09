@extends('layouts.user')

@section('title', 'Mahasiswa')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 fw-bold mb-3">Mahasiswa Aktif</h1>
        <div class="table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Angkatan</th>
                        <th>Konsentrasi</th>
                        <th>Prestasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($mahasiswas as $item)
                        <tr>
                            <td class="fw-semibold">{{ $item->nama }}</td>
                            <td>{{ $item->nim }}</td>
                            <td>{{ $item->angkatan }}</td>
                            <td>{{ $item->konsentrasi ?: '-' }}</td>
                            <td>{{ $item->prestasi ?: '-' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Data mahasiswa belum tersedia.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $mahasiswas->links() }}
    </div>
</div>
@endsection
