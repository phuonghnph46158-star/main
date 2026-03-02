<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\TourGuide;
use App\Models\Vehicle;

class TripController extends Controller
{
    /**
     * Dashboard Quản lý lịch khởi hành tổng thể
     */
    public function index()
    {
        // Sử dụng withCount và withSum để lấy số liệu nhanh từ DB
        $trips = Trip::with(['tour', 'vehicle', 'guides'])
            ->withCount(['bookings as total_orders' => function($query) {
                $query->where('status', 'confirmed');
            }])
            ->withSum(['bookings as total_guests' => function($query) {
                $query->where('status', 'confirmed');
            }], 'quantity')
            ->orderBy('start_date', 'asc')
            ->get()
            ->groupBy(fn($item) => \Carbon\Carbon::parse($item->start_date)->format('Y-m-d'));

        return view('admin.trips.index', compact('trips'));
    }

    /**
     * Chi tiết chuyến đi - Nơi thực hiện "Ghép đoàn & Gán tài nguyên"
     */
    public function showTripDetail($id)
    {
        // Lấy Trip kèm theo thông tin chi tiết của 5 booking và khách hàng của từng booking
        $trip = Trip::with([
            'tour', 
            'vehicle', 
            'guides', 
            'bookings.bookingCustomers' // Lấy danh sách khách lẻ trong từng booking
        ])->findOrFail($id);

        // Lấy danh sách HDV rảnh và Xe rảnh để Admin chọn (Dropdown)
        $availableGuides = TourGuide::where('status', 'available')->get();
        $availableVehicles = Vehicle::where('status', 'available')->get();

        return view('admin.trips.detail', compact('trip', 'availableGuides', 'availableVehicles'));
    }

    /**
     * Xử lý gán HDV và Xe cho đoàn
     */
    public function assignResources(Request $request, $id)
    {
        $request->validate([
            'guide_id' => 'required|exists:tour_guides,id',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        $trip = Trip::findOrFail($id);
        
        // 1. Gán xe vào Trip
        $trip->update([
            'vehicle_id' => $request->vehicle_id,
            'status' => 'started' 
        ]);

        // 2. Gán HDV (Xóa gán cũ nếu có và tạo gán mới)
        $trip->guideAssignments()->updateOrCreate(
            ['trip_id' => $trip->id],
            ['guide_id' => $request->guide_id, 'assigned_at' => now()]
        );

        return back()->with('success', 'Đã gán Hướng dẫn viên và Xe cho đoàn thành công!');
    }
}