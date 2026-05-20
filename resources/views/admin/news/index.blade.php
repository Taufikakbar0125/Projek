@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')
@section('page-title', 'Manajemen Berita')

@section('topbar-actions')
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Berita
    </a>
@endsection

@section('content')
{{-- Filter --}}
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Cari judul berita..." value="{{ request('search') }}">
            </div>
            <div class="col-sm-3">
                <select name="status" class="form-select form-select-sm">
                    <option value="all">Semua Status</option>
                    <option value="pending"   {{ request('status')==='pending'   ? 'selected' : '' }}>Pending</option>
                    <option value="published" {{ request('status')==='published' ? 'selected' : '' }}>Published</option>
                </select>
            </div>
            <div class="col-sm-2">
                <select name="category" class="form-select form-select-sm">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category')==$cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-1">Filter</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Tabel --}}
<div class="card">
    <div class="card-header d-flex align-items-center justify-content-between">
        <span>Daftar Berita</span>
        <span class="text-muted" style="font-size:12px;">{{ $news->total() }} berita</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:50px;">#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Views</th>
                    <th>Tanggal</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($news as $item)
                <tr>
                    <td class="text-muted" style="font-size:12px;">{{ $loop->iteration + ($news->currentPage()-1)*$news->perPage() }}</td>
                    <td>
                        <div class="fw-semibold" style="font-size:13.5px;max-width:360px;" class="text-truncate">
                            {{ Str::limit($item->title, 70) }}
                        </div>
                        @if($item->is_archived)
                            <span class="badge badge-archived rounded-pill mt-1">Diarsipkan</span>
                        @endif
                    </td>
                    <td><span class="badge bg-light text-dark" style="font-size:11px;">{{ $item->category->name ?? '-' }}</span></td>
                    <td>
                        @if($item->status === 'published')
                            <span class="badge badge-published rounded-pill">Published</span>
                        @else
                            <span class="badge badge-pending rounded-pill">Pending</span>
                        @endif
                    </td>
                    <td style="font-size:13px;">{{ number_format($item->views) }}</td>
                    <td style="font-size:12px;color:#64748b;">
                        {{ $item->published_at ? $item->published_at->format('d M Y') : $item->created_at->format('d M Y') }}
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.news.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-5 text-muted">
                        <i class="bi bi-newspaper fs-2 d-block mb-2"></i>
                        Belum ada berita
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($news->hasPages())
    <div class="card-body border-top py-3">
        {{ $news->links() }}
    </div>
    @endif
</div>
@endsection
