<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;   
  

// use App\Models\Tour; // Mở comment này nếu bạn đã có Model Tour

class BookingController extends Controller
{
    public function create($id)
{
    $tours = [
        1 => [
            'id' => 1,
            'name' => 'Tour Phú Quốc 3 Ngày 2 Đêm', 
            'price' => 4500000, 
            'image' => 'https://static-images.vnncdn.net/files/publish/2022/7/27/ha-long-bay-1-852.jpg'
        ],
        // THÊM TOUR ID SỐ 2 VÀO ĐÂY
        2 => [
            'id' => 2,
            'name' => 'Khám phá kỳ quan Vịnh Hạ Long', 
            'price' => 2650000, 
            'image' => 'https://static-images.vnncdn.net/files/publish/2022/7/27/ha-long-bay-1-852.jpg'
        ],
        3 => [
            'id' => 3,
            'name' => 'Khám phá Đảo Ngọc Phú Quốc - Lặn ngắm san hô', 
            'price' => 4150000, 
            'image' => 'https://images.unsplash.com/photo-1583212292454-1fe6229603b7'
        ],
        4 => [
            'id' => 4,
            'name' => 'Sapa mờ sương: Chinh phục đỉnh Fansipan', 
            'price' => 2250000, 
            'image' => 'https://images.unsplash.com/photo-1504457047772-27faf1c00561'
        ],
    ];

    // Lệnh abort(404) này sẽ chạy nếu $id truyền vào không nằm trong danh sách trên
    $selectedTour = $tours[$id] ?? abort(404);

    return view('clients.booking.create', compact('selectedTour'));
}

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|numeric',
            'customer_email' => 'required|email',
            'tour_id' => 'required'
        ]);

        // Lưu dữ liệu thực tế:
        // Booking::create($request->all());

        return redirect()->route('home')->with('success', 'Đặt tour thành công! Chúng tôi sẽ liên hệ sớm nhất.');
    }
}

// test comment