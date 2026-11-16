<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'customer_id',
        'user_id',
        'order_type',
        'customer_name',
        'customer_phone',
        'delivery_address',
        'delivery_date',
        'delivery_time',
        'subtotal',
        'discount_amount',
        'total_amount',
        'cash_received',
        'change_amount',
        'status',
        'payment_status',
        'notes',
        'promotion_id',
        'bonus_info',
    ];

    protected function casts(): array
    {
        return [
            'delivery_date' => 'date',
            'subtotal' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'cash_received' => 'decimal:2',
            'change_amount' => 'decimal:2',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function promotion(): BelongsTo
    {
        return $this->belongsTo(Promotion::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function isAmpera(): bool
    {
        return $this->order_type === 'ampera';
    }

    public function isCatering(): bool
    {
        return str_starts_with($this->order_type, 'catering');
    }

    /**
     * Total nominal pembayaran yang telah diterima / terverifikasi
     */
    public function totalPaid(): float
    {
        return (float) $this->payments()->where('status', 'diterima')->sum('amount');
    }

    /**
     * Sisa tagihan / pembayaran yang belum lunas
     */
    public function remainingPayment(): float
    {
        $remaining = (float) $this->total_amount - $this->totalPaid();
        return max(0, $remaining);
    }

    public function getFormattedRemainingAttribute(): string
    {
        return 'Rp ' . number_format($this->remainingPayment(), 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'masuk' => '<span class="badge bg-secondary">Masuk</span>',
            'dikonfirmasi' => '<span class="badge bg-info text-dark">Dikonfirmasi</span>',
            'diproses' => '<span class="badge bg-primary">Diproses</span>',
            'dikirim' => '<span class="badge bg-warning text-dark">Dikirim</span>',
            'selesai' => '<span class="badge bg-success">Selesai</span>',
            'dibatalkan' => '<span class="badge bg-danger">Dibatalkan</span>',
            default => '<span class="badge bg-secondary">' . e($this->status) . '</span>',
        };
    }

    public function getPaymentStatusBadgeAttribute(): string
    {
        return match($this->payment_status) {
            'belum_bayar' => '<span class="badge bg-danger">Belum Bayar</span>',
            'dp' => '<span class="badge bg-warning text-dark">DP</span>',
            'lunas' => '<span class="badge bg-success">Lunas</span>',
            default => '<span class="badge bg-secondary">' . e($this->payment_status) . '</span>',
        };
    }

    public function getOrderTypeBadgeAttribute(): string
    {
        return match($this->order_type) {
            'ampera' => '<span class="badge bg-dark"><i class="fa fa-cash-register me-1"></i>Ampera</span>',
            'catering_paket' => '<span class="badge bg-primary"><i class="fa fa-box me-1"></i>Katering Paket</span>',
            'catering_custom' => '<span class="badge bg-info text-dark"><i class="fa fa-utensils me-1"></i>Katering Custom</span>',
            default => '<span class="badge bg-secondary">' . e($this->order_type) . '</span>',
        };
    }

    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_amount, 0, ',', '.');
    }
}
