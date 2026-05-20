@extends('admin.layouts.app')
@section('title','Edit Kalender')
@section('page-title','Edit Kalender Akademik')
@section('content')
<div class="row justify-content-center"><div class="col-xl-6">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.kalender.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Edit Kalender Akademik</h5>
</div>
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.kalender.update', $kalender) }}" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Tahun Akademik <span class="text-danger">*</span></label>
        <input type="text" name="tahun_akademik" class="form-control"
               value="{{ old('tahun_akademik', $kalender->tahun_akademik) }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Semester <span class="text-danger">*</span></label>
        <select name="semester" class="form-select" required>
            <option value="Ganjil" {{ old('semester',$kalender->semester)==='Ganjil' ? 'selected':'' }}>Ganjil</option>
            <option value="Genap"  {{ old('semester',$kalender->semester)==='Genap'  ? 'selected':'' }}>Genap</option>
        </select>
    </div>
    <div class="mb-3">
        <label class="form-label">Upload PDF Baru</label>
        @if($kalender->file_pdf)
            <div class="mb-2">
                <a href="{{ Storage::url($kalender->file_pdf) }}" target="_blank" class="btn btn-sm btn-outline-danger">
                    <i class="bi bi-file-pdf me-1"></i>PDF Saat Ini
                </a>
            </div>
        @endif
        <input type="file" name="file_pdf" class="form-control" accept="application/pdf">
        <div class="form-text">Kosongkan jika tidak ingin mengganti</div>
    </div>
    <div class="mb-4">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                   {{ old('is_active', $kalender->is_active) ? 'checked':'' }}>
            <label class="form-check-label" for="is_active">Jadikan aktif (tampil di website)</label>
        </div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
        <a href="{{ route('admin.kalender.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
