<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tour extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'duration',
        'price',
        'child_price',
        'max_people',
        'status'
    ];

    public function category()
    {
        return $this->belongsTo(TourCategory::class);
    }

    public function images()
    {
        return $this->hasMany(TourImage::class);
    }

    public function mainImage()
    {
        return $this->hasOne(TourImage::class)->where('is_main', 1);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
