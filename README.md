# 🎓 Website Universitas Gunung Kidul (UGK)

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/Status-Production-28a745?style=for-the-badge" alt="Status">
</p>

Website resmi **Universitas Gunung Kidul** — dibangun dengan Laravel 12, menampilkan informasi akademik, berita kampus, pengumuman, profil universitas, dan panel admin yang lengkap.

---

## ✨ Fitur Utama

### 🌐 Halaman Publik
| Halaman | URL | Deskripsi |
|---------|-----|-----------|
| Beranda | `/` | Hero carousel, info kotak, berita, pengumuman, agenda |
| Berita | `/berita` | Daftar berita kampus terbaru |
| Pengumuman | `/pengumuman` | Arsip pengumuman resmi |
| Kalender Akademik | `/kalender-akademik` | Jadwal kegiatan akademik |
| Profil | `/profil` | Sejarah, visi-misi, struktur organisasi, peta kampus |
| Akreditasi | `/akreditasi` | Tabel akreditasi program studi |
| Kotak Saran | `/kotak-saran` | Form masukan dari masyarakat |

### 📚 Program Studi
| Prodi | URL |
|-------|-----|
| Teknik Sipil | `/prodi/teknik-sipil` |
| Administrasi Publik | `/prodi/administrasi-publik` |
| Agroteknologi | `/prodi/agroteknologi` |
| Pembangunan Sosial | `/prodi/pembangunan-sosial` |
| Ekonomi Pembangunan | `/prodi/ekonomi-pembangunan` |

### 🔧 Panel Admin
- **Dashboard** — statistik dan overview
- **Manajemen Berita** — CRUD berita dengan kategori
- **Pengumuman** — CRUD pengumuman dengan kategori penting/umum
- **Kalender Akademik** — CRUD agenda kampus
- **Fasilitas** — Kelola foto dan deskripsi fasilitas
- **Pengaturan** — Logo, link sosial media, slider carousel, link PMB
- **Menu Navigasi** — Drag-and-drop menu + submenu dinamis
- **Pengguna** — Manajemen akun admin
- **Mode Maintenance** — Tampilkan halaman maintenance saat diperlukan

### 📱 Responsif Mobile
- Navbar mobile dengan animasi smooth dropdown
- Topbar (Kalender, Tracer Study, Webmail) tersembunyi di mobile
- Carousel foto full tanpa crop di mobile
- Submenu level 3 (Prodi) dengan animasi smooth

---

## 🛠️ Tech Stack

| Teknologi | Versi | Kegunaan |
|-----------|-------|---------|
| **PHP** | 8.2+ | Backend language |
| **Laravel** | 12.x | Framework |
| **MySQL** | 8.0 | Database |
| **Bootstrap** | 5.3 | CSS Framework |
| **Font Awesome** | 6.x | Icon library |
| **Vanilla JS** | ES6+ | Frontend logic |

---

## ⚙️ Instalasi & Setup

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL 8.0
- Node.js (opsional, untuk build assets)

### Langkah Instalasi

**1. Clone repository**
```bash
git clone https://github.com/Taufikakbar0125/Projek.git
cd Projek
```

**2. Install dependencies PHP**
```bash
composer install
```

**3. Salin file environment**
```bash
cp .env.example .env
```

**4. Generate application key**
```bash
php artisan key:generate
```

**5. Konfigurasi database di `.env`**
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database_anda
DB_USERNAME=root
DB_PASSWORD=password_anda
```

**6. Jalankan migrasi database**
```bash
php artisan migrate
```

**7. Buat storage link**
```bash
php artisan storage:link
```

**8. Jalankan server lokal**
```bash
php artisan serve
```

Akses di: **http://localhost:8000**

---

## 🚀 Cara Deploy ke Production

**1. Set environment ke production di `.env`**
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.com
```

**2. Optimize aplikasi**
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

**3. Set permission storage**
```bash
chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache
```

---

## 📁 Struktur Direktori

```
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/          # Controller panel admin
│   │   ├── Auth/           # Controller autentikasi
│   │   └── Public/         # Controller halaman publik
│   ├── Models/             # Eloquent models
│   ├── Middleware/         # Custom middleware
│   └── Providers/          # Service providers & ViewComposers
├── public/
│   ├── css/
│   │   └── style.css       # CSS utama + responsive
│   └── js/
│       └── script.js       # JavaScript utama
├── resources/views/
│   ├── admin/              # Views panel admin
│   ├── includes/           # Navbar, footer (shared)
│   └── pages/              # Views halaman publik
├── routes/
│   ├── web.php             # Route publik
│   └── admin.php           # Route admin (auth protected)
└── database/migrations/    # Database schema
```

---

## 🔐 Akses Admin

URL: `/admin` atau `/login`

> ⚠️ Buat user admin pertama via seeder atau tinker:
```bash
php artisan tinker
# Kemudian:
App\Models\User::create([
    'name' => 'Admin',
    'email' => 'admin@ugk.ac.id',
    'password' => bcrypt('password'),
    'role' => 'admin'
]);
```

---

## 🔒 Keamanan

- File `.env` **tidak di-push** ke repository (ada di `.gitignore`)
- `APP_KEY` harus di-generate ulang di server production
- Password database harus diubah dari default

---

## 📝 Changelog

### v1.0.0 — Initial Release
- ✅ Website publik lengkap (Beranda, Profil, Berita, Prodi, dll)
- ✅ Panel admin dengan autentikasi
- ✅ Navbar mobile responsif dengan smooth dropdown animation
- ✅ Topbar tersembunyi di mobile
- ✅ Carousel foto full tanpa crop di mobile
- ✅ Submenu level 3 (Prodi) smooth animation
- ✅ Mode maintenance

---

## 👨‍💻 Developer

**Taufik Akbar** — [@Taufikakbar0125](https://github.com/Taufikakbar0125)

---

## 📄 Lisensi

Project ini dikembangkan untuk keperluan **Universitas Gunung Kidul**.
Seluruh hak cipta dilindungi © 2024-2025 Universitas Gunung Kidul.
