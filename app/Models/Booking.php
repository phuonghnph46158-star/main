<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tour_id',
        'trip_id',
        'group_id',
        'quantity',
        'total_price',
        'status',
        'booking_code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function customers()
    {
        return $this->hasMany(BookingCustomer::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}

