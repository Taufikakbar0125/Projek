@extends('admin.layouts.app')
@section('title','Manajemen User')
@section('page-title','Manajemen User')
@section('topbar-actions')
<a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm"><i class="bi bi-plus-lg me-1"></i>Tambah User</a>
@endsection
@section('content')
<div class="card mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-sm-5">
                <input type="text" name="search" class="form-control form-control-sm"
                       placeholder="Cari nama atau email..." value="{{ request('search') }}">
            </div>
            <div class="col-sm-3">
                <select name="role" class="form-select form-select-sm">
                    <option value="all">Semua Role</option>
                    <option value="super_admin" {{ request('role')==='super_admin' ? 'selected':'' }}>Super Admin</option>
                    <option value="admin"       {{ request('role')==='admin'       ? 'selected':'' }}>Admin</option>
                    <option value="staff"       {{ request('role')==='staff'       ? 'selected':'' }}>Staff</option>
                </select>
            </div>
            <div class="col-sm-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary btn-sm flex-1">Filter</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Daftar User Admin</span>
        <span class="text-muted" style="font-size:12px;">{{ $users->total() }} user</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr><th>#</th><th>Nama</th><th>Email</th><th>Role</th><th>Bergabung</th><th style="width:120px;">Aksi</th></tr>
            </thead>
            <tbody>
            @forelse($users as $user)
            <tr>
                <td style="font-size:12px;color:#64748b;">{{ $loop->iteration + ($users->currentPage()-1)*$users->perPage() }}</td>
                <td>
                    <div class="d-flex align-items-center gap-2">
                        <div style="width:32px;height:32px;border-radius:50%;background:#dbeafe;display:flex;align-items:center;justify-content:center;font-weight:700;font-size:13px;color:#1a56db;flex-shrink:0;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <span class="fw-semibold" style="font-size:13.5px;">{{ $user->name }}</span>
                        @if($user->id === auth()->id())
                            <span class="badge bg-success bg-opacity-10 text-success" style="font-size:10px;">Kamu</span>
                        @endif
                    </div>
                </td>
                <td style="font-size:13px;color:#64748b;">{{ $user->email }}</td>
                <td>
                    @php $roleColors = ['super_admin'=>'danger','admin'=>'primary','staff'=>'secondary']; @endphp
                    <span class="badge bg-{{ $roleColors[$user->role] ?? 'secondary' }} bg-opacity-10 text-{{ $roleColors[$user->role] ?? 'secondary' }}" style="font-size:11px;">
                        {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                    </span>
                </td>
                <td style="font-size:12px;color:#64748b;">{{ $user->created_at->format('d M Y') }}</td>
                <td>
                    <div class="d-flex gap-1">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        @if($user->id !== auth()->id())
                        <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Hapus user {{ $user->name }}?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                        @endif
                    </div>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="text-center py-5 text-muted"><i class="bi bi-people fs-2 d-block mb-2"></i>Belum ada user</td></tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())<div class="card-body border-top py-3">{{ $users->links() }}</div>@endif
</div>
@endsection
