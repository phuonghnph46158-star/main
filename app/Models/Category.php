<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Bắt buộc phải thêm dòng này vì bảng trong SQL là 'tour_categories'
    protected $table = 'tour_categories';

    protected $fillable = ['name', 'slug', 'description', 'parent_id', 'status'];

    public function tours()
    {
        // Khai báo khóa ngoại chính xác theo SQL (category_id)
        return $this->hasMany(Tour::class, 'category_id');
    }
}