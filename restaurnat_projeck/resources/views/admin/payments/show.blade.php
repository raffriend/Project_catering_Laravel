@extends('layouts.admin')

@section('title', 'Verifikasi Pembayaran ' . $payment->payment_number)
@section('page_title', 'Verifikasi Pembayaran: ' . $payment->payment_number)

@section('content')
<div class="row g-4 justify-content-center">
    <!-- Left: Payment Proof Image -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 p-4 text-center">
            <h5 class="fw-bold mb-3 text-start"><i class="fa fa-image text-primary me-2"></i>Foto Bukti Transfer / Resi</h5>
            @if($payment->proof_image)
                <div class="p-2 border rounded bg-light mb-3">
                    <img src="{{ asset($payment->proof_image) }}" alt="Bukti Transfer" class="img-fluid rounded" style="max-height: 480px; object-fit: contain;">
                </div>
                <a href="{{ asset($payment->proof_image) }}" target="_blank" class="btn btn-outline-primary btn-sm">
                    <i class="fa fa-external-link-alt me-1"></i> Buka Gambar Ukuran Asli
                </a>
            @else
                <div class="py-5 text-muted">
                    <i class="fa fa-image fa-3x mb-2 text-secondary opacity-50"></i>
                    <p>Tidak ada lampiran foto bukti (Pembayaran Cash / Tunai Langsung).</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Right: Payment & Order Information & Verification Action -->
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3 border-bottom pb-2">
                <h5 class="fw-bold mb-0">Rincian Pembayaran</h5>
                {!! $payment->status_badge !!}
            </div>

            <div class="row g-3 mb-4">
                <div class="col-6">
                    <small class="text-muted d-block">Nominal Ditransfer:</small>
                    <h3 class="fw-bold text-success mb-0">{{ $payment->formatted_amount }}</h3>
                </div>
                <div class="col-6 text-end">
                    <small class="text-muted d-block">Metode & Tipe:</small>
                    <span class="badge bg-secondary text-uppercase fs-6">{{ $payment->payment_method }}</span>
                    <span class="badge bg-light text-dark border text-uppercase fs-6">{{ $payment->payment_type }}</span>
                </div>
                <div class="col-12">
                    <small class="text-muted d-block">Waktu Unggah Bukti:</small>
                    <strong>{{ $payment->payment_date->format('l, d F Y - H:i') }} WIB</strong>
                </div>
                @if($payment->notes)
                    <div class="col-12">
                        <small class="text-muted d-block">Catatan Pelanggan:</small>
                        <div class="p-2 bg-light rounded">{{ $payment->notes }}</div>
                    </div>
                @endif
            </div>

            <hr>

            <!-- Order info -->
            <h6 class="fw-bold mb-2">Informasi Pesanan Katering:</h6>
            <div class="p-3 bg-light rounded-3 mb-4">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary">{{ $payment->order->order_number ?? '-' }}</strong>
                    <span>Total Tagihan: <strong>{{ $payment->order->formatted_total ?? '-' }}</strong></span>
                </div>
                <small class="d-block text-muted">Pemesan: <strong>{{ $payment->order->customer_name ?? '-' }}</strong> ({{ $payment->order->customer_phone ?? '-' }})</small>
                <small class="d-block text-muted">Jadwal Kirim: {{ $payment->order->delivery_date->format('d/m/Y') ?? '-' }}</small>
                <div class="mt-2">
                    <a href="{{ route('admin.orders.show', $payment->order_id) }}" class="btn btn-sm btn-link p-0 text-decoration-none">
                        <i class="fa fa-external-link-alt me-1"></i> Buka Rincian Pesanan Ini
                    </a>
                </div>
            </div>

            <!-- Verification Action Form -->
            <h6 class="fw-bold mb-3">Tindakan Verifikasi:</h6>
            <form action="{{ route('admin.payments.verify', $payment->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label small fw-bold">Catatan Verifikator (Opsional):</label>
                    <input type="text" name="notes" class="form-control" placeholder="Contoh: Dana telah masuk rekening BCA">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" name="status" value="diterima" class="btn btn-success flex-fill py-2">
                        <i class="fa fa-check-circle me-1"></i> Terima & Sahkan
                    </button>
                    <button type="submit" name="status" value="ditolak" class="btn btn-danger flex-fill py-2" onclick="return confirm('Tolak bukti pembayaran ini?');">
                        <i class="fa fa-times-circle me-1"></i> Tolak Pembayaran
                    </button>
                </div>
            </form>

            <div class="mt-4 pt-3 border-top text-center">
                <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar Pembayaran
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

