<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrestasiMahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PrestasiMahasiswaController extends Controller
{
    public function index(): View
    {
        $prestasis = PrestasiMahasiswa::latest()->paginate(10);

        return view('admin.prestasi.index', compact('prestasis'));
    }

    public function create(): View
    {
        return view('admin.prestasi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul_prestasi' => ['required', 'string', 'max:255'],
            'nama_mahasiswa' => ['required', 'string', 'max:255'],
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:'.(date('Y') + 1)],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('prestasi-mahasiswa', 's3');
        } else {
            unset($validated['gambar']);
        }

        PrestasiMahasiswa::create($validated);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi mahasiswa berhasil ditambahkan.');
    }

    public function edit(PrestasiMahasiswa $prestasi): View
    {
        return view('admin.prestasi.edit', compact('prestasi'));
    }

    public function update(Request $request, PrestasiMahasiswa $prestasi): RedirectResponse
    {
        $validated = $request->validate([
            'judul_prestasi' => ['required', 'string', 'max:255'],
            'nama_mahasiswa' => ['required', 'string', 'max:255'],
            'tahun' => ['required', 'integer', 'digits:4', 'min:2000', 'max:'.(date('Y') + 1)],
            'deskripsi' => ['nullable', 'string'],
            'gambar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($prestasi->gambar && Storage::disk('s3')->exists($prestasi->gambar)) {
                Storage::disk('s3')->delete($prestasi->gambar);
            }

            $validated['gambar'] = $request->file('gambar')->store('prestasi-mahasiswa', 's3');
        } else {
            unset($validated['gambar']);
        }

        $prestasi->update($validated);

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi mahasiswa berhasil diperbarui.');
    }

    public function destroy(PrestasiMahasiswa $prestasi): RedirectResponse
    {
        if ($prestasi->gambar && Storage::disk('s3')->exists($prestasi->gambar)) {
            Storage::disk('s3')->delete($prestasi->gambar);
        }

        $prestasi->delete();

        return redirect()->route('admin.prestasi.index')->with('success', 'Data prestasi mahasiswa berhasil dihapus.');
    }
}
