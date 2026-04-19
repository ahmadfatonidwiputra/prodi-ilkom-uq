@extends('layouts.user')

@section('title', 'Pendaftaran Mahasiswa Baru')

@section('content')
<section class="section">
    <div class="container">
        
        <div class="section-head" style="margin-left: auto; margin-right: auto; text-align: center;">
            <p class="eyebrow mb-2">Pendaftaran D4 TRPL</p>
            <h2>Formulir Pendaftaran</h2>
            <p style="margin-left: auto; margin-right: auto;">Lengkapi data berikut untuk mendaftar sebagai mahasiswa baru di Program Studi D4 Teknologi Rekayasa Perangkat Lunak UNBIM.</p>
        </div>

        @if (session('success'))
            <div style="background: var(--accent-mint); color: var(--ink); padding: 16px 20px; border-radius: var(--r-md); margin-bottom: 32px; font-weight: 500; text-align: center;">
                {{ session('success') }}
            </div>
        @endif

        <div style="max-width: 800px; margin: 0 auto;">
            @if (isset($banner) && $banner?->image_url)
                <div class="card" style="padding: 0; overflow: hidden; margin-bottom: 32px; border: none;">
                    <img src="{{ $banner->image_url }}" alt="Banner Pendaftaran" style="max-height: 360px; object-fit: cover; width: 100%; display: block;">
                </div>
            @endif

            <div class="card card-pad-lg">
                <form action="{{ route('pendaftaran.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="form-grid" style="margin-bottom: 24px;">
                        <div class="field">
                            <label>Nama Lengkap <span style="color: red;">*</span></label>
                            <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required style="{{ $errors->has('nama_lengkap') ? 'border-color: red;' : '' }}">
                            @error('nama_lengkap') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label>Email <span style="color: red;">*</span></label>
                            <input type="email" name="email" value="{{ old('email') }}" required style="{{ $errors->has('email') ? 'border-color: red;' : '' }}">
                            @error('email') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                        </div>
                        
                        <div class="field">
                            <label>Nomor HP / WhatsApp <span style="color: red;">*</span></label>
                            <input type="text" name="no_hp" value="{{ old('no_hp') }}" required style="{{ $errors->has('no_hp') ? 'border-color: red;' : '' }}">
                            @error('no_hp') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                        </div>

                        <div class="field">
                            <label>Asal Sekolah</label>
                            <input type="text" name="asal_sekolah" value="{{ old('asal_sekolah') }}" style="{{ $errors->has('asal_sekolah') ? 'border-color: red;' : '' }}">
                            @error('asal_sekolah') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="field" style="margin-bottom: 24px;">
                        <label>Pilihan Program Studi <span style="color: red;">*</span></label>
                        <select name="pilihan_program_studi" required style="{{ $errors->has('pilihan_program_studi') ? 'border-color: red;' : '' }}">
                            <option value="">-- Pilih Program Studi --</option>
                            <option value="D4 Teknologi Rekayasa Perangkat Lunak" @selected(old('pilihan_program_studi') === 'D4 Teknologi Rekayasa Perangkat Lunak')>D4 Teknologi Rekayasa Perangkat Lunak</option>
                        </select>
                        @error('pilihan_program_studi') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="field" style="margin-bottom: 24px;">
                        <label>Upload Dokumen Pendukung (Opsional)</label>
                        <input type="file" name="dokumen" accept=".pdf,.jpg,.jpeg,.png" style="{{ $errors->has('dokumen') ? 'border-color: red;' : '' }}">
                        <div class="hint">Format: PDF/JPG/PNG. Maksimal 10MB.</div>
                        @error('dokumen') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                    </div>

                    <div class="field" style="margin-bottom: 32px;">
                        <label>Pesan / Keterangan (Opsional)</label>
                        <textarea name="pesan" rows="4" style="resize: vertical; {{ $errors->has('pesan') ? 'border-color: red;' : '' }}">{{ old('pesan') }}</textarea>
                        @error('pesan') <div class="hint" style="color: red;">{{ $message }}</div> @enderror
                    </div>

                    <div style="text-align: center;">
                        <button type="submit" class="btn-primary-lg" style="width: 100%; justify-content: center; font-size: 16px; padding: 18px;">
                            Kirim Pendaftaran
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</section>
@endsection
