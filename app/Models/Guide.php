<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $table = 'tour_guides';
    
    // Thêm dòng này để báo cho Laravel biết bảng không có cột thời gian
    public $timestamps = false; 

    protected $fillable = ['name', 'phone', 'email', 'experience', 'status'];
}