@extends('admin.layouts.app')
@section('title','Maintenance Mode')
@section('page-title','Maintenance Mode')

@section('content')
<div class="row justify-content-center"><div class="col-xl-8">

{{-- STATUS CARD --}}
<div class="card mb-4">
    <div class="card-body p-4">
        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <div class="fw-bold mb-1" style="font-size:16px;">Status Maintenance Saat Ini</div>
                @if($maintenance->is_active)
                    <span class="badge bg-danger px-3 py-2" style="font-size:13px;">
                        <i class="bi bi-tools me-1"></i> AKTIF — Website tampilkan halaman 503
                    </span>
                    <div class="mt-2 text-muted" style="font-size:12px;">
                        <i class="bi bi-info-circle me-1"></i>
                        Admin & staff yang sudah login tetap bisa akses website normal.
                        Pengunjung biasa akan melihat halaman maintenance.
                    </div>
                @else
                    <span class="badge bg-success px-3 py-2" style="font-size:13px;">
                        <i class="bi bi-check-circle me-1"></i> NONAKTIF — Website berjalan normal
                    </span>
                @endif

                @if($maintenance->countdown_to)
                    <div class="mt-2 text-muted" style="font-size:12px;">
                        <i class="bi bi-alarm me-1"></i>
                        Timer selesai: <strong>{{ $maintenance->countdown_to->format('d M Y H:i') }} WIB</strong>
                    </div>
                @endif
            </div>

            <form method="POST" action="{{ route('admin.maintenance.toggle') }}">
                @csrf
                <button type="submit"
                        class="btn {{ $maintenance->is_active ? 'btn-success' : 'btn-danger' }} px-4"
                        onclick="return confirm('{{ $maintenance->is_active ? 'MATIKAN maintenance mode? Website akan kembali normal.' : 'AKTIFKAN maintenance mode? Pengunjung tidak bisa akses website.' }}')">
                    <i class="bi bi-power me-1"></i>
                    {{ $maintenance->is_active ? 'Matikan Maintenance' : 'Aktifkan Maintenance' }}
                </button>
            </form>
        </div>
    </div>
</div>

{{-- SET TIMER --}}
<div class="card mb-4">
    <div class="card-header fw-bold">
        <i class="bi bi-alarm me-2"></i>Set Timer Countdown Selesai Maintenance
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('admin.maintenance.timer') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Tanggal & Jam Selesai <span class="text-danger">*</span></label>
                <input type="datetime-local" name="countdown_to" class="form-control"
                       value="{{ $maintenance->countdown_to ? $maintenance->countdown_to->format('Y-m-d\TH:i') : '' }}"
                       min="{{ now()->format('Y-m-d\TH:i') }}">
                <div class="form-text">
                    Countdown akan tampil di halaman 503 untuk pengunjung.
                    Kosongkan timer tidak akan menghentikan maintenance otomatis.
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label">Pesan untuk Pengunjung</label>
                <textarea name="message" class="form-control" rows="2"
                          placeholder="Website sedang dalam maintenance. Mohon tunggu.">{{ $maintenance->message }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-check-lg me-1"></i>Simpan Timer & Pesan
            </button>
        </form>
    </div>
</div>

{{-- HAPUS DATA --}}
@if($maintenance->id)
<div class="card mb-4 border-danger">
    <div class="card-header fw-bold text-danger"><i class="bi bi-trash me-2"></i>Reset Data Maintenance</div>
    <div class="card-body">
        <p class="text-muted" style="font-size:13px;">
            Hapus semua data maintenance (status, timer, pesan) dan kembali ke kondisi awal.
            Website akan otomatis kembali normal.
        </p>
        <form method="POST" action="{{ route('admin.maintenance.destroy', $maintenance) }}"
              onsubmit="return confirm('Reset semua data maintenance?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-outline-danger btn-sm">
                <i class="bi bi-trash me-1"></i>Reset Data
            </button>
        </form>
    </div>
</div>
@endif

{{-- PANDUAN --}}
<div class="alert d-flex align-items-start gap-3" style="background:#fef9c3;border:none;border-radius:12px;">
    <i class="bi bi-lightbulb-fill text-warning mt-1 flex-shrink-0"></i>
    <div style="font-size:13px;">
        <strong>Cara kerja Maintenance Mode:</strong><br>
        <ul class="mb-0 mt-1 ps-3">
            <li>Saat <strong>AKTIF</strong>: semua pengunjung yang belum login akan diarahkan ke halaman 503</li>
            <li>Admin & staff yang <strong>sudah login</strong> bisa akses website seperti biasa</li>
            <li>Halaman <code>/admin/login</code> tetap bisa diakses untuk login</li>
            <li>Cache maintenance diperbarui otomatis dalam <strong>1 menit</strong> setelah toggle</li>
            <li>Fitur ini hanya bisa diakses oleh <strong>Super Admin</strong></li>
        </ul>
    </div>
</div>

</div></div>
@endsection
