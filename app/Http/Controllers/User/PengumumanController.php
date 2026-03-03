<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\View\View;

class PengumumanController extends Controller
{
    public function index(): View
    {
        $pengumumans = Pengumuman::latest('tanggal')->paginate(10);

        return view('user.pengumuman.index', compact('pengumumans'));
    }

    public function show(Pengumuman $pengumuman): View
    {
        return view('user.pengumuman.show', compact('pengumuman'));
    }
}
