<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\NavMenu;
use App\Models\Setting;
use App\Models\Information;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== USERS =====
        User::firstOrCreate(
            ['email' => 'superadmin@ugk.ac.id'],
            [
                'name'     => 'Super Admin UGK',
                'password' => Hash::make('Admin@1234'),
                'role'     => 'super_admin',
            ]
        );

        // ===== KATEGORI BERITA =====
        $categories = ['Akademik', 'Prestasi', 'Event', 'Pengumuman', 'Beasiswa', 'Penelitian'];
        foreach ($categories as $cat) {
            Category::firstOrCreate(
                ['slug' => \Illuminate\Support\Str::slug($cat)],
                ['name' => $cat]
            );
        }

        // ===== NAV MENU =====
        $menus = [
            ['label' => 'Beranda',    'url' => '/',        'sort_order' => 1],
            ['label' => 'Profil',     'url' => '/profil',  'sort_order' => 2],
            ['label' => 'Akademik',   'url' => null,       'sort_order' => 3],
            ['label' => 'Berita',     'url' => '/berita',  'sort_order' => 4],
            ['label' => 'Pengumuman', 'url' => '/pengumuman', 'sort_order' => 5],
        ];

        foreach ($menus as $menu) {
            NavMenu::firstOrCreate(
                ['label' => $menu['label']],
                ['url' => $menu['url'], 'sort_order' => $menu['sort_order'], 'is_active' => true]
            );
        }

        // Submenu Akademik
        $akademik = NavMenu::where('label', 'Akademik')->first();
        if ($akademik) {
            $submenus = [
                ['label' => 'Teknik Sipil',         'url' => '/prodi/teknik-sipil',         'sort_order' => 1],
                ['label' => 'Administrasi Publik',   'url' => '/prodi/administrasi-publik',   'sort_order' => 2],
                ['label' => 'Agroteknologi',         'url' => '/prodi/agroteknologi',         'sort_order' => 3],
                ['label' => 'Pembangunan Sosial',    'url' => '/prodi/pembangunan-sosial',    'sort_order' => 4],
                ['label' => 'Ekonomi Pembangunan',   'url' => '/prodi/ekonomi-pembangunan',   'sort_order' => 5],
                ['label' => 'Kalender Akademik',     'url' => '/kalender-akademik',           'sort_order' => 6],
            ];
            foreach ($submenus as $sub) {
                NavMenu::firstOrCreate(
                    ['label' => $sub['label'], 'parent_id' => $akademik->id],
                    ['url' => $sub['url'], 'sort_order' => $sub['sort_order'], 'is_active' => true]
                );
            }
        }

        // ===== SETTINGS DASAR =====
        $defaultSettings = [
            ['key' => 'webpmb',    'type' => 'link', 'text_value' => '#'],
            ['key' => 'siakad',    'type' => 'link', 'text_value' => '#'],
            ['key' => 'perpus',    'type' => 'link', 'text_value' => '#'],
            ['key' => 'youtube',   'type' => 'link', 'text_value' => '#'],
            ['key' => 'pmb',       'type' => 'link', 'text_value' => '#'],
            ['key' => 'instagram', 'type' => 'link', 'text_value' => '#'],
        ];
        foreach ($defaultSettings as $s) {
            Setting::firstOrCreate(['key' => $s['key']], $s);
        }

        // ===== INFORMASI STATISTIK KAMPUS =====
        $stats = [
            ['title' => 'Mahasiswa Aktif',  'slug' => 'mahasiswa-aktif',  'type' => 'statistik', 'value' => '1500'],
            ['title' => 'Dosen & Tendik',   'slug' => 'dosen-tendik',     'type' => 'statistik', 'value' => '120'],
            ['title' => 'Program Studi',    'slug' => 'program-studi',    'type' => 'statistik', 'value' => '5'],
            ['title' => 'Akreditasi Baik',  'slug' => 'akreditasi-baik',  'type' => 'statistik', 'value' => '5'],
        ];
        foreach ($stats as $stat) {
            Information::firstOrCreate(['slug' => $stat['slug']], $stat);
        }
    }
}
