<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FasilitasController extends Controller
{
    public function index(): View
    {
        $fasilitas = Fasilitas::orderBy('urutan')->latest()->paginate(10);

        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    public function create(): View
    {
        return view('admin.fasilitas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'ikon' => ['nullable', 'string', 'max:100'],
            'gambar' => ['nullable', 'url', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        Fasilitas::create($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function show(Fasilitas $fasilitas): RedirectResponse
    {
        return redirect()->route('admin.fasilitas.edit', $fasilitas);
    }

    public function edit(Fasilitas $fasilitas): View
    {
        return view('admin.fasilitas.edit', compact('fasilitas'));
    }

    public function update(Request $request, Fasilitas $fasilitas): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'ikon' => ['nullable', 'string', 'max:100'],
            'gambar' => ['nullable', 'url', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'urutan' => ['nullable', 'integer', 'min:0'],
        ]);

        $fasilitas->update($validated);

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Fasilitas $fasilitas): RedirectResponse
    {
        $fasilitas->delete();

        return redirect()->route('admin.fasilitas.index')->with('success', 'Fasilitas berhasil dihapus.');
    }
}
