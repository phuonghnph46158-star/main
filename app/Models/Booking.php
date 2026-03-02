<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id', 'tour_id', 'trip_id', 'quantity', 'total_price', 
    'status', 'booking_code', 'departure_date',
    'customer_name', 'customer_email', 'customer_phone'  // Thêm 3 dòng này
];

    // Quan hệ với Tour (Để hiện tên tour, giá tour)
    public function tour() {
        return $this->belongsTo(Tour::class);
    }

    // THÊM QUAN HỆ NÀY: Quan hệ với User (Để hiện tên khách hàng, email)
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function trip() {
    return $this->belongsTo(Trip::class);
}

public function departure()
{
    return $this->belongsTo(TripDeparture::class, 'trip_id');
}
}