<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\FasilitasController as AdminFasilitasController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\KurikulumController as AdminKurikulumController;
use App\Http\Controllers\Admin\MahasiswaController as AdminMahasiswaController;
use App\Http\Controllers\Admin\PendaftaranController as AdminPendaftaranController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BeritaController as UserBeritaController;
use App\Http\Controllers\User\DosenController as UserDosenController;
use App\Http\Controllers\User\FasilitasController as UserFasilitasController;
use App\Http\Controllers\User\GaleriController as UserGaleriController;
use App\Http\Controllers\User\HomeController as UserHomeController;
use App\Http\Controllers\User\KurikulumController as UserKurikulumController;
use App\Http\Controllers\User\MahasiswaController as UserMahasiswaController;
use App\Http\Controllers\User\PendaftaranController as UserPendaftaranController;
use App\Http\Controllers\User\PengumumanController as UserPengumumanController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserHomeController::class, 'index'])->name('home');
Route::get('/profil', [UserHomeController::class, 'profil'])->name('profil');
Route::get('/visi-misi', [UserHomeController::class, 'visiMisi'])->name('visi-misi');
Route::get('/dosen', [UserDosenController::class, 'index'])->name('dosen');
Route::get('/berita', [UserBeritaController::class, 'index'])->name('berita');
Route::get('/berita/{berita:slug}', [UserBeritaController::class, 'show'])->name('berita.show');
Route::get('/pengumuman', [UserPengumumanController::class, 'index'])->name('pengumuman');
Route::get('/pengumuman/{pengumuman:slug}', [UserPengumumanController::class, 'show'])->name('pengumuman.show');
Route::get('/galeri', [UserGaleriController::class, 'index'])->name('galeri');
Route::get('/kontak', [UserHomeController::class, 'kontak'])->name('kontak');

Route::get('/kurikulum', [UserKurikulumController::class, 'index'])->name('kurikulum');
Route::get('/fasilitas', [UserFasilitasController::class, 'index'])->name('fasilitas');
Route::get('/mahasiswa', [UserMahasiswaController::class, 'index'])->name('mahasiswa');
Route::get('/pendaftaran', [UserPendaftaranController::class, 'index'])->name('pendaftaran');
Route::post('/pendaftaran', [UserPendaftaranController::class, 'store'])->name('pendaftaran.store');

Route::middleware('auth')->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/dosen', AdminDosenController::class)->parameters(['dosen' => 'dosen']);
    Route::resource('/berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('/pengumuman', AdminPengumumanController::class)->parameters(['pengumuman' => 'pengumuman']);
    Route::resource('/galeri', AdminGaleriController::class)->parameters(['galeri' => 'galeri']);

    Route::resource('/kurikulum', AdminKurikulumController::class)->parameters(['kurikulum' => 'kurikulum']);
    Route::resource('/fasilitas', AdminFasilitasController::class)->parameters(['fasilitas' => 'fasilitas']);
    Route::resource('/mahasiswa', AdminMahasiswaController::class)->parameters(['mahasiswa' => 'mahasiswa']);
    Route::get('/pendaftaran/export', [AdminPendaftaranController::class, 'export'])->name('pendaftaran.export');
    Route::resource('/pendaftaran', AdminPendaftaranController::class)->parameters(['pendaftaran' => 'pendaftaran']);

    Route::get('/profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
