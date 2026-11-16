<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'payment_number',
        'amount',
        'payment_method',
        'payment_type',
        'proof_image',
        'status',
        'payment_date',
        'verified_by',
        'verified_at',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'payment_date' => 'datetime',
            'verified_at' => 'datetime',
        ];
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function verifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function getFormattedAmountAttribute(): string
    {
        return 'Rp ' . number_format($this->amount, 0, ',', '.');
    }

    public function getStatusBadgeAttribute(): string
    {
        return match($this->status) {
            'menunggu_konfirmasi' => '<span class="badge bg-warning text-dark">Menunggu Konfirmasi</span>',
            'diterima' => '<span class="badge bg-success">Diterima</span>',
            'ditolak' => '<span class="badge bg-danger">Ditolak</span>',
            default => '<span class="badge bg-secondary">' . e($this->status) . '</span>',
        };
    }
}

