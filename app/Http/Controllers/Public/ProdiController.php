<?php
// =========================================================
// SIMPAN SEBAGAI: app/Http/Controllers/Public/ProdiController.php
// =========================================================
namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Setting;

class ProdiController extends Controller
{
    private function prodiData(string $bgKey, string $akreditasiKey): array
    {
        $settings = Setting::whereIn('key', [$bgKey, $akreditasiKey])->get()->keyBy('key');
        return [
            'bgImage'      => $settings->get($bgKey)?->getUrl() ?? '#',
            'akreditasiImg'=> $settings->get($akreditasiKey)?->getUrl() ?? '#',
        ];
    }

    public function teksip()
    {
        return view('pages.teksip', $this->prodiData('begteksip', 'akreditasiteksip'));
    }

    public function ap()
    {
        return view('pages.ap', $this->prodiData('begap', 'akreditasiap'));
    }

    public function agro()
    {
        return view('pages.agro', $this->prodiData('backagro', 'akreditasiagro'));
    }

    public function ps()
    {
        return view('pages.ps', $this->prodiData('begps', 'akreditasips'));
    }

    public function ep()
    {
        return view('pages.ep', $this->prodiData('begep', 'akreditasiep'));
    }
}