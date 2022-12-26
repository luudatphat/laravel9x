<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Get the car's owner.
     */
    public function carOwner()
    {
        // hasOneThrough(Chỉ lấy 1) - hasManyThrough(Lấy nhiều)
        // return $this->hasOneThrough(Owner::class, Car::class);

        return $this->hasManyThrough(Owner::class, Car::class);
    }
}
