<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'description',
        'promo_type',
        'min_order_qty',
        'min_order_amount',
        'bonus_description',
        'discount_percent',
        'discount_amount',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'min_order_qty' => 'integer',
            'min_order_amount' => 'decimal:2',
            'discount_percent' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function isCurrentlyValid(): bool
    {
        if (!$this->is_active) {
            return false;
        }

        $today = Carbon::today();
        return $today->between($this->start_date, $this->end_date);
    }
}

