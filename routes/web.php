<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\BeritaController;
use App\Http\Controllers\Public\PengumumanController;
use App\Http\Controllers\Public\KalenderController;
use App\Http\Controllers\Public\ProfilController;
use App\Http\Controllers\Public\ProdiController;
use App\Http\Controllers\Public\PageController;

Route::middleware(['maintenance'])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');

    Route::get('/berita', [BeritaController::class, 'index'])->name('berita');
    Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.detail');

    Route::get('/pengumuman', [PengumumanController::class, 'index'])->name('pengumuman');
    Route::get('/pengumuman/detail/{id}', [PengumumanController::class, 'show'])->name('pengumuman.detail');

    Route::get('/kalender-akademik', [KalenderController::class, 'index'])->name('kalender');

    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');

    /*
     * FIX: redirect('/profil#anchor') tidak berfungsi — browser strip fragment (#)
     * saat server-side 302 redirect. Solusi: kirim ?section= lalu JS scroll ke target.
     * profil.blade.php sudah punya scroll JS yang membaca params.get('section').
     */
    Route::get('/profil/sejarah',             fn() => redirect('/profil?section=sejarah'));
    Route::get('/profil/visi-misi',           fn() => redirect('/profil?section=visi-misi'));
    Route::get('/profil/struktur-organisasi', fn() => redirect('/profil?section=struktur'));
    Route::get('/profil/peta-kampus',         fn() => redirect('/profil?section=peta'));

    Route::get('/prodi/teknik-sipil',          [ProdiController::class, 'teksip'])->name('teksip');
    Route::get('/prodi/administrasi-publik',   [ProdiController::class, 'ap'])->name('ap');
    Route::get('/prodi/agroteknologi',         [ProdiController::class, 'agro'])->name('agro');
    Route::get('/prodi/pembangunan-sosial',    [ProdiController::class, 'ps'])->name('ps');
    Route::get('/prodi/ekonomi-pembangunan',   [ProdiController::class, 'ep'])->name('ep');

    Route::get('/akreditasi',  [PageController::class, 'akreditasi'])->name('akreditasi');
    Route::get('/kotak-saran', [PageController::class, 'kotakSaran'])->name('kotak.saran');
});
