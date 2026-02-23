<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') - TravelGo</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
</head>

<body class="bg-gray-100">

<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-slate-800 text-white flex-shrink-0">

        <!-- LOGO -->
        <div class="p-6 border-b border-slate-700">
            <a href="{{ route('admin.dashboard') }}"
               class="text-2xl font-bold text-blue-400">
                TRAVEL<span class="text-white">GO</span>
            </a>
            <p class="text-xs text-gray-400 mt-1 uppercase tracking-widest">
                Administrator
            </p>
        </div>

        <!-- MENU -->
        <nav class="mt-4 text-sm font-medium">

            {{-- DASHBOARD --}}
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center px-6 py-3 hover:bg-slate-700 transition
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 border-l-4 border-blue-400' : '' }}">
                <i class="fas fa-tachometer-alt w-6"></i>
                Dashboard
            </a>

            {{-- DANH MỤC TOUR --}}
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center px-6 py-3 hover:bg-slate-700 transition
               {{ request()->routeIs('admin.categories.*') ? 'bg-blue-600 border-l-4 border-blue-400' : '' }}">
                <i class="fas fa-list w-6"></i>
                Danh mục tour
            </a>

            {{-- TOUR --}}
            <a href="{{ route('admin.tours.index') }}"
               class="flex items-center px-6 py-3 hover:bg-slate-700 transition
               {{ request()->routeIs('admin.tours.*') ? 'bg-blue-600 border-l-4 border-blue-400' : '' }}">
                <i class="fas fa-map-marked-alt w-6"></i>
                Quản lý tour
            </a>

            {{-- HƯỚNG DẪN VIÊN --}}
            <a href="{{ route('admin.guides.index') }}"
               class="flex items-center px-6 py-3 hover:bg-slate-700 transition
               {{ request()->routeIs('admin.guides.*') ? 'bg-blue-600 border-l-4 border-blue-400' : '' }}">
                <i class="fas fa-user-tie w-6"></i>
                Hướng dẫn viên
            </a>

            {{-- NGƯỜI DÙNG --}}
            <a href="{{ route('admin.users.index') }}"
               class="flex items-center px-6 py-3 hover:bg-slate-700 transition
               {{ request()->routeIs('admin.users.*') ? 'bg-blue-600 border-l-4 border-blue-400' : '' }}">
                <i class="fas fa-users w-6"></i>
                Người dùng
            </a>

            {{-- LOGOUT --}}
            <div class="border-t border-slate-700 mt-4 pt-4">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full flex items-center px-6 py-3 text-red-400 hover:bg-red-500 hover:text-white transition">
                        <i class="fas fa-sign-out-alt w-6"></i>
                        Đăng xuất
                    </button>
                </form>
            </div>

        </nav>
    </aside>

    <!-- MAIN -->
    <main class="flex-1">

        <!-- HEADER -->
        <header class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
            <h2 class="text-xl font-semibold text-gray-800">
                @yield('title')
            </h2>

            <div class="flex items-center gap-4">
                <span class="text-sm text-gray-600">
                    Chào,
                    <strong>{{ auth()->user()->name ?? 'Admin' }}</strong>
                </span>
                <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}"
                    class="w-9 h-9 rounded-full"
                    alt="avatar">
            </div>
        </header>

        <!-- CONTENT -->
        <div class="p-8">
            @yield('content')
        </div>

    </main>

</div>

</body>
</html>
