<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $pengumuman->judul }} - Universitas Gunungkidul</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pengumumanglobal.css') }}">
</head>
<body>
    @include('includes.navbar')

    <div class="container py-5">
        <nav aria-label="breadcrumb" class="mb-4">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('pengumuman') }}">Arsip Pengumuman</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card detail-card p-4 p-md-5">

                    <div class="mb-3">
                        @php
                            $badgeClass = match($pengumuman->kategori) {
                                'Akademik' => 'bg-success',
                                'Penting'  => 'bg-danger',
                                default    => 'bg-primary',
                            };
                        @endphp
                        <span class="badge rounded-pill px-3 py-2 {{ $badgeClass }}">
                            {{ $pengumuman->kategori }}
                        </span>
                        <span class="ms-2 text-muted">
                            <i class="far fa-calendar-alt me-1"></i>
                            {{ $pengumuman->tanggal->format('d F Y') }}
                        </span>
                    </div>

                    <h1 class="fw-bold text-primary mb-4" style="color:#140099 !important;">
                        {{ $pengumuman->judul }}
                    </h1>

                    <div class="meta-info mb-4 d-flex gap-4 flex-wrap">
                        <span><i class="fas fa-user-circle me-1"></i> Oleh: <strong>Admin UGK</strong></span>
                    </div>

                    {{-- FIX: kolom yang benar adalah 'isi', bukan 'deskripsi' --}}
                    @if($pengumuman->isi)
                    <div class="announcement-content mb-5">
                        {!! nl2br(e($pengumuman->isi)) !!}
                    </div>
                    @endif

                    @if($pengumuman->file_pdf)
                    <div class="p-4 rounded-3 bg-light border attachment-box d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="mb-3 mb-md-0">
                            <h5 class="fw-bold mb-1">
                                <i class="fas fa-file-pdf text-danger me-2"></i> Dokumen Lampiran
                            </h5>
                            <p class="small text-muted mb-0">Silakan unduh untuk informasi lebih terperinci.</p>
                        </div>
                        {{-- FIX: pakai Storage::url(), bukan asset('storage/') --}}
                        <a href="{{ Storage::url($pengumuman->file_pdf) }}"
                           target="_blank"
                           class="btn btn-danger px-4 py-2 fw-bold">
                            <i class="fas fa-download me-2"></i> Download PDF
                        </a>
                    </div>
                    @endif

                    <div class="mt-5 d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <a href="{{ route('pengumuman') }}" class="btn btn-outline-secondary px-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Arsip
                        </a>

                        <div class="share-buttons">
                            <span class="small text-muted me-2">Bagikan:</span>
                            <a href="https://wa.me/?text={{ urlencode($pengumuman->judul . ' ' . request()->url()) }}"
                               target="_blank" class="btn btn-sm btn-success">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank" class="btn btn-sm btn-primary">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>
