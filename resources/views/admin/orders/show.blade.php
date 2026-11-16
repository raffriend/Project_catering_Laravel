@extends('layouts.admin')

@section('title', 'Detail Pesanan ' . $order->order_number)
@section('page_title', 'Rincian Pesanan: ' . $order->order_number)

@section('content')
<div class="row g-4">
    <!-- Left Column: Order Items & Customer -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0"><i class="fa fa-receipt text-primary me-2"></i>Item Pesanan Katering</h5>
                <span class="badge bg-light text-dark border">Tipe: {{ strtoupper(str_replace('_', ' ', $order->order_type)) }}</span>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Menu / Paket</th>
                            <th class="text-center" style="width: 120px;">Harga Satuan</th>
                            <th class="text-center" style="width: 80px;">Qty</th>
                            <th class="text-end" style="width: 140px;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <strong class="d-block">{{ $item->item_name }}</strong>
                                    @if($item->notes)
                                        <small class="text-muted">{{ $item->notes }}</small>
                                    @endif
                                </td>
                                <td class="text-center">{{ $item->formatted_price }}</td>
                                <td class="text-center fw-bold">{{ $item->quantity }} Box</td>
                                <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Subtotal:</th>
                            <td class="text-end fw-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
                        </tr>
                        @if($order->discount_amount > 0)
                            <tr>
                                <th colspan="3" class="text-end text-success">Potongan Diskon Promo:</th>
                                <td class="text-end text-success fw-bold">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                            </tr>
                        @endif
                        <tr class="table-active">
                            <th colspan="3" class="text-end fs-5">Total Pembayaran:</th>
                            <td class="text-end fw-bold text-primary fs-5">{{ $order->formatted_total }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            @if($order->bonus_info)
                <div class="alert alert-warning border border-warning mt-3 mb-0">
                    <i class="fa fa-gift text-danger me-2"></i> <strong>Bonus Otomatis:</strong> {{ $order->bonus_info }}
                </div>
            @endif

            @if($order->notes)
                <div class="p-3 bg-light rounded mt-3">
                    <strong class="text-muted small d-block">Catatan Khusus Pemesan:</strong>
                    <p class="mb-0">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Payments Log in Order -->
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa fa-money-check-alt text-primary me-2"></i>Catatan Pembayaran Terkait</h5>
            @if($order->payments->count() > 0)
                <div class="table-responsive">
                    <table class="table table-sm table-bordered align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Transaksi</th>
                                <th>Metode</th>
                                <th>Tipe</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Verifikator</th>
                                <th class="text-center">Bukti</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->payments as $pay)
                                <tr>
                                    <td><code>{{ $pay->payment_number }}</code></td>
                                    <td><span class="badge bg-secondary text-uppercase">{{ $pay->payment_method }}</span></td>
                                    <td><span class="badge bg-light text-dark border text-uppercase">{{ $pay->payment_type }}</span></td>
                                    <td class="fw-bold text-success">{{ $pay->formatted_amount }}</td>
                                    <td>{!! $pay->status_badge !!}</td>
                                    <td><small class="text-muted">{{ $pay->verifier->name ?? 'Belum' }}</small></td>
                                    <td class="text-center">
                                        @if($pay->proof_image)
                                            <a href="{{ asset($pay->proof_image) }}" target="_blank" class="btn btn-sm btn-outline-primary py-0 px-2">
                                                <i class="fa fa-image"></i>
                                            </a>
                                        @else
                                            <span class="text-muted small">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-muted mb-0 small">Belum ada bukti pembayaran yang diunggah.</p>
            @endif
        </div>
    </div>

    <!-- Right Column: Status Update & Customer Info -->
    <div class="col-lg-4">
        <!-- Status Update Box -->
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-bold mb-0"><i class="fa fa-tasks text-primary me-2"></i>Status Pesanan</h5>
                <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-warning btn-sm text-dark fw-bold">
                    <i class="fa fa-edit me-1"></i> Ubah Pesanan
                </a>
            </div>
            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label class="form-label fw-bold small">Status Pesanan:</label>
                    <select name="status" class="form-select">
                        <option value="masuk" {{ $order->status == 'masuk' ? 'selected' : '' }}>Masuk</option>
                        <option value="dikonfirmasi" {{ $order->status == 'dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="diproses" {{ $order->status == 'diproses' ? 'selected' : '' }}>Diproses (Dimasak)</option>
                        <option value="dikirim" {{ $order->status == 'dikirim' ? 'selected' : '' }}>Dikirim (Dalam Pengantaran)</option>
                        <option value="selesai" {{ $order->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $order->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold small">Status Pembayaran:</label>
                    <select name="payment_status" class="form-select">
                        <option value="belum_bayar" {{ $order->payment_status == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                        <option value="dp" {{ $order->payment_status == 'dp' ? 'selected' : '' }}>DP (Uang Muka)</option>
                        <option value="lunas" {{ $order->payment_status == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary w-100 py-2 mb-2">
                    <i class="fa fa-save me-1"></i> Simpan Perubahan Status
                </button>
            </form>
            <a href="{{ route('admin.orders.edit', $order->id) }}" class="btn btn-outline-warning w-100 py-2 text-dark">
                <i class="fa fa-pencil-alt me-1"></i> Koreksi Menu / Porsi / Alamat
            </a>
        </div>

        <!-- Customer & Delivery Info Card -->
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <h5 class="fw-bold mb-3"><i class="fa fa-user text-primary me-2"></i>Data Pemesan & Alamat</h5>
            <div class="mb-3">
                <small class="text-muted d-block">Nama Pemesan:</small>
                <strong class="fs-6">{{ $order->customer_name }}</strong>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">Nomor Telepon / WhatsApp:</small>
                <strong class="text-primary"><i class="fa fa-phone me-1"></i>{{ $order->customer_phone }}</strong>
                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $order->customer_phone)) }}" target="_blank" class="btn btn-sm btn-success d-block mt-2">
                    <i class="fab fa-whatsapp me-1"></i> Hubungi via WhatsApp
                </a>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">Alamat Pengiriman:</small>
                <p class="mb-0">{{ $order->delivery_address }}</p>
            </div>
            <div class="mb-3">
                <small class="text-muted d-block">Jadwal Kirim:</small>
                <strong class="text-danger d-block">{{ $order->delivery_date->format('l, d F Y') }}</strong>
                <span>Pukul {{ date('H:i', strtotime($order->delivery_time)) }} WIB</span>
            </div>

            <hr>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.orders.invoice', $order->id) }}" target="_blank" class="btn btn-outline-secondary w-100 btn-sm">
                    <i class="fa fa-print me-1"></i> Cetak Invoice
                </a>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary w-100 btn-sm">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

