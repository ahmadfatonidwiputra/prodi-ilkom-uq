@extends('layouts.user')

@section('title', 'Kurikulum')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <h1 class="h3 fw-bold mb-0">Mata Kuliah Program Studi</h1>
            <div class="d-flex gap-2">
                <a href="{{ route('kurikulum.rps') }}" class="btn btn-outline-primary btn-sm">RPS</a>
                <a href="{{ route('kurikulum.jadwal-kuliah') }}" class="btn btn-outline-primary btn-sm">Jadwal Kuliah</a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-middle table-hover">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Mata Kuliah</th>
                        <th>Semester</th>
                        <th>SKS</th>
                        <th>Kategori</th>
                    </tr>
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
                            <td><span class="badge text-bg-primary">{{ $item->kategori }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted">Data kurikulum belum tersedia.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $kurikulums->links() }}
    </div>
</div>
@endsection
