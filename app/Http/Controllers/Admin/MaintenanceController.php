<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Maintenance;
use Illuminate\Http\Request;

class MaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = Maintenance::latest()->first() ?? new Maintenance([
            'is_active'    => false,
            'countdown_to' => null,
            'message'      => 'Website sedang dalam maintenance. Mohon tunggu.',
        ]);

        return view('admin.maintenance.index', compact('maintenance'));
    }

    public function toggle(Request $request)
    {
        $maintenance = Maintenance::latest()->first();

        if (!$maintenance) {
            $maintenance = Maintenance::create([
                'is_active' => true,
                'message'   => 'Website sedang dalam maintenance. Mohon tunggu.',
            ]);
        } else {
            $maintenance->update(['is_active' => !$maintenance->is_active]);
        }

        $status = $maintenance->fresh()->is_active ? 'aktif' : 'nonaktif';

        return redirect()->route('admin.maintenance.index')
            ->with('success', "Maintenance mode berhasil di{$status}kan.");
    }

    public function setTimer(Request $request)
    {
        $validated = $request->validate([
            'countdown_to' => 'required|date|after:now',
            'message'      => 'nullable|string|max:500',
        ], [
            'countdown_to.after' => 'Waktu selesai harus di masa yang akan datang.',
        ]);

        $maintenance = Maintenance::latest()->first();

        if (!$maintenance) {
            $validated['is_active'] = true;
            Maintenance::create($validated);
        } else {
            $maintenance->update($validated);
        }

        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Timer maintenance berhasil diperbarui.');
    }

    public function destroy(Maintenance $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.maintenance.index')
            ->with('success', 'Data maintenance berhasil dihapus.');
    }
}
