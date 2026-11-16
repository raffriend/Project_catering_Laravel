<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'role', // owner, admin, cashier, customer
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Cek apakah user adalah Pemilik (Owner / Super Admin)
     */
    public function isOwner(): bool
    {
        return in_array($this->role, ['owner', 'admin']);
    }

    /**
     * Alias untuk backward-compatibility
     */
    public function isAdmin(): bool
    {
        return $this->isOwner();
    }

    /**
     * Cek apakah user adalah Kasir / Karyawan Kasir
     */
    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }

    /**
     * Cek apakah user berhak mengakses Halaman Manager (Pemilik atau Kasir)
     */
    public function isManager(): bool
    {
        return in_array($this->role, ['owner', 'admin', 'cashier']);
    }

    /**
     * Cek apakah user adalah Pelanggan
     */
    public function isCustomer(): bool
    {
        return $this->role === 'customer';
    }

    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function testimonials(): HasMany
    {
        return $this->hasMany(Testimonial::class);
    }
}
