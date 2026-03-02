<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GuideSchedule extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'guide_id',
        'work_date',
        'status',
        'note'
    ];

    public function guide()
    {
        return $this->belongsTo(TourGuide::class, 'guide_id');
    }
}

