@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_title', 'Ubah Data Kategori')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Ubah Kategori: {{ $category->name }}</h5>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="mb-3">
                    <label for="name" class="form-label fw-bold">Nama Kategori <span class="text-danger">*</span></label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Deskripsi Kategori</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label fw-bold">Foto Kategori (Opsional)</label>
                    @if($category->image)
                        <div class="mb-2">
                            <img src="{{ asset($category->image) }}" alt="Preview" class="rounded border" style="width: 80px; height: 80px; object-fit: cover;">
                            <small class="text-muted d-block mt-1">Foto saat ini</small>
                        </div>
                    @endif
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengubah foto. Format: JPG, PNG, WEBP. Maks 2MB.</small>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-check form-switch mb-4">
                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                    <label class="form-check-label fw-bold" for="is_active">Aktifkan Kategori (Ditampilkan di Website)</label>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary px-4">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="fa fa-save me-1"></i> Perbarui Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

