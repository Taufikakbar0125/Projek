@extends('admin.layouts.app')
@section('title','Kategori Berita')
@section('page-title','Kategori Berita')
@section('content')
<div class="row g-4">
    {{-- Form tambah/edit kiri --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                {{ isset($category) ? 'Edit Kategori' : 'Tambah Kategori Baru' }}
            </div>
            <div class="card-body">
                @if(isset($category))
                <form method="POST" action="{{ route('admin.categories.update', $category) }}">
                    @csrf @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $category->name) }}" required autofocus>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary btn-sm"><i class="bi bi-check-lg me-1"></i>Update</button>
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">Batal</a>
                    </div>
                </form>
                @else
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="cth: Akademik" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-plus-lg me-1"></i>Tambah Kategori
                    </button>
                </form>
                @endif
            </div>
        </div>
    </div>

    {{-- Tabel kanan --}}
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span>Daftar Kategori</span>
                <span class="text-muted" style="font-size:12px;">{{ $categories->total() }} kategori</span>
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr><th>#</th><th>Nama</th><th>Slug</th><th>Jumlah Berita</th><th style="width:120px;">Aksi</th></tr>
                    </thead>
                    <tbody>
                    @forelse($categories as $item)
                    <tr>
                        <td style="font-size:12px;color:#64748b;">{{ $loop->iteration }}</td>
                        <td class="fw-semibold" style="font-size:13.5px;">{{ $item->name }}</td>
                        <td><code style="font-size:11px;">{{ $item->slug }}</code></td>
                        <td>
                            <span class="badge bg-primary bg-opacity-10 text-primary" style="font-size:11px;">
                                {{ $item->news_count }} berita
                            </span>
                        </td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="{{ route('admin.categories.edit', $item) }}" class="btn btn-sm btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <form method="POST" action="{{ route('admin.categories.destroy', $item) }}"
                                      onsubmit="return confirm('Hapus kategori ini? Pastikan tidak ada berita yang menggunakan kategori ini.')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger"
                                            {{ $item->news_count > 0 ? 'disabled title=Masih ada berita' : '' }}>
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="5" class="text-center py-5 text-muted"><i class="bi bi-tag fs-2 d-block mb-2"></i>Belum ada kategori</td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @if($categories->hasPages())<div class="card-body border-top py-3">{{ $categories->links() }}</div>@endif
        </div>
    </div>
</div>
@endsection
