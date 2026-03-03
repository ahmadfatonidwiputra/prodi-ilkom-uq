<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function publicIndex(): View
    {
        $beritas = Berita::latest()->paginate(9);

        return view('berita.index', compact('beritas'));
    }

    public function publicShow(Berita $berita): View
    {
        return view('berita.show', compact('berita'));
    }

    public function index(): View
    {
        $beritas = Berita::latest()->paginate(10);

        return view('admin.berita.index', compact('beritas'));
    }

    public function create(): View
    {
        return view('admin.berita.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'string', 'max:255'],
        ]);

        Berita::create($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    public function show(Berita $berita): View
    {
        return view('admin.berita.show', compact('berita'));
    }

    public function edit(Berita $berita): View
    {
        return view('admin.berita.edit', compact('berita'));
    }

    public function update(Request $request, Berita $berita): RedirectResponse
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'isi' => ['required', 'string'],
            'gambar' => ['nullable', 'string', 'max:255'],
        ]);

        $berita->update($validated);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(Berita $berita): RedirectResponse
    {
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus.');
    }
}
