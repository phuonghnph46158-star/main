<div class="card shadow-sm">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <span>Lịch khởi hành: <strong>{{ $trip->tour->name }}</strong> - Ngày: {{ \Carbon\Carbon::parse($trip->start_date)->format('d/m/Y') }}</span>
        <span class="badge bg-light text-dark">Trạng thái: {{ strtoupper($trip->status) }}</span>
    </div>
    
    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5>Tổng số khách: <span class="badge bg-success">{{ $totalPax }} / {{ $trip->max_people }} khách</span></h5>
                <div class="progress mt-2" style="height: 10px;">
                    @php $percent = ($totalPax / $trip->max_people) * 100; @endphp
                    <div class="progress-bar bg-info" role="progressbar" style="width: {{ $percent }}%"></div>
                </div>
            </div>
        </div>

        <div class="card border-warning mb-4">
            <div class="card-header bg-warning text-dark fw-bold">Điều phối Hướng dẫn viên & Phương tiện</div>
            <div class="card-body">
                <form action="{{ route('admin.trips.assignResources', $trip->id) }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Hướng dẫn viên:</label>
                            <select name="guide_id" class="form-select">
                                <option value="">-- Chọn HDV --</option>
                                @foreach($availableGuides as $guide)
                                    <option value="{{ $guide->id }}" {{ $trip->guides->contains($guide->id) ? 'selected' : '' }}>
                                        {{ $guide->name }} ({{ $guide->phone }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Phương tiện (Xe):</label>
                            <select name="vehicle_id" class="form-select">
                                <option value="">-- Chọn Xe --</option>
                                @foreach($availableVehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ $trip->vehicle_id == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->license_plate }} - {{ $vehicle->seats }} chỗ (Tài: {{ $vehicle->driver_name }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-warning w-100 fw-bold">Xác nhận gán</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h5 class="mt-4"><i class="bi bi-box-seam"></i> Danh sách 5 Đơn đặt chỗ (Bookings)</h5>
        <div class="table-responsive">
            <table class="table table-hover table-bordered border-primary">
                <thead class="table-primary">
                    <tr>
                        <th>Mã đơn</th>
                        <th>Khách đại diện</th>
                        <th>SĐT</th>
                        <th>Số lượng</th>
                        <th>Trạng thái</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($trip->bookings as $item)
                    <tr>
                        <td class="fw-bold text-primary">#{{ $item->booking_code }}</td>
                        <td>{{ $item->user->name }}</td>
                        <td>{{ $item->user->phone }}</td>
                        <td class="text-center">{{ $item->quantity }}</td>
                        <td>
                            <span class="badge {{ $item->status == 'confirmed' ? 'bg-success' : 'bg-warning' }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td><small class="text-muted">{{ $item->note ?? 'N/A' }}</small></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>