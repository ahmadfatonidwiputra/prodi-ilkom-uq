<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Mahasiswa;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function index(): View
    {
        $mahasiswas = Mahasiswa::where('status_aktif', true)->latest()->paginate(12);

        return view('user.mahasiswa.index', compact('mahasiswas'));
    }
}
