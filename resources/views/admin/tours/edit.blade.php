@extends('layouts.admin')

@section('title', 'Cập nhật Tour')

@section('content')

{{-- HEADER --}}
<div class="mb-6">
    <h1 class="text-xl font-semibold text-gray-800">
        Cập nhật tour
    </h1>
    <p class="text-sm text-gray-500 mt-1">
        Chỉnh sửa thông tin & hình ảnh tour du lịch
    </p>
</div>

<div class="bg-white shadow rounded-lg p-6 max-w-4xl">

    {{-- ===== HIỂN THỊ LỖI VALIDATION ===== --}}
    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    {{-- ===== END ERROR ===== --}}

    <form action="{{ route('admin.tours.update', $tour) }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- TÊN TOUR --}}
        <div class="mb-5">
            <label class="block text-sm font-medium mb-1">
                Tên tour <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="title"
                   value="{{ old('title', $tour->name) }}"
                   class="w-full px-4 py-2 border rounded @error('title') border-red-500 @enderror"
                   required>
        </div>

        {{-- DANH MỤC --}}
        <div class="mb-5">
            <label class="block text-sm font-medium mb-1">
                Danh mục <span class="text-red-500">*</span>
            </label>
            <select name="category_id"
                    class="w-full px-4 py-2 border rounded"
                    required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $tour->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- GIÁ --}}
        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block text-sm font-medium mb-1">Giá tour *</label>
                <input type="number"
                       name="price"
                       value="{{ old('price', $tour->price) }}"
                       class="w-full px-4 py-2 border rounded"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Giá trẻ em</label>
                <input type="number"
                       name="child_price"
                       value="{{ old('child_price', $tour->child_price) }}"
                       class="w-full px-4 py-2 border rounded">
            </div>
        </div>

        {{-- SỐ NGƯỜI + THỜI GIAN --}}
        <div class="grid grid-cols-2 gap-4 mb-5">
            <div>
                <label class="block text-sm font-medium mb-1">Số người tối đa *</label>
                <input type="number"
                       name="max_people"
                       value="{{ old('max_people', $tour->max_people) }}"
                       class="w-full px-4 py-2 border rounded"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Thời gian *</label>
                <input type="text"
                       name="duration"
                       value="{{ old('duration', $tour->duration) }}"
                       class="w-full px-4 py-2 border rounded"
                       required>
            </div>
        </div>

        {{-- TRẠNG THÁI --}}
        <div class="mb-5">
            <label class="block text-sm font-medium mb-1">Trạng thái</label>
            <select name="status" class="w-full px-4 py-2 border rounded">
                <option value="active" {{ old('status', $tour->status) === 'active' ? 'selected' : '' }}>
                    Hoạt động
                </option>
                <option value="inactive" {{ old('status', $tour->status) === 'inactive' ? 'selected' : '' }}>
                    Ngừng
                </option>
            </select>
        </div>

        {{-- MÔ TẢ --}}
        <div class="mb-6">
            <label class="block text-sm font-medium mb-1">Mô tả</label>
            <textarea name="description"
                      rows="4"
                      class="w-full px-4 py-2 border rounded">{{ old('description', $tour->description) }}</textarea>
        </div>

        {{-- ================= ẢNH TOUR ================= --}}
        <div class="mb-8">
            <h3 class="font-semibold mb-3">Ảnh tour</h3>

            {{-- ẢNH HIỆN TẠI --}}
            <div class="grid grid-cols-4 gap-4 mb-4">
                @forelse($tour->images as $image)
                    <div class="relative">
                        <img src="{{ asset('storage/' . $image->image) }}"
                             class="w-full h-32 object-cover rounded border
                             {{ $image->is_main ? 'ring-2 ring-green-500' : '' }}">

                        @if($image->is_main)
                            <span class="absolute top-1 left-1 text-xs bg-green-600 text-white px-2 py-0.5 rounded">
                                Ảnh chính
                            </span>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500 col-span-4">Chưa có ảnh</p>
                @endforelse
            </div>

            {{-- UPLOAD ẢNH MỚI --}}
            <div>
                <label class="block text-sm font-medium mb-1">Thêm ảnh mới</label>
                <input type="file"
                       name="images[]"
                       multiple
                       accept="image/*"
                       class="block w-full text-sm">
            </div>
        </div>

        {{-- ACTION --}}
        <div class="flex gap-3">
            <button type="submit" class="px-5 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Cập nhật
            </button>

            <a href="{{ route('admin.tours.index') }}"
               class="px-5 py-2 bg-gray-200 rounded hover:bg-gray-300">
                Quay lại
            </a>
        </div>

    </form>
</div>

@endsection
