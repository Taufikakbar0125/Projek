<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::with('category', 'user');

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category_id', $request->category);
        }

        $news       = $query->latest()->paginate(15)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.news.index', compact('news', 'categories'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Quill mengirim HTML seperti <p><br></p> saat kosong — strip dulu untuk validasi
        $request->merge([
            'content' => $request->input('content', ''),
        ]);

        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty(trim(strip_tags($value)))) {
                        $fail('Konten berita tidak boleh kosong.');
                    }
                },
            ],
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:pending,published',
            'published_at'=> 'nullable|date',
        ]);

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => $request->status,
            'published_at'=> $request->published_at,
            // FIX: slug pakai unique check numerik, bukan random suffix
            // Random suffix membuat slug berbeda tiap kali judul sama
            'slug'        => $this->generateUniqueSlug($request->title),
            'user_id'     => auth()->id(),
            'views'       => 0,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['status'] === 'published' && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit(News $news)
    {
        $categories = Category::orderBy('name')->get();
        return view('admin.news.edit', compact('news', 'categories'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'content'     => [
                'required',
                function ($attribute, $value, $fail) {
                    if (empty(trim(strip_tags($value)))) {
                        $fail('Konten berita tidak boleh kosong.');
                    }
                },
            ],
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'status'      => 'required|in:pending,published',
            'published_at'=> 'nullable|date',
        ]);

        $data = [
            'title'       => $request->title,
            'category_id' => $request->category_id,
            'content'     => $request->content,
            'status'      => $request->status,
            'published_at'=> $request->published_at,
        ];

        if ($request->hasFile('image')) {
            if ($news->image) Storage::disk('public')->delete($news->image);
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        if ($data['status'] === 'published' && empty($news->published_at)) {
            $data['published_at'] = now();
        }

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy(News $news)
    {
        if ($news->image) Storage::disk('public')->delete($news->image);
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * Generate slug unik dengan suffix numerik jika ada duplikat.
     * Contoh: "berita-kampus", "berita-kampus-2", "berita-kampus-3"
     * Lebih deterministik dan SEO-friendly daripada random suffix.
     */
    protected function generateUniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i    = 2;

        while (News::where('slug', $slug)->exists()) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
