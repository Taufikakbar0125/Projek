<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universitas Gunungkidul - Mencetak Generasi Unggul</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" media="print" onload="this.media='all'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"></noscript>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @include('includes.navbar')

    @php
        // Semua setting sudah dikirim dari HomeController via $settings (batch 1 query)
        // Gunakan getUrl() dari model Setting, fallback '#' jika kosong
        $getS = fn(string $key, string $def = '#') => optional($settings->get($key))->getUrl() ?? $def;

        $slide1Img   = $getS('slide1');
        $slide2Img   = $getS('slide2');
        $slide3Img   = $getS('slide3');
        $slide4Img   = $getS('slide4');
        $slide1Text  = $slideTexts->get('carousel-slide-1');
        $slide2Text  = $slideTexts->get('carousel-slide-2');
        $slide3Text  = $slideTexts->get('carousel-slide-3');
        $slide4Text  = $slideTexts->get('carousel-slide-4');
        $pmbLink     = $getS('pmb');
        $webpmbLink  = $getS('webpmb');
        $siakadLink  = $getS('siakad');
        $perpusLink  = $getS('perpus');
        $youtubeLink = $getS('youtube');
    @endphp

    <section class="carousel slide" data-bs-ride="carousel" id="heroCarousel">
        <div class="carousel-inner">

            <div class="carousel-item active">
                <div class="carousel-slide-1 d-flex align-items-center justify-content-center text-center"
                     style="min-height:400px;height:60vh;max-height:700px;background-size:cover;background-position:center;{{ $slide1Img !== '#' ? 'background-image:url(\'' . $slide1Img . '\');' : 'background-color:#f8f9fa;' }}">
                    <div class="container carousel-container-text">
                        @if($slide1Img === '#')
                            <h2 class="display-6 fw-bold text-muted">foto slide 1 belum diinput di admin</h2>
                        @else
                            <h2 class="display-4 fw-bold" style="color:{{ $slide1Text->color ?? '#ffffff' }};">{{ $slide1Text->title ?? 'Selamat Datang di Universitas Gunung Kidul' }}</h2>
                            <p class="lead" style="color:{{ $slide1Text->color ?? '#ffffff' }};">{{ $slide1Text->subtitle ?? 'Mencetak Generasi Unggul dan Berdaya Saing Global dengan Semangat Lokal.' }}</p>
                            <a href="{{ $webpmbLink }}" class="btn btn-warning btn-lg fw-bold mt-3">DAFTAR SEKARANG</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide-2 d-flex align-items-center justify-content-center text-center"
                     style="min-height:400px;height:60vh;max-height:700px;background-size:cover;background-position:center;{{ $slide2Img !== '#' ? 'background-image:url(\'' . $slide2Img . '\');' : 'background-color:#f8f9fa;' }}">
                    <div class="container carousel-container-text">
                        @if($slide2Img === '#')
                            <h2 class="display-6 fw-bold text-muted">foto slide 2 belum diinput di admin</h2>
                        @else
                            <h2 class="display-4 fw-bold" style="color:{{ $slide2Text->color ?? '#ffffff' }};">{{ $slide2Text->title ?? 'Unggul dalam Sains dan Teknologi Tepat Guna' }}</h2>
                            <p class="lead" style="color:{{ $slide2Text->color ?? '#ffffff' }};">{{ $slide2Text->subtitle ?? 'Fasilitas modern mendukung riset inovatif untuk kemajuan daerah.' }}</p>
                            <a href="{{ $pmbLink }}" class="btn btn-warning btn-lg fw-bold mt-3">LIHAT FAKULTAS</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide-3 d-flex align-items-center justify-content-center text-center"
                     style="min-height:400px;height:60vh;max-height:700px;background-size:cover;background-position:center;{{ $slide3Img !== '#' ? 'background-image:url(\'' . $slide3Img . '\');' : 'background-color:#f8f9fa;' }}">
                    <div class="container carousel-container-text">
                        @if($slide3Img === '#')
                            <h2 class="display-6 fw-bold text-muted">foto slide 3 belum diinput di admin</h2>
                        @else
                            <h2 class="display-4 fw-bold" style="color:{{ $slide3Text->color ?? '#ffffff' }};">{{ $slide3Text->title ?? 'Kampus Hijau dan Ramah Lingkungan' }}</h2>
                            <p class="lead" style="color:{{ $slide3Text->color ?? '#ffffff' }};">{{ $slide3Text->subtitle ?? 'Komitmen terhadap keberlanjutan dan pelestarian alam kawasan karst.' }}</p>
                            <a href="{{ $pmbLink }}" class="btn btn-warning btn-lg fw-bold mt-3">JELAJAHI KAMPUS</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <div class="carousel-slide-4 d-flex align-items-center justify-content-center text-center"
                     style="min-height:400px;height:60vh;max-height:700px;background-size:cover;background-position:center;{{ $slide4Img !== '#' ? 'background-image:url(\'' . $slide4Img . '\');' : 'background-color:#f8f9fa;' }}">
                    <div class="container carousel-container-text">
                        @if($slide4Img === '#')
                            <h2 class="display-6 fw-bold text-muted">foto slide 4 belum diinput di admin</h2>
                        @else
                            <h2 class="display-4 fw-bold" style="color:{{ $slide4Text->color ?? '#ffffff' }};">{{ $slide4Text->title ?? 'Prestasi Mahasiswa Membanggakan' }}</h2>
                            <p class="lead" style="color:{{ $slide4Text->color ?? '#ffffff' }};">{{ $slide4Text->subtitle ?? 'Raih prestasi gemilang di tingkat nasional dan internasional.' }}</p>
                            <a href="{{ $pmbLink }}" class="btn btn-warning btn-lg fw-bold mt-3">LIHAT PRESTASI</a>
                        @endif
                    </div>
                </div>
            </div>

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
    </section>

    <section class="info-boxes-section">
        <div class="container-fluid px-0">
            <div class="row g-0 justify-content-center px-3" style="max-width:1140px;margin:0 auto;">

                <div class="col-12 col-md-4 mb-3 mb-md-0 px-md-2">
                    <div class="info-box-card d-flex align-items-center bg-white rounded-3 shadow-sm overflow-hidden h-100">
                        <div class="info-box-accent" style="background:#4fc3f7;"></div>
                        <div class="info-box-icon text-primary"><i class="fas fa-user-graduate"></i></div>
                        <div class="info-box-body flex-grow-1">
                            <div class="info-box-title fw-bold">Penerimaan Mahasiswa Baru</div>
                            <div class="info-box-desc text-muted">Jadwal, syarat pendaftaran,<br>dan beasiswa 2024/2025.</div>
                        </div>
                        <div class="info-box-btn-wrap">
                            <a href="{{ $webpmbLink }}" class="btn btn-primary info-box-btn">Info PMB</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-3 mb-md-0 px-md-2">
                    <div class="info-box-card d-flex align-items-center bg-white rounded-3 shadow-sm overflow-hidden h-100">
                        <div class="info-box-accent" style="background:#fddb00;"></div>
                        <div class="info-box-icon text-warning"><i class="fas fa-users"></i></div>
                        <div class="info-box-body flex-grow-1">
                            <div class="info-box-title fw-bold">Portal Akademik</div>
                            <div class="info-box-desc text-muted">Akses SIA, E-Learning,<br>dan informasi nilai mahasiswa.</div>
                        </div>
                        <div class="info-box-btn-wrap">
                            <a href="{{ $siakadLink }}" class="btn btn-warning info-box-btn">Login</a>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-4 mb-0 px-md-2">
                    <div class="info-box-card d-flex align-items-center bg-white rounded-3 shadow-sm overflow-hidden h-100">
                        <div class="info-box-accent" style="background:#28a745;"></div>
                        <div class="info-box-icon text-success"><i class="fas fa-book-open"></i></div>
                        <div class="info-box-body flex-grow-1">
                            <div class="info-box-title fw-bold">Perpustakaan Digital</div>
                            <div class="info-box-desc text-muted">Koleksi jurnal, ebook,<br>dan skripsi online (E-Repository).</div>
                        </div>
                        <div class="info-box-btn-wrap">
                            <a href="{{ $perpusLink }}" class="btn btn-success info-box-btn">Kunjungi</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="py-5 bg-light news-section">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="h3 fw-bold text-primary">Berita Kampus Terbaru</h2>
                <a href="{{ route('berita') }}" class="text-decoration-none fw-bold small">Lihat Semua Berita <i class="fas fa-arrow-right"></i></a>
            </div>

            <div class="row g-4 d-none d-md-flex">
                @forelse($news as $item)
                    <div class="col-md-4">
                        <div class="card h-100 border-0 shadow-sm overflow-hidden">
                            <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height:200px;object-fit:cover;" loading="lazy">
                            <div class="card-body">
                                <div class="text-muted small mb-2">{{ ($item->published_at ?? $item->created_at)->format('d M Y') }} | {{ $item->category->name ?? 'Berita' }}</div>
                                <h3 class="card-title h5 fw-bold">{{ $item->title }}</h3>
                                <p class="card-text small">{{ Str::limit(strip_tags($item->content), 100) }}</p>
                                <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none fw-bold small">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center"><p class="text-muted">Belum ada berita terbaru.</p></div>
                @endforelse
            </div>

            <div class="news-slider-wrap d-md-none">
                <div class="news-slider" id="newsSlider">
                    @forelse($news as $item)
                        <div class="news-slide-item">
                            <div class="card h-100 border-0 shadow-sm overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height:160px;object-fit:cover;" loading="lazy">
                                <div class="card-body">
                                    <div class="text-muted small mb-1">{{ ($item->published_at ?? $item->created_at)->format('d M Y') }} | {{ $item->category->name ?? 'Berita' }}</div>
                                    <h3 class="card-title h6 fw-bold">{{ $item->title }}</h3>
                                    <p class="card-text small">{{ Str::limit(strip_tags($item->content), 80) }}</p>
                                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none fw-bold small">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Belum ada berita terbaru.</p>
                    @endforelse
                </div>
                <div class="news-dots" id="newsDots"></div>
            </div>
        </div>
    </section>

    <section class="py-5">
        <div class="container">

            {{-- $list_pengumuman & $agendas sudah dikirim dari HomeController --}}

            <div class="row g-4 d-none d-md-flex">
                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h3 fw-bold text-primary">Pengumuman</h2>
                        <a href="{{ route('pengumuman') }}" class="text-decoration-none fw-bold small">Arsip <i class="fas fa-list-alt"></i></a>
                    </div>
                    <div class="list-group">
                        @forelse($list_pengumuman as $p)
                            <div class="list-group-item border-0 shadow-sm mb-2 rounded p-3">
                                <div class="d-flex align-items-start">
                                    <div class="text-white text-center p-2 rounded me-3 {{ $p->kategori == 'Penting' ? 'bg-danger' : 'bg-primary' }}" style="min-width:65px;">
                                        <div class="fw-bold fs-5">{{ $p->tanggal->format('d') }}</div>
                                        <div class="small" style="font-size:0.7rem;">{{ $p->tanggal->format('M Y') }}</div>
                                    </div>
                                    <div>
                                        <h4 class="h6 fw-bold mb-1">{{ $p->judul }}</h4>
                                        <p class="mb-0 small text-muted">{{ Str::limit($p->isi, 80) }}</p>
                                        <a href="{{ route('pengumuman.detail', $p->id) }}" class="small text-decoration-none fw-bold mt-1 d-block">Lihat Selengkapnya</a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center p-4"><p class="text-muted small">Belum ada pengumuman terbaru.</p></div>
                        @endforelse
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h3 fw-bold text-primary">Agenda Kampus</h2>
                        <a href="{{ route('kalender') }}" class="text-decoration-none fw-bold small">Lihat Kalender <i class="fas fa-calendar-check"></i></a>
                    </div>
                    <div class="list-group">
                        @forelse($agendas as $agenda)
                            <div class="list-group-item border-0 shadow-sm mb-2 rounded p-3">
                                <div class="d-flex align-items-start">
                                    <div class="text-center p-2 rounded me-3" style="background-color:{{ $agenda->color ?? '#ffc107' }};min-width:60px;">
                                        <div class="fw-bold fs-5" style="color:#fff;">{{ ($agenda->event_date ?? $agenda->created_at)->format('d') }}</div>
                                        <div class="small" style="color:#fff;">{{ ($agenda->event_date ?? $agenda->created_at)->format('M') }}</div>
                                    </div>
                                    <div>
                                        <h4 class="h6 fw-bold mb-0 text-dark">{{ $agenda->title }}</h4>
                                        <p class="mb-0 small text-muted">{{ $agenda->subtitle }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p class="text-muted small">Belum ada agenda terbaru.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="d-md-none">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="h5 fw-bold text-primary mb-0">Pengumuman</h2>
                    <a href="{{ route('pengumuman') }}" class="text-decoration-none fw-bold" style="font-size:0.65rem;">Arsip <i class="fas fa-list-alt"></i></a>
                </div>

                <div class="pengumuman-slider-wrap mb-4">
                    <div class="pengumuman-slider" id="pengumumanSlider">
                        @forelse($list_pengumuman as $p)
                            <div class="pengumuman-slide-item">
                                <div class="list-group-item border-0 shadow-sm rounded p-3" style="margin:0 4px;">
                                    <div class="d-flex align-items-start">
                                        <div class="text-white text-center p-2 rounded me-2 {{ $p->kategori == 'Penting' ? 'bg-danger' : 'bg-primary' }}" style="min-width:42px;flex-shrink:0;">
                                            <div class="fw-bold" style="font-size:0.95rem;line-height:1.1;">{{ $p->tanggal->format('d') }}</div>
                                            <div style="font-size:0.55rem;line-height:1.2;">{{ $p->tanggal->format('M Y') }}</div>
                                        </div>
                                        <div style="min-width:0;">
                                            <h4 class="fw-bold mb-1" style="font-size:0.72rem;line-height:1.3;">{{ $p->judul }}</h4>
                                            <p class="mb-1 text-muted" style="font-size:0.65rem;line-height:1.3;">{{ Str::limit($p->isi, 70) }}</p>
                                            <a href="{{ route('pengumuman.detail', $p->id) }}" class="text-decoration-none fw-bold" style="font-size:0.62rem;">Lihat Selengkapnya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="pengumuman-slide-item">
                                <div class="text-center p-4"><p class="text-muted small">Belum ada pengumuman terbaru.</p></div>
                            </div>
                        @endforelse
                    </div>
                    <div class="news-dots" id="pengumumanDots"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h2 class="h5 fw-bold text-primary mb-0">Agenda Kampus</h2>
                    <a href="{{ route('kalender') }}" class="text-decoration-none fw-bold" style="font-size:0.65rem;">Lihat Kalender <i class="fas fa-calendar-check"></i></a>
                </div>

                <div class="list-group">
                    @forelse($agendas as $agenda)
                        <div class="list-group-item border-0 shadow-sm mb-2 rounded p-2">
                            <div class="d-flex align-items-start">
                                <div class="text-center p-2 rounded me-2" style="background-color:{{ $agenda->color ?? '#ffc107' }};min-width:42px;flex-shrink:0;">
                                    <div class="fw-bold" style="color:#fff;font-size:0.95rem;line-height:1.1;">{{ ($agenda->event_date ?? $agenda->created_at)->format('d') }}</div>
                                    <div style="color:#fff;font-size:0.55rem;line-height:1.2;">{{ ($agenda->event_date ?? $agenda->created_at)->format('M') }}</div>
                                </div>
                                <div style="min-width:0;">
                                    <h4 class="fw-bold mb-0 text-dark" style="font-size:0.72rem;line-height:1.3;">{{ $agenda->title }}</h4>
                                    <p class="mb-0 text-muted" style="font-size:0.65rem;line-height:1.3;">{{ $agenda->subtitle }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted small">Belum ada agenda terbaru.</p>
                    @endforelse
                </div>
            </div>

        </div>
    </section>

    <section class="py-5 bg-primary text-white">
        <div class="container">
            <h2 class="text-center mb-4">Profil Video Universitas Gunung kidul</h2>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="ratio ratio-16x9 shadow">
                        <iframe src="{{ $youtubeLink }}" allowfullscreen loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 fasilitas-section">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Fasilitas Kampus</h2>

            {{-- $facilities sudah dikirim dari HomeController --}}

            <div class="row g-4 d-none d-md-flex">
                @forelse($facilities as $f)
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm h-100">
                            <img src="{{ asset('storage/' . $f->image) }}" class="card-img-top" alt="{{ $f->name }}" style="height:200px;object-fit:cover;" loading="lazy">
                            <div class="card-body text-center">
                                <h3 class="card-title h5 fw-bold">{{ $f->name }}</h3>
                                <p class="card-text small">{{ $f->description }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center"><p class="text-muted">Data fasilitas belum tersedia.</p></div>
                @endforelse
            </div>

            <div class="news-slider-wrap d-md-none">
                <div class="news-slider" id="fasilitasSlider">
                    @forelse($facilities as $f)
                        <div class="news-slide-item">
                            <div class="card border-0 shadow-sm overflow-hidden">
                                <img src="{{ asset('storage/' . $f->image) }}" class="card-img-top" alt="{{ $f->name }}" style="height:180px;object-fit:cover;" loading="lazy">
                                <div class="card-body text-center">
                                    <h3 class="card-title h6 fw-bold">{{ $f->name }}</h3>
                                    <p class="card-text small">{{ $f->description }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted text-center">Data fasilitas belum tersedia.</p>
                    @endforelse
                </div>
                <div class="news-dots" id="fasilitasDots"></div>
            </div>

        </div>
    </section>

    <section class="py-5 bg-warning">
        <div class="container">
            @php
                // $stats sudah dikirim dari HomeController — tidak perlu query ulang di view
                $mhs        = $stats->get('mahasiswa-aktif');
                $dosen      = $stats->get('dosen-tendik');
                $prodi      = $stats->get('program-studi');
                $akreditasi = $stats->get('akreditasi-baik');
            @endphp
            <div class="row text-center">
                <div class="col-6 col-md-3">
                    <i class="fas fa-users fa-3x mb-2" style="color:{{ $mhs->color ?? '#0d6efd' }};"></i>
                    <div class="display-6 fw-bold" style="color:{{ $mhs->color ?? '#0d6efd' }};">{{ $mhs->value ?? '425' }}+</div>
                    <div class="small fw-bold">{{ $mhs->title ?? 'Mahasiswa Aktif' }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-chalkboard-teacher fa-3x mb-2" style="color:{{ $dosen->color ?? '#0d6efd' }};"></i>
                    <div class="display-6 fw-bold" style="color:{{ $dosen->color ?? '#0d6efd' }};">{{ $dosen->value ?? '150' }}+</div>
                    <div class="small fw-bold">{{ $dosen->title ?? 'Dosen & Tendik' }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-sitemap fa-3x mb-2" style="color:{{ $prodi->color ?? '#0d6efd' }};"></i>
                    <div class="display-6 fw-bold" style="color:{{ $prodi->color ?? '#0d6efd' }};">{{ $prodi->value ?? '10' }}</div>
                    <div class="small fw-bold">{{ $prodi->title ?? 'Program Studi' }}</div>
                </div>
                <div class="col-6 col-md-3">
                    <i class="fas fa-trophy fa-3x mb-2" style="color:{{ $akreditasi->color ?? '#0d6efd' }};"></i>
                    <div class="display-6 fw-bold" style="color:{{ $akreditasi->color ?? '#0d6efd' }};">{{ $akreditasi->value ?? '5' }}+</div>
                    <div class="small fw-bold">{{ $akreditasi->title ?? 'Akreditasi Baik' }}</div>
                </div>
            </div>
        </div>
    </section>

    @include('includes.footer')

    <div class="floating-pmb" id="floatingPMB">
        <a href="{{ $pmbLink }}" class="floating-pmb-btn" target="_blank">
            <button class="floating-pmb-close" onclick="closeFloatingPMB(event)" title="Tutup">×</button>
            <div class="floating-pmb-content">
                <div class="floating-pmb-icon"><i class="fab fa-whatsapp"></i></div>
                <div class="floating-pmb-text">
                    <div class="floating-pmb-title">Layanan Pmb UGK</div>
                    <div class="floating-pmb-subtitle">Klik info pendaftaran</div>
                </div>
            </div>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>