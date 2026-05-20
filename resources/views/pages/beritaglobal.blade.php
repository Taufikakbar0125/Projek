<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $berita->title }} - Universitas Gunungkidul</title>
    <meta name="description" content="{{ Str::limit(strip_tags($berita->content), 160) }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/berita-global.css') }}">
</head>
<body>
    @include('includes.navbar')

    <main class="article-content-area">
        <div class="container">
            <div class="row">
                {{-- KONTEN UTAMA --}}
                <div class="col-lg-8">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('berita') }}">Berita</a></li>
                            <li class="breadcrumb-item active">{{ Str::limit($berita->title, 30) }}</li>
                        </ol>
                    </nav>

                    <h1 class="article-title">{{ $berita->title }}</h1>

                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt me-1"></i> {{ ($berita->published_at ?? $berita->created_at)->format('d M Y') }}</span>
                        <span><i class="far fa-eye me-1"></i> Dilihat {{ number_format($berita->views) }} kali</span>
                        @if($berita->category)
                            <span class="badge bg-primary px-3 rounded-pill">{{ $berita->category->name }}</span>
                        @endif
                    </div>

                    @if($berita->image)
                    <div class="article-image-wrapper">
                        <img src="{{ Storage::url($berita->image) }}"
                             class="article-image shadow"
                             alt="{{ $berita->title }}"
                             loading="lazy">
                    </div>
                    @endif

                    <div class="article-body">
                        {!! $berita->content !!}
                    </div>

                    <div class="py-4 mt-5 border-top">
                        <a href="{{ route('berita') }}" class="btn btn-dark rounded-pill px-4">
                            <i class="fas fa-arrow-left me-2"></i> Kembali ke Berita
                        </a>
                    </div>
                </div>

                {{-- SIDEBAR — $others dari controller, bukan query di blade --}}
                <div class="col-lg-4">
                    <div class="sidebar-sticky">
                        <h5 class="sidebar-title">Berita Terkait</h5>

                        @forelse($others as $other)
                        <a href="{{ route('berita.detail', $other->slug) }}" class="sidebar-item">
                            @if($other->image)
                                <img src="{{ Storage::url($other->image) }}"
                                     class="sidebar-thumb" alt="{{ $other->title }}" loading="lazy">
                            @else
                                <div class="sidebar-thumb d-flex align-items-center justify-content-center bg-light">
                                    <i class="fas fa-newspaper text-muted"></i>
                                </div>
                            @endif
                            <div class="sidebar-text">
                                <h6>{{ Str::limit($other->title, 55) }}</h6>
                                <span>{{ ($other->published_at ?? $other->created_at)->format('d/m/Y') }}</span>
                            </div>
                        </a>
                        @empty
                        <p class="text-muted small">Belum ada berita lain.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('includes.footer')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/script.js') }}" defer></script>
</body>
</html>
