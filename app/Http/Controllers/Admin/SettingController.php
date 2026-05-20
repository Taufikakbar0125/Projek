<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::orderBy('key')->get()->groupBy(function ($item) {
            if (str_starts_with($item->key, 'slide'))      return 'Slide / Carousel';
            if (str_starts_with($item->key, 'akreditasi')) return 'Akreditasi';
            if (str_starts_with($item->key, 'beg') || str_starts_with($item->key, 'back')) return 'Background Prodi';
            if (in_array($item->key, ['rektor','warek1','warek2','warek3','dekanft','dekanfp','dekanfe','dekanfisipol'])) return 'Foto Pimpinan';
            if (in_array($item->key, ['webpmb','siakad','perpus','youtube','pmb','instagram','tracer','webmail','logo_utama','saintek','fishum','feb','kalender'])) return 'Link & Logo';
            return 'Lainnya';
        });

        return view('admin.setting.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'key'  => 'required|string|max:100',
            'type' => 'required|in:text,link,image,pdf',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,webp,pdf|max:5120',
        ]);

        $setting = Setting::firstOrNew(['key' => $request->key]);

        if ($request->hasFile('file')) {
            // Hapus file lama
            if ($setting->value && in_array($setting->type, ['image','pdf'])) {
                Storage::disk('public')->delete($setting->value);
            }
            $setting->value = $request->file('file')->store('settings', 'public');
            $setting->type  = $request->type;
        } else {
            $setting->value = $request->input('value');
            $setting->type  = $request->type;
        }

        $setting->save();

        return redirect()->route('admin.setting.index')
            ->with('success', 'Setting "' . $request->key . '" berhasil diperbarui.');
    }

    public function destroy(Setting $setting)
    {
        if ($setting->value && in_array($setting->type, ['image','pdf'])) {
            Storage::disk('public')->delete($setting->value);
        }
        $setting->delete();

        return redirect()->route('admin.setting.index')
            ->with('success', 'Setting berhasil dihapus.');
    }
}
