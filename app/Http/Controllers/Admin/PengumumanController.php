<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengumumanController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengumuman::query();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('kategori') && $request->kategori !== 'all') {
            $query->where('kategori', $request->kategori);
        }

        $pengumuman = $query->orderBy('tanggal', 'desc')->paginate(15)->withQueryString();

        return view('admin.pengumuman.index', compact('pengumuman'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'tanggal'  => 'required|date',
            'kategori' => 'required|in:Penting,Akademik,Umum',
            'isi'      => 'nullable|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('pengumuman', 'public');
        }

        Pengumuman::create($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $validated = $request->validate([
            'judul'    => 'required|string|max:255',
            'tanggal'  => 'required|date',
            'kategori' => 'required|in:Penting,Akademik,Umum',
            'isi'      => 'nullable|string',
            'file_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($pengumuman->file_pdf) Storage::disk('public')->delete($pengumuman->file_pdf);
            $validated['file_pdf'] = $request->file('file_pdf')->store('pengumuman', 'public');
        }

        $pengumuman->update($validated);

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil diperbarui.');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        if ($pengumuman->file_pdf) Storage::disk('public')->delete($pengumuman->file_pdf);
        $pengumuman->delete();

        return redirect()->route('admin.pengumuman.index')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}