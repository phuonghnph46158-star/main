@extends('layouts.admin')

@section('title', 'Quản lý Danh mục Tour')

@section('content')

    {{-- HEADER --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-xl font-semibold text-gray-800">
            Danh sách danh mục
        </h1>

        <a href="{{ route('admin.categories.create') }}"
           class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
            <i class="fas fa-plus mr-2"></i>
            Thêm danh mục
        </a>
    </div>

    {{-- THÔNG BÁO --}}
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- TABLE --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-6 py-3">ID</th>
                <th class="px-6 py-3">Tên danh mục</th>
                <th class="px-6 py-3">Slug</th>
                <th class="px-6 py-3 text-center">Trạng thái</th>
                <th class="px-6 py-3 text-right">Hành động</th>
            </tr>
            </thead>

            <tbody class="divide-y">
            @forelse($categories as $category)
                <tr class="hover:bg-gray-50">
                    <td class="px-6 py-3">#{{ $category->id }}</td>

                    <td class="px-6 py-3 font-medium text-gray-800">
                        {{ $category->name }}
                    </td>

                    <td class="px-6 py-3">
                        <span class="px-2 py-1 text-xs bg-gray-100 rounded">
                            /{{ $category->slug }}
                        </span>
                    </td>

                    <td class="px-6 py-3 text-center">
                        @if($category->status === 'active')
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Hoạt động
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Ngừng
                            </span>
                        @endif
                    </td>

                    <td class="px-6 py-3 text-right space-x-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}"
                           class="inline-flex items-center px-3 py-1 text-sm text-yellow-600 hover:text-yellow-800">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.categories.destroy', $category->id) }}"
                              method="POST"
                              class="inline-block"
                              onsubmit="return confirm('Bạn có chắc muốn xoá danh mục này?')">
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center px-3 py-1 text-sm text-red-600 hover:text-red-800">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-6 text-center text-gray-500">
                        Chưa có danh mục nào
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

@endsection
