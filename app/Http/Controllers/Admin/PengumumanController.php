<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(): View
    {
        $pengumumans = Pengumuman::latest('tanggal')->paginate(10);

        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create(): View
    {
        return view('admin.pengumuman.create');
    }

    public function store(StorePengumumanRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file_path')) {
            $validated['file_path'] = $request->file('file_path')->store('pengumuman/files', 's3');
        } else {
            unset($validated['file_path']);
        }

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function show(Pengumuman $pengumuman): RedirectResponse
    {
        return redirect()->route('admin.pengumuman.edit', $pengumuman);
    }

    public function edit(Pengumuman $pengumuman): View
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(UpdatePengumumanRequest $request, Pengumuman $pengumuman): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('file_path')) {
            if ($pengumuman->file_path && Storage::disk('s3')->exists($pengumuman->file_path)) {
                Storage::disk('s3')->delete($pengumuman->file_path);
            }

            $validated['file_path'] = $request->file('file_path')->store('pengumuman/files', 's3');
        } else {
            unset($validated['file_path']);
        }

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman): RedirectResponse
    {
        if ($pengumuman->file_path && Storage::disk('s3')->exists($pengumuman->file_path)) {
            Storage::disk('s3')->delete($pengumuman->file_path);
        }

        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
