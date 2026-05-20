@extends('admin.layouts.app')
@section('title', 'Edit Pengumuman')
@section('page-title', 'Edit Pengumuman')

@section('content')
<div class="row justify-content-center">
<div class="col-xl-7">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Edit Pengumuman</h5>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pengumuman.update', $pengumuman) }}" enctype="multipart/form-data">
            @csrf @method('PUT')
            <div class="mb-3">
                <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control" value="{{ old('judul', $pengumuman->judul) }}" required>
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control"
                           value="{{ old('tanggal', \Carbon\Carbon::parse($pengumuman->tanggal)->format('Y-m-d')) }}" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select" required>
                        @foreach(['Umum','Akademik','Penting'] as $kat)
                            <option value="{{ $kat }}" {{ old('kategori', $pengumuman->kategori)===$kat ? 'selected' : '' }}>{{ $kat }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi / Keterangan</label>
                <textarea name="isi" class="form-control" rows="4">{{ old('isi', $pengumuman->isi) }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label">Upload PDF Baru</label>
                @if($pengumuman->file_pdf)
                    <div class="mb-2">
                        <a href="{{ Storage::url($pengumuman->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-file-pdf me-1"></i>Lihat PDF Saat Ini
                        </a>
                    </div>
                @endif
                <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
                <div class="form-text">Kosongkan jika tidak ingin mengganti PDF</div>
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
