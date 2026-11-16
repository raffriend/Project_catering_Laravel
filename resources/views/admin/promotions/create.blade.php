@extends('layouts.admin')

@section('title', 'Tambah Promo')
@section('page_title', 'Buat Promo & Bonus Baru')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Formulir Promo Baru</h5>
                <a href="{{ route('admin.promotions.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.promotions.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label fw-bold">Judul Promo <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Contoh: Pesan 50 Box Gratis 1 Loyang Bolu" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label fw-bold">Kode Kupon (Opsional)</label>
                        <input type="text" name="code" class="form-control text-uppercase" value="{{ old('code') }}" placeholder="BOLU50">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Jenis Promo <span class="text-danger">*</span></label>
                        <select name="promo_type" class="form-select" id="promo_type" required>
                            <option value="bonus" {{ old('promo_type') == 'bonus' ? 'selected' : '' }}>Bonus Barang / Makanan (Misal: Bolu)</option>
                            <option value="discount" {{ old('promo_type') == 'discount' ? 'selected' : '' }}>Diskon Potongan Harga</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Minimal Jumlah Pesanan (Box / Porsi)</label>
                        <input type="number" name="min_order_qty" class="form-control" value="{{ old('min_order_qty', 50) }}" min="0">
                        <small class="text-muted">Isi 0 jika tidak ada batasan box.</small>
                    </div>

                    <div class="col-12" id="field_bonus">
                        <label class="form-label fw-bold">Deskripsi Hadiah Bonus</label>
                        <input type="text" name="bonus_description" class="form-control" value="{{ old('bonus_description', 'Gratis 1 Loyang Bolu Panggang Spesial') }}" placeholder="Contoh: Gratis 1 Loyang Bolu Panggang Lembut">
                    </div>

                    <div class="col-md-6" id="field_discount" style="display: none;">
                        <label class="form-label fw-bold">Diskon Persen (%)</label>
                        <input type="number" name="discount_percent" class="form-control" value="{{ old('discount_percent') }}" min="0" max="100" step="0.5" placeholder="Contoh: 10">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Deskripsi Promo Lengkap <span class="text-danger">*</span></label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3" required placeholder="Jelaskan ketentuan promo untuk ditampilkan ke pelanggan...">{{ old('description', 'Pesan minimal 50 box katering mendapatkan bonus 1 loyang bolu spesial.') }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Mulai <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" class="form-control" value="{{ old('start_date', date('Y-m-d')) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tanggal Berakhir <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" class="form-control" value="{{ old('end_date', date('Y-m-d', strtotime('+3 months'))) }}" required>
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_active">Aktifkan Program Promo</label>
                        </div>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.promotions.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Simpan Promo
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $('#promo_type').change(function() {
        if ($(this).val() === 'bonus') {
            $('#field_bonus').show();
            $('#field_discount').hide();
        } else {
            $('#field_bonus').hide();
            $('#field_discount').show();
        }
    });
</script>
@endpush

