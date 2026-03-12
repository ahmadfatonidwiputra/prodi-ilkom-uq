<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Fasilitas;
use App\Models\Pendaftaran;
use App\Models\PrestasiMahasiswa;
use App\Models\ProfilProdi;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profil = ProfilProdi::latest()->first();

        $fasilitasUnggulan = Schema::hasTable('fasilitas')
            ? Fasilitas::orderBy('urutan')->latest()->take(4)->get()
            : collect();
        $beritaTerbaru = Berita::latest()->take(3)->get();
        $dosenUnggulan = Dosen::latest()->take(4)->get();

        $statistik = [
            'dosen' => Dosen::count(),
            'mahasiswa_aktif' => Schema::hasTable('pendaftarans')
                ? Pendaftaran::where('status', 'diterima')->count()
                : 0,
            'prestasi_mahasiswa' => Schema::hasTable('prestasi_mahasiswas')
                ? PrestasiMahasiswa::count()
                : 0,
            'fasilitas' => Schema::hasTable('fasilitas') ? Fasilitas::count() : 0,
        ];

        return view('user.home', compact('profil', 'fasilitasUnggulan', 'beritaTerbaru', 'dosenUnggulan', 'statistik'));
    }

    public function profil(): View
    {
        $profil = ProfilProdi::latest()->first();

        return view('user.profil', compact('profil'));
    }

    public function visiMisi(): View
    {
        $profil = ProfilProdi::latest()->first();

        return view('user.visi-misi', compact('profil'));
    }

    public function kontak(): View
    {
        return view('user.kontak');
    }
}
