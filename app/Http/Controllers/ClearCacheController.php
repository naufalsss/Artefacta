<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class ClearCacheController extends Controller
{
    public function index()
    {
        // Clear semua cache Laravel
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');

        return "✅ Cache cleared, Laravel siap jalan di hosting!";
    }
}
