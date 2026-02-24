@extends('layouts.client')

@section('content') 
<div class="max-w-4xl mx-auto py-16 px-4">
    <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-slate-100 flex flex-col md:flex-row">
        {{-- THÔNG TIN TOUR --}}
        <div class="md:w-1/3 bg-slate-900 text-white p-8">
            {{-- ĐÃ FIX: Logic lấy ảnh thông minh từ bảng Tours hoặc bảng phụ --}}
            @php 
                $tourImage = $selectedTour->image; // Lấy từ cột image mới thêm vào bảng tours
                if (!$tourImage) {
                    $mainImg = $selectedTour->images->where('is_main', 1)->first() ?? $selectedTour->images->first();
                    $tourImage = $mainImg ? $mainImg->image : null;
                }
                $finalImageUrl = $tourImage ? asset('storage/' . $tourImage) : 'https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=800';
            @endphp

            <img src="{{ $finalImageUrl }}" 
                 class="rounded-2xl mb-6 h-40 w-full object-cover shadow-lg" 
                 onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=800'">
            
            <h2 class="text-2xl font-bold mb-2">{{ $selectedTour->name }}</h2>
            <div class="flex items-center gap-2 text-orange-400 text-sm mb-4">
                <i class="fas fa-map-marker-alt"></i> 
                {{ $selectedTour->category->name ?? 'Điểm đến hấp dẫn' }}
            </div>
            <p class="text-blue-400 text-2xl font-black">{{ number_format($selectedTour->price, 0, ',', '.') }}<span class="text-sm ml-1">đ</span></p>
            <p class="text-slate-400 text-xs mt-4 italic">* Giá đã bao gồm thuế và phí dịch vụ</p>
        </div>

        {{-- FORM ĐẶT TOUR --}}
        <div class="md:w-2/3 p-8">
            <h3 class="text-2xl font-bold mb-6 text-slate-800">Thông tin liên hệ</h3>
            
            {{-- Hiển thị thông báo lỗi nếu có --}}
            @if ($errors->any())
                <div class="mb-4 p-4 bg-red-50 text-red-600 rounded-xl text-sm">
                    @foreach ($errors->all() as $error)
                        <p>• {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form action="{{ route('booking.store') }}" method="POST" class="space-y-4">
                @csrf
                {{-- Các trường ẩn để khớp với Database --}}
                <input type="hidden" name="tour_id" value="{{ $selectedTour->id }}">
                <input type="hidden" name="total_price" value="{{ $selectedTour->price }}"> {{-- Đổi tên cho khớp với Controller thường dùng --}}
                
                {{-- Bổ sung trip_id mặc định --}}
                <input type="hidden" name="trip_id" value="{{ $selectedTour->trips->first()->id ?? 1 }}">

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Họ và tên</label>
                    <input type="text" name="customer_name" class="w-full border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Nguyễn Văn A" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Số điện thoại</label>
                        <input type="text" name="customer_phone" class="w-full border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="0901234xxx" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Số người đi</label>
                        <input type="number" name="quantity" min="1" value="1" class="w-full border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" required>
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Ngày khởi hành</label>
                    <input type="date" name="departure_date" 
                           min="{{ date('Y-m-d') }}" 
                           class="w-full border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" 
                           required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 mb-1">Email</label>
                    <input type="email" name="customer_email" class="w-full border-slate-200 rounded-xl p-3 focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="email@example.com" required>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transform active:scale-95 transition duration-300">
                        XÁC NHẬN ĐẶT TOUR
                    </button>
                    <p class="text-center text-slate-400 text-xs mt-4">
                        Bằng cách nhấn xác nhận, bạn đồng ý với các điều khoản của TravelGo
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection