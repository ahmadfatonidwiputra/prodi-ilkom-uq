<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ProfilProdi;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('user.home');
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
