@extends('layouts.admin')

@section('title', 'Danh sách hướng dẫn viên')

@section('content')

{{-- HEADER --}}
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-xl font-semibold text-gray-800">
            Quản lý hướng dẫn viên
        </h1>
        <p class="text-sm text-gray-500 mt-1">
            Danh sách các hướng dẫn viên trong hệ thống
        </p>
    </div>

    <a href="{{ route('admin.guides.create') }}"
       class="inline-flex items-center px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
        <i class="fas fa-plus mr-2"></i>
        Thêm hướng dẫn viên
    </a>
</div>

{{-- FLASH MESSAGE --}}
@if(session('success'))
    <div class="mb-4 px-4 py-3 bg-green-100 text-green-700 rounded">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-4 px-4 py-3 bg-red-100 text-red-700 rounded">
        {{ session('error') }}
    </div>
@endif

{{-- TABLE --}}
<div class="bg-white shadow rounded-lg overflow-hidden">
    <table class="min-w-full text-sm">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
            <tr>
                <th class="px-6 py-3 text-left">#</th>
                <th class="px-6 py-3 text-left">Tên</th>
                <th class="px-6 py-3 text-left">Điện thoại</th>
                <th class="px-6 py-3 text-left">Email</th>
                <th class="px-6 py-3 text-center">Kinh nghiệm</th>
                <th class="px-6 py-3 text-center">Trạng thái</th>
                <th class="px-6 py-3 text-center w-40">Hành động</th>
            </tr>
        </thead>

        <tbody class="divide-y">
        @forelse($guides as $guide)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-4 font-medium">
                    {{ $guide->id }}
                </td>

                <td class="px-6 py-4 font-semibold text-gray-800">
                    {{ $guide->name }}
                </td>

                <td class="px-6 py-4">
                    {{ $guide->phone }}
                </td>

                <td class="px-6 py-4">
                    {{ $guide->email }}
                </td>

                <td class="px-6 py-4 text-center">
                    {{ $guide->experience }} năm
                </td>

                {{-- STATUS --}}
                <td class="px-6 py-4 text-center">
                    @if($guide->status === 'available')
                        <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                            Sẵn sàng
                        </span>
                    @elseif($guide->status === 'busy')
                        <span class="px-2 py-1 text-xs rounded bg-yellow-100 text-yellow-700">
                            Đang bận
                        </span>
                    @elseif($guide->status === 'inactive')
                        <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                            Ngừng hoạt động
                        </span>
                    @else
                        <span class="px-2 py-1 text-xs rounded bg-gray-100 text-gray-600">
                            Không xác định
                        </span>
                    @endif
                </td>

                {{-- ACTION --}}
                <td class="px-6 py-4 text-center">
                    <a href="{{ route('admin.guides.edit', $guide) }}"
                       class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 text-xs mr-1">
                        <i class="fas fa-edit mr-1"></i>
                        Sửa
                    </a>

                    <form action="{{ route('admin.guides.destroy', $guide) }}"
                          method="POST"
                          class="inline-block"
                          onsubmit="return confirm('Bạn có chắc chắn muốn xoá hướng dẫn viên này?')">
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                            <i class="fas fa-trash mr-1"></i>
                            Xoá
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="px-6 py-8 text-center text-gray-500">
                    Chưa có hướng dẫn viên nào
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

{{-- PAGINATION --}}
<div class="mt-6">
    {{ $guides->links('pagination::tailwind') }}
</div>

@endsection
