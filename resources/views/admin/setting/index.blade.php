@extends('admin.layouts.app')
@section('title','Pengaturan Website')
@section('page-title','Pengaturan Website')
@section('content')

<div class="alert alert-primary d-flex align-items-center gap-2 mb-4" style="background:#eff6ff;color:#1e40af;border:none;border-radius:10px;">
    <i class="bi bi-info-circle-fill"></i>
    Klik ikon pensil pada baris setting untuk mengisi key otomatis di form bawah, lalu simpan.
</div>

@foreach($settings as $group => $items)
<div class="card mb-4">
    <div class="card-header fw-bold" style="font-size:13px;">
        <i class="bi bi-folder me-2"></i>{{ $group }}
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th style="width:220px;">Key</th>
                    <th>Tipe</th>
                    <th>Nilai Saat Ini</th>
                    <th style="width:100px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach($items as $setting)
            <tr>
                <td><code style="font-size:12px;">{{ $setting->key }}</code></td>
                <td>
                    <span class="badge bg-light text-dark" style="font-size:11px;">{{ $setting->type ?? 'text' }}</span>
                </td>
                <td>
                    {{-- FIX: pakai kolom 'value' tunggal, bukan image_value/text_value --}}
                    @if($setting->value && in_array($setting->type, ['image','pdf']))
                        @if($setting->type === 'image')
                            <img src="{{ Storage::url($setting->value) }}"
                                 style="height:40px;border-radius:6px;object-fit:cover;"
                                 loading="lazy" alt="{{ $setting->key }}">
                        @else
                            <a href="{{ Storage::url($setting->value) }}" target="_blank"
                               class="btn btn-sm btn-outline-danger py-0" style="font-size:11px;">
                                <i class="bi bi-file-pdf me-1"></i>Lihat PDF
                            </a>
                        @endif
                    @elseif($setting->value)
                        <span style="font-size:12px;color:#374151;">{{ Str::limit($setting->value, 60) }}</span>
                    @else
                        <span class="text-muted" style="font-size:12px;">—</span>
                    @endif
                </td>
                <td>
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-outline-primary"
                                onclick="openEditModal('{{ $setting->key }}','{{ $setting->type ?? 'text' }}','{{ addslashes($setting->value ?? '') }}')"
                                title="Edit {{ $setting->key }}">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <form method="POST" action="{{ route('admin.setting.destroy', $setting) }}"
                              onsubmit="return confirm('Hapus setting \'{{ $setting->key }}\'?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endforeach

@if($errors->any())
<div class="alert alert-danger" style="font-size:13px;">
    @foreach($errors->all() as $e)<div>{{ $e }}</div>@endforeach
</div>
@endif

{{-- Form Tambah / Update --}}
<div class="card" id="form-setting">
    <div class="card-header fw-bold" style="font-size:13px;">
        <i class="bi bi-plus-circle me-2"></i>Tambah / Update Setting
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.setting.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3">
                <div class="col-sm-3">
                    <label class="form-label">Key <span class="text-danger">*</span></label>
                    <input type="text" name="key" id="edit-key" class="form-control form-control-sm"
                           placeholder="cth: slide1" value="{{ old('key') }}" required>
                    <div class="form-text">Jangan ada spasi, gunakan underscore.</div>
                </div>
                <div class="col-sm-2">
                    <label class="form-label">Tipe <span class="text-danger">*</span></label>
                    <select name="type" id="edit-type" class="form-select form-select-sm"
                            onchange="toggleInput(this.value)">
                        <option value="text">Teks</option>
                        <option value="link">Link/URL</option>
                        <option value="image">Gambar</option>
                        <option value="pdf">PDF</option>
                    </select>
                </div>
                <div class="col-sm-5">
                    <label class="form-label">Nilai</label>
                    <div id="input-text">
                        <input type="text" name="value" id="edit-value"
                               class="form-control form-control-sm"
                               placeholder="Teks atau URL..."
                               value="{{ old('value') }}">
                    </div>
                    <div id="input-file" class="d-none">
                        <input type="file" name="file" class="form-control form-control-sm"
                               accept="image/jpg,image/jpeg,image/png,image/webp,application/pdf">
                        <div class="form-text">JPG/PNG/WebP/PDF, maks 5MB</div>
                    </div>
                </div>
                <div class="col-sm-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-check-lg me-1"></i>Simpan
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleInput(type) {
    const isFile = (type === 'image' || type === 'pdf');
    document.getElementById('input-text').classList.toggle('d-none', isFile);
    document.getElementById('input-file').classList.toggle('d-none', !isFile);
}

function openEditModal(key, type, value) {
    document.getElementById('edit-key').value  = key;
    document.getElementById('edit-type').value = type;
    document.getElementById('edit-value').value = value;
    toggleInput(type);
    document.getElementById('form-setting').scrollIntoView({ behavior: 'smooth' });
    setTimeout(() => document.getElementById('edit-key').focus(), 400);
}
</script>
@endpush
