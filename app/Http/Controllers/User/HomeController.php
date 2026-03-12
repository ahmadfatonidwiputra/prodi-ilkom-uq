<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use App\Models\Fasilitas;
use App\Models\Pendaftaran;
use App\Models\PrestasiMahasiswa;
use App\Models\ProfilProdi;
use App\Models\SiteContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $profil = ProfilProdi::latest()->first();

        $dosenUnggulan = Dosen::latest()->take(4)->get();
        $fasilitasSlides = collect();

        if (Schema::hasTable('site_contents')) {
            $fasilitasKeys = [
                ['key' => 'fasilitas_lab_pemrograman', 'title' => 'Lab Pemrograman'],
                ['key' => 'fasilitas_lab_jaringan_komputer', 'title' => 'Lab Jaringan Komputer'],
                ['key' => 'fasilitas_ruang_kelas', 'title' => 'Ruang Kelas'],
                ['key' => 'fasilitas_perpustakaan', 'title' => 'Perpustakaan'],
                ['key' => 'fasilitas_coding_learn', 'title' => 'Coding Learn'],
            ];

            $contentByKey = SiteContent::query()
                ->whereIn('key', array_column($fasilitasKeys, 'key'))
                ->get()
                ->keyBy('key');

            $fasilitasSlides = collect($fasilitasKeys)
                ->map(function (array $item) use ($contentByKey): array {
                    $content = $contentByKey->get($item['key']);

                    return [
                        'title' => $content?->title ?: $item['title'],
                        'body' => $content?->body,
                        'image_url' => $content?->image_url,
                    ];
                })
                ->filter(fn (array $slide): bool => ! empty($slide['image_url']))
                ->values();
        }

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

        return view('user.home', compact('profil', 'dosenUnggulan', 'fasilitasSlides', 'statistik'));
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
}
