@extends('layouts.admin')

@section('title', 'Thêm danh mục Tour')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Thêm danh mục tour
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Tạo mới danh mục để phân loại tour du lịch
        </p>
    </div>

    {{-- FORM --}}
    <div class="bg-white shadow rounded-lg p-6 max-w-xl">
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf

            {{-- TÊN DANH MỤC --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tên danh mục <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200
                           @error('name') border-red-500 @enderror"
                    placeholder="Ví dụ: Tour Châu Âu"
                    required
                >

                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- TRẠNG THÁI --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Trạng thái
                </label>

                <select
                    name="status"
                    class="w-full px-4 py-2 border rounded-md focus:ring focus:ring-blue-200"
                >
                    <option value="active" {{ old('status') === 'active' ? 'selected' : '' }}>
                        Hoạt động
                    </option>
                    <option value="blocked" {{ old('status') === 'blocked' ? 'selected' : '' }}>
                        Ngừng hoạt động
                    </option>
                </select>
            </div>

            {{-- ACTION --}}
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                >
                    <i class="fas fa-save mr-1"></i>
                    Lưu danh mục
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

@endsection
