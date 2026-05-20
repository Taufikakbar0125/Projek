<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index(Request $request)
    {
        $query = Information::query();

        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $information = $query->latest()->paginate(15)->withQueryString();
        return view('admin.information.index', compact('information'));
    }

    public function create()
    {
        return view('admin.information.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:information,slug',
            'type'       => 'required|in:agenda,statistik,carousel,lainnya',
            'value'      => 'nullable|string|max:255',
            'content'    => 'nullable|string',
            'color'      => 'nullable|string|max:20',
            'subtitle'   => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
        ]);

        // Pastikan color selalu tersimpan dengan default jika kosong
        $validated['color'] = $validated['color'] ?? '#0d6efd';

        Information::create($validated);

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi berhasil ditambahkan.');
    }

    public function edit(Information $information)
    {
        return view('admin.information.edit', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        $validated = $request->validate([
            'title'      => 'required|string|max:255',
            'slug'       => 'required|string|max:255|unique:information,slug,' . $information->id,
            'type'       => 'required|in:agenda,statistik,carousel,lainnya',
            'value'      => 'nullable|string|max:255',
            'content'    => 'nullable|string',
            'color'      => 'nullable|string|max:20',
            'subtitle'   => 'nullable|string|max:255',
            'event_date' => 'nullable|date',
        ]);

        $validated['color'] = $validated['color'] ?? '#0d6efd';

        $information->update($validated);

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi berhasil diperbarui.');
    }

    public function destroy(Information $information)
    {
        $information->delete();

        return redirect()->route('admin.information.index')
            ->with('success', 'Informasi berhasil dihapus.');
    }
}
