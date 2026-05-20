@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#dbeafe;">
                <i class="bi bi-newspaper text-primary fs-5"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['published'] }}</div>
                <div class="stat-label">Berita Tayang</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#fef9c3;">
                <i class="bi bi-hourglass-split text-warning fs-5"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['pending'] }}</div>
                <div class="stat-label">Berita Pending</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#dcfce7;">
                <i class="bi bi-eye text-success fs-5"></i>
            </div>
            <div>
                <div class="stat-value">{{ number_format($stats['total_views']) }}</div>
                <div class="stat-label">Total Views</div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#f3e8ff;">
                <i class="bi bi-people text-purple fs-5" style="color:#7c3aed;"></i>
            </div>
            <div>
                <div class="stat-value">{{ $stats['total_users'] }}</div>
                <div class="stat-label">Total Admin</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Berita Pending --}}
    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex align-items-center justify-content-between">
                <span><i class="bi bi-hourglass-split text-warning me-2"></i>Berita Menunggu Persetujuan</span>
                <a href="{{ route('admin.news.index', ['status'=>'pending']) }}" class="btn btn-sm btn-outline-secondary" style="font-size:12px;">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                @forelse($pendingNews as $item)
                <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom">
                    @if($item->image)
                        <img src="{{ Storage::url($item->image) }}" class="rounded" style="width:46px;height:46px;object-fit:cover;">
                    @else
                        <div class="rounded d-flex align-items-center justify-content-center bg-light" style="width:46px;height:46px;">
                            <i class="bi bi-image text-muted"></i>
                        </div>
                    @endif
                    <div class="flex-1" style="min-width:0;">
                        <div class="fw-600 text-truncate" style="font-size:13.5px;font-weight:600;">{{ $item->title }}</div>
                        <div style="font-size:12px;color:#64748b;">
                            {{ $item->category->name ?? '-' }} &bull;
                            {{ $item->created_at->diffForHumans() }}
                            @if($item->user) &bull; {{ $item->user->name }} @endif
                        </div>
                    </div>
                    <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-primary" style="font-size:12px;white-space:nowrap;">
                        Review
                    </a>
                </div>
                @empty
                <div class="text-center py-5 text-muted">
                    <i class="bi bi-check-circle fs-2 d-block mb-2 text-success"></i>
                    Tidak ada berita pending
                </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Berita Terbaru --}}
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <i class="bi bi-clock-history text-primary me-2"></i>Berita Terbaru Tayang
            </div>
            <div class="card-body p-0">
                @foreach($latestNews as $item)
                <div class="d-flex align-items-center gap-3 px-4 py-3 border-bottom">
                    <div style="width:36px;height:36px;border-radius:8px;background:#dbeafe;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-newspaper text-primary" style="font-size:16px;"></i>
                    </div>
                    <div style="min-width:0;flex:1;">
                        <div class="text-truncate fw-semibold" style="font-size:13px;">{{ $item->title }}</div>
                        <div style="font-size:11px;color:#94a3b8;">
                            {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                            &bull; {{ number_format($item->views) }} views
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
