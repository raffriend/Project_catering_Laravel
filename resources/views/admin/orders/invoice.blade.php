<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Invoice - {{ $order->order_number }} - CV. Kedai Agung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #fff; color: #333; }
        .invoice-box { max-width: 800px; margin: auto; padding: 30px; border: 1px solid #eee; }
        @media print {
            .no-print { display: none; }
            .invoice-box { border: none; padding: 0; }
        }
    </style>
</head>
<body>
<div class="invoice-box my-4">
    <div class="d-flex justify-content-between align-items-center mb-4 no-print">
        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-outline-secondary btn-sm">Kembali ke Detail</a>
        <button onclick="window.print()" class="btn btn-primary btn-sm">Cetak Invoice</button>
    </div>

    <!-- Header -->
    <div class="row align-items-center mb-4 pb-3 border-bottom">
        <div class="col-6">
            <h2 class="fw-bold text-warning mb-0" style="color: #FEA116 !important;">CV. KEDAI AGUNG</h2>
            <small class="text-muted d-block">Sistem Pengelolaan & Jasa Boga Katering</small>
            <small class="text-muted d-block">Jl. Raya Kedai Agung No. 45, Indonesia</small>
            <small class="text-muted d-block">Telp/WA: 0812-3456-7890 | info@kedaiagung.com</small>
        </div>
        <div class="col-6 text-end">
            <h4 class="fw-bold mb-1 text-dark">INVOICE TAGIHAN</h4>
            <strong class="text-primary fs-5 d-block">{{ $order->order_number }}</strong>
            <small class="text-muted d-block">Tanggal Pesan: {{ $order->created_at->format('d/m/Y H:i') }}</small>
            <div class="mt-2">
                Status Pesanan: <span class="badge bg-secondary">{{ strtoupper($order->status) }}</span>
                Status Bayar: <span class="badge bg-success">{{ strtoupper($order->payment_status) }}</span>
            </div>
        </div>
    </div>

    <!-- Customer & Delivery Info -->
    <div class="row mb-4">
        <div class="col-6">
            <h6 class="fw-bold text-muted text-uppercase small">Tujuan Tagihan (Pemesan):</h6>
            <h5 class="fw-bold mb-1">{{ $order->customer_name }}</h5>
            <div>No. HP / WA: {{ $order->customer_phone }}</div>
            <div class="text-muted small mt-1">Alamat Pengiriman: {{ $order->delivery_address }}</div>
        </div>
        <div class="col-6 text-end">
            <h6 class="fw-bold text-muted text-uppercase small">Waktu Pengiriman Katering:</h6>
            <h5 class="fw-bold text-primary mb-1">{{ $order->delivery_date->format('l, d F Y') }}</h5>
            <div>Pukul {{ date('H:i', strtotime($order->delivery_time)) }} WIB</div>
        </div>
    </div>

    <!-- Items -->
    <table class="table table-bordered mb-4">
        <thead class="table-light">
            <tr>
                <th style="width: 50px;">No</th>
                <th>Deskripsi Menu / Paket Katering</th>
                <th class="text-center" style="width: 120px;">Harga</th>
                <th class="text-center" style="width: 80px;">Qty</th>
                <th class="text-end" style="width: 140px;">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $idx => $item)
                <tr>
                    <td>{{ $idx + 1 }}</td>
                    <td>
                        <strong>{{ $item->item_name }}</strong>
                        @if($item->notes)
                            <small class="text-muted d-block">{{ $item->notes }}</small>
                        @endif
                    </td>
                    <td class="text-center">{{ $item->formatted_price }}</td>
                    <td class="text-center">{{ $item->quantity }} Box</td>
                    <td class="text-end fw-bold">{{ $item->formatted_subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th colspan="4" class="text-end">Subtotal:</th>
                <td class="text-end fw-bold">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</td>
            </tr>
            @if($order->discount_amount > 0)
                <tr>
                    <th colspan="4" class="text-end text-success">Potongan Diskon Promo:</th>
                    <td class="text-end fw-bold text-success">- Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</td>
                </tr>
            @endif
            <tr class="table-active">
                <th colspan="4" class="text-end fs-5">Total Pembayaran:</th>
                <td class="text-end fw-bold text-primary fs-5">{{ $order->formatted_total }}</td>
            </tr>
        </tfoot>
    </table>

    @if($order->bonus_info)
        <div class="alert alert-warning border border-warning p-2 small mb-4">
            <strong>Bonus Spesial:</strong> {{ $order->bonus_info }}
        </div>
    @endif

    <!-- Payment info & Signatures -->
    <div class="row pt-3">
        <div class="col-7">
            <h6 class="fw-bold small text-uppercase">Instruksi Pembayaran Manual:</h6>
            <small class="text-muted d-block">• Bank BCA: 123-456-7890 a.n CV. Kedai Agung</small>
            <small class="text-muted d-block">• Bank Mandiri: 140-00-1234567-8 a.n CV. Kedai Agung</small>
            <small class="text-muted d-block">• Bank BRI: 0123-01-001234-53-0 a.n CV. Kedai Agung</small>
        </div>
        <div class="col-5 text-center">
            <small class="text-muted d-block mb-5">Hormat Kami,<br><strong>CV. KEDAI AGUNG</strong></small>
            <strong class="border-top pt-2 d-inline-block px-4">Bagian Kasir / Keuangan</strong>
        </div>
    </div>
</div>
</body>
</html>

