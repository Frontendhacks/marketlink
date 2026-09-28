<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'contact',
        'email',
        'address',
        'password',
        'role',
        'status',
        'approval_status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
    public const FARMER_STATUSES = ['pending', 'approved', 'rejected', 'inactive'];

    public function isApprovedFarmer(): bool
    {
        return $this->role === 'farmer'
            && $this->approval_status === 'approved'
            && $this->status === 'active'
            && $this->farmerProfile()->where('status', 'approved')->exists();
    }

    public function farmerBlockedMessage(): string
    {
        return match ($this->approval_status) {
            'rejected' => 'Your farmer registration was rejected by the admin.',
            'inactive' => 'Your farmer account has been deactivated by the admin.',
            default => 'Your registration has been submitted and is waiting for admin approval.',
        };
    }

    public function farmerProfile()
    {
        return $this->hasOne(FarmerProfile::class, 'farmer_id');
    }
    public function products()
    {
        return $this->hasMany(Product::class, 'farmer_id');
    }
    public function farmerProfiles()
{
    return $this->hasMany(FarmerProfile::class, 'farmer_id');
}
    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');
        }
        public function favorites()
        {
            return $this->hasMany(Favorite::class, 'customer_id');
            }
            public function reviews()
            {
                return $this->hasMany(Review::class, 'customer_id');
                }
        public function reports()
        {
            return $this->hasMany(Report::class, 'generated_by');
            }
}

