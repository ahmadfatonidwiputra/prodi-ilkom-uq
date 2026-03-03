<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Pengumuman;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalDosen = Dosen::count();
        $totalBerita = Berita::count();
        $totalPengumuman = Pengumuman::count();
        $totalGaleri = Galeri::count();

        return view('admin.dashboard', compact('totalDosen', 'totalBerita', 'totalPengumuman', 'totalGaleri'));
    }
}
