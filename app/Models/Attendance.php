<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_id',
        'group_id',
        'guide_id',
        'attendance_date',
        'session',
        'note'
    ];

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function guide()
    {
        return $this->belongsTo(TourGuide::class, 'guide_id');
    }

    public function details()
    {
        return $this->hasMany(AttendanceDetail::class);
    }
}

