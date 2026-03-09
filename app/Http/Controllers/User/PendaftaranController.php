<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PendaftaranController extends Controller
{
    public function index(): View
    {
        return view('user.pendaftaran.index');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_lengkap' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'no_hp' => ['required', 'string', 'max:30'],
            'asal_sekolah' => ['nullable', 'string', 'max:255'],
            'pesan' => ['nullable', 'string'],
        ]);

        Pendaftaran::create($validated + ['status' => 'pending']);

        return back()->with('success', 'Pendaftaran berhasil dikirim. Tim kami akan segera menghubungi Anda.');
    }
}
