@extends('admin.layouts.app')
@section('title','Tambah Menu')
@section('page-title','Tambah Menu Navigasi')
@section('content')
<div class="row justify-content-center"><div class="col-xl-6">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.navmenu.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Tambah Menu Baru</h5>
</div>

{{-- Panduan level --}}
<div class="alert alert-info d-flex gap-2 mb-4" style="font-size:13px;background:#eff6ff;border:none;border-radius:10px;">
    <i class="bi bi-info-circle-fill mt-1"></i>
    <div>
        <strong>Panduan Level Menu:</strong><br>
        <span class="text-muted">Tidak ada parent</span> = Menu Utama (level 1, misal: Beranda, Profil)<br>
        <span class="text-muted">Parent = Menu Utama</span> = Submenu dropdown (level 2, misal: Teknik Sipil di bawah Akademik)<br>
        <span class="text-muted">Parent = Submenu (—)</span> = Sub-submenu (level 3, misal: Prodi di bawah Fakultas)
    </div>
</div>

<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.navmenu.store') }}">
    @csrf

    @if($errors->any())
        <div class="alert alert-danger" style="font-size:13px;">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Label Menu <span class="text-danger">*</span></label>
        <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
               value="{{ old('label') }}" placeholder="cth: Teknik Sipil" required>
        @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">URL / Link</label>
        <input type="text" name="url" class="form-control" value="{{ old('url') }}"
               placeholder="cth: /prodi/teknik-sipil">
        <div class="form-text">Kosongkan jika menu ini hanya sebagai header (tidak bisa diklik).</div>
    </div>

    <div class="mb-3">
        <label class="form-label">Parent Menu</label>
        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">— Tidak ada (Menu Utama / Level 1) —</option>
            @foreach($allMenus as $m)
                <option value="{{ $m['id'] }}" {{ old('parent_id') == $m['id'] ? 'selected' : '' }}>
                    {{ $m['prefix'] }}{{ $m['label'] }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            Tanda <code>—</code> = Level 2 (submenu). Tanda <code>— —</code> = Level 3 (sub-submenu).
        </div>
        @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control"
               value="{{ old('sort_order', 0) }}" min="0" style="max-width:120px;">
        <div class="form-text">Angka lebih kecil tampil lebih dulu.</div>
    </div>

    <div class="mb-4">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                   {{ old('is_active', true) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif (tampil di navbar)</label>
        </div>
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
        <a href="{{ route('admin.navmenu.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
