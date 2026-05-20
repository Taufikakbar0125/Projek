<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - Universitas Gunung kidul</title>
    <link rel="preconnect" href="https://cdn.jsdelivr.net">
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profil.css') }}">
</head>
<body>
    @include('includes.navbar')

    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-university me-3"></i>Profil Universitas Gunung kidul</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Profil</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="tab-navigation">
        <div class="container">
            <ul class="nav nav-tabs" id="profilTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="sejarah-tab" data-bs-toggle="tab" data-bs-target="#sejarah" type="button" role="tab">
                        <i class="fas fa-history"></i>
                        <span>Sejarah</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="visi-misi-tab" data-bs-toggle="tab" data-bs-target="#visi-misi" type="button" role="tab">
                        <i class="fas fa-bullseye"></i>
                        <span>Visi & Misi</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="struktur-tab" data-bs-toggle="tab" data-bs-target="#struktur" type="button" role="tab">
                        <i class="fas fa-sitemap"></i>
                        <span>Struktur Organisasi</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="peta-tab" data-bs-toggle="tab" data-bs-target="#peta" type="button" role="tab">
                        <i class="fas fa-map-marked-alt"></i>
                        <span>Peta Kampus</span>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="sambutan-tab" data-bs-toggle="tab" data-bs-target="#sambutan" type="button" role="tab">
                        <i class="fas fa-comment-dots"></i>
                        <span>Sambutan Rektor</span>
                    </button>
                </li>
            </ul>
        </div>
    </section>

    <section class="profil-section">
        <div class="container">
            <div class="tab-content" id="profilTabsContent">

                {{-- TAB SEJARAH --}}
                <div class="tab-pane fade show active" id="sejarah" role="tabpanel">
                    <div class="content-card">
                        <div class="content-header">
                            <h2><i class="fas fa-history text-primary me-2"></i>Sejarah Universitas Gunung kidul</h2>
                        </div>
                        <div class="content-body">
                            <div class="text-section mb-4">
                                <h3 class="section-title">Awal Mula Berdirinya</h3>
                                <p class="lead">Universitas Gunung kidul (UGK) didirikan pada tahun 2010 dengan semangat untuk memberikan akses pendidikan tinggi berkualitas bagi masyarakat Gunung kidul dan sekitarnya.</p>
                                <p>Berawal dari inisiatif tokoh masyarakat dan akademisi lokal yang melihat kebutuhan akan lembaga pendidikan tinggi di wilayah Gunung kidul, UGK hadir sebagai solusi untuk meningkatkan kualitas sumber daya manusia di daerah ini. Pada awalnya, UGK hanya memiliki 3 program studi dengan total 150 mahasiswa.</p>
                            </div>

                            <div class="text-section mb-4">
                                <h3 class="section-title">Perjalanan Sejarah</h3>
                                <p>Universitas Gunung kidul resmi berdiri pada tahun 2010 dengan tiga program studi perintis, yakni Teknik Sipil, Agroteknologi, dan Manajemen, yang mengakomodasi 150 mahasiswa angkatan pertama. Dua tahun kemudian, tepatnya pada 2012, UGK berhasil memperoleh akreditasi institusi peringkat B dari BAN-PT sebagai pengakuan atas kualitas pembelajaran yang dijalankan.</p>
                                <p>Seiring perkembangan kebutuhan industri, pada tahun 2015 universitas menambah lima program studi baru, termasuk Teknik Informatika, Akuntansi, dan Ilmu Komunikasi. Milestone besar tercapai pada tahun 2018 dengan peresmian kampus baru seluas 10 hektar yang dilengkapi laboratorium modern dan perpustakaan digital. Ekspansi ini berlanjut hingga tahun 2020 melalui jalinan kerjasama dengan lima universitas di Asia Tenggara untuk riset dan pertukaran mahasiswa.</p>
                                <p>Pada tahun 2023, UGK mengukuhkan posisinya sebagai perguruan tinggi terbaik di kawasan dengan meraih peringkat Akreditasi Unggul (A) dari BAN-PT. Kini, di tahun 2025, universitas bertransformasi penuh menuju era digital melalui sistem pembelajaran hybrid, riset berbasis AI, serta program inkubator startup bagi mahasiswa.</p>
                            </div>

                            <div class="achievement-section">
                                <h3 class="section-title">Pencapaian & Prestasi</h3>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="achievement-card">
                                            <div class="achievement-icon"><i class="fas fa-trophy"></i></div>
                                            <div class="achievement-content">
                                                <h4>50+ Penghargaan</h4>
                                                <p>Prestasi mahasiswa dan dosen di tingkat nasional dan internasional</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="achievement-card">
                                            <div class="achievement-icon"><i class="fas fa-graduation-cap"></i></div>
                                            <div class="achievement-content">
                                                <h4>5000+ Alumni</h4>
                                                <p>Tersebar di berbagai industri dan berkontribusi untuk masyarakat</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="achievement-card">
                                            <div class="achievement-icon"><i class="fas fa-handshake"></i></div>
                                            <div class="achievement-content">
                                                <h4>100+ Mitra Kerja</h4>
                                                <p>Kerjasama dengan industri, pemerintah, dan institusi pendidikan</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="achievement-card">
                                            <div class="achievement-icon"><i class="fas fa-flask"></i></div>
                                            <div class="achievement-content">
                                                <h4>200+ Publikasi</h4>
                                                <p>Karya ilmiah dosen dan mahasiswa di jurnal nasional dan internasional</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB VISI MISI --}}
                <div class="tab-pane fade" id="visi-misi" role="tabpanel">
                    <div class="content-card">
                        <div class="content-header">
                            <h2><i class="fas fa-bullseye text-primary me-2"></i>Visi & Misi Universitas</h2>
                        </div>
                        <div class="content-body">
                            <div class="text-section mb-5">
                                <h3 class="section-title">Visi</h3>
                                <p class="lead">"Menjadi Universitas Unggul dalam Pembangunan Kawasan Karst Tahun 2045."</p>
                            </div>

                            <div class="text-section mb-5">
                                <h3 class="section-title">Misi</h3>
                                <h4 class="misi-subtitle">1. Pendidikan Berkualitas</h4>
                                <p>Menyelenggarakan pendidikan tinggi yang berkualitas dan inovatif untuk menghasilkan lulusan yang kompeten, berakhlak mulia, dan berdaya saing global.</p>
                                <h4 class="misi-subtitle">2. Riset & Inovasi</h4>
                                <p>Mengembangkan penelitian dan inovasi yang berkontribusi pada kemajuan ilmu pengetahuan, teknologi, dan pembangunan daerah.</p>
                                <h4 class="misi-subtitle">3. Pengabdian Masyarakat</h4>
                                <p>Melaksanakan pengabdian kepada masyarakat yang berorientasi pada pemberdayaan dan peningkatan kesejahteraan masyarakat lokal.</p>
                                <h4 class="misi-subtitle">4. Tata Kelola Profesional</h4>
                                <p>Menerapkan tata kelola institusi yang baik, profesional, dan akuntabel untuk mendukung pencapaian visi universitas.</p>
                                <h4 class="misi-subtitle">5. Kerjasama Strategis</h4>
                                <p>Membangun kerjasama strategis dengan berbagai pihak baik nasional maupun internasional untuk meningkatkan kualitas tri dharma perguruan tinggi.</p>
                            </div>

                            <div class="text-section mb-5">
                                <h3 class="section-title">Tujuan</h3>
                                <p>Universitas Gunung kidul memiliki tujuan strategis untuk menghasilkan lulusan yang berkompeten, inovatif, dan berkarakter. Kami berkomitmen menghasilkan penelitian berkualitas yang bermanfaat bagi masyarakat serta memberikan solusi inovatif untuk permasalahan yang dihadapi masyarakat. Melalui upaya berkelanjutan, kami juga fokus untuk meningkatkan daya saing dan reputasi institusi di tingkat nasional maupun internasional.</p>
                            </div>

                            <div class="text-section">
                                <h3 class="section-title">Nilai-Nilai Inti</h3>
                                <p>Universitas Gunung kidul menjunjung tinggi nilai-nilai inti INSPIR yang menjadi landasan dalam setiap kegiatan akademik dan non-akademik:</p>
                                <p><strong>Integritas</strong> - Kami berkomitmen untuk jujur, konsisten, dan bertanggung jawab dalam setiap tindakan dan keputusan yang diambil.</p>
                                <p><strong>Inovasi</strong> - Kami mendorong kreativitas dan kemampuan adaptif dalam menghadapi perubahan dan tantangan zaman.</p>
                                <p><strong>Sinergi</strong> - Kami percaya pada kekuatan kolaborasi dan kerjasama untuk mencapai tujuan bersama yang lebih besar.</p>
                                <p><strong>Profesional</strong> - Kami bekerja dengan standar tinggi, kompeten, dan dedikasi penuh dalam menjalankan tugas dan tanggung jawab.</p>
                                <p><strong>Inklusif</strong> - Kami menghargai keberagaman dan memberikan kesempatan yang sama bagi semua sivitas akademika tanpa diskriminasi.</p>
                                <p><strong>Religius</strong> - Kami menjunjung tinggi nilai-nilai spiritual dan moral sebagai fondasi dalam pengembangan karakter dan intelektual.</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB STRUKTUR ORGANISASI --}}
                <div class="tab-pane fade" id="struktur" role="tabpanel">
                    <div class="content-card">
                        <div class="content-header">
                            <h2><i class="fas fa-sitemap text-primary me-2"></i>Struktur Organisasi</h2>
                        </div>
                        <div class="content-body">
                            @php
                                // FIX: Ganti Setting::getLink() individual (16 cache-lookup)
                                // dengan $fotoSettings dari ProfilController (1 batch query, sudah di-cache).
                                $avatarBase = 'https://ui-avatars.com/api/?color=7F9CF5&background=EBF4FF&name=';
                                $getF = fn(string $key, string $label) => optional($fotoSettings->get($key))->getUrl() ?? ($avatarBase . $label);

                                $rektor  = $getF('rektor',      'Rektor+UGK');
                                $warek1  = $getF('warek1',      'Warek+1');
                                $warek2  = $getF('warek2',      'Warek+2');
                                $warek3  = $getF('warek3',      'Warek+3');
                                $dekanft = $getF('dekanft',     'Dekan+FT');
                                $dekanfp = $getF('dekanfp',     'Dekan+FP');
                                $dekanfe = $getF('dekanfe',     'Dekan+FE');
                                $dekanfi = $getF('dekanfisipol','Dekan+FISIPOL');
                            @endphp

                            <div class="org-chart">
                                <div class="org-level">
                                    <div class="org-box rektor">
                                        <div class="org-photo">
                                            <img src="{{ $rektor }}" alt="Rektor" loading="eager" width="80" height="80">
                                        </div>
                                        <h4>Dr. Sugiyanto, S.Sos., M.M.</h4>
                                        <p>Rektor</p>
                                    </div>
                                </div>

                                <div class="org-level">
                                    <div class="row g-3 d-none d-md-flex">
                                        <div class="col-md-4">
                                            <div class="org-box warek">
                                                <div class="org-photo">
                                                    <img src="{{ $warek1 }}" alt="Wakil Rektor I" loading="lazy" width="80" height="80">
                                                </div>
                                                <h5>Dr. Septiono Eko Bawono, ST., M.eng.</h5>
                                                <p>Wakil Rektor I</p>
                                                <small>Bidang Akademik & Sistem Informasi</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="org-box warek">
                                                <div class="org-photo">
                                                    <img src="{{ $warek2 }}" alt="Wakil Rektor II" loading="lazy" width="80" height="80">
                                                </div>
                                                <h5>Dra. Nurdiana Tri Mulatsih, M.Si.</h5>
                                                <p>Wakil Rektor II</p>
                                                <small>Bidang Umum, Perencanaan, Keuangan & SDM</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="org-box warek">
                                                <div class="org-photo">
                                                    <img src="{{ $warek3 }}" alt="Wakil Rektor III" loading="lazy" width="80" height="80">
                                                </div>
                                                <h5>Dr. Catarina Wahyu Dyah, P.,SE., M.Pd.</h5>
                                                <p>Wakil Rektor III</p>
                                                <small>Bidang P2K, Humas, Alumni & Kerjasama</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="warek-slider d-md-none">
                                        <div class="warek-slider-track">
                                            @foreach ([['src' => $warek1, 'alt' => 'Wakil Rektor I', 'nama' => 'Dr. Septiono Eko Bawono, ST., M.eng.', 'jabatan' => 'Wakil Rektor I', 'bidang' => 'Bidang Akademik & Sistem Informasi'], ['src' => $warek2, 'alt' => 'Wakil Rektor II', 'nama' => 'Dra. Nurdiana Tri Mulatsih, M.Si.', 'jabatan' => 'Wakil Rektor II', 'bidang' => 'Bidang Umum, Perencanaan, Keuangan & SDM'], ['src' => $warek3, 'alt' => 'Wakil Rektor III', 'nama' => 'Dr. Catarina Wahyu Dyah, P.,SE., M.Pd.', 'jabatan' => 'Wakil Rektor III', 'bidang' => 'Bidang P2K, Humas, Alumni & Kerjasama']] as $w)
                                            <div class="warek-slide">
                                                <div class="org-box warek">
                                                    <div class="org-photo">
                                                        <img src="{{ $w['src'] }}" alt="{{ $w['alt'] }}" loading="lazy" width="80" height="80">
                                                    </div>
                                                    <h5>{{ $w['nama'] }}</h5>
                                                    <p>{{ $w['jabatan'] }}</p>
                                                    <small>{{ $w['bidang'] }}</small>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="warek-dots">
                                            <span class="warek-dot active" data-index="0"></span>
                                            <span class="warek-dot" data-index="1"></span>
                                            <span class="warek-dot" data-index="2"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="org-level">
                                    <h4 class="text-center mb-3 text-primary">Fakultas & Dekan</h4>
                                    <div class="row g-3">
                                        @foreach ([['src' => $dekanft, 'nama' => 'Dr. Hendry Edy, ST., M.T.', 'jabatan' => 'Dekan Fakultas Teknik'], ['src' => $dekanfp, 'nama' => 'Nusron Habibur Rohman., SE., M.MA.', 'jabatan' => 'Dekan Fakultas Pertanian'], ['src' => $dekanfe, 'nama' => 'Siti Rohmah, SE., M.M.', 'jabatan' => 'Dekan Fakultas Ekonomi'], ['src' => $dekanfi, 'nama' => 'Rosalia W.s.d., S.Sos., M.Si.', 'jabatan' => 'Dekan Fakultas Ilmu Sosial & Politik']] as $d)
                                        <div class="col-md-3">
                                            <div class="org-box dekan">
                                                <div class="org-photo-sm">
                                                    <img src="{{ $d['src'] }}" alt="{{ $d['jabatan'] }}" loading="lazy" width="50" height="50">
                                                </div>
                                                <h6>{{ $d['nama'] }}</h6>
                                                <p>{{ $d['jabatan'] }}</p>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="org-level mt-4">
                                    <h4 class="text-center mb-3 text-primary">Unit Penunjang</h4>
                                    <div class="row g-3">
                                        @foreach ([['icon' => 'fa-book-reader', 'label' => 'Perpustakaan'], ['icon' => 'fa-flask', 'label' => 'Laboratorium'], ['icon' => 'fa-desktop', 'label' => 'Pusat TIK'], ['icon' => 'fa-briefcase', 'label' => 'Pusat Karir'], ['icon' => 'fa-language', 'label' => 'Pusat Bahasa'], ['icon' => 'fa-microscope', 'label' => 'LPPM']] as $u)
                                        <div class="col-md-4">
                                            <div class="org-box unit">
                                                <i class="fas {{ $u['icon'] }}"></i>
                                                <h6>{{ $u['label'] }}</h6>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="text-center mt-5">
                                <a href="#" class="btn btn-primary btn-lg">
                                    <i class="fas fa-download me-2"></i>Download Struktur Organisasi Lengkap (PDF)
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB PETA KAMPUS --}}
                <div class="tab-pane fade" id="peta" role="tabpanel">
                    <div class="content-card">
                        <div class="content-header">
                            <h2><i class="fas fa-map-marked-alt text-primary me-2"></i>Peta Kampus</h2>
                        </div>
                        <div class="content-body">
                            <div class="location-info mb-4">
                                <h3 class="section-title"><i class="fas fa-map-pin me-2"></i>Lokasi Kampus</h3>
                                <div class="row g-3">
                                    @foreach ([['icon' => 'fa-map-marker-alt', 'label' => 'Alamat Kampus 1:', 'value' => 'Jl. KH Agus Salim No.170, Ledoksari, Kepek, Wonosari, Gunungkidul, Daerah Istimewa Yogyakarta, 55813'], ['icon' => 'fa-map-marker-alt', 'label' => 'Alamat Kampus 2:', 'value' => 'Jl. Lkr. Utara, Selang II, Selang, Kec. Wonosari, Kabupaten Gunungkidul, Daerah Istimewa Yogyakarta 55851'], ['icon' => 'fa-phone', 'label' => 'Telepon:', 'value' => '0823-1313-2007'], ['icon' => 'fa-envelope', 'label' => 'Email:', 'value' => 'univ_gunungkidul2019@ugk.ac.id'], ['icon' => 'fa-globe', 'label' => 'Website:', 'value' => 'www.ugk.ac.id']] as $info)
                                    <div class="col-md-6">
                                        <div class="info-card">
                                            <i class="fas {{ $info['icon'] }}"></i>
                                            <div>
                                                <strong>{{ $info['label'] }}</strong>
                                                <p>{{ $info['value'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="facilities-section mb-4">
                                <h3 class="section-title"><i class="fas fa-building me-2"></i>Fasilitas Kampus</h3>
                                <div class="row g-3">
                                    @foreach ([['icon' => 'fa-university', 'nama' => 'Gedung Rektorat', 'desc' => 'Pusat administrasi dan pengelolaan universitas'], ['icon' => 'fa-chalkboard-teacher', 'nama' => 'Gedung Kuliah', 'desc' => '12 gedung dengan 120+ ruang kuliah ber-AC'], ['icon' => 'fa-flask', 'nama' => 'Laboratorium', 'desc' => '20+ laboratorium modern untuk praktikum'], ['icon' => 'fa-book-reader', 'nama' => 'Perpustakaan', 'desc' => '50,000+ koleksi buku dan jurnal digital'], ['icon' => 'fa-dumbbell', 'nama' => 'Fasilitas Olahraga', 'desc' => 'Lapangan futsal, basket, voli, dan gym'], ['icon' => 'fa-home', 'nama' => 'Asrama Mahasiswa', 'desc' => 'Kapasitas 500+ mahasiswa dengan fasilitas lengkap'], ['icon' => 'fa-utensils', 'nama' => 'Kantin & Kafe', 'desc' => '5 kantin dan 3 kafe dengan menu bervariasi'], ['icon' => 'fa-pray', 'nama' => 'Masjid Kampus', 'desc' => 'Masjid 2 lantai dengan kapasitas 1000 jamaah'], ['icon' => 'fa-car', 'nama' => 'Area Parkir', 'desc' => 'Lahan parkir luas untuk mobil dan motor']] as $f)
                                    <div class="col-md-4">
                                        <div class="facility-card">
                                            <div class="facility-icon"><i class="fas {{ $f['icon'] }}"></i></div>
                                            <h5>{{ $f['nama'] }}</h5>
                                            <p>{{ $f['desc'] }}</p>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="map-embed">
                                <h3 class="section-title"><i class="fas fa-location-arrow me-2"></i>Lokasi di Google Maps</h3>
                                <div class="ratio ratio-16x9">
                                    <iframe
                                        src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d2407.792515099495!2d110.62030017701288!3d-7.959739803789765!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7bb5c329416dfd%3A0xd14070e0eaebf905!2sUniversitas%20Gunung%20Kidul%20Kampus%20II!5e1!3m2!1sid!2sid!4v1766372439048!5m2!1sid!2sid"
                                        style="border:0;"
                                        allowfullscreen=""
                                        loading="lazy"
                                        referrerpolicy="no-referrer-when-downgrade"
                                        class="rounded">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- TAB SAMBUTAN REKTOR --}}
                <div class="tab-pane fade" id="sambutan" role="tabpanel">
                    <div class="content-card">
                        <div class="content-header">
                            <h2><i class="fas fa-comment-dots text-primary me-2"></i>Sambutan Rektor</h2>
                        </div>
                        <div class="content-body">
                            <div class="sambutan-wrapper">
                                <div class="sambutan-profile">
                                    <div class="sambutan-photo">
                                        <img src="{{ optional($fotoSettings->get('rektor'))->getUrl() ?? 'https://ui-avatars.com/api/?name=Rektor+UGK&color=7F9CF5&background=EBF4FF&size=200' }}" alt="Foto Rektor" loading="lazy" width="150" height="150">
                                    </div>
                                    <h3 class="sambutan-name">Dr. Sugiyanto, S.Sos., M.M.</h3>
                                    <p class="sambutan-jabatan">Rektor Universitas Gunung kidul</p>
                                </div>

                                <div class="sambutan-text">
                                    <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,<br>Salam sejahtera bagi kita semua.</p>
                                    <p>Puji syukur kita panjatkan kehadirat Tuhan Yang Maha Esa atas segala rahmat dan karunia-Nya sehingga Universitas Gunung kidul dapat terus berkembang dan berkontribusi nyata bagi masyarakat, bangsa, dan negara.</p>
                                    <p>Universitas Gunung kidul hadir dengan tekad yang kuat untuk menjadi institusi pendidikan tinggi yang unggul, inovatif, dan berakar pada kearifan lokal. Sejak berdiri pada tahun 2010, kami telah melewati berbagai fase perkembangan yang membanggakan — mulai dari memperoleh akreditasi institusi peringkat B pada tahun 2012, hingga meraih predikat Akreditasi Unggul (A) dari BAN-PT pada tahun 2023. Pencapaian ini bukan sekadar penghargaan, melainkan cerminan kerja keras seluruh sivitas akademika yang tidak pernah berhenti berinovasi.</p>
                                    <p>Kami percaya bahwa pendidikan adalah investasi jangka panjang. Oleh karena itu, kami terus berupaya menghadirkan kurikulum yang relevan dengan kebutuhan industri, tenaga pengajar yang kompeten dan berdedikasi, serta fasilitas pembelajaran yang modern dan mendukung. Program studi yang kami tawarkan dirancang tidak hanya untuk mempersiapkan lulusan yang siap kerja, tetapi juga untuk mencetak pemimpin masa depan yang berkarakter, berintegritas, dan berwawasan global.</p>
                                    <p>Menghadapi era transformasi digital yang semakin pesat, Universitas Gunung kidul berkomitmen untuk terus beradaptasi. Melalui sistem pembelajaran hybrid, riset berbasis kecerdasan buatan, dan program inkubator startup, kami mendorong mahasiswa untuk tidak hanya menjadi konsumen teknologi, tetapi juga pencipta solusi bagi tantangan nyata di masyarakat.</p>
                                    <p>Kepada seluruh mahasiswa, saya berpesan: manfaatkan setiap kesempatan yang ada di kampus ini sebaik-baiknya. Jadilah generasi yang tidak hanya cerdas secara intelektual, tetapi juga kaya akan nilai-nilai kemanusiaan dan kepedulian sosial. Kepada para orang tua dan wali, terima kasih atas kepercayaan yang telah diberikan kepada kami. Amanah ini kami emban dengan sepenuh hati.</p>
                                    <p>Kepada seluruh dosen, tenaga kependidikan, dan mitra kami, terima kasih atas dedikasi dan kerja sama yang luar biasa. Bersama, kita wujudkan Universitas Gunung kidul sebagai perguruan tinggi yang memberikan dampak positif bagi pembangunan kawasan dan kemajuan bangsa Indonesia.</p>
                                    <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>
                                    <div class="sambutan-ttd">
                                        <p>Wonosari, {{ date('Y') }}</p>
                                        <p class="ttd-name">Dr. Sugiyanto, S.Sos., M.M.</p>
                                        <p class="ttd-jabatan">Rektor Universitas Gunung kidul</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
    <script src="{{ asset('js/profil.js') }}" defer></script>
    {{-- FIX: Handle ?section= query param dari route /profil/sejarah, /profil/visi-misi, dst --}}
    <script>
    (function () {
        const params = new URLSearchParams(window.location.search);
        const section = params.get('section');
        if (!section) return;
        window.addEventListener('load', function () {
            const target = document.getElementById(section);
            if (target) {
                setTimeout(function () {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 200);
            }
        });
    })();
    </script>
</body>
</html>