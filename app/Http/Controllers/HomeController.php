<?php

namespace App\Http\Controllers;

use App\Models\ProfilProdi;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('welcome');
    }

    public function profil(): View
    {
        $profil = ProfilProdi::latest()->first();

        return view('profil', compact('profil'));
    }

    public function visiMisi(): View
    {
        $profil = ProfilProdi::latest()->first();

        return view('visi-misi', compact('profil'));
    }

    public function kontak(): View
    {
        return view('kontak');
    }
}
