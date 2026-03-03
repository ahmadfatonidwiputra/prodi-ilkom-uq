<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\ProfilProdi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(): View
    {
        $totalDosen = Dosen::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();

        return view('admin.dashboard', compact('totalDosen', 'totalBerita', 'totalGaleri'));
    }

    public function editProfil(): View
    {
        $profil = ProfilProdi::firstOrCreate(
            ['id' => 1],
            ['tentang' => '', 'visi' => '', 'misi' => '']
        );

        return view('admin.profil.edit', compact('profil'));
    }

    public function updateProfil(Request $request): RedirectResponse
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
