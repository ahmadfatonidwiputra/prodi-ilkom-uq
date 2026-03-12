@extends('layouts.admin')

@section('title', $config['title'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h4 mb-1">{{ $config['title'] }}</h1>
        <p class="text-muted mb-0">Kelola konten halaman ini dari panel admin.</p>
    </div>
    <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-secondary">Kembali</a>
</div>

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm">
    <div class="card-body">
        <form action="{{ route('admin.site-content.update', $section) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label" for="title">Judul Halaman</label>
                <input type="text" id="title" name="title" value="{{ old('title', $content->title) }}" class="form-control @error('title') is-invalid @enderror" required>
                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            @if ($config['allow_body'])
                <div class="mb-3">
                    <label class="form-label" for="body">Konten</label>
                    <textarea id="body" name="body" rows="8" class="form-control @error('body') is-invalid @enderror">{{ old('body', $content->body) }}</textarea>
                    @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>
            @endif

            @if ($config['allow_image'])
                <div class="mb-3">
                    <label class="form-label" for="image_path">Upload Gambar</label>
                    <input type="file" id="image_path" name="image_path" class="form-control @error('image_path') is-invalid @enderror" accept=".jpg,.jpeg,.png,.webp">
                    @error('image_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if ($content->image_path)
                        <div class="mt-3">
                            <img src="{{ $content->image_url }}" alt="{{ $content->title }}" class="img-fluid rounded border" style="max-height: 260px;">
                        </div>
                    @endif
                </div>
            @endif

            @if ($config['allow_file'])
                <div class="mb-3">
                    <label class="form-label" for="file_path">Upload Dokumen</label>
                    <input type="file" id="file_path" name="file_path" class="form-control @error('file_path') is-invalid @enderror" accept=".pdf,.doc,.docx">
                    @error('file_path')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    @if ($content->file_path)
                        <div class="mt-2">
                            <a href="{{ $content->file_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                Lihat Dokumen Saat Ini
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
