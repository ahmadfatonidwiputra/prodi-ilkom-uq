<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function index(): View
    {
        $alumnis = Alumni::latest('angkatan_lulus')->paginate(10);

        return view('admin.alumni.index', compact('alumnis'));
    }

    public function create(): View
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'angkatan_lulus' => ['required', 'integer', 'digits:4'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'perusahaan' => ['nullable', 'string', 'max:255'],
            'testimoni' => ['nullable', 'string'],
            'foto' => ['nullable', 'url', 'max:255'],
        ]);

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function show(Alumni $alumni): RedirectResponse
    {
        return redirect()->route('admin.alumni.edit', $alumni);
    }

    public function edit(Alumni $alumni): View
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni): RedirectResponse
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'angkatan_lulus' => ['required', 'integer', 'digits:4'],
            'pekerjaan' => ['nullable', 'string', 'max:255'],
            'perusahaan' => ['nullable', 'string', 'max:255'],
            'testimoni' => ['nullable', 'string'],
            'foto' => ['nullable', 'url', 'max:255'],
        ]);

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni): RedirectResponse
    {
        $alumni->delete();

        return redirect()->route('admin.alumni.index')->with('success', 'Data alumni berhasil dihapus.');
    }
}
