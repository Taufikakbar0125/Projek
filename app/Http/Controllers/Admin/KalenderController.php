<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kalender;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KalenderController extends Controller
{
    public function index()
    {
        $kalenders = Kalender::latest()->paginate(10);
        return view('admin.kalender.index', compact('kalenders'));
    }

    public function create()
    {
        return view('admin.kalender.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tahun_akademik' => 'required|string|max:20',
            'semester'       => 'required|in:Ganjil,Genap',
            'file_pdf'       => 'nullable|file|mimes:pdf|max:10240',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('file_pdf')) {
            $validated['file_pdf'] = $request->file('file_pdf')->store('kalender', 'public');
        }

        // Jika diaktifkan, nonaktifkan yang lain
        if ($request->boolean('is_active')) {
            Kalender::where('is_active', true)->update(['is_active' => false]);
        }

        $validated['is_active'] = $request->boolean('is_active');
        Kalender::create($validated);

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Kalender akademik berhasil ditambahkan.');
    }

    public function edit(Kalender $kalender)
    {
        return view('admin.kalender.edit', compact('kalender'));
    }

    public function update(Request $request, Kalender $kalender)
    {
        $validated = $request->validate([
            'tahun_akademik' => 'required|string|max:20',
            'semester'       => 'required|in:Ganjil,Genap',
            'file_pdf'       => 'nullable|file|mimes:pdf|max:10240',
            'is_active'      => 'boolean',
        ]);

        if ($request->hasFile('file_pdf')) {
            if ($kalender->file_pdf) Storage::disk('public')->delete($kalender->file_pdf);
            $validated['file_pdf'] = $request->file('file_pdf')->store('kalender', 'public');
        }

        if ($request->boolean('is_active')) {
            Kalender::where('id', '!=', $kalender->id)->update(['is_active' => false]);
        }

        $validated['is_active'] = $request->boolean('is_active');
        $kalender->update($validated);

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Kalender akademik berhasil diperbarui.');
    }

    public function destroy(Kalender $kalender)
    {
        if ($kalender->file_pdf) Storage::disk('public')->delete($kalender->file_pdf);
        $kalender->delete();

        return redirect()->route('admin.kalender.index')
            ->with('success', 'Kalender akademik berhasil dihapus.');
    }
}