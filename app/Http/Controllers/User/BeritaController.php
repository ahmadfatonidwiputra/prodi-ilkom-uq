<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\View\View;

class BeritaController extends Controller
{
    public function index(): View
    {
        $beritas = Berita::latest()->paginate(9);

        return view('user.berita.index', compact('beritas'));
    }

    public function show(Berita $berita): View
    {
        return view('user.berita.show', compact('berita'));
    }
}
