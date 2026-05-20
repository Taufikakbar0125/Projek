<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembangunan Sosial - Universitas Gunungkidul</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ps.css') }}">
</head>
<body>
    @include('includes.navbar')

    {{-- $bgImage dan $akreditasiImg sudah dikirim dari ProdiController (batch query).
         Tidak perlu @php block di sini. --}}

    <section class="hero-prodi">
        @if($bgImage !== '#')
            <img src="{{ $bgImage }}" class="hero-bg-img" alt="Background Pembangunan Sosial">
        @else
            <div class="hero-bg-fallback"></div>
        @endif
        <div class="hero-overlay"></div>
        <div class="container hero-body">
            <div class="row align-items-center">
                <div class="col-lg-6 text-white hero-content">
                    <div class="badge-prodi mb-3"><i class="fas fa-users me-2"></i>Program Studi</div>
                    <h1 class="display-3 fw-bold mb-4">Pembangunan Sosial</h1>
                    <p class="lead mb-4">Mempersiapkan agen perubahan yang ahli dalam pemberdayaan masyarakat dan analisis kebijakan kesejahteraan sosial.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="#" class="btn btn-warning btn-lg px-4"><i class="fas fa-info-circle me-2"></i>Lihat Selengkapnya</a>
                        <a href="https://wa.me/6281904019244" class="btn btn-outline-light btn-lg px-4"><i class="fab fa-whatsapp me-2"></i>Hubungi Kami</a>
                        
                        {{-- Tombol Lihat Akreditasi --}}
                        <button type="button" class="btn btn-primary btn-lg px-4" data-bs-toggle="modal" data-bs-target="#modalAkreditasi">
                            <i class="fas fa-certificate me-2"></i>Lihat Akreditasi
                        </button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-stats">
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-graduation-cap"></i></div>
                            <div class="stat-info"><h3 class="stat-number">S1 "S.Sos"</h3><p class="stat-label">Jenjang Pendidikan</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-certificate"></i></div>
                            <div class="stat-info"><h3 class="stat-number">B</h3><p class="stat-label">Akreditasi BAN-PT</p></div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><i class="fas fa-clock"></i></div>
                            <div class="stat-info"><h3 class="stat-number">8 Semester</h3><p class="stat-label">Durasi Studi</p></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quick-info py-5">
        <div class="container">
            <div class="row g-4 d-none d-md-flex">
                <div class="col-md-4"><div class="info-box"><div class="info-icon"><i class="fas fa-hand-holding-heart"></i></div><h3>Pemberdayaan</h3><p>Strategi penguatan ekonomi dan sosial komunitas lokal</p></div></div>
                <div class="col-md-4"><div class="info-box"><div class="info-icon"><i class="fas fa-search-location"></i></div><h3>Riset Sosial</h3><p>Analisis mendalam mengenai fenomena dan isu sosial terkini</p></div></div>
                <div class="col-md-4"><div class="info-box"><div class="info-icon"><i class="fas fa-user-shield"></i></div><h3>Kebijakan Sosial</h3><p>Perumusan solusi untuk masalah kesejahteraan masyarakat</p></div></div>
            </div>
            <div class="info-slider d-md-none">
                <div class="info-slide active"><div class="info-box"><div class="info-icon"><i class="fas fa-hand-holding-heart"></i></div><h3>Pemberdayaan</h3><p>Strategi penguatan ekonomi dan sosial komunitas lokal</p></div></div>
                <div class="info-slide"><div class="info-box"><div class="info-icon"><i class="fas fa-search-location"></i></div><h3>Riset Sosial</h3><p>Analisis mendalam mengenai fenomena dan isu sosial terkini</p></div></div>
                <div class="info-slide"><div class="info-box"><div class="info-icon"><i class="fas fa-user-shield"></i></div><h3>Kebijakan Sosial</h3><p>Perumusan solusi untuk masalah kesejahteraan masyarakat</p></div></div>
                <div class="info-dots">
                    <span class="info-dot active"></span>
                    <span class="info-dot"></span>
                    <span class="info-dot"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="keunggulan py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5"><h2 class="display-5 fw-bold text-primary">Keunggulan Program</h2><p class="lead text-muted">Mengapa memilih Pembangunan Sosial UGK?</p></div>
            <div class="row g-3">
                <div class="col-6"><div class="keunggulan-card"><div class="keunggulan-number">01</div><h4>Kurikulum Aplikatif</h4><p>Studi kasus nyata dinamika masyarakat pedesaan dan kota</p></div></div>
                <div class="col-6"><div class="keunggulan-card"><div class="keunggulan-number">02</div><h4>Praktika Lapangan</h4><p>Terjun langsung mendampingi komunitas dalam desa binaan</p></div></div>
                <div class="col-6"><div class="keunggulan-card"><div class="keunggulan-number">03</div><h4>Networking Luas</h4><p>Kerjasama dengan Dinas Sosial, NGO, dan CSR perusahaan</p></div></div>
                <div class="col-6"><div class="keunggulan-card"><div class="keunggulan-number">04</div><h4>Lulusan Berintegritas</h4><p>Mencetak sarjana sosial yang siap menjadi perancang program sosial</p></div></div>
            </div>
        </div>
    </section>

    <section class="cta-section py-5"><div class="container"><div class="cta-box text-center">
        <h2 class="display-5 fw-bold text-white mb-4">Siap Jadi Agen Perubahan?</h2>
        <p class="lead text-white mb-4">Bergabunglah dan bangun kesejahteraan masyarakat bersama kami</p>
        <a href="#" class="btn btn-warning btn-lg px-5"><i class="fas fa-arrow-right me-2"></i>Pelajari Lebih Lanjut</a>
    </div></div></section>

    {{-- MODAL AKREDITASI --}}
    <div class="modal fade" id="modalAkreditasi" tabindex="-1" aria-labelledby="modalAkreditasiLabel" aria-hidden="true" style="z-index: 9999;">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content bg-dark border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-white" id="modalAkreditasiLabel">Sertifikat Akreditasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-3 text-center">
                    @if($akreditasiImg && $akreditasiImg !== '#')
                        <img src="{{ $akreditasiImg }}" alt="Akreditasi Pembangunan Sosial" class="img-fluid rounded shadow">
                    @else
                        <div class="py-5 text-white-50">
                            <i class="fas fa-image fa-3x mb-3"></i>
                            <p>Sertifikat belum tersedia di admin panel.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/slide.js') }}" defer></script>
</body>
</html>