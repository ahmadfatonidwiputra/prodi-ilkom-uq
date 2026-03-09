<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use Illuminate\View\View;

class KurikulumController extends Controller
{
    public function index(): View
    {
        $kurikulums = Kurikulum::orderBy('semester')->orderBy('kode_mk')->paginate(12);

        return view('user.kurikulum.index', compact('kurikulums'));
    }
}
