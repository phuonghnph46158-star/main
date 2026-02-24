@extends('admin.layout')

@section('content')
<div class="container-fluid p-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Điều phối đoàn: {{ $trip->tour->name }}</h4>
            <span class="text-muted">Ngày khởi hành: <strong>{{ \Carbon\Carbon::parse($trip->departure_date)->format('d/m/Y') }}</strong></span>
        </div>
        <a href="{{ route('admin.trips.index') }}" class="btn btn-outline-secondary">Quay lại</a>
    </div>

    <div class="row">
    <div class="col-md-8">
        <h5>Danh sách các đơn hàng đã ghép vào ngày này</h5>
        <table class="table border">
            <thead>
                <tr>
                    <th>Mã đơn</th>
                    <th>Khách hàng</th>
                    <th>Số lượng</th>
                </tr>
            </thead>
            <tbody>
                @foreach($trip->bookings as $booking)
                <tr>
                    <td>{{ $booking->booking_code }}</td>
                    <td>{{ $booking->user->name }}</td>
                    <td>{{ $booking->quantity }} người</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="col-md-4">
        <div class="card card-body shadow-sm">
            <h6>Gán Hướng dẫn viên</h6>
            <form action="{{ route('admin.trips.assignGuide', $trip->id) }}" method="POST">
                @csrf
                <select name="guide_id" class="form-select mb-3" required>
                    <option value="">-- Chọn HDV --</option>
                    @foreach($guides as $guide)
                        <option value="{{ $guide->id }}" {{ $trip->guide_id == $guide->id ? 'selected' : '' }}>
                            {{ $guide->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-success w-100">Xác nhận gán</button>
            </form>
        </div>
    </div>
</div>
</div>
@endsection