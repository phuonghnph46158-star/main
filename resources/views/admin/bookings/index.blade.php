@extends('admin.layout')

@section('content')
<div class="container-fluid p-4">
    <h4 class="fw-bold mb-4">Danh sách đơn đặt tour</h4>
    <div class="card border-0 shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4">ID</th>
                        <th>Khách hàng</th>
                        <th>Thông tin tour</th>
                        <th>Trạng thái</th>
                        <th class="text-end pe-4">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                    <tr>
                        <td class="ps-4 text-muted">#{{ $booking->id }}</td>
                        
                        <td class="fw-bold">
                            {{ $booking->user->name ?? 'N/A' }}
                        </td>
                        
                        <td>
                            <div class="text-primary fw-bold">{{ $booking->tour->name ?? 'Tour không tồn tại' }}</div>
                            <small class="text-muted">Số lượng: <strong>{{ $booking->quantity }}</strong> khách</small>
                        </td>

                        <td>
                            @if($booking->status == 'pending')
                                <span class="badge bg-info rounded-pill">Chờ xử lý</span>
                            @elseif($booking->status == 'confirmed')
                                <span class="badge bg-success rounded-pill">Đã xác nhận</span>
                            @else
                                <span class="badge bg-secondary rounded-pill">{{ $booking->status }}</span>
                            @endif
                        </td>

                        <td class="text-end pe-4">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-outline-primary border-0">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer bg-white border-0 py-3">
            {{ $bookings->links() }}
        </div>
    </div>
</div>
@endsection