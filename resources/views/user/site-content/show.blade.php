@extends('layouts.user')

@section('title', $config['title'])

@push('styles')
    <style>
        .rich-content p {
            margin-bottom: 1rem;
        }

        .rich-content ol,
        .rich-content ul {
            padding-left: 1.2rem;
            margin-bottom: 1rem;
        }

        .rich-content a {
            color: #5f2ecf;
            text-decoration: underline;
            font-weight: 600;
        }

        .rich-content strong,
        .rich-content b {
            color: #111827;
        }
    </style>
@endpush

@section('content')
<div class="card border-0 shadow-sm">
    <div class="card-body p-4 p-lg-5">
        <h1 class="h3 fw-bold mb-3">{{ $content?->title ?? $config['title'] }}</h1>

        @if (!empty($content?->image_url))
            <img src="{{ $content->image_url }}" alt="{{ $content?->title ?? $config['title'] }}" class="img-fluid rounded border mb-4">
        @endif

        <div class="text-muted mb-4 rich-content">
            @if (!empty($content?->body))
                {!! $content->body !!}
            @else
                Konten belum tersedia.
            @endif
        </div>

        @if (!empty($content?->file_url))
            <a href="{{ $content->file_url }}" target="_blank" class="btn btn-primary">
                <i class="bi bi-download me-1"></i> Unduh Dokumen
            </a>
        @endif
    </div>
</div>
@endsection
