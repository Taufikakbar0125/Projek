<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsip Pengumuman - Universitas Gunungkidul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/pengumuman.css') }}">
</head>
<body>
    @include('includes.navbar')

    @php
        $query = \App\Models\Pengumuman::query();
        if (request('search')) {
            $query->where('judul', 'like', '%' . request('search') . '%');
        }
        if (request('category') && request('category') !== 'all') {
            $query->where('kategori', request('category'));
        }
        $all_pengumuman = $query->orderBy('tanggal', 'desc')->paginate(10)->withQueryString();
        $total_penting  = \App\Models\Pengumuman::where('kategori', 'Penting')->count();
        $total_akademik = \App\Models\Pengumuman::where('kategori', 'Akademik')->count();
        $total_umum     = \App\Models\Pengumuman::where('kategori', 'Umum')->count();
    @endphp

    {{-- PAGE HEADER --}}
    <section class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <h1><i class="fas fa-bullhorn"></i>Arsip Pengumuman</h1>
                    <p class="lead mb-0">Informasi dan pengumuman resmi Universitas Gunungkidul</p>
                </div>
                <div class="col-lg-4 text-lg-end mt-2 mt-lg-0">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb justify-content-lg-end mb-0">
                            <li class="breadcrumb-item"><a href="{{ url('/') }}">Beranda</a></li>
                            <li class="breadcrumb-item active">Pengumuman</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    {{-- STAT CARDS --}}
    <section class="container mt-4">
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <div class="stat-card stat-card-primary">
                    <div class="stat-icon"><i class="fas fa-file-alt"></i></div>
                    <div class="stat-content">
                        <h3>{{ \App\Models\Pengumuman::count() }}</h3>
                        <p>Total Pengumuman</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-card-warning">
                    <div class="stat-icon"><i class="fas fa-exclamation-circle"></i></div>
                    <div class="stat-content">
                        <h3>{{ $total_penting }}</h3>
                        <p>Penting</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-card-success">
                    <div class="stat-icon"><i class="fas fa-calendar-check"></i></div>
                    <div class="stat-content">
                        <h3>{{ $total_akademik }}</h3>
                        <p>Akademik</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="stat-card stat-card-info">
                    <div class="stat-icon"><i class="fas fa-info-circle"></i></div>
                    <div class="stat-content">
                        <h3>{{ $total_umum }}</h3>
                        <p>Umum</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- FILTER BAR --}}
        <form action="{{ url()->current() }}" method="GET" class="filter-bar mt-4">
            <div class="row g-2 align-items-end">
                <div class="col-5 col-md-3">
                    <label class="form-label fw-bold d-none d-md-block">Kategori</label>
                    <select class="form-select" name="category" onchange="this.form.submit()">
                        <option value="all" {{ request('category') == 'all' ? 'selected' : '' }}>Semua</option>
                        <option value="Akademik" {{ request('category') == 'Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Penting" {{ request('category') == 'Penting' ? 'selected' : '' }}>Penting</option>
                        <option value="Umum" {{ request('category') == 'Umum' ? 'selected' : '' }}>Umum</option>
                    </select>
                </div>
                <div class="col-7 col-md-7">
                    <label class="form-label fw-bold d-none d-md-block">Cari Pengumuman</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Cari judul..." value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <a href="{{ url()->current() }}" class="btn btn-outline-secondary w-100">
                        <i class="fas fa-redo"></i> <span class="d-none d-md-inline">Reset</span>
                    </a>
                </div>
            </div>
        </form>
    </section>

    {{-- TIMELINE --}}
    <section class="container mt-4 mb-5">
        <div class="timeline-container">
            @forelse($all_pengumuman as $item)
                <div class="timeline-item {{ strtolower($item->kategori) }}">
                    <div class="timeline-date">
                        <span class="day">{{ date('d', strtotime($item->tanggal)) }}</span>
                        <span class="month">{{ date('M', strtotime($item->tanggal)) }}</span>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <div class="timeline-title">
                                <h3>{{ $item->judul }}</h3>
                                <span class="timeline-category {{ strtolower($item->kategori) }}">
                                    {{ $item->kategori }}
                                </span>
                            </div>
                        </div>
                        <div class="timeline-description">
                            {{ Str::limit(strip_tags($item->deskripsi), 180) }}
                        </div>
                        <div class="timeline-meta">
                            <span><i class="fas fa-user"></i> Admin UGK</span>
                            <span><i class="fas fa-calendar"></i> {{ $item->tanggal->format('d M Y') }}</span>
                            @if($item->file_pdf)
                                <span><i class="fas fa-file-pdf text-danger"></i> Ada Lampiran</span>
                            @endif
                        </div>
                        <div class="timeline-action d-flex gap-2 mt-3 flex-wrap">
                            <a href="{{ route('pengumuman.detail', $item->id) }}" class="btn btn-primary btn-sm rounded-pill px-3">
                                Lihat Detail <i class="fas fa-eye ms-1"></i>
                            </a>
                            @if($item->file_pdf)
                                <a href="{{ asset('storage/' . $item->file_pdf) }}" target="_blank" class="btn btn-outline-danger btn-sm rounded-pill px-3">
                                    Unduh PDF <i class="fas fa-download ms-1"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-results py-5 text-center">
                    <i class="fas fa-inbox fa-4x text-muted mb-3"></i>
                    <h3>Tidak Ada Pengumuman</h3>
                    <p>Tidak ada pengumuman yang sesuai dengan kriteria Anda.</p>
                </div>
            @endforelse
        </div>

        <div class="pagination-wrapper mt-4 d-flex justify-content-center">
            {{ $all_pengumuman->links('pagination::bootstrap-5') }}
        </div>
    </section>

    @include('includes.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>