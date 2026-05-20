<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = News::published()->with('category');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->whereHas('category', fn($q) =>
                $q->where('slug', $request->category)
            );
        }

        $all_news   = $query->latest('published_at')->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('pages.berita', compact('all_news', 'categories'));
    }

    public function show(string $slug)
    {
        $berita = News::where('slug', $slug)
            ->published()
            ->with('category')
            ->firstOrFail();

        // Increment views — tidak trigger Observer
        News::where('id', $berita->id)->increment('views');

        // Berita lain yang sudah published
        $others = News::published()
            ->where('id', '!=', $berita->id)
            ->with('category')
            ->latest('published_at')
            ->take(5)
            ->get();

        return view('pages.beritaglobal', compact('berita', 'others'));
    }
}
