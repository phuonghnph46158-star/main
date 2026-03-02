<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'trip_id',
        'type',
        'max_people',
        'current_people',
        'status',
        'note'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function guideAssignments()
    {
        return $this->hasMany(GuideAssignment::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
}

