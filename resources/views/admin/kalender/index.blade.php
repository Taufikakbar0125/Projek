@extends('admin.layouts.app')
@section('title','Kalender Akademik')
@section('page-title','Kalender Akademik')
@section('topbar-actions')
<a href="{{ route('admin.kalender.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah</a>
@endsection
@section('content')
<div class="card">
    <div class="card-header">Daftar Kalender Akademik</div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Tahun Akademik</th><th>Semester</th><th>Status</th><th>File</th><th>Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($kalenders as $item)
            <tr>
                <td style="font-size:12px;color:#64748b;">{{ $loop->iteration }}</td>
                <td class="fw-semibold">{{ $item->tahun_akademik }}</td>
                <td>{{ $item->semester }}</td>
                <td>
                    @if($item->is_active)
                        <span class="badge badge-published rounded-pill">Aktif</span>
                    @else
                        <span class="badge badge-archived rounded-pill">Nonaktif</span>
                    @endif
                </td>
                <td>
                    @if($item->file_pdf)
                        <a href="{{ Storage::url($item->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger" style="font-size:11px;"><i class="bi bi-file-pdf"></i> PDF</a>
                    @else
                        <span class="text-muted" style="font-size:12px;">—</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.kalender.edit',$item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <form method="POST" action="{{ route('admin.kalender.destroy',$item) }}" onsubmit="return confirm('Hapus?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-calendar3 fs-2 d-block mb-2"></i>Belum ada kalender</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($kalenders->hasPages())<div class="card-body border-top py-3">{{ $kalenders->links() }}</div>@endif
</div>
@endsection
