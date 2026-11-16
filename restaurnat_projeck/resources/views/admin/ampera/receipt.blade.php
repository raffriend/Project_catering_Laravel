<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Struk Transaksi {{ $order->order_number }} - CV. Kedai Agung</title>
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 13px;
            color: #000;
            background-color: #fff;
            margin: 0;
            padding: 15px;
            width: 80mm;
            box-sizing: border-box;
        }
        .text-center { text-align: center; }
        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }
        .border-top { border-top: 1px dashed #000; padding-top: 5px; }
        .border-bottom { border-bottom: 1px dashed #000; padding-bottom: 5px; }
        .my-2 { margin-top: 8px; margin-bottom: 8px; }
        .mb-1 { margin-bottom: 4px; }
        .item-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
        }
        .no-print {
            margin-top: 20px;
            text-align: center;
        }
        @media print {
            .no-print { display: none; }
        }
        .btn-print {
            background-color: #0F172B;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-family: sans-serif;
            font-size: 14px;
        }
    </style>
</head>
<body onload="window.print()">

    <div class="text-center">
        <h2 style="margin: 0; font-size: 18px;">CV. KEDAI AGUNG</h2>
        <div style="font-size: 11px;">Rumah Makan & Jasa Boga Katering</div>
        <div style="font-size: 11px;">Jl. Kedai Agung No. 1, Kota</div>
        <div style="font-size: 11px;">WhatsApp: 0812-3456-7890</div>
    </div>

    <div class="border-top my-2"></div>

    <div style="font-size: 11px;">
        <div class="item-row">
            <span>No: {{ $order->order_number }}</span>
            <span>{{ $order->created_at->format('d/m/y H:i') }}</span>
        </div>
        <div class="item-row">
            <span>Kasir: {{ $order->user->name ?? 'Kasir' }}</span>
            <span>{{ $order->delivery_address ?? 'Ampera' }}</span>
        </div>
        @if($order->customer_name && $order->customer_name !== '-')
            <div class="item-row">
                <span>Pelanggan: {{ $order->customer_name }}</span>
            </div>
        @endif
    </div>

    <div class="border-top my-2"></div>

    <!-- Items -->
    <div>
        @foreach($order->items as $item)
            <div style="margin-bottom: 6px;">
                <div class="fw-bold">{{ $item->item_name }}</div>
                <div class="item-row" style="font-size: 12px;">
                    <span>{{ $item->quantity }} x Rp {{ number_format($item->unit_price, 0, ',', '.') }}</span>
                    <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="border-top my-2"></div>

    <!-- Total -->
    <div>
        <div class="item-row">
            <span>SUBTOTAL</span>
            <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
        </div>
        @if($order->discount_amount > 0)
            <div class="item-row">
                <span>DISKON</span>
                <span>-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
            </div>
        @endif
        <div class="item-row fw-bold" style="font-size: 15px; margin-top: 4px;">
            <span>TOTAL</span>
            <span>{{ $order->formatted_total }}</span>
        </div>
        <div class="item-row" style="margin-top: 4px;">
            <span>BAYAR ({{ strtoupper($order->payments->first()->payment_method ?? 'TUNAI') }})</span>
            <span>Rp {{ number_format($order->cash_received ?? $order->total_amount, 0, ',', '.') }}</span>
        </div>
        <div class="item-row">
            <span>KEMBALI</span>
            <span>Rp {{ number_format($order->change_amount ?? 0, 0, ',', '.') }}</span>
        </div>
    </div>

    <div class="border-top my-2"></div>

    <div class="text-center" style="font-size: 11px; margin-top: 10px;">
        <div>*** TERIMA KASIH ***</div>
        <div>Selamat Menikmati Hidangan Kami!</div>
        <div style="font-size: 10px; color: #555; margin-top: 4px;">Layanan Katering: hubungi 0812-3456-7890</div>
    </div>

    <div class="no-print">
        <button class="btn-print" onclick="window.print()">🖨️ Cetak Struk Ulang</button>
        <button class="btn-print" style="background:#555;" onclick="window.close()">Tutup</button>
    </div>

</body>
</html>

