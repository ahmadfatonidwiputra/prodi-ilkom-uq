<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = Mahasiswa::latest()->paginate(10);

        return view('admin.mahasiswa.index', compact('mahasiswas'));
    }

    public function create(): View
    {
        return view('admin.mahasiswa.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:30', 'unique:mahasiswas,nim'],
            'angkatan' => ['required', 'integer', 'digits:4'],
            'konsentrasi' => ['nullable', 'string', 'max:255'],
            'prestasi' => ['nullable', 'string', 'max:255'],
            'status_aktif' => ['nullable', 'boolean'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif');

        Mahasiswa::create($validated);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data prestasi mahasiswa berhasil ditambahkan.');
    }

    public function show(Mahasiswa $mahasiswa): RedirectResponse
    {
        return redirect()->route('admin.mahasiswa.edit', $mahasiswa);
    }

    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('admin.mahasiswa.edit', compact('mahasiswa'));
    }

    public function update(Request $request, Mahasiswa $mahasiswa): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:30', 'unique:mahasiswas,nim,'.$mahasiswa->id],
            'angkatan' => ['required', 'integer', 'digits:4'],
            'konsentrasi' => ['nullable', 'string', 'max:255'],
            'prestasi' => ['nullable', 'string', 'max:255'],
            'status_aktif' => ['nullable', 'boolean'],
        ]);

        $validated['status_aktif'] = $request->boolean('status_aktif');

        $mahasiswa->update($validated);

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data prestasi mahasiswa berhasil diperbarui.');
    }

    public function destroy(Mahasiswa $mahasiswa): RedirectResponse
    {
        $mahasiswa->delete();

        return redirect()->route('admin.mahasiswa.index')->with('success', 'Data prestasi mahasiswa berhasil dihapus.');
    }
}
