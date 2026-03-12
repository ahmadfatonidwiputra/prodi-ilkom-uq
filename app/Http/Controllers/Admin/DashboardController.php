<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\Dosen;
use App\Models\Galeri;
use App\Models\Pendaftaran;
use App\Models\Pengumuman;
use App\Models\PrestasiMahasiswa;
use App\Models\SiteContent;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $hasPrestasiTable = Schema::hasTable('prestasi_mahasiswas');
        $hasSiteContentTable = Schema::hasTable('site_contents');

        $metrics = [
            'totalMahasiswaAktif' => $hasPrestasiTable ? PrestasiMahasiswa::count() : 0,
            'halamanDiperbaruiHariIni' => Dosen::whereDate('updated_at', Carbon::today())->count()
                + Berita::whereDate('updated_at', Carbon::today())->count()
                + Pengumuman::whereDate('updated_at', Carbon::today())->count()
                + Galeri::whereDate('updated_at', Carbon::today())->count()
                + ($hasPrestasiTable ? PrestasiMahasiswa::whereDate('updated_at', Carbon::today())->count() : 0)
                + ($hasSiteContentTable ? SiteContent::whereDate('updated_at', Carbon::today())->count() : 0),
            'pendaftaranBaru' => Pendaftaran::whereDate('created_at', Carbon::today())->count(),
            'permintaanUpdateProfil' => Pendaftaran::where('status', 'pending')->count(), // keep key for existing view text
            'totalDosen' => Dosen::count(),
            'totalBerita' => Berita::count(),
            'totalPengumuman' => Pengumuman::count(),
            'totalGaleri' => Galeri::count(),
            'totalPrestasiMahasiswa' => $hasPrestasiTable ? PrestasiMahasiswa::count() : 0,
        ];

        $aktivitasTerbaru = collect()
            ->merge(Berita::latest()->take(3)->get()->map(fn (Berita $item) => [
                'judul' => 'Berita diperbarui: '.$item->judul,
                'waktu' => $item->updated_at,
                'ikon' => 'newspaper',
            ]))
            ->merge(Pengumuman::latest()->take(3)->get()->map(fn (Pengumuman $item) => [
                'judul' => 'Pengumuman diperbarui: '.$item->judul,
                'waktu' => $item->updated_at,
                'ikon' => 'megaphone',
            ]))
            ->merge(($hasPrestasiTable
                ? PrestasiMahasiswa::latest()->take(3)->get()->map(fn (PrestasiMahasiswa $item) => [
                    'judul' => 'Prestasi diperbarui: '.$item->judul_prestasi,
                    'waktu' => $item->updated_at,
                    'ikon' => 'trophy',
                ])
                : collect()))
            ->merge(Pendaftaran::latest()->take(3)->get()->map(fn (Pendaftaran $item) => [
                'judul' => 'Pendaftaran masuk: '.$item->nama_lengkap,
                'waktu' => $item->created_at,
                'ikon' => 'person-plus',
            ]))
            ->sortByDesc('waktu')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact('metrics', 'aktivitasTerbaru'));
    }
}
