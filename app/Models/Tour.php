<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    // THÊM 'image' VÀO ĐÂY (Vì migration ngày 20/02 đã thêm cột này vào bảng tours)
    protected $fillable = [
        'category_id', 'name', 'slug', 'description', 
        'duration', 'price', 'child_price', 'max_people', 'status', 'image'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class, 'tour_id');
    }

    public function images()
    {
        return $this->hasMany(TourImage::class, 'tour_id');
    }
}