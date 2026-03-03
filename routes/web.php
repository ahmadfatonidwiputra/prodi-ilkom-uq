<?php

use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DosenController as AdminDosenController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\PengumumanController as AdminPengumumanController;
use App\Http\Controllers\Admin\ProfilController as AdminProfilController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BeritaController as UserBeritaController;
use App\Http\Controllers\User\DosenController as UserDosenController;
use App\Http\Controllers\User\GaleriController as UserGaleriController;
use App\Http\Controllers\User\HomeController as UserHomeController;
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

Route::middleware('auth')->get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->name('dashboard');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dosen', AdminDosenController::class)->parameters(['dosen' => 'dosen']);
    Route::resource('/berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);
    Route::resource('/pengumuman', AdminPengumumanController::class)->parameters(['pengumuman' => 'pengumuman']);
    Route::resource('/galeri', AdminGaleriController::class)->parameters(['galeri' => 'galeri']);
    Route::get('/profil', [AdminProfilController::class, 'edit'])->name('profil.edit');
    Route::put('/profil', [AdminProfilController::class, 'update'])->name('profil.update');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
