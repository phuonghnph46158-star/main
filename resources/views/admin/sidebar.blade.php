<h5 class="text-primary mb-4">
    <i class="fa fa-user-cog me-2"></i> ADMIN
</h5>

<ul class="nav flex-column">

    {{-- DASHBOARD --}}
    <li class="nav-item">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-link nav-link-admin {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa fa-tachometer-alt me-2"></i> Dashboard
        </a>
    </li>

    {{-- DANH MỤC TOUR --}}
    <li class="nav-item">
        <a href="{{ route('admin.categories.index') }}"
           class="nav-link nav-link-admin {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
            <i class="fa fa-list me-2"></i> Danh mục tour
        </a>
    </li>

    {{-- TOUR --}}
    <li class="nav-item">
        <a href="{{ route('admin.tours.index') }}"
           class="nav-link nav-link-admin {{ request()->routeIs('admin.tours.*') ? 'active' : '' }}">
            <i class="fa fa-map-marker-alt me-2"></i> Quản lý tour
        </a>
    </li>

    {{-- HƯỚNG DẪN VIÊN --}}
    <li class="nav-item">
        <a href="{{ route('admin.guides.index') }}"
           class="nav-link nav-link-admin {{ request()->routeIs('admin.guides.*') ? 'active' : '' }}">
            <i class="fa fa-user-tie me-2"></i> Hướng dẫn viên
        </a>
    </li>

    {{-- ĐƠN ĐẶT TOUR (CHƯA CÓ ROUTE THÌ CÓ THỂ ẨN) --}}
    <li class="nav-item">
        <a href="#"
           class="nav-link nav-link-admin disabled">
            <i class="fa fa-clipboard-list me-2"></i> Đơn đặt tour
        </a>
    </li>

    {{-- NGƯỜI DÙNG --}}
    <li class="nav-item">
        <a href="{{ route('admin.users.index') }}"
           class="nav-link nav-link-admin {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fa fa-users me-2"></i> Người dùng
        </a>
    </li>

    {{-- LOGOUT --}}
    <li class="nav-item mt-3">
        <hr>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit"
                class="nav-link text-danger p-2 border-0 bg-transparent text-start w-100">
                <i class="fa fa-sign-out-alt me-2"></i> Đăng xuất
            </button>
        </form>
    </li>

</ul>
