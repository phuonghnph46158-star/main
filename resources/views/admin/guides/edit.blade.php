@extends('layouts.admin')

@section('title', 'Cập nhật hướng dẫn viên')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Cập nhật hướng dẫn viên
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Chỉnh sửa thông tin hướng dẫn viên
        </p>
    </div>

    {{-- FORM --}}
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl">
        <form action="{{ route('admin.guides.update', $guide) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- NAME --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tên hướng dẫn viên
                </label>
                <input type="text"
                       name="name"
                       value="{{ old('name', $guide->name) }}"
                       class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PHONE --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Điện thoại
                </label>
                <input type="text"
                       name="phone"
                       value="{{ old('phone', $guide->phone) }}"
                       class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email
                </label>
                <input type="email"
                       name="email"
                       value="{{ old('email', $guide->email) }}"
                       class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EXPERIENCE --}}
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kinh nghiệm (năm)
                </label>
                <input type="number"
                       name="experience"
                       min="0"
                       value="{{ old('experience', $guide->experience) }}"
                       class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                       required>
                @error('experience')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUS --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Trạng thái
                </label>
                <select name="status"
                        class="w-full border rounded-md px-3 py-2 focus:ring focus:ring-blue-200"
                        required>
                    <option value="available"
                        {{ old('status', $guide->status) === 'available' ? 'selected' : '' }}>
                        Sẵn sàng
                    </option>
                    <option value="busy"
                        {{ old('status', $guide->status) === 'busy' ? 'selected' : '' }}>
                        Đang bận
                    </option>
                    <option value="inactive"
                        {{ old('status', $guide->status) === 'inactive' ? 'selected' : '' }}>
                        Ngừng hoạt động
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTION --}}
            <div class="flex gap-3">
                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                    <i class="fas fa-save mr-1"></i>
                    Cập nhật
                </button>

                <a href="{{ route('admin.guides.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

@endsection
