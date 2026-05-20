@extends('admin.layouts.app')
@section('title','Menu Navigasi')
@section('page-title','Menu Navigasi')
@section('topbar-actions')
<a href="{{ route('admin.navmenu.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah Menu</a>
@endsection
@section('content')
<div class="row g-4">
    {{-- Pohon menu --}}
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">Struktur Menu</div>
            <div class="card-body">
                @forelse($menus as $menu)
                <div class="border rounded p-3 mb-3" style="background:#f8fafc;">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-semibold" style="font-size:14px;">{{ $menu->label }}</span>
                            @if($menu->url)
                                <code class="ms-2" style="font-size:11px;">{{ $menu->url }}</code>
                            @endif
                            @if(!$menu->is_active)
                                <span class="badge badge-archived ms-2" style="font-size:10px;">Nonaktif</span>
                            @endif
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.navmenu.edit', $menu) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                            <form method="POST" action="{{ route('admin.navmenu.destroy', $menu) }}" onsubmit="return confirm('Hapus menu dan semua submenu-nya?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    {{-- Level 2 --}}
                    @foreach($menu->children as $child)
                    <div class="d-flex align-items-center justify-content-between mt-2 ms-4 border-start ps-3">
                        <div>
                            <i class="bi bi-arrow-return-right text-muted me-1" style="font-size:12px;"></i>
                            <span style="font-size:13px;">{{ $child->label }}</span>
                            @if($child->url)<code class="ms-2" style="font-size:11px;">{{ $child->url }}</code>@endif
                            @if(!$child->is_active)<span class="badge badge-archived ms-1" style="font-size:10px;">Nonaktif</span>@endif
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.navmenu.edit', $child) }}" class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-pencil" style="font-size:11px;"></i></a>
                            <form method="POST" action="{{ route('admin.navmenu.destroy', $child) }}" onsubmit="return confirm('Hapus submenu ini?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger py-0 px-2"><i class="bi bi-trash" style="font-size:11px;"></i></button>
                            </form>
                        </div>
                    </div>
                    {{-- Level 3 --}}
                    @foreach($child->children as $grandchild)
                    <div class="d-flex align-items-center justify-content-between mt-2 ms-8 border-start ps-3" style="margin-left:3rem;">
                        <div>
                            <i class="bi bi-arrow-return-right text-muted me-1" style="font-size:11px;"></i>
                            <span style="font-size:12px;color:#64748b;">{{ $grandchild->label }}</span>
                            @if($grandchild->url)<code class="ms-1" style="font-size:10px;">{{ $grandchild->url }}</code>@endif
                        </div>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.navmenu.edit', $grandchild) }}" class="btn btn-sm btn-outline-primary py-0 px-2"><i class="bi bi-pencil" style="font-size:10px;"></i></a>
                            <form method="POST" action="{{ route('admin.navmenu.destroy', $grandchild) }}" onsubmit="return confirm('Hapus?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger py-0 px-2"><i class="bi bi-trash" style="font-size:10px;"></i></button>
                            </form>
                        </div>
                    </div>
                    @endforeach
                    @endforeach
                </div>
                @empty
                <div class="text-center py-4 text-muted"><i class="bi bi-list-nested fs-2 d-block mb-2"></i>Belum ada menu</div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Info semua menu flat --}}
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">Semua Menu ({{ $allMenus->count() }})</div>
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead class="table-light">
                        <tr><th>Label</th><th>Parent</th><th>Urutan</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                    @foreach($allMenus as $m)
                    <tr>
                        <td style="font-size:12px;">{{ $m->label }}</td>
                        <td style="font-size:12px;color:#64748b;">{{ $m->parent?->label ?? '—' }}</td>
                        <td style="font-size:12px;">{{ $m->sort_order }}</td>
                        <td>
                            @if($m->is_active)
                                <span class="badge badge-published rounded-pill" style="font-size:10px;">Aktif</span>
                            @else
                                <span class="badge badge-archived rounded-pill" style="font-size:10px;">Nonaktif</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
