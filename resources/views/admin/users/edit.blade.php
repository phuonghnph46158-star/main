@extends('layouts.admin')

@section('title', 'Cập nhật người dùng')

@section('content')

    {{-- HEADER --}}
    <div class="mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Cập nhật người dùng
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Chỉnh sửa thông tin tài khoản
        </p>
    </div>

    {{-- FORM --}}
    <div class="bg-white shadow rounded-lg p-6 max-w-2xl">
        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            {{-- TÊN --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Tên người dùng <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full px-4 py-2 border rounded-md
                           @error('name') border-red-500 @enderror"
                    required
                >
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- EMAIL --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Email <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full px-4 py-2 border rounded-md
                           @error('email') border-red-500 @enderror"
                    required
                >
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PHONE --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Số điện thoại
                </label>
                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="w-full px-4 py-2 border rounded-md
                           @error('phone') border-red-500 @enderror"
                >
                @error('phone')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ROLE --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Vai trò <span class="text-red-500">*</span>
                </label>
                <select
                    name="role"
                    class="w-full px-4 py-2 border rounded-md
                           @error('role') border-red-500 @enderror"
                    required
                >
                    <option value="user" {{ old('role', $user->role) === 'user' ? 'selected' : '' }}>
                        User
                    </option>
                    <option value="admin" {{ old('role', $user->role) === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>
                @error('role')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- STATUS --}}
            <div class="mb-5">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Trạng thái <span class="text-red-500">*</span>
                </label>
                <select
                    name="status"
                    class="w-full px-4 py-2 border rounded-md
                           @error('status') border-red-500 @enderror"
                    required
                >
                    <option value="active" {{ old('status', $user->status) === 'active' ? 'selected' : '' }}>
                        Hoạt động
                    </option>
                    <option value="blocked" {{ old('status', $user->status) === 'blocked' ? 'selected' : '' }}>
                        Bị khoá
                    </option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- PASSWORD --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Mật khẩu mới
                </label>
                <input
                    type="password"
                    name="password"
                    class="w-full px-4 py-2 border rounded-md
                           @error('password') border-red-500 @enderror"
                    placeholder="Để trống nếu không đổi"
                >
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- ACTION --}}
            <div class="flex items-center gap-3">
                <button
                    type="submit"
                    class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                >
                    <i class="fas fa-save mr-1"></i>
                    Cập nhật
                </button>

                <a href="{{ route('admin.users.index') }}"
                   class="px-5 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition">
                    Quay lại
                </a>
            </div>
        </form>
    </div>

@endsection
