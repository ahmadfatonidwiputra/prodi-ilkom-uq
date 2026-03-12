<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Kurikulum;
use App\Models\Pendaftaran;
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
                + Kurikulum::whereDate('updated_at', Carbon::today())->count()
                + ($hasPrestasiTable ? PrestasiMahasiswa::whereDate('updated_at', Carbon::today())->count() : 0)
                + ($hasSiteContentTable ? SiteContent::whereDate('updated_at', Carbon::today())->count() : 0),
            'pendaftaranBaru' => Pendaftaran::whereDate('created_at', Carbon::today())->count(),
            'permintaanUpdateProfil' => Pendaftaran::where('status', 'pending')->count(), // keep key for existing view text
            'totalDosen' => Dosen::count(),
            'totalKurikulum' => Kurikulum::count(),
            'totalPendaftaran' => Pendaftaran::count(),
            'totalPrestasiMahasiswa' => $hasPrestasiTable ? PrestasiMahasiswa::count() : 0,
        ];

        $aktivitasTerbaru = collect()
            ->merge(Dosen::latest()->take(3)->get()->map(fn (Dosen $item) => [
                'judul' => 'Profil dosen diperbarui: '.$item->nama,
                'waktu' => $item->updated_at,
                'ikon' => 'person-badge',
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
            ->merge(Kurikulum::latest()->take(2)->get()->map(fn (Kurikulum $item) => [
                'judul' => 'Kurikulum diperbarui: '.$item->nama_mk,
                'waktu' => $item->updated_at,
                'ikon' => 'journal-check',
            ]))
            ->sortByDesc('waktu')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact('metrics', 'aktivitasTerbaru'));
    }
}
