<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'user_phone',
        'number',
    ];

    public function user()
    {
        // One To One
        // Lấy ngược lại bảng user với khóa ngoại user_id trong bảng phone
        return $this->belongsTo(User::class);
    }
}
