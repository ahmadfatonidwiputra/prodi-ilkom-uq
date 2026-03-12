<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Admin\SiteContentController;
use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Support\Facades\Schema;
use Illuminate\View\View;

class SitePageController extends Controller
{
    public function show(string $section): View
    {
        $config = SiteContentController::sections()[$section] ?? null;

        abort_unless($config, 404);

        $content = Schema::hasTable('site_contents')
            ? SiteContent::where('key', $config['key'])->first()
            : null;

        return view('user.site-content.show', compact('content', 'config', 'section'));
    }
}
