@extends('layouts.admin')

@section('title', 'Quản lý người dùng')

@section('content')

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-xl font-semibold text-gray-800">
                Quản lý người dùng
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Danh sách tài khoản trong hệ thống
            </p>
        </div>
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
                    <th class="px-6 py-3 text-left">Email</th>
                    <th class="px-6 py-3 text-center">Vai trò</th>
                    <th class="px-6 py-3 text-center">Trạng thái</th>
                    <th class="px-6 py-3 text-center w-40">Hành động</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($users as $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">
                            #{{ $user->id }}
                        </td>

                        <td class="px-6 py-4 font-semibold text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $user->role === 'admin'
                                    ? 'bg-blue-100 text-blue-700'
                                    : 'bg-gray-100 text-gray-700' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <span class="px-2 py-1 rounded text-xs
                                {{ $user->status === 'active'
                                    ? 'bg-green-100 text-green-700'
                                    : 'bg-red-100 text-red-700' }}">
                                {{ $user->status === 'active' ? 'Hoạt động' : 'Bị khoá' }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-yellow-400 text-white rounded-md hover:bg-yellow-500 text-xs mr-1">
                                <i class="fas fa-edit mr-1"></i> Sửa
                            </a>

                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xoá người dùng này?')">
                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="inline-flex items-center px-3 py-1.5 bg-red-500 text-white rounded-md hover:bg-red-600 text-xs">
                                    <i class="fas fa-trash mr-1"></i> Xoá
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Chưa có người dùng nào
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
