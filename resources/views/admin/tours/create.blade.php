@extends('layouts.admin')

@section('title', 'Thêm Tour')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Thêm tour mới
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Nhập thông tin tour du lịch
        </p>
    </div>

    {{-- HIỂN THỊ LỖI --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-700 rounded-md">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORM --}}
    <div class="bg-white shadow rounded-lg p-6 max-w-4xl">
        <form action="{{ route('admin.tours.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            {{-- TÊN TOUR --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tên tour <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title"
                       value="{{ old('title') }}"
                       class="w-full px-4 py-2 border rounded-md @error('title') border-red-500 @enderror"
                       required>
            </div>

            {{-- DANH MỤC --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Danh mục <span class="text-red-500">*</span>
                </label>
                <select name="category_id"
                        class="w-full px-4 py-2 border rounded-md @error('category_id') border-red-500 @enderror"
                        required>
                    <option value="">— Chọn danh mục —</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- GIÁ --}}
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Giá tour (VNĐ) *
                    </label>
                    <input type="number"
                           name="price"
                           value="{{ old('price') }}"
                           min="0"
                           class="w-full px-4 py-2 border rounded-md"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Giá trẻ em
                    </label>
                    <input type="number"
                           name="child_price"
                           value="{{ old('child_price') }}"
                           min="0"
                           class="w-full px-4 py-2 border rounded-md">
                </div>
            </div>

            {{-- SỐ NGƯỜI + THỜI GIAN --}}
            <div class="grid grid-cols-2 gap-4 mb-5">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Số người tối đa *
                    </label>
                    <input type="number"
                           name="max_people"
                           value="{{ old('max_people') }}"
                           min="1"
                           class="w-full px-4 py-2 border rounded-md"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Thời gian *
                    </label>
                    <input type="text"
                           name="duration"
                           value="{{ old('duration') }}"
                           class="w-full px-4 py-2 border rounded-md"
                           required>
                </div>
            </div>

            {{-- TRẠNG THÁI --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Trạng thái
                </label>
                <select name="status"
                        class="w-full px-4 py-2 border rounded-md">
                    <option value="active" selected>Hoạt động</option>
                    <option value="inactive">Ngừng hoạt động</option>
                </select>
            </div>

            {{-- MÔ TẢ --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Mô tả tour
                </label>
                <textarea name="description"
                          rows="4"
                          class="w-full px-4 py-2 border rounded-md">{{ old('description') }}</textarea>
            </div>

            {{-- ẢNH TOUR --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Ảnh tour
                </label>

                <input type="file"
                       name="images[]"
                       multiple
                       accept="image/*"
                       class="block w-full text-sm text-gray-600">

                <p class="text-xs text-gray-500 mt-1">
                    Có thể chọn nhiều ảnh (jpg, png). Ảnh đầu tiên sẽ là ảnh đại diện.
                </p>
            </div>

            {{-- ACTION --}}
            <div class="flex items-center gap-3">
                <button type="submit"
                        class="px-5 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                    <i class="fas fa-save mr-1"></i>
                    Lưu tour
                </button>

                <a href="{{ route('admin.tours.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300">
                    Quay lại
                </a>
            </div>

        </form>
    </div>

@endsection
