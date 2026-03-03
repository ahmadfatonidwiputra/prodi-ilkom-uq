<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function publicIndex(): View
    {
        $galeris = Galeri::latest()->paginate(12);

        return view('galeri.index', compact('galeris'));
    }

    public function index(): View
    {
        $galeris = Galeri::latest()->paginate(10);

        return view('admin.galeri.index', compact('galeris'));
    }

    public function create(): View
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'string', 'max:255'],
        ]);

        Galeri::create($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil ditambahkan.');
    }

    public function show(Galeri $galeri): View
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri): View
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'string', 'max:255'],
        ]);

        $galeri->update($validated);

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil diperbarui.');
    }

    public function destroy(Galeri $galeri): RedirectResponse
    {
        $galeri->delete();

        return redirect()->route('admin.galeri.index')->with('success', 'Galeri berhasil dihapus.');
    }
}
