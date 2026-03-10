<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Dosen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View
    {
        $dosens = Dosen::latest()->paginate(10);

        return view('admin.dosen.index', compact('dosens'));
    }

    public function create(): View
    {
        return view('admin.dosen.create');
    }

    public function store(StoreDosenRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('dosens', 's3');
        }

        Dosen::create($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil ditambahkan.');
    }

    public function show(Dosen $dosen): RedirectResponse
    {
        return redirect()->route('admin.dosen.edit', $dosen);
    }

    public function edit(Dosen $dosen): View
    {
        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(UpdateDosenRequest $request, Dosen $dosen): RedirectResponse
    {
        $validated = $request->validated();

        if ($request->hasFile('foto')) {
            if ($dosen->foto && Storage::disk('s3')->exists($dosen->foto)) {
                Storage::disk('s3')->delete($dosen->foto);
            }

            $validated['foto'] = $request->file('foto')->store('dosens', 's3');
        } else {
            unset($validated['foto']);
        }

        $dosen->update($validated);

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil diperbarui.');
    }

    public function destroy(Dosen $dosen): RedirectResponse
    {
        if ($dosen->foto && Storage::disk('s3')->exists($dosen->foto)) {
            Storage::disk('s3')->delete($dosen->foto);
        }

        $dosen->delete();

        return redirect()->route('admin.dosen.index')->with('success', 'Data dosen berhasil dihapus.');
    }
}
