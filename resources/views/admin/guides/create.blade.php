@extends('layouts.admin')

@section('title', 'Thêm hướng dẫn viên')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Thêm hướng dẫn viên
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Nhập thông tin hướng dẫn viên mới
        </p>
    </div>

    {{-- FORM --}}
    <form action="{{ route('admin.guides.store') }}" method="POST"
          class="bg-white shadow rounded-lg p-6 max-w-2xl">
        @csrf

        {{-- NAME --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Tên hướng dẫn viên <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="name"
                   value="{{ old('name') }}"
                   class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('name')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- PHONE --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Điện thoại <span class="text-red-500">*</span>
            </label>
            <input type="text"
                   name="phone"
                   value="{{ old('phone') }}"
                   class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('phone')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Email <span class="text-red-500">*</span>
            </label>
            <input type="email"
                   name="email"
                   value="{{ old('email') }}"
                   class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('email')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- EXPERIENCE --}}
        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Kinh nghiệm (năm) <span class="text-red-500">*</span>
            </label>
            <input type="number"
                   name="experience"
                   value="{{ old('experience', 0) }}"
                   min="0"
                   class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('experience')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- STATUS --}}
        <div class="mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Trạng thái <span class="text-red-500">*</span>
            </label>
            <select name="status"
                    class="w-full rounded-md border-gray-300 focus:border-blue-500 focus:ring-blue-500"
                    required>
                <option value="">-- Chọn trạng thái --</option>
                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>
                    Sẵn sàng
                </option>
                <option value="busy" {{ old('status') == 'busy' ? 'selected' : '' }}>
                    Đang bận
                </option>
                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                    Ngừng hoạt động
                </option>
            </select>
            @error('status')
                <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- ACTIONS --}}
        <div class="flex items-center gap-3">
            <button type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                <i class="fas fa-save mr-1"></i>
                Lưu
            </button>

            <a href="{{ route('admin.guides.index') }}"
               class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                Quay lại
            </a>
        </div>

    </form>

@endsection
