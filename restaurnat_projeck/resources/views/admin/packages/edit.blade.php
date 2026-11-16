@extends('layouts.admin')

@section('title', 'Edit Paket Katering')
@section('page_title', 'Ubah Paket Katering')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Ubah Paket: {{ $package->name }}</h5>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.packages.update', $package->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label fw-bold">Nama Paket Katering <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $package->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-bold">Harga per Porsi (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price_per_package" class="form-control @error('price_per_package') is-invalid @enderror" value="{{ old('price_per_package', (int)$package->price_per_package) }}" min="0" step="500" required>
                        </div>
                        @error('price_per_package')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Minimal Pemesanan (Porsi/Box) <span class="text-danger">*</span></label>
                        <input type="number" name="min_order" class="form-control @error('min_order') is-invalid @enderror" value="{{ old('min_order', $package->min_order) }}" min="1" required>
                        @error('min_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Foto Paket</label>
                        @if($package->image)
                            <div class="mb-2">
                                <img src="{{ asset($package->image) }}" alt="Preview" class="rounded border" style="width: 70px; height: 70px; object-fit: cover;">
                            </div>
                        @endif
                        <input type="file" name="image" class="form-control" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak mengubah foto.</small>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi Ringkas Paket</label>
                        <textarea name="description" class="form-control" rows="2">{{ old('description', $package->description) }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Daftar Menu yang Didapatkan (Rincian Isi)</label>
                        <textarea name="includes" class="form-control" rows="5">{{ old('includes', $package->includes) }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Aktifkan Paket (Ditampilkan di Website)</label>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Perbarui Paket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

