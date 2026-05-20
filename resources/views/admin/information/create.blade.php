@extends('admin.layouts.app')
@section('title','Tambah Informasi')
@section('page-title','Tambah Informasi')
@section('content')
<div class="row justify-content-center"><div class="col-xl-7">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.information.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Tambah Informasi Baru</h5>
</div>
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.information.store') }}">
    @csrf

    {{-- Row 1: Judul & Slug --}}
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label">Judul / Nama Agenda <span class="text-danger">*</span></label>
            <input type="text" name="title" id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   value="{{ old('title') }}" required>
            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
        <div class="col-md-6">
            <label class="form-label">ID Sistem (Slug) <span class="text-danger">*</span></label>
            <input type="text" name="slug" id="slug"
                   class="form-control @error('slug') is-invalid @enderror"
                   value="{{ old('slug') }}" required>
            <div class="form-text">Key unik, dipakai di kode. cth: <code>mahasiswa-aktif</code></div>
            @error('slug')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    {{-- Row 2: Tipe & Warna --}}
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label">Jenis Informasi <span class="text-danger">*</span></label>
            <select name="type" id="type" class="form-select" required>
                <option value="statistik" {{ old('type')==='statistik' ? 'selected':'' }}>Teks / Statistik (Angka)</option>
                <option value="agenda"    {{ old('type')==='agenda'    ? 'selected':'' }}>Agenda / Event</option>
                <option value="carousel"  {{ old('type')==='carousel'  ? 'selected':'' }}>Carousel Slide</option>
                <option value="lainnya"   {{ old('type')==='lainnya'   ? 'selected':'' }}>Lainnya</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Warna Teks &amp; Icon</label>
            <div class="input-group">
                <input type="text" name="color" id="colorHex"
                       class="form-control"
                       value="{{ old('color', '#0d6efd') }}"
                       maxlength="20"
                       placeholder="#0d6efd">
                <span class="input-group-text p-1">
                    <input type="color" id="colorPicker"
                           value="{{ old('color', '#0d6efd') }}"
                           class="form-control form-control-color border-0 p-0"
                           style="width:36px;height:36px;cursor:pointer;"
                           title="Pilih warna">
                </span>
            </div>
            <div class="form-text">Dipakai untuk warna teks, angka, dan ikon di halaman utama.</div>
        </div>
    </div>

    {{-- Row 3: Value & Subtitle --}}
    <div class="row g-3 mb-3">
        <div class="col-md-6">
            <label class="form-label">Nilai / Value</label>
            <input type="text" name="value" class="form-control" value="{{ old('value') }}"
                   placeholder="cth: 1500, atau URL gambar">
            <div class="form-text">Untuk statistik: angka. Untuk carousel: URL gambar.</div>
        </div>
        <div class="col-md-6">
            <label class="form-label">Subjudul / Deskripsi Singkat</label>
            <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}"
                   placeholder="cth: Semester Ganjil 2024/2025">
            <div class="form-text">Teks kecil di bawah judul (untuk agenda & carousel).</div>
        </div>
    </div>

    {{-- Event Date — tampil hanya untuk agenda --}}
    <div class="mb-3" id="eventDateWrap" style="{{ old('type','statistik') === 'agenda' ? '' : 'display:none;' }}">
        <label class="form-label">Tanggal Event <span class="text-danger">*</span></label>
        <input type="date" name="event_date" class="form-control @error('event_date') is-invalid @enderror"
               value="{{ old('event_date') }}">
        <div class="form-text">Tanggal pelaksanaan agenda. Agenda yang sudah lewat otomatis tidak ditampilkan.</div>
        @error('event_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    {{-- Konten --}}
    <div class="mb-4">
        <label class="form-label">Konten / Deskripsi Lengkap</label>
        <textarea name="content" class="form-control" rows="4"
                  placeholder="Deskripsi lengkap (opsional)...">{{ old('content') }}</textarea>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        <a href="{{ route('admin.information.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
@push('scripts')
<script>
(function () {
    // Auto-generate slug dari title (hanya jika user belum manual edit)
    const titleEl = document.getElementById('title');
    const slugEl  = document.getElementById('slug');
    titleEl.addEventListener('input', function () {
        if (!slugEl.dataset.edited) {
            slugEl.value = this.value.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .replace(/^-|-$/g, '');
        }
    });
    slugEl.addEventListener('input', function () {
        this.dataset.edited = '1';
    });

    // Sync color picker <-> hex input
    const hexInput    = document.getElementById('colorHex');
    const colorPicker = document.getElementById('colorPicker');
    colorPicker.addEventListener('input', function () {
        hexInput.value = this.value;
    });
    hexInput.addEventListener('input', function () {
        // Only sync picker if value looks like a valid hex
        if (/^#[0-9a-fA-F]{6}$/.test(this.value)) {
            colorPicker.value = this.value;
        }
    });

    // Tampilkan/sembunyikan field event_date berdasarkan type
    const typeSelect    = document.getElementById('type');
    const eventDateWrap = document.getElementById('eventDateWrap');
    const eventDateInput = eventDateWrap.querySelector('input[name=event_date]');
    typeSelect.addEventListener('change', function () {
        const isAgenda = this.value === 'agenda';
        eventDateWrap.style.display = isAgenda ? '' : 'none';
        eventDateInput.required = isAgenda;
    });
    // Trigger on load
    typeSelect.dispatchEvent(new Event('change'));
})();
</script>
@endpush
