<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilProdi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function edit(): View
    {
        $profil = ProfilProdi::firstOrCreate(
            ['id' => 1],
            ['tentang' => '', 'visi' => '', 'misi' => '']
        );

        return view('admin.profil.edit', compact('profil'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'tentang' => ['required', 'string'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
        ]);

        $profil = ProfilProdi::firstOrCreate(
            ['id' => 1],
            ['tentang' => '', 'visi' => '', 'misi' => '']
        );

        $profil->update($validated);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil prodi berhasil diperbarui.');
    }
}
