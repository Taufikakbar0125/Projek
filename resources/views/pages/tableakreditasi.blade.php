<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Akreditasi - Universitas Gunungkidul</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        :root {
            --navy: #0f1c6b;
            --blue: #1a3fef;
            --gold: #f4c842;
            --gold2: #e8b020;
        }

        /* ── HERO ── */
        .akr-hero {
            background: linear-gradient(135deg, var(--navy) 0%, var(--blue) 60%, #0d24ab 100%);
            padding: 80px 0 60px;
            overflow: hidden;
        }
        .akr-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 70% 60% at 10% 30%, rgba(244,200,66,.12) 0%, transparent 60%);
            pointer-events: none;
        }
        .hero-badge {
            display: inline-flex; align-items: center; gap: 8px;
            background: rgba(244,200,66,.15); border: 1px solid rgba(244,200,66,.4);
            color: var(--gold); padding: 6px 18px; border-radius: 999px;
            font-size: .75rem; font-weight: 700; letter-spacing: .08em;
            text-transform: uppercase; margin-bottom: 20px;
        }
        .hero-title { font-size: clamp(2rem,5vw,3.2rem); font-weight: 800; color: #fff; line-height: 1.2; margin-bottom: 16px; }
        .hero-title span { color: var(--gold); }
        .hero-desc { color: rgba(255,255,255,.75); font-size: 1rem; max-width: 540px; line-height: 1.7; }
        .stat-box {
            background: rgba(255,255,255,.08); border: 1px solid rgba(255,255,255,.12);
            border-radius: 14px; padding: 20px 12px; text-align: center;
        }
        .stat-box .val { font-size: 1.5rem; font-weight: 800; color: var(--gold); }
        .stat-box .lbl { font-size: .68rem; color: rgba(255,255,255,.55); text-transform: uppercase; letter-spacing: .07em; margin-top: 6px; }

        /* ── SECTION ── */
        .akr-section { padding: 60px 0 80px; background: #f8f9fc; }
        .sec-label { display: flex; align-items: center; gap: 12px; margin-bottom: 28px; }
        .sec-label .line { width: 48px; height: 3px; background: linear-gradient(90deg, var(--blue), transparent); border-radius: 2px; }
        .sec-label span { font-size: .72rem; font-weight: 700; text-transform: uppercase; letter-spacing: .1em; color: var(--blue); }

        /* ── CARDS ── */
        .akr-card {
            background: #fff; border-radius: 16px; border: 1px solid #e8ecf4;
            padding: 20px 24px; display: flex; align-items: center; gap: 18px;
            margin-bottom: 14px; box-shadow: 0 2px 8px rgba(15,28,107,.06);
        }
        .prodi-card {
            cursor: pointer; transition: all .25s ease;
        }
        .prodi-card:hover { border-color: var(--blue); box-shadow: 0 8px 28px rgba(26,63,239,.12); transform: translateY(-3px); }

        .akr-icon {
            width: 52px; height: 52px; border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.3rem; color: #fff; flex-shrink: 0;
        }
        .akr-icon.inst { width: 56px; height: 56px; border-radius: 13px; font-size: 1.5rem; }

        .card-info { flex: 1; min-width: 0; }
        .card-no { font-size: .68rem; font-weight: 600; color: #a0aec0; font-family: monospace; }
        .card-name { font-size: 1.05rem; font-weight: 700; color: var(--navy); margin: 2px 0 6px; }
        .card-meta { font-size: .8rem; color: #718096; margin-top: 4px; }
        .card-badges { display: flex; align-items: center; gap: 6px; flex-wrap: wrap; }

        /* ── BADGES ── */
        .bdg {
            border-radius: 999px; font-size: .68rem; font-weight: 700; padding: 2px 10px;
            display: inline-flex; align-items: center; gap: 4px;
        }
        .bdg-blue  { background: #eef1fb; color: var(--blue); border: 1px solid #c5cffa; }
        .bdg-gold  { background: #fffbea; color: #b7791f; border: 1px solid #f6e05e; }
        .bdg-green { background: #e8f5e9; color: #2e7d32; border: 1px solid #a5d6a7; }
        .bdg-red   { background: #fff5f5; color: #c53030; border: 1px solid #feb2b2; }

        /* ── BUTTONS ── */
        .btn-outline-akr {
            background: transparent; border: 1.5px solid var(--blue); color: var(--blue);
            font-size: .8rem; font-weight: 700; border-radius: 9px; padding: 9px 18px;
            white-space: nowrap; flex-shrink: 0; display: inline-flex; align-items: center;
            gap: 6px; transition: all .2s; text-decoration: none; cursor: pointer;
        }
        .btn-outline-akr:hover { background: var(--blue); color: #fff; }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold2), var(--gold));
            color: var(--navy); font-weight: 700; font-size: .82rem;
            border: none; border-radius: 8px; padding: 10px 20px;
            display: inline-flex; align-items: center; gap: 7px;
            text-decoration: none; transition: all .2s; flex-shrink: 0; cursor: pointer;
        }
        .btn-gold:hover { color: var(--navy); box-shadow: 0 4px 16px rgba(244,200,66,.45); transform: scale(1.04); }
        .btn-gold.dis { background: #e2e8f0; color: #a0aec0; cursor: not-allowed; box-shadow: none; transform: none; }

        .btn-gold-sm {
            background: linear-gradient(135deg, var(--gold2), var(--gold));
            color: var(--navy); font-weight: 700; font-size: .75rem;
            border: none; border-radius: 7px; padding: 8px 14px;
            display: inline-flex; align-items: center; gap: 5px;
            text-decoration: none; transition: all .2s; cursor: pointer;
        }
        .btn-gold-sm:hover { color: var(--navy); box-shadow: 0 4px 14px rgba(244,200,66,.4); }

        /* ── DETAIL ── */
        #detail-view { display: none; }
        .back-btn {
            display: inline-flex; align-items: center; gap: 8px;
            color: var(--blue); background: none; border: none; cursor: pointer;
            font-size: .88rem; font-weight: 700; padding: 0; margin-bottom: 22px;
        }
        .back-btn:hover { text-decoration: underline; color: var(--blue); }

        /* ── TABLE ── */
        .akr-table-wrap { background: #fff; border: 1px solid #e8ecf4; border-radius: 16px; overflow: hidden; box-shadow: 0 2px 8px rgba(15,28,107,.06); }
        .akr-table { width: 100%; border-collapse: collapse; font-size: .86rem; }
        .akr-table thead { background: #f8f9fc; }
        .akr-table thead th {
            padding: 13px 16px; text-align: left; font-size: .68rem; font-weight: 700;
            text-transform: uppercase; letter-spacing: .08em; color: #718096;
            border-bottom: 1px solid #e8ecf4;
        }
        .akr-table tbody tr { border-bottom: 1px solid #f0f4f8; }
        .akr-table tbody tr:last-child { border-bottom: none; }
        .akr-table tbody tr:hover { background: #f8f9fc; }
        .akr-table tbody td { padding: 13px 16px; vertical-align: middle; color: #1a202c; }
        .td-no { font-size: .7rem; color: #a0aec0; font-family: monospace; font-weight: 600; }
        .td-yr { font-weight: 700; color: var(--navy); }
        .td-sk { font-size: .75rem; color: #718096; font-family: monospace; }
        .expired { color: #c53030; }

        /* ── INFO NOTE ── */
        .info-note {
            background: #fff; border: 1px solid #e8ecf4; border-left: 4px solid var(--blue);
            border-radius: 12px; padding: 16px 20px; display: flex; align-items: flex-start;
            gap: 12px; margin-top: 24px;
        }
        .info-note i { color: var(--blue); margin-top: 2px; flex-shrink: 0; }
        .info-note p { font-size: .88rem; color: #4a5568; margin: 0; line-height: 1.6; }

        /* ── EMPTY STATE ── */
        .empty-state { text-align: center; padding: 40px 20px; color: #a0aec0; }
        .empty-state i { font-size: 2rem; display: block; margin-bottom: 10px; opacity: .4; }
        .empty-state p { font-size: .9rem; font-style: italic; margin: 0; }

        @media (max-width: 576px) {
            .akr-card { flex-wrap: wrap; }
            .btn-gold, .btn-outline-akr { width: 100%; justify-content: center; margin-top: 8px; }
            .akr-table thead th:nth-child(5), .akr-table tbody td:nth-child(5) { display: none; }
        }
    </style>
</head>
<body>

@include('includes.navbar')

{{-- HERO --}}
<section class="akr-hero position-relative">
    <div class="container position-relative">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <div class="hero-badge"><i class="fas fa-certificate"></i> Terakreditasi Resmi BAN-PT</div>
                <h1 class="hero-title">Akreditasi <span>Universitas Gunungkidul</span></h1>
                <p class="hero-desc">Dokumen akreditasi resmi institusi dan seluruh program studi dari BAN-PT. Klik program studi untuk melihat riwayat lengkap.</p>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-4"><div class="stat-box"><div class="val">5</div><div class="lbl">Program Studi</div></div></div>
                    <div class="col-4"><div class="stat-box"><div class="val">BAN-PT</div><div class="lbl">Lembaga</div></div></div>
                    <div class="col-4"><div class="stat-box"><div class="val">Baik</div><div class="lbl">Peringkat Inst.</div></div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- MAIN --}}
<section class="akr-section">
    <div class="container">

        {{-- LIST VIEW --}}
        <div id="list-view">

            {{-- Institusi --}}
            <div class="sec-label"><div class="line"></div><span>Akreditasi Institusi</span></div>

            @php
                // FIX: $settings sudah dikirim PageController (batch query). Gunakan itu.
                $instPdf = optional($settings->get('akreditasiinstitusipdf'))->getUrl() ?? '#';
            @endphp

            <div class="akr-card">
                <div class="akr-icon inst" style="background: linear-gradient(135deg,#0f1c6b,#1a3fef);">
                    <i class="fas fa-university"></i>
                </div>
                <div class="card-info">
                    <div class="card-name">Universitas Gunungkidul (Institusi)</div>
                    <div class="card-badges mb-1">
                        <span class="bdg bdg-blue">Institusi</span>
                        <span class="bdg bdg-green"><i class="fas fa-check-circle" style="font-size:.62rem;"></i> Baik</span>
                    </div>
                    <div class="card-meta"><strong>Berlaku:</strong> 2022-07-26 Sampai 2027-07-26 &nbsp;|&nbsp; <strong>SK:</strong> 392/SK/BAN-PT/Ak/PT/VII/2022</div>
                </div>
                {{-- Tombol institusi: pakai button + openPDF agar tidak freeze tab --}}
                <button
                    class="btn-gold {{ $instPdf === '#' ? 'dis' : '' }}"
                    onmouseenter="prefetchPDF('{{ $instPdf }}')"
                    onclick="openPDF('{{ $instPdf }}', this)">
                    <i class="fas fa-file-pdf"></i>
                    <span class="d-none d-sm-inline">Unduh PDF</span>
                    <span class="d-sm-none">PDF</span>
                </button>
            </div>

            <div style="margin-top:40px;"></div>

            {{-- Daftar Prodi --}}
            <div class="sec-label"><div class="line"></div><span>Daftar Program Studi</span></div>

            @php
            $prodiList = [
                ['no'=>'01','nama'=>'Teknik Sipil',         'key'=>'akreditasiteksippdf','style'=>'background:linear-gradient(135deg,#2563eb,#1e40af)','icon'=>'fas fa-building'],
                ['no'=>'02','nama'=>'Agroteknologi',         'key'=>'akreditasiagropdf',  'style'=>'background:linear-gradient(135deg,#059669,#065f46)','icon'=>'fas fa-leaf'],
                ['no'=>'03','nama'=>'Administrasi Publik',   'key'=>'akreditasiappdf',    'style'=>'background:linear-gradient(135deg,#7c3aed,#4c1d95)','icon'=>'fas fa-file-alt'],
                ['no'=>'04','nama'=>'Ekonomi Pembangunan',   'key'=>'akreditasieppdf',    'style'=>'background:linear-gradient(135deg,#d97706,#92400e)','icon'=>'fas fa-chart-line'],
                ['no'=>'05','nama'=>'Pembangunan Sosial',    'key'=>'akreditasipspdf',    'style'=>'background:linear-gradient(135deg,#dc2626,#7f1d1d)','icon'=>'fas fa-users'],
            ];
            @endphp

            @foreach($prodiList as $p)
            @php
                // FIX: Hitung $avail dari $settings yang sudah di-load controller (tidak re-query)
                $avail = 0;
                for ($i = 1; $i <= 10; $i++) {
                    $url = optional($settings->get($p['key'] . $i))->getUrl();
                    if ($url) $avail++;
                }
            @endphp
            <div class="akr-card prodi-card" onclick="showDetail('{{ $p['key'] }}')">
                <div class="akr-icon" style="{{ $p['style'] }}"><i class="{{ $p['icon'] }}"></i></div>
                <div class="card-info">
                    <div class="card-no">{{ $p['no'] }}</div>
                    <div class="card-name">{{ $p['nama'] }}</div>
                    <div class="card-badges mb-1">
                        <span class="bdg bdg-blue">S1</span>
                        <span class="bdg bdg-gold"><i class="fas fa-check-circle" style="font-size:.62rem;"></i> Terakreditasi</span>
                    </div>
                    <div class="card-meta">
                        <i class="fas fa-history" style="font-size:.65rem;"></i>
                        {{ $avail > 0 ? $avail.' riwayat tersedia' : 'Belum ada dokumen' }}
                    </div>
                </div>
                <button class="btn-outline-akr">Lihat Riwayat <i class="fas fa-arrow-right" style="font-size:.75rem;"></i></button>
            </div>
            @endforeach

            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                <p>Klik program studi untuk melihat riwayat lengkap. Dokumen resmi dikeluarkan oleh <strong>BAN-PT</strong>. Hubungi bagian akademik jika ada pertanyaan.</p>
            </div>

        </div>
        {{-- END LIST VIEW --}}

        {{-- DETAIL VIEW --}}
        <div id="detail-view">

            <button class="back-btn" onclick="showList()">
                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Prodi
            </button>

            <div id="detail-header" class="akr-card" style="margin-bottom:28px;"></div>

            <div class="sec-label"><div class="line"></div><span>Riwayat Akreditasi</span></div>

            <div class="akr-table-wrap">
                <table class="akr-table">
                    <thead>
                        <tr>
                            <th>No</th><th>Tahun SK</th><th>Akreditasi</th>
                            <th>Berlaku Hingga</th><th>Nomor SK</th><th>Dokumen</th>
                        </tr>
                    </thead>
                    <tbody id="akr-tbody"></tbody>
                </table>
            </div>

            <div class="info-note">
                <i class="fas fa-info-circle"></i>
                <p>Hanya dokumen yang sudah diunggah admin yang ditampilkan. Hubungi bagian akademik untuk informasi lebih lanjut.</p>
            </div>

        </div>
        {{-- END DETAIL VIEW --}}

    </div>
</section>

@include('includes.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── META PRODI ──
const PRODI = {
    akreditasiteksippdf: { no:'01', nama:'Teknik Sipil',       icon:'fas fa-building',   style:'background:linear-gradient(135deg,#2563eb,#1e40af)' },
    akreditasiagropdf:   { no:'02', nama:'Agroteknologi',       icon:'fas fa-leaf',       style:'background:linear-gradient(135deg,#059669,#065f46)' },
    akreditasiappdf:     { no:'03', nama:'Administrasi Publik', icon:'fas fa-file-alt',   style:'background:linear-gradient(135deg,#7c3aed,#4c1d95)' },
    akreditasieppdf:     { no:'04', nama:'Ekonomi Pembangunan', icon:'fas fa-chart-line', style:'background:linear-gradient(135deg,#d97706,#92400e)' },
    akreditasipspdf:     { no:'05', nama:'Pembangunan Sosial',  icon:'fas fa-users',      style:'background:linear-gradient(135deg,#dc2626,#7f1d1d)' },
};

// ── URL PDF DARI LARAVEL (di-generate server-side, tidak ada request tambahan) ──
const PDF = {
    inst: @json(optional($settings->get('akreditasiinstitusipdf'))->getUrl() ?? '#'),
    @foreach(['akreditasiteksippdf','akreditasiagropdf','akreditasiappdf','akreditasieppdf','akreditasipspdf'] as $key)
    @for($i=1;$i<=10;$i++)
    '{{ $key.$i }}': @json(optional($settings->get($key.$i))->getUrl() ?? '#'),
    @endfor
    @endforeach
};

// ── DATA RIWAYAT (diurutkan descending per tahun) ──
const HIST = {
    akreditasiteksippdf: [
        {yr:'2024',rank:'Baik', exp:'2029-04-20',sk:'0102/SK/LAM Teknik/AS/IV/2024',          key:'akreditasiteksippdf1'},
        {yr:'2022',rank:'Baik', exp:'2024-03-12',sk:'9157/SK/BAN-PT/Ak.kp/S/XI/2022',         key:'akreditasiteksippdf3'},
        {yr:'2021',rank:'Baik', exp:'2026-03-15',sk:'112/SK/BAN-PT/Akred/S/III/2021',          key:'akreditasiteksippdf9'},
        {yr:'2019',rank:'C',    exp:'2024-03-12',sk:'391/SK/BAN-PT/Akred/S/III/2019',          key:'akreditasiteksippdf2'},
        {yr:'2018',rank:'Baik', exp:'2023-07-20',sk:'078/SK/BAN-PT/Akred/S/VII/2018',          key:'akreditasiteksippdf8'},
        {yr:'2016',rank:'C',    exp:'2021-11-30',sk:'441/SK/BAN-PT/Akred/S/XI/2016',           key:'akreditasiteksippdf7'},
        {yr:'2014',rank:'C',    exp:'2019-09-10',sk:'312/SK/BAN-PT/Akred/S/IX/2014',           key:'akreditasiteksippdf6'},
        {yr:'2013',rank:'C',    exp:'2018-11-12',sk:'237/SK/BAN-PT/Ak-XVI/S/XI/2013',          key:'akreditasiteksippdf4'},
        {yr:'2012',rank:'C',    exp:'2017-06-05',sk:'198/SK/BAN-PT/Akred/S/VI/2012',           key:'akreditasiteksippdf5'},
        {yr:'2004',rank:'—',    exp:'2009-03-01',sk:'005/SK/BAN-PT/Akred/S/III/2004',          key:'akreditasiteksippdf11'},
    ],
    akreditasiagropdf: [
        {yr:'2024',rank:'Baik',        exp:'2029-01-30',sk:'264/SK/BAN-PT/Ak/S/I/2024',        key:'akreditasiagropdf1'},
        {yr:'2023',rank:'Baik Sekali', exp:'2028-09-01',sk:'510/SK/BAN-PT/Akred/S/IX/2023',    key:'akreditasiagropdf10'},
        {yr:'2020',rank:'Baik',        exp:'2025-03-20',sk:'321/SK/BAN-PT/Akred/S/III/2020',   key:'akreditasiagropdf9'},
        {yr:'2018',rank:'B',           exp:'2023-04-17',sk:'1071/SK/BAN-PT/Akred/S/IV/2018',   key:'akreditasiagropdf2'},
        {yr:'2017',rank:'Baik',        exp:'2022-07-14',sk:'189/SK/BAN-PT/Akred/S/VII/2017',   key:'akreditasiagropdf8'},
        {yr:'2014',rank:'B',           exp:'2019-05-10',sk:'076/SK/BAN-PT/Akred/S/V/2014',     key:'akreditasiagropdf7'},
        {yr:'2013',rank:'C',           exp:'2018-08-24',sk:'174/SK/BAN-PT/Ak-XVI/S/VIII/2013', key:'akreditasiagropdf3'},
        {yr:'2011',rank:'C',           exp:'2016-02-28',sk:'034/SK/BAN-PT/Akred/S/II/2011',    key:'akreditasiagropdf6'},
        {yr:'2009',rank:'C',           exp:'2014-09-05',sk:'017/SK/BAN-PT/Akred/S/IX/2009',    key:'akreditasiagropdf5'},
        {yr:'2007',rank:'—',           exp:'2012-04-22',sk:'009/SK/BAN-PT/Akred/S/IV/2007',    key:'akreditasiagropdf4'},
    ],
    akreditasiappdf: [
        {yr:'2024',rank:'Baik Sekali', exp:'2029-02-10',sk:'612/SK/BAN-PT/Akred/S/II/2024',    key:'akreditasiappdf10'},
        {yr:'2023',rank:'Baik',        exp:'2028-04-18',sk:'1421/SK/BAN-PT/Ak/S/IV/2023',      key:'akreditasiappdf1'},
        {yr:'2017',rank:'Baik',        exp:'2022-10-07',sk:'4209/SK/BAN-PT/Akred/S/XI/2017',   key:'akreditasiappdf2'},
        {yr:'2015',rank:'B',           exp:'2020-10-22',sk:'134/SK/BAN-PT/Akred/S/X/2015',     key:'akreditasiappdf4'},
        {yr:'2012',rank:'C',           exp:'2017-08-15',sk:'025/BAN-PT/Ak-XV/S1/VIII/2012',    key:'akreditasiappdf3'},
        {yr:'2012',rank:'C',           exp:'2017-06-09',sk:'067/SK/BAN-PT/Akred/S/VI/2012',    key:'akreditasiappdf5'},
        {yr:'2010',rank:'C',           exp:'2015-01-30',sk:'029/SK/BAN-PT/Akred/S/I/2010',     key:'akreditasiappdf6'},
        {yr:'2008',rank:'C',           exp:'2013-07-14',sk:'013/SK/BAN-PT/Akred/S/VII/2008',   key:'akreditasiappdf7'},
        {yr:'2006',rank:'—',           exp:'2011-03-08',sk:'007/SK/BAN-PT/Akred/S/III/2006',   key:'akreditasiappdf8'},
        {yr:'2004',rank:'—',           exp:'2009-09-25',sk:'002/SK/BAN-PT/Akred/S/IX/2004',    key:'akreditasiappdf9'},
    ],
    akreditasieppdf: [
        {yr:'2023',rank:'Baik', exp:'2028-11-18',sk:'544/SK/BAN-PT/Akred/S/XI/2023',           key:'akreditasieppdf10'},
        {yr:'2023',rank:'Baik', exp:'2028-03-16',sk:'239/DE/A.5/AR.10/III/2023',               key:'akreditasieppdf1'},
        {yr:'2020',rank:'Baik', exp:'2025-06-30',sk:'355/SK/BAN-PT/Akred/S/VI/2020',           key:'akreditasieppdf9'},
        {yr:'2017',rank:'B',    exp:'2022-08-15',sk:'2777/SK/BAN-PT/Akred/S/VIII/2017',        key:'akreditasieppdf2'},
        {yr:'2017',rank:'B',    exp:'2022-02-14',sk:'201/SK/BAN-PT/Akred/S/II/2017',           key:'akreditasieppdf8'},
        {yr:'2014',rank:'C',    exp:'2019-08-05',sk:'099/SK/BAN-PT/Akred/S/VIII/2014',         key:'akreditasieppdf7'},
        {yr:'2012',rank:'C',    exp:'2017-10-18',sk:'032/BAN-PT/Ak-XV/S1/X/2012',              key:'akreditasieppdf3'},
        {yr:'2011',rank:'C',    exp:'2016-04-22',sk:'041/SK/BAN-PT/Akred/S/IV/2011',           key:'akreditasieppdf6'},
        {yr:'2009',rank:'C',    exp:'2014-10-01',sk:'019/SK/BAN-PT/Akred/S/X/2009',            key:'akreditasieppdf5'},
        {yr:'2007',rank:'—',    exp:'2012-08-17',sk:'010/SK/BAN-PT/Akred/S/VIII/2007',         key:'akreditasieppdf4'},
    ],
    akreditasipspdf: [
        {yr:'2024',rank:'Baik', exp:'2029-10-19',sk:'6313/SK/BAN-PT/Ak/S/X/2024',              key:'akreditasipspdf1'},
        {yr:'2019',rank:'C',    exp:'2024-04-30',sk:'1296/SK/BAN-PT/Akred/S/IV/2019',          key:'akreditasipspdf2'},
        {yr:'2015',rank:'B',    exp:'2020-05-22',sk:'155/SK/BAN-PT/Akred/S/V/2015',            key:'akreditasipspdf4'},
        {yr:'2013',rank:'C',    exp:'2013-10-01',sk:'222/SK/BAN-PT/AK-XVI/S/XI/2013',          key:'akreditasipspdf3'},
        {yr:'2012',rank:'C',    exp:'2017-12-01',sk:'071/SK/BAN-PT/Akred/S/XII/2012',          key:'akreditasipspdf5'},
        {yr:'2010',rank:'C',    exp:'2015-07-20',sk:'033/SK/BAN-PT/Akred/S/VII/2010',          key:'akreditasipspdf6'},
        {yr:'2008',rank:'C',    exp:'2013-02-14',sk:'015/SK/BAN-PT/Akred/S/II/2008',           key:'akreditasipspdf7'},
        {yr:'2006',rank:'—',    exp:'2011-08-09',sk:'008/SK/BAN-PT/Akred/S/VIII/2006',         key:'akreditasipspdf8'},
        {yr:'2004',rank:'—',    exp:'2009-03-27',sk:'003/SK/BAN-PT/Akred/S/III/2004',          key:'akreditasipspdf9'},
        {yr:'2002',rank:'—',    exp:'2007-01-11',sk:'001C/SK/BAN-PT/Akred/S/I/2002',           key:'akreditasipspdf10'},
    ],
};

// ── CACHE tanggal agar tidak re-parse setiap render ──
const _dateCache = {};
const _now = Date.now();

function fmtDate(d) {
    if (!d || d === '—') return '<span style="color:#a0aec0;font-style:italic;">—</span>';
    if (_dateCache[d]) return _dateCache[d];
    const dt  = new Date(d);
    const exp = dt.getTime() < _now;
    const s   = dt.toLocaleDateString('id-ID', {day:'2-digit', month:'long', year:'numeric'});
    const result = exp
        ? `<span class="expired">${s} <small>(Kedaluwarsa)</small></span>`
        : `<span>${s}</span>`;
    _dateCache[d] = result;
    return result;
}

function rankBadge(r) {
    if (!r || r === '—') return '<span style="color:#a0aec0;font-style:italic;">—</span>';
    const cls = ['Unggul','Baik Sekali','A'].includes(r) ? 'bdg-green' : r === 'C' ? 'bdg-red' : 'bdg-gold';
    return `<span class="bdg ${cls}"><i class="fas fa-check-circle" style="font-size:.6rem;"></i> ${r}</span>`;
}

// ── PREFETCH PDF saat hover (cukup sekali per URL) ──
const _prefetched = new Set();
function prefetchPDF(url) {
    if (!url || url === '#' || _prefetched.has(url)) return;
    _prefetched.add(url);
    const link = document.createElement('link');
    link.rel  = 'prefetch';
    link.href = url;
    link.as   = 'document';
    document.head.appendChild(link);
}

// ── BUKA PDF di tab baru dengan loading feedback ──
// Menggunakan window.open() agar tab utama tidak freeze saat browser mulai download
function openPDF(url, btn) {
    if (!url || url === '#') { toast('Dokumen PDF belum tersedia. Hubungi admin.'); return; }

    const orig = btn.innerHTML;
    btn.innerHTML     = '<i class="fas fa-spinner fa-spin"></i> Membuka...';
    btn.style.pointerEvents = 'none';

    window.open(url, '_blank', 'noopener,noreferrer');

    setTimeout(() => {
        btn.innerHTML           = orig;
        btn.style.pointerEvents = '';
    }, 1500);
}

// ── SHOW DETAIL ──
function showDetail(key) {
    const m = PRODI[key];
    if (!m) return;

    // Render header prodi
    document.getElementById('detail-header').innerHTML = `
        <div class="akr-icon" style="${m.style};width:60px;height:60px;border-radius:14px;font-size:1.5rem;">
            <i class="${m.icon}"></i>
        </div>
        <div class="card-info">
            <div class="card-no">${m.no}</div>
            <div class="card-name" style="font-size:1.15rem;">${m.nama}</div>
            <div class="card-badges">
                <span class="bdg bdg-blue">S1</span>
                <span class="bdg bdg-gold"><i class="fas fa-check-circle" style="font-size:.62rem;"></i> Terakreditasi</span>
            </div>
        </div>`;

    // Filter hanya yang sudah ada PDF-nya
    const rows  = (HIST[key] || []).filter(r => (PDF[r.key] || '#') !== '#');
    const tbody = document.getElementById('akr-tbody');

    if (!rows.length) {
        tbody.innerHTML = `<tr><td colspan="6">
            <div class="empty-state">
                <i class="fas fa-folder-open"></i>
                <p>Belum ada dokumen akreditasi yang diunggah.</p>
            </div>
        </td></tr>`;
    } else {
        // Build seluruh HTML sekaligus — lebih cepat dari loop appendChild
        tbody.innerHTML = rows.map((r, i) => {
            const url = PDF[r.key];
            return `<tr>
                <td class="td-no">${String(i + 1).padStart(2, '0')}</td>
                <td class="td-yr">${r.yr}</td>
                <td>${rankBadge(r.rank)}</td>
                <td>${fmtDate(r.exp)}</td>
                <td class="td-sk">${r.sk}</td>
                <td>
                    <button class="btn-gold-sm"
                        onmouseenter="prefetchPDF('${url}')"
                        onclick="openPDF('${url}', this)">
                        <i class="fas fa-file-pdf"></i> Unduh PDF
                    </button>
                </td>
            </tr>`;
        }).join('');
    }

    document.getElementById('list-view').style.display  = 'none';
    document.getElementById('detail-view').style.display = 'block';

    // requestAnimationFrame: pastikan DOM sudah update sebelum scroll
    requestAnimationFrame(() => {
        document.getElementById('detail-view').scrollIntoView({behavior: 'smooth', block: 'start'});
    });
}

// ── SHOW LIST ──
function showList() {
    document.getElementById('detail-view').style.display = 'none';
    document.getElementById('list-view').style.display   = 'block';
    requestAnimationFrame(() => window.scrollTo({top: 0, behavior: 'smooth'}));
}

// ── TOAST ──
function toast(msg) {
    document.getElementById('akr-toast')?.remove();
    const el = Object.assign(document.createElement('div'), {
        id: 'akr-toast',
        innerHTML: `<i class="fas fa-exclamation-circle me-2"></i>${msg}`
    });
    Object.assign(el.style, {
        position: 'fixed', bottom: '28px', left: '50%', transform: 'translateX(-50%)',
        background: '#0f1c6b', color: '#fff', border: '1px solid rgba(244,200,66,.5)',
        borderRadius: '10px', padding: '12px 22px', fontSize: '.85rem',
        zIndex: '9999', boxShadow: '0 8px 24px rgba(15,28,107,.3)',
        display: 'flex', alignItems: 'center', transition: 'opacity .3s',
    });
    document.body.appendChild(el);
    setTimeout(() => el.style.opacity = '0', 2800);
    setTimeout(() => el.remove(), 3100);
}
</script>

    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>