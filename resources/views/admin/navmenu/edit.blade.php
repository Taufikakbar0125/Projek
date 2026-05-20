@extends('admin.layouts.app')
@section('title','Edit Menu')
@section('page-title','Edit Menu Navigasi')
@section('content')
<div class="row justify-content-center"><div class="col-xl-6">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.navmenu.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Edit Menu: <span class="text-primary">{{ $navmenu->label }}</span></h5>
</div>

<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.navmenu.update', $navmenu) }}">
    @csrf @method('PUT')

    @if($errors->any())
        <div class="alert alert-danger" style="font-size:13px;">
            @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
        </div>
    @endif

    <div class="mb-3">
        <label class="form-label">Label Menu <span class="text-danger">*</span></label>
        <input type="text" name="label" class="form-control @error('label') is-invalid @enderror"
               value="{{ old('label', $navmenu->label) }}" required>
        @error('label')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">URL / Link</label>
        <input type="text" name="url" class="form-control" value="{{ old('url', $navmenu->url) }}">
        <div class="form-text">Kosongkan jika menu ini hanya sebagai header dropdown.</div>
    </div>

    <div class="mb-3">
        <label class="form-label">Parent Menu</label>
        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
            <option value="">— Tidak ada (Menu Utama / Level 1) —</option>
            @foreach($allMenus as $m)
                <option value="{{ $m['id'] }}" {{ old('parent_id', $navmenu->parent_id) == $m['id'] ? 'selected' : '' }}>
                    {{ $m['prefix'] }}{{ $m['label'] }}
                </option>
            @endforeach
        </select>
        <div class="form-text">
            Tanda <code>—</code> = Level 2. Tanda <code>— —</code> = Level 3.
        </div>
        @error('parent_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label">Urutan Tampil</label>
        <input type="number" name="sort_order" class="form-control"
               value="{{ old('sort_order', $navmenu->sort_order) }}" min="0" style="max-width:120px;">
    </div>

    <div class="mb-4">
        <div class="form-check">
            <input type="checkbox" name="is_active" value="1" class="form-check-input" id="is_active"
                   {{ old('is_active', $navmenu->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">Aktif (tampil di navbar)</label>
        </div>
    </div>

    {{-- Info posisi saat ini --}}
    <div class="mb-4 p-3 rounded" style="background:#f8fafc;font-size:12px;color:#64748b;">
        <strong>Posisi saat ini:</strong>
        @if($navmenu->parent)
            @if($navmenu->parent->parent)
                {{ $navmenu->parent->parent->label }} → {{ $navmenu->parent->label }} → {{ $navmenu->label }}
                <span class="badge bg-secondary ms-2">Level 3</span>
            @else
                {{ $navmenu->parent->label }} → {{ $navmenu->label }}
                <span class="badge bg-primary ms-2">Level 2</span>
            @endif
        @else
            {{ $navmenu->label }}
            <span class="badge bg-success ms-2">Level 1 (Menu Utama)</span>
        @endif
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
        <a href="{{ route('admin.navmenu.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
