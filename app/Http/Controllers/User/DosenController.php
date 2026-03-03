<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Dosen;
use Illuminate\View\View;

class DosenController extends Controller
{
    public function index(): View
    {
        $dosens = Dosen::latest()->paginate(12);

        return view('user.dosen', compact('dosens'));
    }
}
