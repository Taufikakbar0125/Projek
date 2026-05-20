{{-- ============================================================ --}}
{{-- SIMPAN SEBAGAI: resources/views/admin/pengumuman/create.blade.php --}}
{{-- ============================================================ --}}
@extends('admin.layouts.app')
@section('title', 'Tambah Pengumuman')
@section('page-title', 'Tambah Pengumuman')

@section('content')
<div class="row justify-content-center">
<div class="col-xl-7">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Tambah Pengumuman Baru</h5>
</div>
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pengumuman.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Judul Pengumuman <span class="text-danger">*</span></label>
                <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                       value="{{ old('judul') }}" required>
                @error('judul')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="row g-3 mb-3">
                <div class="col-sm-6">
                    <label class="form-label">Tanggal <span class="text-danger">*</span></label>
                    <input type="date" name="tanggal" class="form-control" value="{{ old('tanggal', date('Y-m-d')) }}" required>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="kategori" class="form-select" required>
                        <option value="Umum"     {{ old('kategori')==='Umum'     ? 'selected' : '' }}>Umum</option>
                        <option value="Akademik" {{ old('kategori')==='Akademik' ? 'selected' : '' }}>Akademik</option>
                        <option value="Penting"  {{ old('kategori')==='Penting'  ? 'selected' : '' }}>Penting</option>
                    </select>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Isi / Keterangan</label>
                <textarea name="isi" class="form-control" rows="4" placeholder="Isi pengumuman (opsional)...">{{ old('isi') }}</textarea>
            </div>
            <div class="mb-4">
                <label class="form-label">Upload PDF</label>
                <input type="file" name="file_pdf" class="form-control @error('file_pdf') is-invalid @enderror" accept="application/pdf">
                <div class="form-text">Format PDF, maks 5MB</div>
                @error('file_pdf')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
                <a href="{{ route('admin.pengumuman.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>
@endsection
