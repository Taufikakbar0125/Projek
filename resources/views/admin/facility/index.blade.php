@extends('admin.layouts.app')
@section('title','Fasilitas')
@section('page-title','Fasilitas Kampus')
@section('topbar-actions')
<a href="{{ route('admin.facility.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Fasilitas</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar Fasilitas</span>
        <span class="text-muted" style="font-size:12px;">{{ $facilities->total() }} fasilitas</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Foto</th><th>Nama</th><th>Deskripsi</th><th>Urutan</th><th style="width:120px;">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($facilities as $item)
            <tr>
                <td style="font-size:12px;color:#64748b;">{{ $loop->iteration }}</td>
                <td>
                    @if($item->image)
                        <img src="{{ Storage::url($item->image) }}" style="width:48px;height:48px;object-fit:cover;border-radius:8px;">
                    @else
                        <div style="width:48px;height:48px;background:#f1f5f9;border-radius:8px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-image text-muted"></i>
                        </div>
                    @endif
                </td>
                <td class="fw-semibold" style="font-size:13.5px;">{{ $item->name }}</td>
                <td style="font-size:13px;color:#64748b;">{{ Str::limit($item->description, 60) }}</td>
                <td style="font-size:13px;">{{ $item->sort_order }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.facility.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.facility.destroy', $item) }}" onsubmit="return confirm('Hapus fasilitas ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-building fs-2 d-block mb-2"></i>Belum ada fasilitas</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($facilities->hasPages())<div class="card-body border-top py-3">{{ $facilities->links() }}</div>@endif
</div>
@endsection
