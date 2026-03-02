<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuideAssignment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'guide_id',
        'trip_id',
        'group_id',
        'assigned_at'
    ];

    public function guide()
    {
        return $this->belongsTo(TourGuide::class, 'guide_id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}

