@extends('admin.layouts.app')
@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">
<style>
    .ql-container { min-height: 300px; font-size: 14px; border-radius: 0 0 8px 8px; }
    .ql-toolbar { border-radius: 8px 8px 0 0; border-color: #d1d5db !important; }
    .ql-container { border-color: #d1d5db !important; }
    .image-preview { max-width: 200px; max-height: 150px; object-fit: cover; border-radius: 8px; }
    #quill-error { display:none; color:#dc2626; font-size:12px; margin-top:4px; }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
<div class="col-xl-9">

<div class="d-flex align-items-center gap-3 mb-4">
    <a href="{{ route('admin.news.index') }}" class="btn btn-sm btn-outline-secondary">
        <i class="bi bi-arrow-left"></i>
    </a>
    <h5 class="mb-0 fw-bold">Edit Berita</h5>
</div>

<form method="POST" action="{{ route('admin.news.update', $news) }}" enctype="multipart/form-data" id="news-form">
    @csrf @method('PUT')

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">Informasi Berita</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Judul Berita <span class="text-danger">*</span></label>
                        <input type="text" name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $news->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Konten Berita <span class="text-danger">*</span></label>
                        <input type="hidden" name="content" id="content-input" value="{{ old('content', $news->content) }}">
                        <div id="quill-editor"></div>
                        <div id="quill-error">Konten berita tidak boleh kosong.</div>
                        @error('content')
                            <div class="text-danger mt-1" style="font-size:12px;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-3">
                <div class="card-header">Publikasi</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">Status <span class="text-danger">*</span></label>
                        <select name="status" class="form-select">
                            <option value="pending"   {{ old('status', $news->status) === 'pending'   ? 'selected' : '' }}>Pending</option>
                            <option value="published" {{ old('status', $news->status) === 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Publish</label>
                        <input type="datetime-local" name="published_at" class="form-control"
                               value="{{ old('published_at', $news->published_at?->format('Y-m-d\TH:i')) }}">
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Kategori</div>
                <div class="card-body">
                    <select name="category_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ old('category_id', $news->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header">Foto Berita</div>
                <div class="card-body">
                    @if($news->image)
                        <img src="{{ Storage::url($news->image) }}" class="image-preview mb-2 d-block">
                        <div style="font-size:11px;color:#64748b;" class="mb-2">Foto saat ini</div>
                    @endif
                    <input type="file" name="image" class="form-control" accept="image/*"
                           onchange="previewImage(this)">
                    <div class="form-text">Kosongkan jika tidak ingin mengganti foto</div>
                    <img id="image-preview-new" class="image-preview mt-2 d-none">
                </div>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-lg me-1"></i>Update Berita
                </button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-outline-secondary">Batal</a>
            </div>
        </div>
    </div>
</form>

</div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<script>
const quill = new Quill('#quill-editor', {
    theme: 'snow',
    modules: {
        toolbar: [
            [{ header: [2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            ['link', 'image'],
            ['blockquote', 'code-block'],
            ['clean']
        ]
    }
});

// Load konten yang sudah ada
const existing = document.getElementById('content-input').value;
if (existing) {
    quill.root.innerHTML = existing;
}

document.getElementById('news-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const html   = quill.root.innerHTML;
    const text   = quill.getText().trim();
    const hidden = document.getElementById('content-input');
    const errDiv = document.getElementById('quill-error');

    hidden.value = html;

    if (!text || text.length === 0) {
        errDiv.style.display = 'block';
        quill.root.style.border = '1px solid #dc2626';
        return;
    }

    errDiv.style.display = 'none';
    quill.root.style.border = '';
    this.submit();
});

quill.on('text-change', function() {
    if (quill.getText().trim().length > 0) {
        document.getElementById('quill-error').style.display = 'none';
        quill.root.style.border = '';
    }
});

function previewImage(input) {
    const preview = document.getElementById('image-preview-new');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.src = e.target.result;
            preview.classList.remove('d-none');
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
