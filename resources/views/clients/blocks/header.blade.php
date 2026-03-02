<header class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b">
    <div class="max-w-7xl mx-auto px-4 h-20 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold text-blue-600">TRAVEL<span class="text-orange-500">GO</span></a>
        
        <nav class="hidden md:flex space-x-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-blue-600 transition">Trang chủ</a>
            <a href="/destinations" class="hover:text-blue-600 transition">Điểm đến</a>
            <a href="/services" class="hover:text-blue-600 transition">Dịch vụ</a>
            <a href="/about" class="hover:text-blue-600 transition">Giới thiệu</a>
            <a href="/contact" class="hover:text-blue-600 transition">Liên hệ</a> 
        </nav>

        <div class="flex items-center gap-2">


            <a href="{{ route('admin.login') }}" class="px-5 py-2 rounded-full border border-blue-600 text-blue-600 hover:bg-blue-50 font-semibold transition">
                Đăng nhập
            </a>
            
            <a href="/register" class="px-5 py-2 rounded-full bg-blue-600 text-white hover:bg-blue-700 font-semibold shadow-md transition">
                Đăng ký
            </a>
        </div>
    </div>
</header>