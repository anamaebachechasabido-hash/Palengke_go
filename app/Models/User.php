<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password', 'role'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The four user roles defined in the PalengkE-Go Project Proposal.
     */
    public const ROLE_ADMIN = 'admin';
    public const ROLE_VENDOR = 'vendor';
    public const ROLE_CUSTOMER = 'customer';
    public const ROLE_DELIVERY = 'delivery';

    public static function roles(): array
    {
        return [
            self::ROLE_ADMIN => 'Administrator',
            self::ROLE_VENDOR => 'Vendor',
            self::ROLE_CUSTOMER => 'Customer',
            self::ROLE_DELIVERY => 'Delivery Personnel',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isVendor(): bool
    {
        return $this->role === self::ROLE_VENDOR;
    }

    public function isCustomer(): bool
    {
        return $this->role === self::ROLE_CUSTOMER;
    }

    public function isDelivery(): bool
    {
        return $this->role === self::ROLE_DELIVERY;
    }

    /**
     * Name of the route to this user's role-specific dashboard.
     */
    public function dashboardRoute(): string
    {
        return match ($this->role) {
            self::ROLE_ADMIN => 'admin.dashboard',
            self::ROLE_VENDOR => 'vendor.dashboard',
            self::ROLE_DELIVERY => 'delivery.dashboard',
            default => 'customer.dashboard',
        };
    }

    /**
     * Human-readable label for this user's role.
     */
    public function roleLabel(): string
    {
        return self::roles()[$this->role] ?? ucfirst($this->role);
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
