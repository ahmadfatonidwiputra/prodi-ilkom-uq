<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\View\View;

class FasilitasController extends Controller
{
    public function index(): View
    {
        $fasilitas = Fasilitas::orderBy('urutan')->latest()->paginate(12);

        return view('user.fasilitas.index', compact('fasilitas'));
    }
}
