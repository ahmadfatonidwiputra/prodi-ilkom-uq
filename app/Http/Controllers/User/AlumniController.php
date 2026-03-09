<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Alumni;
use Illuminate\View\View;

class AlumniController extends Controller
{
    public function index(): View
    {
        $alumnis = Alumni::latest('angkatan_lulus')->paginate(12);

        return view('user.alumni.index', compact('alumnis'));
    }
}
