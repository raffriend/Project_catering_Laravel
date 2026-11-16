@extends('layouts.admin')

@section('title', 'Tambah Paket Katering')
@section('page_title', 'Tambah Paket Katering Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Formulir Paket Katering</h5>
                <a href="{{ route('admin.packages.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row g-3">
                    <div class="col-md-7">
                        <label class="form-label fw-bold">Nama Paket Katering <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Contoh: Paket Katering Hemat" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-5">
                        <label class="form-label fw-bold">Harga per Porsi (Rp) <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" name="price_per_package" class="form-control @error('price_per_package') is-invalid @enderror" value="{{ old('price_per_package') }}" placeholder="25000" min="0" step="500" required>
                        </div>
                        @error('price_per_package')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Minimal Pemesanan (Porsi/Box) <span class="text-danger">*</span></label>
                        <input type="number" name="min_order" class="form-control @error('min_order') is-invalid @enderror" value="{{ old('min_order', 15) }}" min="1" required>
                        @error('min_order')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Foto Paket (Opsional)</label>
                        <input type="file" name="image" class="form-control" accept="image/*">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi Ringkas Paket</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Cocok untuk rapat kantor, syukuran keluarga, dll...">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Daftar Menu yang Didapatkan (Rincian Isi)</label>
                        <textarea name="includes" class="form-control" rows="5" placeholder="• Nasi Putih&#10;• Ayam Bakar Madu&#10;• Tahu & Tempe Bacem&#10;• Sayur Gulai Singkong&#10;• Buah & Kerupuk&#10;• Air Mineral">{{ old('includes') }}</textarea>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Aktifkan Paket (Ditampilkan di Website)</label>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.packages.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Simpan Paket
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

