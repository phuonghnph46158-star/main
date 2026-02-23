<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourGuide extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'experience',
        'status'
    ];

    public function assignments()
    {
        return $this->hasMany(GuideAssignment::class, 'guide_id');
    }

    public function schedules()
    {
        return $this->hasMany(GuideSchedule::class, 'guide_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'guide_id');
    }
}

