@extends('layouts.admin')

@section('title', $config['title'])

@if (($config['allow_body'] ?? false) && (($config['rich_text'] ?? false) === true))
    @push('styles')
        <style>
            .editor-toolbar {
                display: flex;
                flex-wrap: wrap;
                gap: .35rem;
                padding: .65rem;
                border: 1px solid #d1d5db;
                border-bottom: 0;
                border-radius: .75rem .75rem 0 0;
                background: #f8fafc;
            }

            .editor-toolbar .btn {
                min-width: 40px;
                padding: .2rem .5rem;
            }

            #body-editor {
                min-height: 320px;
                border: 1px solid #d1d5db;
                border-top: 0;
                border-radius: 0 0 .75rem .75rem;
                padding: .9rem;
                background: #fff;
                line-height: 1.65;
                outline: none;
            }

            #body-editor:focus {
                border-color: #86b7fe;
                box-shadow: 0 0 0 .15rem rgba(13, 110, 253, .15);
            }
        </style>
    @endpush
@endif

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
                    @if (($config['rich_text'] ?? false) === true)
                        <div class="@error('body') border border-danger rounded-3 @enderror">
                            <div class="editor-toolbar" id="body-toolbar">
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="bold"><strong>B</strong></button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="italic"><em>I</em></button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="underline"><u>U</u></button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="insertOrderedList">1.</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="insertUnorderedList">&bull;</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-link>Link</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-block="H2">H2</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-block="H3">H3</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-block="BLOCKQUOTE">Quote</button>
                                <button class="btn btn-sm btn-outline-secondary" type="button" data-editor-cmd="removeFormat">Clear</button>
                            </div>
                            <div id="body-editor" contenteditable="true"></div>
                        </div>
                        <textarea id="body" name="body" class="d-none">{{ old('body', $content->body) }}</textarea>
                        <script type="application/json" id="body-initial">@json(old('body', $content->body))</script>
                    @else
                        <textarea id="body" name="body" rows="8" class="form-control @error('body') is-invalid @enderror">{{ old('body', $content->body) }}</textarea>
                    @endif
                    @if (($config['rich_text'] ?? false) === true)
                        <small class="text-muted d-block mt-2">
                            Anda dapat menggunakan format teks seperti numbering, bold, italic, hyperlink, dan heading.
                        </small>
                    @endif
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

@if (($config['allow_body'] ?? false) && (($config['rich_text'] ?? false) === true))
    @push('scripts')
        <script>
            (function () {
                const editor = document.getElementById('body-editor');
                const field = document.getElementById('body');
                const form = field ? field.closest('form') : null;
                const initialDataEl = document.getElementById('body-initial');
                const commandButtons = document.querySelectorAll('[data-editor-cmd]');
                const blockButtons = document.querySelectorAll('[data-editor-block]');
                const linkButton = document.querySelector('[data-editor-link]');
                let savedRange = null;

                if (!editor || !field) {
                    return;
                }

                const saveSelection = () => {
                    const selection = window.getSelection();
                    if (!selection || selection.rangeCount === 0) {
                        return;
                    }

                    const range = selection.getRangeAt(0);
                    if (editor.contains(range.commonAncestorContainer)) {
                        savedRange = range.cloneRange();
                    }
                };

                const restoreSelection = () => {
                    if (!savedRange) {
                        return;
                    }
                    const selection = window.getSelection();
                    if (!selection) {
                        return;
                    }
                    selection.removeAllRanges();
                    selection.addRange(savedRange);
                };

                const syncToTextarea = () => {
                    const html = editor.innerHTML.trim();
                    field.value = html === '<br>' ? '' : html;
                };

                const applyCommand = (command, value = null) => {
                    editor.focus();
                    restoreSelection();
                    document.execCommand(command, false, value);
                    saveSelection();
                    syncToTextarea();
                };

                if (initialDataEl) {
                    try {
                        const initialHtml = JSON.parse(initialDataEl.textContent || '""') || '';
                        editor.innerHTML = initialHtml !== '' ? initialHtml : '<p><br></p>';
                    } catch (error) {
                        editor.innerHTML = '<p><br></p>';
                    }
                }

                commandButtons.forEach((button) => {
                    button.addEventListener('mousedown', (event) => {
                        event.preventDefault();
                        const command = button.getAttribute('data-editor-cmd');
                        if (command === 'removeFormat') {
                            applyCommand('removeFormat');
                            applyCommand('unlink');
                            return;
                        }
                        applyCommand(command);
                    });
                });

                blockButtons.forEach((button) => {
                    button.addEventListener('mousedown', (event) => {
                        event.preventDefault();
                        const block = button.getAttribute('data-editor-block');
                        applyCommand('formatBlock', block);
                    });
                });

                if (linkButton) {
                    linkButton.addEventListener('mousedown', (event) => {
                        event.preventDefault();
                        editor.focus();
                        restoreSelection();
                        const url = window.prompt('Masukkan URL (contoh: https://unbim.ac.id)');
                        if (url && url.trim() !== '') {
                            applyCommand('createLink', url.trim());
                        }
                    });
                }

                editor.addEventListener('mouseup', saveSelection);
                editor.addEventListener('keyup', saveSelection);
                editor.addEventListener('focus', saveSelection);
                editor.addEventListener('input', syncToTextarea);
                if (form) {
                    form.addEventListener('submit', syncToTextarea);
                }

                syncToTextarea();
            })();
        </script>
    @endpush
@endif
