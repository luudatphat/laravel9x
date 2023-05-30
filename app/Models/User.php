<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    use Billable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        // 'shop_name',
        // 'shop_email',
        // 'shop_id',
        // 'domain',
        // 'name',
        // 'shop_phone',
        // 'shop_status',
        // 'shop_country',
        // 'shop_owner',
        // 'plan_name',
        // 'app_plan',
        // 'access_token',
        // 'currency'
        'name',
        'email',
        'shop_phone',
        'shop_status',
        'shop_country',
        'shop_owner',
        'plan_name',
        'app_plan',
        'access_token',
        'currency',
        'password'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
