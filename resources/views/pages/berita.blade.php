<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berita Kampus - Universitas Gunungkidul</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita.css') }}">
</head>
<body>
    @include('includes.navbar')

    <section class="page-header">
        <div class="container">
            <h1><i class="fas fa-newspaper me-2"></i>Berita Kampus</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                    <li class="breadcrumb-item active">Berita</li>
                </ol>
            </nav>
        </div>
    </section>

    <section class="container py-5">
        {{-- Filter & Search — kategori dari DB bukan hardcode --}}
        <form method="GET" action="{{ route('berita') }}" class="row g-2 mb-4 align-items-end">
            <div class="col-md-5">
                <input type="text" name="search" class="form-control"
                       placeholder="Cari berita..." value="{{ request('search') }}">
            </div>
            <div class="col-md-4">
                <select name="category" class="form-select">
                    <option value="all">Semua Kategori</option>
                    {{-- FIX: kategori dari DB bukan hardcode --}}
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
            <div class="col-md-1">
                <a href="{{ route('berita') }}" class="btn btn-outline-secondary w-100" title="Reset">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>

        {{-- Grid Berita --}}
        <div class="row g-4">
            @forelse($all_news as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden news-card">
                    <a href="{{ route('berita.detail', $item->slug) }}" class="text-decoration-none">
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}"
                                 class="card-img-top"
                                 alt="{{ $item->title }}"
                                 style="height:200px;object-fit:cover;"
                                 loading="lazy">
                        @else
                            <div class="d-flex align-items-center justify-content-center bg-light"
                                 style="height:200px;">
                                <i class="fas fa-newspaper fa-3x text-muted"></i>
                            </div>
                        @endif
                    </a>
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex align-items-center gap-2 mb-2">
                            @if($item->category)
                                <span class="badge bg-primary rounded-pill" style="font-size:11px;">
                                    {{ $item->category->name }}
                                </span>
                            @endif
                            <small class="text-muted">
                                {{ ($item->published_at ?? $item->created_at)->format('d M Y') }}
                            </small>
                        </div>
                        <h3 class="card-title h6 fw-bold mb-2">
                            <a href="{{ route('berita.detail', $item->slug) }}" class="text-dark text-decoration-none">
                                {{ $item->title }}
                            </a>
                        </h3>
                        <p class="card-text small text-muted flex-grow-1">
                            {{ Str::limit(strip_tags($item->content), 100) }}
                        </p>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <small class="text-muted">
                                <i class="fas fa-eye me-1"></i>{{ number_format($item->views) }} views
                            </small>
                            <a href="{{ route('berita.detail', $item->slug) }}"
                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                Baca
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <i class="fas fa-newspaper fa-4x text-muted mb-3 d-block"></i>
                <h4 class="text-muted">Belum ada berita</h4>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        @if($all_news->hasPages())
        <div class="d-flex justify-content-center mt-5">
            {{ $all_news->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </section>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>
