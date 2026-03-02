@extends('admin.layout')

@section('content_title', 'Thêm tour mới')

@section('content')
{{-- Hiển thị lỗi nếu có để bạn biết sai ở đâu --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('tours.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mb-3">
        <label class="form-label">Tên tour</label>
        {{-- Đã đổi từ title sang name để khớp với Migration --}}
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Danh mục</label>
        <select name="category_id" class="form-control" required>
            <option value="">-- Chọn danh mục --</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label">Giá người lớn</label>
            <input type="number" name="price" class="form-control" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label">Số người tối đa</label>
            {{-- Bắt buộc phải có vì Migration yêu cầu --}}
            <input type="number" name="max_people" class="form-control" required>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">Thời gian</label>
        <input type="text" name="duration" class="form-control" placeholder="VD: 3 ngày 2 đêm" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh đại diện</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <div class="mt-4">
        <button type="submit" class="btn btn-success px-4">Lưu tour</button>
        <a href="{{ route('tours.index') }}" class="btn btn-secondary px-4">Quay lại</a>
    </div>
</form>
@endsection