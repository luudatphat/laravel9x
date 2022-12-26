<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function phone()
    {
        // One To One
        // Lấy thông tin phone , khi bảng Phone có khóa ngoại là chưa id user (vd : user_id)
        return $this->hasOne(Phone::class);
    }

    /**
     * Get the user's most recent order.
     */
    public function latestOrder()
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }

    /**
     * Get the user's oldest order.
     */
    public function oldestOrder()
    {
        return $this->hasOne(Order::class)->oldestOfMany();
    }

    /**
     * Get the user's largest order.
     */
    public function largestOrder()
    {
        // ofMany(max, min)
        return $this->hasOne(Order::class)->ofMany('price', 'max');
    }

    /**
     * The roles that belong to the user.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
