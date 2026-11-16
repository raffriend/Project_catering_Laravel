@extends('layouts.admin')

@section('title', 'Detail Pelanggan ' . $customer->name)
@section('page_title', 'Profil & Riwayat: ' . $customer->name)

@section('content')
<div class="row g-4">
    <!-- Left Column: Customer Profile -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-3 p-4 mb-4">
            <div class="text-center mb-3">
                <div class="rounded-circle bg-primary bg-opacity-10 text-primary mx-auto mb-2 d-flex align-items-center justify-content-center" style="width: 80px; height: 80px;">
                    <i class="fa fa-user fa-3x"></i>
                </div>
                <h4 class="fw-bold mb-1">{{ $customer->name }}</h4>
                @if($customer->is_regular)
                    <span class="badge bg-warning text-dark"><i class="fa fa-star me-1"></i>Pelanggan Tetap</span>
                @endif
            </div>

            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item px-0 d-flex justify-content-between">
                    <span class="text-muted">Nomor Telepon:</span>
                    <strong class="text-primary">{{ $customer->phone }}</strong>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between">
                    <span class="text-muted">Email:</span>
                    <span>{{ $customer->email ?? '-' }}</span>
                </li>
                <li class="list-group-item px-0 d-flex justify-content-between">
                    <span class="text-muted">Tipe Pelanggan:</span>
                    <span class="badge bg-secondary text-capitalize">{{ str_replace('_', ' ', $customer->customer_type) }}</span>
                </li>
                <li class="list-group-item px-0">
                    <span class="text-muted d-block small mb-1">Alamat Lengkap:</span>
                    <p class="mb-0">{{ $customer->address }}</p>
                </li>
            </ul>

            <div class="p-3 bg-light rounded text-center mb-3">
                <small class="text-muted d-block">Total Akumulasi Belanja:</small>
                <h4 class="fw-bold text-success mb-0">Rp {{ number_format($totalSpending, 0, ',', '.') }}</h4>
                <small class="text-muted">{{ $customer->orders->count() }} transaksi pesanan</small>
            </div>

            @if($customer->notes)
                <div class="p-3 bg-light rounded mb-3">
                    <small class="fw-bold d-block text-dark mb-1">Catatan Khusus:</small>
                    <small class="text-muted">{{ $customer->notes }}</small>
                </div>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-warning btn-sm w-100">
                    <i class="fa fa-edit me-1"></i> Edit Data
                </a>
                <a href="https://wa.me/{{ preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $customer->phone)) }}" target="_blank" class="btn btn-success btn-sm w-100">
                    <i class="fab fa-whatsapp me-1"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>

    <!-- Right Column: Order History -->
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-3 p-4">
            <h5 class="fw-bold mb-3"><i class="fa fa-history text-primary me-2"></i>Riwayat Seluruh Pesanan Katering</h5>

            @if($customer->orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Pesanan</th>
                                <th>Jadwal Kirim</th>
                                <th>Total</th>
                                <th>Status Pesanan</th>
                                <th>Pembayaran</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->orders as $order)
                                <tr>
                                    <td>
                                        <strong class="text-primary">{{ $order->order_number }}</strong>
                                        <small class="d-block text-muted">{{ $order->created_at->format('d/m/Y') }}</small>
                                    </td>
                                    <td>
                                        {{ $order->delivery_date->format('d/m/Y') }}
                                        <small class="d-block text-muted">{{ date('H:i', strtotime($order->delivery_time)) }} WIB</small>
                                    </td>
                                    <td>
                                        <strong class="text-dark">{{ $order->formatted_total }}</strong>
                                    </td>
                                    <td>{!! $order->status_badge !!}</td>
                                    <td>{!! $order->payment_status_badge !!}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary py-0 px-2">
                                            <i class="fa fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-5 text-muted">
                    <i class="fa fa-inbox fa-3x mb-2 text-secondary opacity-50"></i>
                    <p class="mb-0">Belum ada riwayat pesanan untuk pelanggan ini.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

