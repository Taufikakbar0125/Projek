<?php

namespace App\Providers;

use App\Models\News;
use App\Models\NavMenu;
use App\Models\Setting;
use App\Models\Maintenance;
use App\Observers\NewsObserver;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Paginator::useBootstrapFive();
        News::observe(NewsObserver::class);

        // Share $navMenus dan $footerSettings ke semua view public — cache 1 jam
        View::composer(['pages.*', 'includes.*', 'errors.*'], function ($view) {

            // NavMenu — cache-nya di-clear oleh NavMenu::booted() di model (tidak perlu dobel di sini)
            $menus = Cache::remember('nav_menus', 3600, function () {
                return NavMenu::whereNull('parent_id')
                    ->where('is_active', true)
                    ->orderBy('sort_order')
                    ->with(['children' => function ($q) {
                        $q->where('is_active', true)
                          ->orderBy('sort_order')
                          ->with(['children' => function ($q2) {
                              $q2->where('is_active', true)->orderBy('sort_order');
                          }]);
                    }])
                    ->get();
            });
            $view->with('navMenus', $menus);

            // Batch load navbar + footer settings dalam 1 query, cache 1 jam.
            // Menggantikan Setting::getLink() individual di navbar.blade.php dan footer.blade.php.
            // Tambahan 'logo_utama' untuk navbar logo.
            $footerSettings = Cache::remember('footer_settings', 3600, function () {
                $keys = [
                    'instagram', 'youtube', 'saintek', 'fishum', 'feb',
                    'perpus', 'pmb', 'siakad', 'kalender', 'tracer', 'webmail',
                    'logo_utama',
                ];
                return Setting::whereIn('key', $keys)->get()->keyBy('key');
            });
            $view->with('footerSettings', $footerSettings);
        });

        // Cache maintenance — di-clear di sini karena Maintenance model tidak punya booted()
        Maintenance::saved(function () {
            Cache::forget('maintenance_active');
            Cache::forget('maintenance_data');
            Cache::forget('maintenance_countdown');
        });
        Maintenance::deleted(function () {
            Cache::forget('maintenance_active');
            Cache::forget('maintenance_data');
            Cache::forget('maintenance_countdown');
        });

        // Cache footer_settings — di-clear saat ada Setting yang berubah
        Setting::saved(fn()   => Cache::forget('footer_settings'));
        Setting::deleted(fn() => Cache::forget('footer_settings'));
    }
}
