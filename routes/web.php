<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\PrestasiMahasiswaController as AdminPrestasiMahasiswaController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\Admin\SiteContentController as AdminSiteContentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BeritaController as UserBeritaController;
use App\Http\Controllers\User\DosenController as UserDosenController;
use App\Http\Controllers\User\GaleriController as UserGaleriController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\KurikulumController as UserKurikulumController;
use App\Http\Controllers\User\PendaftaranController as UserPendaftaranController;
use App\Http\Controllers\User\PengumumanController as UserPengumumanController;
use App\Http\Controllers\User\PrestasiMahasiswaController as UserPrestasiMahasiswaController;
use App\Http\Controllers\User\SitePageController as UserSitePageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [UserHomeController::class, 'index'])->name('home');

Route::prefix('tentang-prodi')->name('tentang-prodi.')->group(function (): void {
    Route::get('/profil-program-studi', [UserSitePageController::class, 'show'])
        ->defaults('section', 'tentang-profil-program-studi')
        ->name('profil-program-studi');
    Route::get('/visi-misi', [UserSitePageController::class, 'show'])
        ->defaults('section', 'tentang-visi-misi')
        ->name('visi-misi');
    Route::get('/profil-lulusan', [UserSitePageController::class, 'show'])
        ->defaults('section', 'tentang-profil-lulusan')
        ->name('profil-lulusan');
    Route::get('/profesi-profil-lulusan', [UserSitePageController::class, 'show'])
        ->defaults('section', 'tentang-profesi-profil-lulusan')
        ->name('profesi-profil-lulusan');
    Route::get('/struktur-organisasi', [UserSitePageController::class, 'show'])
        ->defaults('section', 'tentang-struktur-organisasi')
        ->name('struktur-organisasi');
});

Route::prefix('kurikulum')->name('kurikulum.')->group(function (): void {
    Route::get('/matakuliah', [UserKurikulumController::class, 'index'])->name('matakuliah');
    Route::get('/rps', [UserSitePageController::class, 'show'])
        ->defaults('section', 'kurikulum-rps')
        ->name('rps');
    Route::get('/jadwal-kuliah', [UserSitePageController::class, 'show'])
        ->defaults('section', 'kurikulum-jadwal-kuliah')
        ->name('jadwal-kuliah');
});

Route::get('/dosen', [UserDosenController::class, 'index'])->name('dosen');

Route::prefix('fasilitas')->name('fasilitas.')->group(function (): void {
    Route::get('/lab-pemrograman', [UserSitePageController::class, 'show'])
        ->defaults('section', 'fasilitas-lab-pemrograman')
        ->name('lab-pemrograman');
    Route::get('/lab-jaringan-komputer', [UserSitePageController::class, 'show'])
        ->defaults('section', 'fasilitas-lab-jaringan-komputer')
        ->name('lab-jaringan-komputer');
    Route::get('/ruang-kelas', [UserSitePageController::class, 'show'])
        ->defaults('section', 'fasilitas-ruang-kelas')
        ->name('ruang-kelas');
    Route::get('/perpustakaan', [UserSitePageController::class, 'show'])
        ->defaults('section', 'fasilitas-perpustakaan')
        ->name('perpustakaan');
    Route::get('/coding-learn', [UserSitePageController::class, 'show'])
        ->defaults('section', 'fasilitas-coding-learn')
        ->name('coding-learn');
});

Route::get('/prestasi-mahasiswa', [UserPrestasiMahasiswaController::class, 'index'])->name('prestasi-mahasiswa');

Route::prefix('hmps')->name('hmps.')->group(function (): void {
    Route::get('/profil', [UserSitePageController::class, 'show'])
        ->defaults('section', 'hmps-profil')
        ->name('profil');
    Route::get('/struktur-organisasi', [UserSitePageController::class, 'show'])
        ->defaults('section', 'hmps-struktur-organisasi')
        ->name('struktur-organisasi');
    Route::get('/program-kerja', [UserSitePageController::class, 'show'])
        ->defaults('section', 'hmps-program-kerja')
        ->name('program-kerja');
    Route::get('/kegiatan', [UserSitePageController::class, 'show'])
        ->defaults('section', 'hmps-kegiatan')
        ->name('kegiatan');
    Route::get('/rekruitment', [UserSitePageController::class, 'show'])
        ->defaults('section', 'hmps-rekruitment')
        ->name('rekruitment');
});

Route::get('/pengumuman', [UserPengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pengumuman/{pengumuman:slug}', [UserPengumumanController::class, 'show'])->name('pengumuman.show');

Route::get('/berita', [UserBeritaController::class, 'index'])->name('berita');
Route::get('/berita/{berita:slug}', [UserBeritaController::class, 'show'])->name('berita.show');

Route::get('/galeri', [UserGaleriController::class, 'index'])->name('galeri');
Route::get('/pendaftaran', [UserPendaftaranController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [UserPendaftaranController::class, 'store'])->name('pendaftaran.store');
Route::get('/kontak', [UserHomeController::class, 'kontak'])->name('kontak');

// Legacy aliases
Route::redirect('/profil', '/tentang-prodi/profil-program-studi')->name('profil');
Route::redirect('/visi-misi', '/tentang-prodi/visi-misi')->name('visi-misi');
Route::redirect('/kurikulum', '/kurikulum/matakuliah')->name('kurikulum');
Route::redirect('/fasilitas', '/fasilitas/lab-pemrograman')->name('fasilitas');
Route::redirect('/mahasiswa', '/prestasi-mahasiswa')->name('mahasiswa');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/dosen', AdminDosenController::class)->parameters(['dosen' => 'dosen']);
    Route::resource('/berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('/pengumuman', AdminPengumumanController::class)->parameters(['pengumuman' => 'pengumuman']);
    Route::resource('/galeri', AdminGaleriController::class)->parameters(['galeri' => 'galeri']);
    Route::resource('/kurikulum', AdminKurikulumController::class)->parameters(['kurikulum' => 'kurikulum']);
    Route::resource('/prestasi-mahasiswa', AdminPrestasiMahasiswaController::class)
        ->parameters(['prestasi-mahasiswa' => 'prestasi'])
        ->names('prestasi')
        ->except(['show']);

    Route::get('/pendaftaran/export', [AdminPendaftaranController::class, 'export'])->name('pendaftaran.export');
    Route::resource('/pendaftaran', AdminPendaftaranController::class)->parameters(['pendaftaran' => 'pendaftaran']);

    Route::get('/profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');

    Route::get('/konten/{section}', [AdminSiteContentController::class, 'edit'])
        ->whereIn('section', array_keys(AdminSiteContentController::sections()))
        ->name('site-content.edit');
    Route::put('/konten/{section}', [AdminSiteContentController::class, 'update'])
        ->whereIn('section', array_keys(AdminSiteContentController::sections()))
        ->name('site-content.update');

    // Legacy aliases
    Route::redirect('/fasilitas', '/admin/konten/fasilitas-lab-pemrograman')->name('fasilitas.index');
    Route::redirect('/mahasiswa', '/admin/prestasi-mahasiswa')->name('mahasiswa.index');
});

Route::middleware('auth')->group(function (): void {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
