<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TripDeparture extends Model
{
    protected $table = 'trip_departures';

    protected $fillable = [
        'tour_id',
        'departure_date',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'trip_id');
    }
}