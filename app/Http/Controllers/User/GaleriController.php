<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\View\View;

class GaleriController extends Controller
{
    public function index(): View
    {
        $galeris = Galeri::latest()->paginate(12);

        return view('user.galeri.index', compact('galeris'));
    }
}
