@extends('layouts.admin')

@section('title', 'Edit Pelanggan')
@section('page_title', 'Ubah Data Pelanggan')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold mb-0">Ubah Data: {{ $customer->name }}</h5>
                <a href="{{ route('admin.customers.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali
                </a>
            </div>

            <form action="{{ route('admin.customers.update', $customer->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nama Pelanggan / Instansi <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Nomor HP / WhatsApp <span class="text-danger">*</span></label>
                        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}" required>
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Alamat Email (Opsional)</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Tipe Pelanggan <span class="text-danger">*</span></label>
                        <select name="customer_type" class="form-select @error('customer_type') is-invalid @enderror" required>
                            <option value="individual" {{ old('customer_type', $customer->customer_type) == 'individual' ? 'selected' : '' }}>Perorangan / Pribadi</option>
                            <option value="institution" {{ old('customer_type', $customer->customer_type) == 'institution' ? 'selected' : '' }}>Instansi / Perusahaan</option>
                            <option value="catering_langganan" {{ old('customer_type', $customer->customer_type) == 'catering_langganan' ? 'selected' : '' }}>Langganan Katering Rutin</option>
                        </select>
                        @error('customer_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Alamat Lengkap Pengiriman <span class="text-danger">*</span></label>
                        <textarea name="address" class="form-control @error('address') is-invalid @enderror" rows="3" required>{{ old('address', $customer->address) }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_regular" id="is_regular" value="1" {{ old('is_regular', $customer->is_regular) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="is_regular">Tandai sebagai Pelanggan Katering Tetap / Prioritas</label>
                        </div>
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-bold">Catatan Tambahan (Opsional)</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $customer->notes) }}</textarea>
                    </div>

                    <div class="col-12 text-end mt-4">
                        <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Perbarui Pelanggan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

