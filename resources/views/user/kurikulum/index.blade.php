@extends('layouts.user')

@section('title', 'Kurikulum')

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <h1 class="h3 fw-bold mb-3">Kurikulum Program Studi</h1>
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
