<?php
// =========================================================
// SIMPAN SEBAGAI: app/Http/Controllers/Public/ProfilController.php
// =========================================================
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class ProfilController extends Controller
{
    public function index()
    {
        // Semua key foto struktural diambil sekaligus
        $keys = ['rektor','warek1','warek2','warek3','dekanft','dekanfp','dekanfe','dekanfisipol'];
        $fotoSettings = Setting::whereIn('key', $keys)->get()->keyBy('key');
        return view('pages.profil', compact('fotoSettings'));
    }
}