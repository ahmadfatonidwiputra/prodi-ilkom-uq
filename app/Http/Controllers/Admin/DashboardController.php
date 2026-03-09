<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use Illuminate\Support\Carbon;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $metrics = [
            'totalMahasiswaAktif' => Mahasiswa::where('status_aktif', true)->count(),
            'halamanDiperbaruiHariIni' => Dosen::whereDate('updated_at', Carbon::today())->count()
                + Berita::whereDate('updated_at', Carbon::today())->count()
                + Pengumuman::whereDate('updated_at', Carbon::today())->count()
                + Galeri::whereDate('updated_at', Carbon::today())->count(),
            'pendaftaranBaru' => Pendaftaran::whereDate('created_at', Carbon::today())->count(),
            'permintaanUpdateProfil' => Pendaftaran::where('status', 'pending')->count(),
            'totalDosen' => Dosen::count(),
            'totalBerita' => Berita::count(),
            'totalPengumuman' => Pengumuman::count(),
            'totalGaleri' => Galeri::count(),
            'totalPrestasiMahasiswa' => Mahasiswa::whereNotNull('prestasi')->where('prestasi', '!=', '')->count(),
        ];

        $aktivitasTerbaru = collect()
            ->merge(Berita::latest()->take(3)->get()->map(fn (Berita $item) => [
                'judul' => 'Berita diperbarui: ' . $item->judul,
                'waktu' => $item->updated_at,
                'ikon' => 'newspaper',
            ]))
            ->merge(Pengumuman::latest()->take(3)->get()->map(fn (Pengumuman $item) => [
                'judul' => 'Pengumuman diperbarui: ' . $item->judul,
                'waktu' => $item->updated_at,
                'ikon' => 'megaphone',
            ]))
            ->merge(Pendaftaran::latest()->take(3)->get()->map(fn (Pendaftaran $item) => [
                'judul' => 'Pendaftaran masuk: ' . $item->nama_lengkap,
                'waktu' => $item->created_at,
                'ikon' => 'person-plus',
            ]))
            ->sortByDesc('waktu')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact('metrics', 'aktivitasTerbaru'));
    }
}
