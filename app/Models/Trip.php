<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'start_date',
        'end_date',
        'max_people',
        'current_people',
        'status'
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function groups()
    {
        return $this->hasMany(Group::class);
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
