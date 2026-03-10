<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilProdi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function edit(): View
    {
        $hasSertifikatColumn = Schema::hasColumn('profil_prodis', 'sertifikat_akreditasi');

        $defaults = [
            'tentang' => '',
            'visi' => '',
            'misi' => '',
        ];

        if ($hasSertifikatColumn) {
            $defaults['sertifikat_akreditasi'] = null;
        }

        $profil = ProfilProdi::firstOrCreate(
            ['id' => 1],
            $defaults
        );

        return view('admin.profil.edit', compact('profil', 'hasSertifikatColumn'));
    }

    public function update(Request $request): RedirectResponse
    {
        $hasSertifikatColumn = Schema::hasColumn('profil_prodis', 'sertifikat_akreditasi');

        $rules = [
            'tentang' => ['required', 'string'],
            'visi' => ['required', 'string'],
            'misi' => ['required', 'string'],
        ];

        if ($hasSertifikatColumn) {
            $rules['sertifikat_akreditasi'] = ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'];
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('sertifikat_akreditasi') && ! $hasSertifikatColumn) {
            return back()
                ->withInput()
                ->withErrors([
                    'sertifikat_akreditasi' => 'Fitur upload sertifikat belum aktif. Jalankan migration terlebih dahulu.',
                ]);
        }

        $defaults = [
            'tentang' => '',
            'visi' => '',
            'misi' => '',
        ];

        if ($hasSertifikatColumn) {
            $defaults['sertifikat_akreditasi'] = null;
        }

        $profil = ProfilProdi::firstOrCreate(
            ['id' => 1],
            $defaults
        );

        if ($hasSertifikatColumn && $request->hasFile('sertifikat_akreditasi')) {
            if ($profil->sertifikat_akreditasi && Storage::disk('s3')->exists($profil->sertifikat_akreditasi)) {
                Storage::disk('s3')->delete($profil->sertifikat_akreditasi);
            }

            $validated['sertifikat_akreditasi'] = $request->file('sertifikat_akreditasi')->store('profil/sertifikat', 's3');
        } else {
            unset($validated['sertifikat_akreditasi']);
        }

        $profil->update($validated);

        return redirect()->route('admin.profil.edit')->with('success', 'Profil prodi berhasil diperbarui.');
    }
}
