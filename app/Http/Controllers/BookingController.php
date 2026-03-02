<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['tour', 'user'])
                    ->orderBy('id', 'desc')
                    ->paginate(10);
                    
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show($id)
    {
        $booking = Booking::with(['tour', 'user'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,canceled'
        ]);

        $booking = Booking::findOrFail($id);
        
        $booking->update([
            'status' => $request->status
        ]);

        return redirect()->back()
            ->with('success', 'Đã cập nhật trạng thái đơn hàng thành công!');
    }

    /**
     * STORE ĐÃ FIX TÍNH TỔNG TIỀN
     */
    public function store(Request $request)
    {
        $request->validate([
            'tour_id' => 'required',
            'quantity' => 'required|integer|min:1',
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email',
            'customer_phone' => 'required',
            'departure_date' => 'required|date',
        ]);

        // 🔥 Lấy tour từ database
        $tour = Tour::findOrFail($request->tour_id);

        $quantity = (int) $request->quantity;

        // 🔥 Tính tổng tiền chuẩn
        $total_price = $tour->price * $quantity;

        Booking::create([
            'user_id'        => auth()->id(),
            'tour_id'        => $tour->id,
            'trip_id'        => $request->trip_id ?? 1,
            'quantity'       => $quantity,
            'total_price'    => $total_price,
            'status'         => 'pending',
            'booking_code'   => 'BK-' . strtoupper(uniqid()),
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'departure_date' => $request->departure_date,
        ]);

        return redirect()->route('booking.history')
            ->with('success', 'Đặt tour thành công!');
    }

    public function history()
    {
        $bookings = Booking::where('user_id', auth()->id())
                    ->with('tour')
                    ->orderBy('id', 'desc')
                    ->get();
                    
        return view('clients.booking.history', compact('bookings'));
    }

    public function create($id)
    {
        $selectedTour = Tour::find($id);

        if (!$selectedTour) {
            $tours = [
                1 => [
                    'id' => 1,
                    'name' => 'Tour Phú Quốc 3 Ngày 2 Đêm',
                    'price' => 4500000,
                    'image' => 'https://via.placeholder.com/150'
                ],
            ];
            $selectedTour = (object) ($tours[$id] ?? abort(404));
        }

        return view('clients.booking.create', compact('selectedTour'));
    }
}