<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(): View
    {
        $pendaftarans = Pendaftaran::latest()->paginate(10);

        return view('admin.pendaftaran.index', compact('pendaftarans'));
    }

    public function create(): RedirectResponse
    {
        return redirect()->route('admin.pendaftaran.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'pesan' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:pending,diterima,ditolak'],
        ]);

        Pendaftaran::create($validated);

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil ditambahkan.');
    }

    public function show(Pendaftaran $pendaftaran): RedirectResponse
    {
        return redirect()->route('admin.pendaftaran.edit', $pendaftaran);
    }

    public function edit(Pendaftaran $pendaftaran): View
    {
        return view('admin.pendaftaran.edit', compact('pendaftaran'));
    }

    public function update(Request $request, Pendaftaran $pendaftaran): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'pesan' => ['nullable', 'string'],
            'status' => ['required', 'string', 'in:pending,diterima,ditolak'],
        ]);

        $pendaftaran->update($validated);

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil diperbarui.');
    }

    public function destroy(Pendaftaran $pendaftaran): RedirectResponse
    {
        $pendaftaran->delete();

        return redirect()->route('admin.pendaftaran.index')->with('success', 'Data pendaftaran berhasil dihapus.');
    }
}
