<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'subscription_level',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Relations
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    // Subscription level helper
    public function getCurrentSubscriptionLevel(): string
    {
        return $this->subscription_level ?? 'free';
    }

    public function canAccessProduct($product): bool
    {
        $levels = ['free', 'basic', 'premium', 'vip'];

        $userLevel = $this->getCurrentSubscriptionLevel();
        $userIndex = array_search($userLevel, $levels, true);
        $userIndex = $userIndex === false ? 0 : $userIndex;

        $productLevel = data_get($product, 'access_level', data_get($product, 'level', 'free'));
        $productIndex = array_search($productLevel, $levels, true);
        $productIndex = $productIndex === false ? 0 : $productIndex;

        return $userIndex >= $productIndex;
    }
}
