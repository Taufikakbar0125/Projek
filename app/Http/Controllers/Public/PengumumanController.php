<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('kategori', $request->category);
        }

        $all_pengumuman = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();

        // Hitung total per kategori — satu query dengan groupBy lebih efisien
        $kategoris = Pengumuman::selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $total_penting  = $kategoris->get('Penting', 0);
        $total_akademik = $kategoris->get('Akademik', 0);
        $total_umum     = $kategoris->get('Umum', 0);

        return view('pages.pengumuman', compact(
            'all_pengumuman', 'total_penting', 'total_akademik', 'total_umum'
        ));
    }

    public function show(int $id)
    {
        $pengumuman = Pengumuman::findOrFail($id);
        return view('pages.pengumumanglobal', compact('pengumuman'));
    }
}
