<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class KurikulumController extends Controller
{
    public function index(): View
    {
        $kurikulums = Kurikulum::orderBy('semester')->orderBy('kode_mk')->paginate(10);

        return view('admin.kurikulum.index', compact('kurikulums'));
    }

    public function create(): View
    {
        return view('admin.kurikulum.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mk' => ['required', 'string', 'max:30', 'unique:kurikulums,kode_mk'],
            'nama_mk' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'between:1,14'],
            'sks' => ['required', 'integer', 'between:1,8'],
            'kategori' => ['required', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        Kurikulum::create($validated);

        return redirect()->route('admin.kurikulum.index')->with('success', 'Data kurikulum berhasil ditambahkan.');
    }

    public function show(Kurikulum $kurikulum): RedirectResponse
    {
        return redirect()->route('admin.kurikulum.edit', $kurikulum);
    }

    public function edit(Kurikulum $kurikulum): View
    {
        return view('admin.kurikulum.edit', compact('kurikulum'));
    }

    public function update(Request $request, Kurikulum $kurikulum): RedirectResponse
    {
        $validated = $request->validate([
            'kode_mk' => ['required', 'string', 'max:30', 'unique:kurikulums,kode_mk,'.$kurikulum->id],
            'nama_mk' => ['required', 'string', 'max:255'],
            'semester' => ['required', 'integer', 'between:1,14'],
            'sks' => ['required', 'integer', 'between:1,8'],
            'kategori' => ['required', 'string', 'max:50'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        $kurikulum->update($validated);

        return redirect()->route('admin.kurikulum.index')->with('success', 'Data kurikulum berhasil diperbarui.');
    }

    public function destroy(Kurikulum $kurikulum): RedirectResponse
    {
        $kurikulum->delete();

        return redirect()->route('admin.kurikulum.index')->with('success', 'Data kurikulum berhasil dihapus.');
    }
}
