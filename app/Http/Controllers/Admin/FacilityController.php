<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FacilityController extends Controller
{
    public function index()
    {
        $facilities = Facility::orderBy('sort_order')->paginate(15);
        return view('admin.facility.index', compact('facilities'));
    }

    public function create()
    {
        return view('admin.facility.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        $validated['sort_order'] = $request->input('sort_order', 0);
        Facility::create($validated);

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function edit(Facility $facility)
    {
        return view('admin.facility.edit', compact('facility'));
    }

    public function update(Request $request, Facility $facility)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'description'=> 'nullable|string',
            'image'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sort_order' => 'nullable|integer|min:0',
        ]);

        if ($request->hasFile('image')) {
            if ($facility->image) Storage::disk('public')->delete($facility->image);
            $validated['image'] = $request->file('image')->store('facilities', 'public');
        }

        $facility->update($validated);

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroy(Facility $facility)
    {
        if ($facility->image) Storage::disk('public')->delete($facility->image);
        $facility->delete();

        return redirect()->route('admin.facility.index')
            ->with('success', 'Fasilitas berhasil dihapus.');
    }
}