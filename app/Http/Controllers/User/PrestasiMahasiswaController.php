<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\PrestasiMahasiswa;
use Illuminate\View\View;

class PrestasiMahasiswaController extends Controller
{
    public function index(): View
    {
        $prestasis = PrestasiMahasiswa::latest()->paginate(12);

        return view('user.prestasi.index', compact('prestasis'));
    }
}
