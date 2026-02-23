<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'booking_id',
        'method',
        'amount',
        'status',
        'transaction_code',
        'paid_at'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
