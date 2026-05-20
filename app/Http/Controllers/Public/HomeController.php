<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Pengumuman;
use App\Models\Information;
use App\Models\Facility;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        // 3 berita terbaru published
        $news = News::published()
            ->with('category')
            ->latest('published_at')
            ->take(3)
            ->get();

        // 3 pengumuman terbaru
        $list_pengumuman = Pengumuman::orderBy('tanggal', 'desc')
            ->take(3)
            ->get();

        // Agenda mendatang (type=agenda) — filter pakai event_date, bukan created_at
        $agendas = Information::where('type', 'agenda')
            ->where(function ($q) {
                $q->whereDate('event_date', '>=', now()->toDateString())
                  ->orWhereNull('event_date'); // fallback: tampil jika event_date belum diisi
            })
            ->orderBy('event_date', 'asc')
            ->take(3)
            ->get();

        // Fasilitas kampus
        $facilities = Facility::orderBy('sort_order', 'asc')->get();

        // Slide teks carousel — query sekali, dipakai di controller bukan di view
        $slideTexts = Information::whereIn('slug', [
            'carousel-slide-1', 'carousel-slide-2',
            'carousel-slide-3', 'carousel-slide-4',
        ])->get()->keyBy('slug');

        // Statistik kampus
        $stats = Information::whereIn('slug', [
            'mahasiswa-aktif', 'dosen-tendik',
            'program-studi', 'akreditasi-baik',
        ])->get()->keyBy('slug');

        // Semua setting homepage dalam 1 query
        $settingKeys = ['slide1','slide2','slide3','slide4','webpmb','siakad','perpus','youtube','pmb','instagram'];
        $settings = Setting::whereIn('key', $settingKeys)->get()->keyBy('key');

        return view('pages.index', compact(
            'news', 'list_pengumuman', 'agendas', 'facilities',
            'slideTexts', 'stats', 'settings'
        ));
    }
}
