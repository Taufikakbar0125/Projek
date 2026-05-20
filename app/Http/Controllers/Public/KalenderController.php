<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Kalender;
use App\Models\Pengumuman;

class KalenderController extends Controller
{
    public function index()
    {
        // Ambil kalender yang aktif, bukan sekedar yang terbaru
        $setup = Kalender::where('is_active', true)->latest()->first();

        // Fallback: jika tidak ada yang aktif, ambil yang terbaru
        if (!$setup) {
            $setup = Kalender::latest()->first();
        }

        $announcements = Pengumuman::orderBy('tanggal', 'desc')->take(5)->get();

        return view('pages.kalender', compact('setup', 'announcements'));
    }
}
