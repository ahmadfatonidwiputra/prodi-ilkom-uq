<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\SiteContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(): View
    {
        $banner = Schema::hasTable('site_contents')
            ? SiteContent::where('key', 'pendaftaran_banner')->first()
            : null;

        return view('user.pendaftaran.index', compact('banner'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'pilihan_program_studi' => ['required', 'string', 'max:255'],
            'pesan' => ['nullable', 'string'],
            'dokumen' => ['nullable', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ]);

        if ($request->hasFile('dokumen')) {
            $validated['dokumen'] = $request->file('dokumen')->store('pendaftaran/dokumen', 's3');
        } else {
            unset($validated['dokumen']);
        }

        Pendaftaran::create($validated + ['status' => 'pending']);

        return back()->with('success', 'Pendaftaran berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
