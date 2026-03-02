@extends('admin.layout')

@section('content_title', 'Danh sách tour')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-0 text-dark">Danh sách Tour</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0" style="font-size: 0.85rem;">
                <li class="breadcrumb-item"><a href="/admin" class="text-decoration-none text-muted">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Quản lý tour</li>
            </ol>
        </nav>
    </div>
    
    <a href="{{ route('tours.create') }}" class="nav-link-admin btn btn-primary px-4 py-2 rounded-pill shadow-sm d-flex align-items-center border-0" style="background: var(--primary-color);">
        <i class="fas fa-plus-circle me-2"></i>
        <span>Thêm tour mới</span>
    </a>
</div>

<div class="table-responsive shadow-sm rounded-4 overflow-hidden bg-white">
    <table class="table table-hover align-middle mb-0">
        <thead class="bg-light text-muted uppercase" style="font-size: 0.75rem; letter-spacing: 1px;">
            <tr>
                <th class="px-4 py-3 border-0">#</th>
                <th class="py-3 border-0">Tên tour</th>
                <th class="py-3 border-0">Danh mục</th>
                <th class="py-3 border-0">Giá</th>
                <th class="py-3 border-0 text-center">Thời gian</th>
                <th class="px-4 py-3 border-0 text-end">Hành động</th>
            </tr>
        </thead>
        <tbody style="font-size: 0.9rem; border-top: 0;">
            @foreach($tours as $tour)
            <tr>
                <td class="px-4 text-muted">#{{ $tour->id }}</td>
                <td class="fw-bold text-dark">{{ $tour->title }}</td>
                <td>
                    <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill fw-normal">
                        {{ $tour->category->name ?? 'Chưa phân loại' }}
                    </span>
                </td>
                <td class="fw-bold text-primary">{{ number_format($tour->price) }} đ</td>
                <td class="text-center text-muted"><i class="far fa-clock me-1 small"></i> {{ $tour->duration }}</td>
                <td class="px-4 text-end">
                    <div class="btn-group shadow-sm rounded-3 overflow-hidden">
                        <a href="{{ route('tours.edit', $tour) }}" class="btn btn-white btn-sm border-0 text-warning px-3" title="Chỉnh sửa">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="{{ route('tours.destroy', $tour) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc chắn muốn xóa tour này?')" class="btn btn-white btn-sm border-0 text-danger px-3" title="Xóa">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<style>
    /* Làm đẹp bảng mượt mà hơn */
    .table thead th { font-weight: 600; }
    .table tbody tr { transition: all 0.2s; }
    .table tbody tr:hover { background-color: #f8fafc; }
    .btn-white { background: white; }
    .btn-white:hover { background: #f1f5f9; }
    .bg-info-subtle { background-color: #e0f2fe !important; color: #0369a1 !important; }
</style>

@endsection