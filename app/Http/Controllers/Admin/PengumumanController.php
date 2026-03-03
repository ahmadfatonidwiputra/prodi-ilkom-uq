<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;
use App\Models\Pengumuman;
use Illuminate\Http\RedirectResponse;
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
        Pengumuman::create($request->validated());

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
        $pengumuman->update($request->validated());

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman): RedirectResponse
    {
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }
}
