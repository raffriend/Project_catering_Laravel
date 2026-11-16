@extends('layouts.admin')

@section('title', 'Edit Menu')
@section('page_title', 'Ubah Data Menu')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Ubah Menu: {{ $menu->name }}</h5>
                <a href="{{ route('admin.menus.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-7">
                        <label for="name" class="form-label fw-bold">Nama Menu <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $menu->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label for="category_id" class="form-label fw-bold">Kategori <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $menu->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="price" class="form-label fw-bold">Harga Menu (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', (int)$menu->price) }}" min="0" step="500" required>
                        </div>
                        @error('price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label fw-bold">Foto Menu</label>
                        @if($menu->image)
                            <div class="mb-2">
                                <img src="{{ asset($menu->image) }}" alt="Preview" class="rounded border" style="width: 70px; height: 70px; object-fit: cover;">
                                <small class="text-muted ms-2">Foto saat ini</small>
                            </div>
                        @endif
                        <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak mengubah foto.</small>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label fw-bold">Deskripsi Menu & Komposisi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $menu->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="p-3 bg-light rounded-3">
                            <div class="fw-bold mb-2">Pengaturan Status Menu:</div>
                            <div class="row g-3">
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_available" name="is_available" value="1" {{ old('is_available', $menu->is_available) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_available">Stok Tersedia</label>
                                    </div>
                                    <small class="text-muted">Dapat dipesan pelanggan</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_daily" name="is_daily" value="1" {{ old('is_daily', $menu->is_daily) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_daily">Menu Harian</label>
                                    </div>
                                    <small class="text-muted">Tersedia setiap hari</small>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="is_popular" name="is_popular" value="1" {{ old('is_popular', $menu->is_popular) ? 'checked' : '' }}>
                                        <label class="form-check-label fw-semibold" for="is_popular">Menu Populer / Favorit</label>
                                    </div>
                                    <small class="text-muted">Ditampilkan di highlight beranda</small>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Perbarui Menu
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

