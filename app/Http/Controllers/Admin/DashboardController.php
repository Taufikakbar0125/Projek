<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\User;
use App\Models\Pengumuman;

class DashboardController extends Controller
{
    public function index()
    {
        // Satu query untuk status berita
        $newsStats = News::selectRaw("
            COUNT(*) as total,
            SUM(CASE WHEN status = 'pending' THEN 1 ELSE 0 END) as pending,
            SUM(CASE WHEN status = 'published' THEN 1 ELSE 0 END) as published,
            SUM(views) as total_views
        ")->first();

        $stats = [
            'pending'     => $newsStats->pending ?? 0,
            'published'   => $newsStats->published ?? 0,
            'total_views' => $newsStats->total_views ?? 0,
            'total_users' => User::count(),
            'pengumuman'  => Pengumuman::count(),
        ];

        $pendingNews = News::where('status', 'pending')
            ->with('category', 'user')
            ->latest()
            ->take(10)
            ->get();

        $latestNews = News::where('status', 'published')
            ->with('category')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('admin.dashboard.index', compact('stats', 'pendingNews', 'latestNews'));
    }
}
