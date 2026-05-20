{{--
    navbar.blade.php
    FIX: Ganti Setting::getLink('tracer'), Setting::getLink('webmail'), Setting::getLink('logo_utama')
    dengan $footerSettings yang sudah di-inject ViewComposer (batch 1 query, cache 1 jam).
    Tidak ada query DB atau cache-lookup individual di file ini.
--}}

{{-- 1. TOPBAR (hidden di mobile via CSS) --}}
<div class="bg-primary text-white py-2 topbar-mobile-hide">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('kalender') }}" class="text-white text-decoration-none small">
                        <i class="fas fa-calendar-alt me-1"></i> Kalender Akademik
                    </a>
                    <a href="{{ optional($footerSettings->get('tracer'))->getUrl() ?? '#' }}"
                       class="text-white text-decoration-none small" target="_blank" rel="noopener">
                        <i class="fas fa-graduation-cap me-1"></i> Tracer Study
                    </a>
                    <a href="{{ optional($footerSettings->get('webmail'))->getUrl() ?? '#' }}"
                       class="text-white text-decoration-none small" target="_blank" rel="noopener">
                        <i class="fas fa-envelope me-1"></i> Webmail
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 2. NAVBAR UTAMA --}}
<header class="sticky-top bg-white shadow-sm">
    <div class="container">
        <nav class="navbar navbar-expand-lg py-3">
            <div class="container-fluid">

                {{-- LOGO — pakai $footerSettings, tidak ada Setting::getLink() --}}
                <a class="navbar-brand d-flex align-items-center" href="/">
                    @php $logo = optional($footerSettings->get('logo_utama'))->getUrl(); @endphp
                    @if($logo)
                        <img src="{{ $logo }}" alt="Logo UGK" height="60" loading="lazy">
                    @else
                        <span class="badge bg-secondary me-2">Logo Belum Diupload</span>
                    @endif
                    <div class="ms-2">
                        <div class="h5 mb-0 text-primary fw-bold lh-1">UNIVERSITAS</div>
                        <div class="h5 mb-0 text-primary fw-bold lh-1">GUNUNG KIDUL</div>
                    </div>
                </a>

                <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarMain" aria-controls="navbarMain"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars text-primary"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarMain">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                        {{-- Pakai $navMenus dari ViewComposer — tidak ada query DB di sini --}}
                        @foreach($navMenus ?? [] as $menu)
                            @php
                                $menuUrl = $menu->url
                                    ? (str_starts_with($menu->url, 'http') ? $menu->url : '/' . ltrim($menu->url, '/'))
                                    : '#';
                                $isActive = request()->is(ltrim($menuUrl, '/'));
                            @endphp

                            @if($menu->children->count() > 0)
                                <li class="nav-item dropdown">
                                    <a class="nav-link fw-bold dropdown-toggle {{ $isActive ? 'active' : '' }}"
                                       href="#" id="nav{{ $menu->id }}" role="button"
                                       data-bs-toggle="dropdown" aria-expanded="false">
                                        {{ strtoupper($menu->label) }}
                                    </a>
                                    <ul class="dropdown-menu border-0 shadow-sm" aria-labelledby="nav{{ $menu->id }}">
                                        @foreach($menu->children as $child)
                                            @php
                                                $childUrl = $child->url
                                                    ? (str_starts_with($child->url, 'http') ? $child->url : '/' . ltrim($child->url, '/'))
                                                    : '#';
                                            @endphp

                                            @if($child->children->count() > 0)
                                                <li class="dropdown-submenu">
                                                    <div class="d-flex align-items-center justify-content-between pe-2">
                                                        <a class="dropdown-item flex-grow-1" href="{{ $childUrl }}">{{ $child->label }}</a>
                                                        <span class="submenu-arrow d-lg-none p-2" data-bs-target="#sub{{ $child->id }}">
                                                            <i class="fas fa-chevron-right text-muted small"></i>
                                                        </span>
                                                    </div>
                                                    <ul class="dropdown-menu border-0 shadow-sm" id="sub{{ $child->id }}">
                                                        @foreach($child->children as $grandChild)
                                                            @php
                                                                $grandUrl = $grandChild->url
                                                                    ? (str_starts_with($grandChild->url, 'http') ? $grandChild->url : '/' . ltrim($grandChild->url, '/'))
                                                                    : '#';
                                                            @endphp
                                                            <li><a class="dropdown-item ps-4" href="{{ $grandUrl }}">{{ $grandChild->label }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a class="dropdown-item" href="{{ $childUrl }}">{{ $child->label }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link fw-bold {{ $isActive ? 'active' : '' }}" href="{{ $menuUrl }}">
                                        {{ strtoupper($menu->label) }}
                                    </a>
                                </li>
                            @endif
                        @endforeach

                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>
{{-- script.js di-load di masing-masing halaman dengan defer, bukan di sini --}}
