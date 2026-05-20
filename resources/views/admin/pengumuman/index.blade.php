@extends('admin.layouts.app')

@section('title', 'Manajemen Pengumuman')
@section('page-title', 'Manajemen Pengumuman')

@section('topbar-actions')
    <a href="{{ route('admin.pengumuman.create') }}" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-lg me-1"></i>Tambah Pengumuman
    </a>
@endsection

@section('content')
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Cari judul pengumuman..." value="{{ request('search') }}">
            </div>
            <div class="col-sm-3">
                <select name="kategori" class="form-select form-select-sm">
                    <option value="all">Semua Kategori</option>
                    <option value="Penting"  {{ request('kategori')==='Penting'  ? 'selected' : '' }}>Penting</option>
                    <option value="Akademik" {{ request('kategori')==='Akademik' ? 'selected' : '' }}>Akademik</option>
                    <option value="Umum"     {{ request('kategori')==='Umum'     ? 'selected' : '' }}>Umum</option>
                </select>
            </div>
            <div class="col-sm-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-1">Filter</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Pengumuman</span>
        <span class="text-muted" style="font-size:12px;">{{ $pengumuman->total() }} pengumuman</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Tanggal</th>
                    <th>File PDF</th>
                    <th style="width:120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pengumuman as $item)
                <tr>
                    <td class="text-muted" style="font-size:12px;">{{ $loop->iteration + ($pengumuman->currentPage()-1)*$pengumuman->perPage() }}</td>
                    <td class="fw-semibold" style="font-size:13.5px;">{{ Str::limit($item->judul, 60) }}</td>
                    <td>
                        @php
                            $badgeColor = match($item->kategori) {
                                'Penting'  => 'danger',
                                'Akademik' => 'primary',
                                default    => 'secondary',
                            };
                        @endphp
                        <span class="badge bg-{{ $badgeColor }} bg-opacity-10 text-{{ $badgeColor }}" style="font-size:11px;">
                            {{ $item->kategori }}
                        </span>
                    </td>
                    <td style="font-size:12px;color:#64748b;">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td>
                        @if($item->file_pdf)
                            <a href="{{ Storage::url($item->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger" style="font-size:11px;">
                                <i class="bi bi-file-pdf me-1"></i>Lihat PDF
                            </a>
                        @else
                            <span class="text-muted" style="font-size:12px;">—</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.pengumuman.edit', $item) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form method="POST" action="{{ route('admin.pengumuman.destroy', $item) }}"
                                  onsubmit="return confirm('Hapus pengumuman ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">
                        <i class="bi bi-megaphone fs-2 d-block mb-2"></i>Belum ada pengumuman
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($pengumuman->hasPages())
    <div class="card-body border-top py-3">{{ $pengumuman->links() }}</div>
    @endif
</div>
@endsection
