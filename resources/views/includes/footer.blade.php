{{--
    Footer menggunakan $footerSettings yang di-inject oleh AppServiceProvider ViewComposer.
    Satu query batch di-cache 1 jam — tidak ada Setting::getLink() individual di sini.
    Helper: $footerSettings->get('key')?->getUrl() ?? '#'
--}}
@php
    // Helper closure agar kode di bawah ringkas
    $fs = function(string $key, string $default = '#') use ($footerSettings): string {
        $s = $footerSettings->get($key);
        if (!$s || empty($s->value)) return $default;
        return $s->getUrl() ?? $default;
    };
@endphp

<footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row g-4">

            {{-- Kolom 1: Info Universitas - full width di mobile, 4 kolom di desktop --}}
            <div class="col-12 col-md-4">
                <h4 class="text-warning mb-3">UNIVERSITAS GUNUNG KIDUL (UGK)</h4>

                <p class="mb-0 fw-bold text-warning">Kampus 1:</p>
                <p class="mb-1 text-white">Jl. KH Agus Salim No.170, Ledoksari, Kepek</p>
                <p class="mb-3 text-white">Wonosari, Gunungkidul, Daerah Istimewa Yogyakarta, 55813</p>

                <p class="mb-0 fw-bold text-warning">Kampus 2:</p>
                <p class="mb-1 text-white">Jl. Lkr. Utara, Selang II, Selang</p>
                <p class="mb-3 text-white">Wonosari, Gunungkidul, Daerah Istimewa Yogyakarta, 55851</p>

                <p class="mb-1 text-white"><i class="fas fa-phone me-2 text-warning"></i>0823-1313-2007</p>
                <p class="mb-1 text-white"><i class="fas fa-envelope me-2 text-warning"></i>
                    <a href="mailto:univ_gunungkidul2019@ugk.ac.id" class="text-white text-decoration-none">univ_gunungkidul2019@ugk.ac.id</a>
                </p>
                <div class="mt-3">
                    <a href="#" class="text-white me-3"><i class="fab fa-facebook-f fa-lg"></i></a>
                    <a href="#" class="text-white me-3"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="{{ $fs('instagram') }}" class="text-white me-3" target="_blank" rel="noopener"><i class="fab fa-instagram fa-lg"></i></a>
                    <a href="{{ $fs('youtube') }}" class="text-white" target="_blank" rel="noopener"><i class="fab fa-youtube fa-lg"></i></a>
                </div>
            </div>

            {{-- Kolom 2: Akademik - 6/2 di mobile, 2 kolom di desktop --}}
            <div class="col-6 col-md-2">
                <h4 class="text-warning mb-3 footer-heading">AKADEMIK</h4>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ $fs('saintek') }}" class="text-white text-decoration-none">Fakultas Teknik</a></li>
                    <li><a href="{{ $fs('fishum') }}" class="text-white text-decoration-none">Fakultas Ilmu Sosial</a></li>
                    <li><a href="{{ $fs('feb') }}" class="text-white text-decoration-none">Fakultas Pertanian</a></li>
                    <li><a href="{{ $fs('perpus') }}" class="text-white text-decoration-none">Perpustakaan</a></li>
                    <li><a href="{{ $fs('kalender') }}" class="text-white text-decoration-none">Kalender Akademik</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Layanan Cepat - 6/2 di mobile, 3 kolom di desktop --}}
            <div class="col-6 col-md-3">
                <h4 class="text-warning mb-3 footer-heading">LAYANAN CEPAT</h4>
                <ul class="list-unstyled footer-links">
                    <li><a href="{{ $fs('pmb') }}" class="text-white text-decoration-none">Pendaftaran Mahasiswa Baru</a></li>
                    <li><a href="{{ $fs('siakad') }}" class="text-white text-decoration-none">Portal Mahasiswa (SIA)</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Jurnal UGK</a></li>
                    <li><a href="{{ $fs('tracer') }}" class="text-white text-decoration-none">Tracer Study</a></li>
                </ul>
            </div>

            {{-- Kolom 4: Link Lainnya - 6/2 di mobile, 3 kolom di desktop --}}
            <div class="col-6 col-md-3">
                <h4 class="text-warning mb-3 footer-heading">LINK LAINNYA</h4>
                <ul class="list-unstyled footer-links">
                    <li><a href="#" class="text-white text-decoration-none">Unit Kegiatan Mahasiswa</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Pusat Karir</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Galeri Foto</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Kebijakan Privasi</a></li>
                    <li><a href="#" class="text-white text-decoration-none">Struktur Organisasi</a></li>
                </ul>
            </div>

        </div>

        <hr class="border-secondary my-4">

        <div class="text-center small text-light opacity-75">
            &copy; {{ date('Y') }} Universitas Gunung Kidul. Hak Cipta Dilindungi.
        </div>
    </div>
</footer>
