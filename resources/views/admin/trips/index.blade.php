@extends('admin.layout')

@section('content_title', 'Danh sách tour theo ngày')

@section('content')

<div class="card shadow-sm border-0">
    <div class="card-body">
        <h4 class="mb-4">Quản lý lịch khởi hành</h4>
        <table class="table table-hover align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Tên Tour</th>
                    <th>Ngày khởi hành</th>
                    <th>Tổng khách ghép</th>
                    <th>Trạng thái đoàn</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                {{-- Vòng lặp 1: Tách từng khối NGÀY riêng biệt --}}
                @foreach($trips as $date => $dayTrips)
                    <tr class="bg-light border-bottom">
                        <td colspan="5" class="py-3">
                            <h6 class="mb-0 text-primary fw-bold">
                                <i class="far fa-calendar-alt me-2"></i> 
                                KHỞI HÀNH NGÀY: {{ \Carbon\Carbon::parse($date)->format('d/m/Y') }} 
                                <span class="badge bg-secondary ms-2">{{ $dayTrips->count() }} chuyến đi</span>
                            </h6>
                        </td>
                    </tr>

                    {{-- Vòng lặp 2: Hiển thị các tour cụ thể của ngày đó --}}
                    @foreach($dayTrips as $trip)
                    <tr>
                        <td class="ps-4">
                            <strong>{{ $trip->tour->name ?? 'N/A' }}</strong>
                        </td>
                        <td>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($trip->start_date)->format('d/m/Y') }}</span>
                        </td>
                        <td>
                            <span class="badge bg-primary px-3">
                                {{ $trip->bookings->sum('quantity') }} khách
                            </span>
                        </td>
                        <td>
                            @php $totalPax = $trip->bookings->sum('quantity'); @endphp
                            <span class="badge {{ $totalPax >= 10 ? 'bg-success' : 'bg-warning' }}">
                                {{ $totalPax >= 10 ? 'Đủ điều kiện' : 'Đang chờ ghép' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.trips.show', $trip->id) }}" class="btn btn-info btn-sm text-white shadow-sm">
                                <i class="fas fa-users-cog"></i> Chi tiết ghép đoàn
                            </a>
                        </td>
                    </tr>
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<style>
    .table thead th { font-weight: 600; background-color: #f1f5f9; border-top: none; }
    .table tbody tr { transition: all 0.2s; }
    /* Làm nổi bật hàng tiêu đề ngày */
    .bg-light.border-bottom td { background-color: #f8fafc !important; border-left: 4px solid #0ea5e9; }
    .btn-info { background-color: #0ea5e9; border: none; }
    .btn-info:hover { background-color: #0284c7; }
</style>

@endsection