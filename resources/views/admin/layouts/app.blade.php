<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Panel') — UGK</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-w: 260px;
            --primary: #1a56db;
            --primary-dark: #1e429f;
            --sidebar-bg: #0f172a;
            --sidebar-hover: #1e293b;
            --sidebar-active: #1a56db;
            --topbar-h: 64px;
        }
        * { box-sizing: border-box; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            margin: 0;
        }

        /* ======= SIDEBAR ======= */
        #sidebar {
            position: fixed;
            top: 0; left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--sidebar-bg);
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }
        .sidebar-brand {
            padding: 20px 20px 16px;
            border-bottom: 1px solid #1e293b;
            flex-shrink: 0;
        }
        .sidebar-brand img { height: 36px; object-fit: contain; }
        .sidebar-brand-text { color: #fff; font-weight: 700; font-size: 15px; line-height: 1.2; }
        .sidebar-brand-sub { color: #64748b; font-size: 11px; }

        .sidebar-menu { padding: 12px 0; flex: 1; }
        .sidebar-section {
            padding: 16px 20px 6px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.2px;
            color: #475569;
            text-transform: uppercase;
        }
        .sidebar-item { list-style: none; }
        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 9px 20px;
            color: #94a3b8;
            text-decoration: none;
            font-size: 13.5px;
            font-weight: 500;
            transition: all 0.15s;
            border-left: 3px solid transparent;
        }
        .sidebar-link:hover {
            color: #e2e8f0;
            background: var(--sidebar-hover);
        }
        .sidebar-link.active {
            color: #fff;
            background: rgba(26, 86, 219, 0.15);
            border-left-color: var(--sidebar-active);
        }
        .sidebar-link i { font-size: 16px; width: 18px; text-align: center; }

        .sidebar-footer {
            padding: 16px 20px;
            border-top: 1px solid #1e293b;
            flex-shrink: 0;
        }
        .sidebar-user { display: flex; align-items: center; gap: 10px; }
        .sidebar-avatar {
            width: 34px; height: 34px;
            border-radius: 50%;
            background: var(--primary);
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-weight: 700; font-size: 14px;
            flex-shrink: 0;
        }
        .sidebar-user-name { color: #e2e8f0; font-size: 13px; font-weight: 600; }
        .sidebar-user-role { color: #64748b; font-size: 11px; }

        /* ======= MAIN CONTENT ======= */
        #main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .topbar {
            position: sticky; top: 0;
            height: var(--topbar-h);
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            display: flex; align-items: center;
            padding: 0 24px;
            gap: 16px;
            z-index: 100;
            box-shadow: 0 1px 3px rgba(0,0,0,0.06);
        }
        .topbar-title { font-weight: 700; font-size: 17px; color: #0f172a; flex: 1; }
        .topbar-badge {
            background: #fef3c7; color: #92400e;
            font-size: 11px; font-weight: 600;
            padding: 3px 10px; border-radius: 20px;
        }

        .page-content { padding: 28px 28px; flex: 1; }

        /* ======= CARD ======= */
        .card {
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 1px 4px rgba(0,0,0,0.04);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #f1f5f9;
            border-radius: 12px 12px 0 0 !important;
            padding: 16px 20px;
            font-weight: 600;
            font-size: 14px;
        }

        /* ======= STAT CARDS ======= */
        .stat-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
        }
        .stat-icon {
            width: 44px; height: 44px; border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
            font-size: 20px;
        }
        .stat-value { font-size: 26px; font-weight: 700; color: #0f172a; }
        .stat-label { font-size: 12px; color: #64748b; font-weight: 500; }

        /* ======= TABLE ======= */
        .table { font-size: 13.5px; }
        .table th { font-weight: 600; color: #475569; font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; }
        .table td { vertical-align: middle; }

        /* ======= BADGE STATUS ======= */
        .badge-published { background: #dcfce7; color: #15803d; font-size: 11px; }
        .badge-pending   { background: #fef9c3; color: #a16207; font-size: 11px; }
        .badge-archived  { background: #f1f5f9; color: #64748b; font-size: 11px; }

        /* ======= FORM ======= */
        .form-label { font-weight: 600; font-size: 13px; color: #374151; }
        .form-control, .form-select {
            font-size: 13.5px;
            border-radius: 8px;
            border: 1px solid #d1d5db;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
            font-size: 13.5px;
        }
        .btn-primary:hover { background: var(--primary-dark); border-color: var(--primary-dark); }

        /* ======= ALERT ======= */
        .alert { border-radius: 10px; font-size: 13.5px; border: none; }
        .alert-success { background: #dcfce7; color: #15803d; }
        .alert-danger   { background: #fee2e2; color: #991b1b; }

        /* ======= RESPONSIVE ======= */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #main { margin-left: 0; }
            .page-content { padding: 16px; }
        }
    </style>
    @stack('styles')
</head>
<body>

<!-- ======= SIDEBAR ======= -->
<nav id="sidebar">
    <div class="sidebar-brand">
        <div class="sidebar-brand-text">UGK Admin</div>
        <div class="sidebar-brand-sub">Panel Manajemen Website</div>
    </div>

    <div class="sidebar-menu">
        <ul class="list-unstyled mb-0">

            <li class="sidebar-section">Utama</li>

            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-grid-1x2"></i> Dashboard
                </a>
            </li>

            <li class="sidebar-section">Konten</li>

            <li class="sidebar-item">
                <a href="{{ route('admin.news.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.news.*') ? 'active' : '' }}">
                    <i class="bi bi-newspaper"></i> Berita
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.categories.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="bi bi-tag"></i> Kategori
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.pengumuman.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.pengumuman.*') ? 'active' : '' }}">
                    <i class="bi bi-megaphone"></i> Pengumuman
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.kalender.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.kalender.*') ? 'active' : '' }}">
                    <i class="bi bi-calendar3"></i> Kalender Akademik
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.facility.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.facility.*') ? 'active' : '' }}">
                    <i class="bi bi-building"></i> Fasilitas
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.information.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.information.*') ? 'active' : '' }}">
                    <i class="bi bi-info-circle"></i> Informasi
                </a>
            </li>

            <li class="sidebar-section">Pengaturan</li>

            <li class="sidebar-item">
                <a href="{{ route('admin.navmenu.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.navmenu.*') ? 'active' : '' }}">
                    <i class="bi bi-list-nested"></i> Menu Navigasi
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.setting.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.setting.*') ? 'active' : '' }}">
                    <i class="bi bi-gear"></i> Pengaturan Web
                </a>
            </li>

            @if(auth()->user()->hasMinRole('admin'))
            <li class="sidebar-item">
                <a href="{{ route('admin.users.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Manajemen User
                </a>
            </li>
            @endif

            @if(auth()->user()->isSuperAdmin())
            <li class="sidebar-item">
                <a href="{{ route('admin.maintenance.index') }}"
                   class="sidebar-link {{ request()->routeIs('admin.maintenance.*') ? 'active' : '' }}">
                    <i class="bi bi-tools"></i> Maintenance
                </a>
            </li>
            @endif

            <li class="sidebar-section">Website</li>

            <li class="sidebar-item">
                <a href="{{ url('/') }}" target="_blank" class="sidebar-link">
                    <i class="bi bi-box-arrow-up-right"></i> Lihat Website
                </a>
            </li>
        </ul>
    </div>

    <div class="sidebar-footer">
        <div class="sidebar-user">
            <div class="sidebar-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            <div>
                <div class="sidebar-user-name">{{ auth()->user()->name }}</div>
                <div class="sidebar-user-role">{{ ucfirst(str_replace('_', ' ', auth()->user()->role)) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-sm w-100 text-start sidebar-link"
                    style="background:none;border:none;padding:8px 0;color:#ef4444;font-size:13px;">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</nav>

<!-- ======= MAIN CONTENT ======= -->
<div id="main">
    <!-- Topbar -->
    <div class="topbar">
        <button class="btn btn-sm d-md-none" onclick="document.getElementById('sidebar').classList.toggle('show')">
            <i class="bi bi-list fs-5"></i>
        </button>
        <div class="topbar-title">@yield('page-title', 'Dashboard')</div>
        @yield('topbar-actions')
    </div>

    <!-- Flash Messages -->
    <div class="px-4 pt-3">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible d-flex align-items-center gap-2 fade show">
                <i class="bi bi-check-circle-fill"></i>
                {{ session('success') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible d-flex align-items-center gap-2 fade show">
                <i class="bi bi-exclamation-circle-fill"></i>
                {{ session('error') }}
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <strong>Ada kesalahan:</strong>
                <ul class="mb-0 mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Page Content -->
    <div class="page-content">
        @yield('content')
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
