<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role',
        'status'
    ];

    protected $hidden = ['password'];

    // User đặt nhiều booking
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    // User viết nhiều đánh giá
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
