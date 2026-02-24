@extends('admin.layout')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Chi tiết đơn hàng #{{ $booking->booking_code }}</h4>
        <a href="{{ route('admin.bookings.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-lg-8">

            {{-- Thông tin khách hàng --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 text-primary">
                    <i class="fas fa-user-circle me-2"></i>Thông tin khách hàng đặt tour
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small text-uppercase">Tên khách hàng</p>
                            <p class="fw-bold text-dark mb-0">{{ $booking->customer_name ?? 'Không có dữ liệu' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small text-uppercase">Email liên hệ</p>
                            <p class="text-dark mb-0">{{ $booking->customer_email ?? 'Không có dữ liệu' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small text-uppercase">Số điện thoại</p>
                            <p class="fw-bold text-dark mb-0">{{ $booking->customer_phone ?? 'Chưa cung cấp' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-muted mb-1 small text-uppercase">Ngày khởi hành</p>
                            <p class="fw-bold text-blue-600 mb-0">
                                <i class="far fa-calendar-check me-1"></i>
                                {{ $booking->departure_date 
                                    ? \Carbon\Carbon::parse($booking->departure_date)->format('d/m/Y') 
                                    : 'Chưa chọn ngày' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Chi tiết tour --}}
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white fw-bold py-3 text-primary">
                    <i class="fas fa-map-marked-alt me-2"></i>Chi tiết dịch vụ
                </div>
                <div class="card-body">
                    <div class="d-flex flex-column flex-md-row gap-4">

                        @php
                            $imagePath = null;

                            if (!empty($booking->tour?->image)) {

                                if (file_exists(public_path('storage/' . $booking->tour->image))) {
                                    $imagePath = asset('storage/' . $booking->tour->image);
                                }
                                elseif (file_exists(public_path($booking->tour->image))) {
                                    $imagePath = asset($booking->tour->image);
                                }
                            }
                        @endphp

                        <img src="{{ $imagePath ?? 'https://via.placeholder.com/180x120?text=No+Image' }}"
                             class="rounded shadow-sm"
                             style="width: 180px; height: 120px; object-fit: cover;">

                        <div class="flex-grow-1">
                            <h5 class="text-dark fw-bold mb-2">
                                {{ $booking->tour->name ?? 'Không có thông tin tour' }}
                            </h5>

                            <div class="row">
                                <div class="col-sm-6">
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-users me-2"></i>
                                        Số lượng: <strong>{{ $booking->quantity }}</strong> người
                                    </p>
                                    <p class="mb-1 text-muted small">
                                        <i class="fas fa-clock me-2"></i>
                                        Ngày đặt đơn: 
                                        {{ $booking->created_at 
                                            ? $booking->created_at->format('d/m/Y H:i') 
                                            : '-' }}
                                    </p>
                                </div>

                                <div class="col-sm-6 text-md-end">
                                    <p class="text-muted small mb-0">Tổng cộng thanh toán:</p>
                                    <h4 class="text-danger fw-black">
                                        {{ number_format($booking->total_price ?? 0) }}đ
                                    </h4>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

        {{-- Admin action --}}
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm sticky-top" style="top: 20px;">
                <div class="card-header bg-white fw-bold py-3 text-primary">
                    <i class="fas fa-cog me-2"></i>Thao tác Admin
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.bookings.updateStatus', $booking->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="small text-muted mb-2 d-block">Trạng thái đơn hàng:</label>
                            <select name="status" class="form-select shadow-none border-2">
                                <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>
                                    ⏳ Chờ xử lý
                                </option>
                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>
                                    ✅ Xác nhận
                                </option>
                                <option value="canceled" {{ $booking->status == 'canceled' ? 'selected' : '' }}>
                                    ❌ Hủy đơn
                                </option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fw-bold shadow-sm mb-2">
                            Cập nhật đơn hàng
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection