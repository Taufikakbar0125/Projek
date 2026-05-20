@extends('admin.layouts.app')
@section('title','Edit User')
@section('page-title','Edit User Admin')
@section('content')
<div class="row justify-content-center"><div class="col-xl-6">
<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-outline-secondary"><i class="bi bi-arrow-left"></i></a>
    <h5 class="mb-0 fw-bold">Edit User</h5>
</div>
<div class="card"><div class="card-body">
<form method="POST" action="{{ route('admin.users.update', $user) }}">
    @csrf @method('PUT')
    <div class="mb-3">
        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name) }}" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email) }}" required>
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Role <span class="text-danger">*</span></label>
        <select name="role" class="form-select @error('role') is-invalid @enderror" required
                {{ $user->id === auth()->id() ? 'disabled' : '' }}>
            {{-- Hanya tampilkan role yang diizinkan berdasarkan role user yang login --}}
            @foreach($allowedRoles as $role)
                <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                    {{ match($role) {
                        'super_admin' => 'Super Admin',
                        'admin'       => 'Admin',
                        'staff'       => 'Staff',
                        default       => $role
                    } }}
                </option>
            @endforeach
        </select>
        {{-- Jika disabled, kirim value via hidden input supaya tidak hilang saat submit --}}
        @if($user->id === auth()->id())
            <input type="hidden" name="role" value="{{ $user->role }}">
            <div class="form-text text-warning"><i class="bi bi-lock me-1"></i>Tidak bisa mengubah role diri sendiri.</div>
        @endif
        @error('role')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <div class="input-group">
            <input type="password" name="password" id="pw"
                   class="form-control @error('password') is-invalid @enderror">
            <button type="button" class="btn btn-outline-secondary" onclick="togglePw()">
                <i class="bi bi-eye" id="pw-icon"></i>
            </button>
        </div>
        <div class="form-text">Kosongkan jika tidak ingin mengubah password.</div>
        @error('password')<div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>@enderror
    </div>
    <div class="mb-4">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-primary"><i class="bi bi-check-lg me-1"></i>Update</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary">Batal</a>
    </div>
</form>
</div></div>
</div></div>
@endsection
@push('scripts')
<script>
function togglePw() {
    const input = document.getElementById('pw');
    const icon  = document.getElementById('pw-icon');
    input.type  = input.type === 'password' ? 'text' : 'password';
    icon.className = input.type === 'password' ? 'bi bi-eye' : 'bi bi-eye-slash';
}
</script>
@endpush
