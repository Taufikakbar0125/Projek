@extends('admin.layouts.app')
@section('title','Tambah Fasilitas')
@section('page-title','Tambah Fasilitas')
@section('content')
<div class="row justify-content-center"><div class="col-xl-7">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.facility.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Tambah Fasilitas Baru</h5>
</div>
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.facility.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label class="form-label">Nama Fasilitas <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" placeholder="cth: Laboratorium Komputer" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea name="description" class="form-control" rows="3"
                  placeholder="Deskripsi singkat fasilitas...">{{ old('description') }}</textarea>
    </div>
    <div class="mb-3">
        <label class="form-label">Foto Fasilitas</label>
        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
               accept="image/jpg,image/jpeg,image/png,image/webp" onchange="previewImg(this)">
        <div class="form-text">JPG/PNG/WebP, maks 2MB</div>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        <img id="preview" class="mt-2 rounded d-none" style="max-width:200px;max-height:150px;object-fit:cover;">
    </div>
    <div class="mb-4">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}" min="0" style="max-width:120px;">
        <div class="form-text">Angka lebih kecil = tampil lebih dulu</div>
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        <a href="{{ route('admin.facility.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
@push('scripts')
<script>
function previewImg(input) {
    const preview = document.getElementById('preview');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.src = e.target.result; preview.classList.remove('d-none'); };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
