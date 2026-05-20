@extends('admin.layouts.app')
@section('title','Informasi')
@section('page-title','Manajemen Informasi')
@section('topbar-actions')
<a href="{{ route('admin.information.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Informasi</a>
@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Cari judul..." value="{{ request('search') }}">
            </div>
            <div class="col-sm-3">
                <select name="type" class="form-select form-select-sm">
                    <option value="">Semua Tipe</option>
                    <option value="agenda"    {{ request('type')==='agenda'    ? 'selected':'' }}>Agenda</option>
                    <option value="statistik" {{ request('type')==='statistik' ? 'selected':'' }}>Statistik</option>
                    <option value="carousel"  {{ request('type')==='carousel'  ? 'selected':'' }}>Carousel</option>
                    <option value="lainnya"   {{ request('type')==='lainnya'   ? 'selected':'' }}>Lainnya</option>
                </select>
            </div>
            <div class="col-sm-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-1">Filter</button>
                <a href="{{ route('admin.information.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Informasi</span>
        <span class="text-muted" style="font-size:12px;">{{ $information->total() }} item</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Judul</th><th>Slug</th><th>Tipe</th><th>Nilai</th><th style="width:120px;">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($information as $item)
            <tr>
                <td style="font-size:12px;color:#64748b;">{{ $loop->iteration + ($information->currentPage()-1)*$information->perPage() }}</td>
                <td class="fw-semibold" style="font-size:13.5px;">{{ $item->title }}</td>
                <td><code style="font-size:11px;">{{ $item->slug }}</code></td>
                <td>
                    @php $colors = ['agenda'=>'primary','statistik'=>'success','carousel'=>'warning','lainnya'=>'secondary']; @endphp
                    <span class="badge bg-{{ $colors[$item->type] ?? 'secondary' }} bg-opacity-10 text-{{ $colors[$item->type] ?? 'secondary' }}" style="font-size:11px;">
                        {{ ucfirst($item->type) }}
                    </span>
                </td>
                <td style="font-size:12px;color:#64748b;">{{ Str::limit($item->value ?? $item->content, 40) }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.information.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.information.destroy', $item) }}" onsubmit="return confirm('Hapus informasi ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-info-circle fs-2 d-block mb-2"></i>Belum ada informasi</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($information->hasPages())<div class="card-body border-top py-3">{{ $information->links() }}</div>@endif
</div>
@endsection
