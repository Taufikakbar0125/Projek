<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\KalenderController;
use App\Http\Controllers\Admin\FacilityController;
use App\Http\Controllers\Admin\InformationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\NavMenuController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MaintenanceController;

// Semua route admin wajib login (middleware admin = minimal role 'staff')
Route::middleware(['admin'])->group(function () {

    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Berita
    Route::resource('news', NewsController::class)->names([
        'index'   => 'admin.news.index',
        'create'  => 'admin.news.create',
        'store'   => 'admin.news.store',
        'show'    => 'admin.news.show',
        'edit'    => 'admin.news.edit',
        'update'  => 'admin.news.update',
        'destroy' => 'admin.news.destroy',
    ]);

    // Kategori — hanya admin ke atas
    Route::resource('categories', CategoryController::class)->names([
        'index'   => 'admin.categories.index',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ])->middleware('admin:admin');

    // Pengumuman
    Route::resource('pengumuman', PengumumanController::class)->names([
        'index'   => 'admin.pengumuman.index',
        'create'  => 'admin.pengumuman.create',
        'store'   => 'admin.pengumuman.store',
        'edit'    => 'admin.pengumuman.edit',
        'update'  => 'admin.pengumuman.update',
        'destroy' => 'admin.pengumuman.destroy',
    ]);

    // Kalender Akademik — admin ke atas
    Route::resource('kalender', KalenderController::class)->names([
        'index'   => 'admin.kalender.index',
        'create'  => 'admin.kalender.create',
        'store'   => 'admin.kalender.store',
        'edit'    => 'admin.kalender.edit',
        'update'  => 'admin.kalender.update',
        'destroy' => 'admin.kalender.destroy',
    ])->middleware('admin:admin');

    // Fasilitas — admin ke atas
    Route::resource('facility', FacilityController::class)->names([
        'index'   => 'admin.facility.index',
        'create'  => 'admin.facility.create',
        'store'   => 'admin.facility.store',
        'edit'    => 'admin.facility.edit',
        'update'  => 'admin.facility.update',
        'destroy' => 'admin.facility.destroy',
    ])->middleware('admin:admin');

    // Informasi Kampus — admin ke atas
    Route::resource('information', InformationController::class)->names([
        'index'   => 'admin.information.index',
        'create'  => 'admin.information.create',
        'store'   => 'admin.information.store',
        'edit'    => 'admin.information.edit',
        'update'  => 'admin.information.update',
        'destroy' => 'admin.information.destroy',
    ])->middleware('admin:admin');

    // Pengaturan Web — admin ke atas
    Route::get('setting', [SettingController::class, 'index'])->name('admin.setting.index')->middleware('admin:admin');
    Route::post('setting', [SettingController::class, 'update'])->name('admin.setting.update')->middleware('admin:admin');
    Route::delete('setting/{setting}', [SettingController::class, 'destroy'])->name('admin.setting.destroy')->middleware('admin:admin');

    // Menu Navigasi — admin ke atas
    Route::resource('navmenu', NavMenuController::class)->names([
        'index'   => 'admin.navmenu.index',
        'create'  => 'admin.navmenu.create',
        'store'   => 'admin.navmenu.store',
        'edit'    => 'admin.navmenu.edit',
        'update'  => 'admin.navmenu.update',
        'destroy' => 'admin.navmenu.destroy',
    ])->middleware('admin:admin');

    // Manajemen User — admin ke atas
    Route::resource('users', UserController::class)->names([
        'index'   => 'admin.users.index',
        'create'  => 'admin.users.create',
        'store'   => 'admin.users.store',
        'edit'    => 'admin.users.edit',
        'update'  => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ])->middleware('admin:admin');

    // Maintenance — hanya super_admin
    Route::get('maintenance', [MaintenanceController::class, 'index'])->name('admin.maintenance.index')->middleware('admin:super_admin');
    Route::post('maintenance/toggle', [MaintenanceController::class, 'toggle'])->name('admin.maintenance.toggle')->middleware('admin:super_admin');
    Route::post('maintenance/timer', [MaintenanceController::class, 'setTimer'])->name('admin.maintenance.timer')->middleware('admin:super_admin');
    Route::delete('maintenance/{maintenance}', [MaintenanceController::class, 'destroy'])->name('admin.maintenance.destroy')->middleware('admin:super_admin');
});
