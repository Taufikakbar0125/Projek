<?php
// =========================================================
// SIMPAN SEBAGAI: app/Http/Controllers/Public/PageController.php
// =========================================================
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class PageController extends Controller
{
    public function akreditasi()
    {
        // Semua key PDF akreditasi diambil sekaligus
        $pdfKeys = [];
        $prodiKeys = ['akreditasiteksippdf','akreditasiagropdf','akreditasiappdf','akreditasieppdf','akreditasipspdf'];
        foreach ($prodiKeys as $k) {
            for ($i = 1; $i <= 10; $i++) {
                $pdfKeys[] = $k . $i;
            }
        }
        $pdfKeys[] = 'akreditasiinstitusipdf';

        $settings = Setting::whereIn('key', $pdfKeys)->get()->keyBy('key');

        return view('pages.tableakreditasi', compact('settings'));
    }

    public function kotakSaran()
    {
        return view('pages.kotaksaran');
    }
}