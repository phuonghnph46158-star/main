<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'vehicle_id',    // Đã thêm: ID xe cho đoàn
        'start_date',
        'end_date',
        'max_people',
        'current_people',
        'status',
        'pickup_location', // Đã thêm: Điểm đón chính
        'operator_note'    // Đã thêm: Ghi chú điều hành
    ];

    // --- Relationships ---

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    /**
     * Một Trip có thể gán cho một Xe (Vehicle)
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    /**
     * Lấy danh sách Booking của chuyến đi này
     */
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    /**
     * Quan hệ với bảng trung gian gán HDV
     */
    public function guideAssignments()
    {
        return $this->hasMany(GuideAssignment::class);
    }

    /**
     * Lấy trực tiếp Hướng dẫn viên (thông qua bảng gán)
     */
    public function guides()
    {
        return $this->belongsToMany(TourGuide::class, 'guide_assignments', 'trip_id', 'guide_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    // --- Accessors & Logic xử lý ghép đoàn ---

    /**
     * Tính tổng số khách thực tế từ các booking đã xác nhận
     * Giúp bạn kiểm tra con số 35 khách có khớp với database không
     */
    public function getTotalConfirmedGuestsAttribute()
    {
        return $this->bookings()->where('status', 'confirmed')->sum('quantity');
    }

    /**
     * Kiểm tra xem đoàn đã đủ số lượng tối thiểu để khởi hành chưa
     */
    public function getIsReadyToStartAttribute()
    {
        // Ví dụ min_people là 10
        return $this->total_confirmed_guests >= 10;
    }

    /**
     * Tính phần trăm lấp đầy chỗ (Progress bar cho UI)
     */
    public function getFillPercentageAttribute()
    {
        if ($this->max_people <= 0) return 0;
        return round(($this->total_confirmed_guests / $this->max_people) * 100);
    }

    // --- Scopes (Dùng để query nhanh cho Dashboard) ---

    /**
     * Lấy các chuyến khởi hành trong một ngày cụ thể
     */
    public function scopeStartingOn($query, $date)
    {
        return $query->whereDate('start_date', $date);
    }

    /**
     * Lấy các chuyến chưa có Hướng dẫn viên
     */
    public function scopeWithoutGuide($query)
    {
        return $query->doesntHave('guideAssignments');
    }
}