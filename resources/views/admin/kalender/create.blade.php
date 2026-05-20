@extends('admin.layouts.app')
@section('title','Tambah Kalender')
@section('page-title','Tambah Kalender Akademik')
@section('content')
<div class="row justify-content-center"><div class="col-xl-6">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.kalender.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Tambah Kalender Akademik</h5>
</div>
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.kalender.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
        <input type="text" name="tahun_akademik" class="form-control" placeholder="2024/2025" value="{{ old('tahun_akademik') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Semester <span class="text-danger">*</span></label>
        <select name="semester" class="form-select" required>
            <option value="Ganjil">Ganjil</option>
            <option value="Genap">Genap</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Upload PDF Kalender</label>
        <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
        <div class="form-text">Format PDF, maks 10MB</div>
    </div>
    <div class="mb-4">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active">
            <label class="form-check-label" for="is_active">Jadikan aktif (tampil di website)</label>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        <a href="{{ route('admin.kalender.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
