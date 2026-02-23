@extends('layouts.admin')

@section('title', 'Danh sách Tour')

@section('content')

    {{-- FLASH MESSAGE --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-md">
            {{ session('success') }}
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Quản lý Tour
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Danh sách các tour du lịch trong hệ thống
            </p>
        </div>

        <a href="{{ route('admin.tours.create') }}"
           class="px-5 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-1"></i>
            Thêm tour
        </a>
    </div>

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm">
            <thead class="bg-gray-100 text-gray-700 uppercase text-xs">
                <tr>
                    <th class="px-4 py-3 text-left">#</th>
                    <th class="px-4 py-3 text-left">Ảnh</th>
                    <th class="px-6 py-3 text-left">Tên tour</th>
                    <th class="px-6 py-3 text-left">Danh mục</th>
                    <th class="px-6 py-3 text-right">Giá</th>
                    <th class="px-6 py-3 text-right">Giá trẻ em</th>
                    <th class="px-6 py-3 text-center">Số người</th>
                    <th class="px-6 py-3 text-center">Thời gian</th>
                    <th class="px-6 py-3 text-center">Trạng thái</th>
                    <th class="px-6 py-3 text-center w-44">Hành động</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($tours as $tour)
                    <tr class="hover:bg-gray-50">
                        {{-- ID --}}
                        <td class="px-4 py-4 font-medium">
                            #{{ $tour->id }}
                        </td>

                        {{-- ẢNH TOUR --}}
                        <td class="px-4 py-4">
                            @if($tour->mainImage)
                                <img
                                    src="{{ asset('storage/' . $tour->mainImage->image) }}"
                                    class="w-20 h-14 object-cover rounded border"
                                    alt="{{ $tour->name }}">
                            @else
                                <div class="w-20 h-14 flex items-center justify-center bg-gray-100 text-gray-400 rounded text-xs">
                                    No image
                                </div>
                            @endif
                        </td>

                        {{-- TÊN TOUR --}}
                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $tour->name }}
                        </td>

                        {{-- DANH MỤC --}}
                        <td class="px-6 py-4">
                            {{ $tour->category->name ?? '—' }}
                        </td>

                        {{-- GIÁ --}}
                        <td class="px-6 py-4 text-right text-blue-600 font-medium">
                            {{ number_format($tour->price) }} đ
                        </td>

                        {{-- GIÁ TRẺ EM --}}
                        <td class="px-6 py-4 text-right">
                            {{ $tour->child_price ? number_format($tour->child_price).' đ' : '—' }}
                        </td>

                        {{-- SỐ NGƯỜI --}}
                        <td class="px-6 py-4 text-center">
                            {{ $tour->max_people }}
                        </td>

                        {{-- THỜI GIAN --}}
                        <td class="px-6 py-4 text-center">
                            {{ $tour->duration }}
                        </td>

                        {{-- TRẠNG THÁI --}}
                        <td class="px-6 py-4 text-center">
                            @if($tour->status === 'active')
                                <span class="px-2 py-1 text-xs rounded bg-green-100 text-green-700">
                                    Hoạt động
                                </span>
                            @else
                                <span class="px-2 py-1 text-xs rounded bg-red-100 text-red-700">
                                    Ngừng
                                </span>
                            @endif
                        </td>

                        {{-- HÀNH ĐỘNG --}}
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.tours.edit', $tour) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 text-xs mr-1">
                                <i class="fas fa-edit mr-1"></i> Sửa
                            </a>

                            <form action="{{ route('admin.tours.destroy', $tour) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa tour này?')">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                                    <i class="fas fa-trash mr-1"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-6 py-8 text-center text-gray-500">
                            Chưa có tour nào được tạo
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
