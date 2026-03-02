<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TourCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
        'status'
    ];

    // Danh mục cha
    public function parent()
    {
        return $this->belongsTo(TourCategory::class, 'parent_id');
    }

    // Danh mục con
    public function children()
    {
        return $this->hasMany(TourCategory::class, 'parent_id');
    }

    // 1 danh mục có nhiều tour
    public function tours()
    {
        return $this->hasMany(Tour::class, 'category_id');
    }
}
