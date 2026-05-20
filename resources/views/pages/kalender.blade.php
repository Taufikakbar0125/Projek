<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kalender Akademik - Universitas Gunungkidul</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/kalender.css') }}">
    <style>
        .pdf-embed-wrapper {
            width: 100%;
            min-height: 600px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: #f8f9fa;
        }
        .pdf-embed-wrapper iframe {
            width: 100%;
            height: 650px;
            border: none;
        }
        .pdf-fallback {
            padding: 3rem;
            text-align: center;
        }
        @media (max-width: 768px) {
            .pdf-embed-wrapper iframe { height: 400px; }
        }
    </style>
</head>
<body>
    @include('includes.navbar')

    <section class="kalender-header py-5 mt-5">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Beranda</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Kalender Akademik</li>
                </ol>
            </nav>
            <h2 class="fw-bold mt-3">Kalender Akademik & Pengumuman</h2>
            <div class="header-line"></div>
        </div>
    </section>

    <section class="kalender-body pb-5">
        <div class="container">
            <div class="row g-4">
                {{-- KOLOM KIRI: Preview PDF + Tombol Download --}}
                <div class="col-lg-8">

                    @if($setup && $setup->file_pdf)
                        {{-- INFO KALENDER AKTIF --}}
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <h5 class="fw-bold mb-0">{{ $setup->tahun_akademik }} — Semester {{ $setup->semester }}</h5>
                                <small class="text-muted">Kalender Akademik Aktif</small>
                            </div>
                            <a href="{{ Storage::url($setup->file_pdf) }}"
                               class="btn btn-danger"
                               download
                               target="_blank">
                                <i class="fas fa-file-pdf me-2"></i>Unduh PDF
                            </a>
                        </div>

                        {{-- PREVIEW PDF LANGSUNG DI HALAMAN --}}
                        <div class="pdf-embed-wrapper">
                            {{-- Gunakan embed/object untuk support lebih luas --}}
                            <iframe
                                src="{{ Storage::url($setup->file_pdf) }}#toolbar=1&navpanes=0&scrollbar=1"
                                title="Kalender Akademik {{ $setup->tahun_akademik }}"
                                loading="lazy">
                                {{-- Fallback jika browser tidak support iframe PDF --}}
                                <div class="pdf-fallback">
                                    <i class="fas fa-file-pdf fa-3x text-danger mb-3 d-block"></i>
                                    <p>Browser Anda tidak mendukung preview PDF.</p>
                                    <a href="{{ Storage::url($setup->file_pdf) }}"
                                       class="btn btn-danger" download>
                                        <i class="fas fa-download me-2"></i>Unduh PDF
                                    </a>
                                </div>
                            </iframe>
                        </div>

                    @else
                        <div class="kalender-frame">
                            <div class="no-data-box p-5 text-center">
                                <i class="fas fa-calendar-alt fa-3x mb-3 text-muted d-block"></i>
                                <p class="text-muted mb-0">Kalender akademik belum diunggah di panel admin.</p>
                                <small class="text-muted">Silakan upload PDF kalender di menu Admin → Kalender Akademik</small>
                            </div>
                        </div>
                    @endif
                </div>

                {{-- KOLOM KANAN: Pengumuman Terbaru --}}
                <div class="col-lg-4">
                    <div class="announcement-sidebar">
                        <div class="sidebar-title p-3">
                            <h5 class="mb-0 fw-bold">
                                <i class="fas fa-bullhorn me-2 text-primary"></i>Pengumuman Terbaru
                            </h5>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0">
                                <tbody>
                                    @forelse($announcements as $item)
                                    <tr class="border-bottom">
                                        <td class="p-3">
                                            <a href="{{ route('pengumuman.detail', $item->id) }}"
                                               class="text-decoration-none d-block">
                                                <small class="text-muted small-date">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}
                                                </small>
                                                <div class="news-title fw-semibold text-dark">
                                                    {{ Str::limit($item->judul, 60) }}
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td class="p-4 text-center text-muted">Belum ada pengumuman terbaru.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="p-3 text-center">
                            <a href="{{ route('pengumuman') }}" class="btn btn-sm btn-outline-dark w-100">Lihat Semua</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>
