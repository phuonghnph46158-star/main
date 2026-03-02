@extends('layouts.client')

@section('title', 'Trang chủ - TravelGo')

@section('banner')
    @include('clients.blocks.banner')
@endsection

@section('content')
<section class="max-w-7xl mx-auto px-4 py-16">
    <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6">
        <div class="w-full md:w-1/3 text-center md:text-left">
            <h2 class="text-3xl font-bold text-slate-800 uppercase tracking-wider">Tour nổi bật nhất</h2>
            <div class="h-1 w-20 bg-orange-500 mt-2 mx-auto md:mx-0"></div>
        </div>

        <div class="w-full md:w-2/3 flex justify-end">
            <form action="{{ route('client.search') }}" method="GET" class="flex w-full max-w-xl bg-white rounded-2xl shadow-lg border border-slate-100 overflow-hidden">
                <div class="flex-1 flex items-center px-6 py-2">
                    <i class="fas fa-search text-blue-500 mr-3"></i>
                    <input type="text" name="keyword" placeholder="Bạn muốn đi đâu?" 
                           class="w-full border-none focus:ring-0 text-slate-600 font-medium bg-transparent">
                </div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 font-bold transition-all duration-300">
                    TÌM
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
        @forelse($tours as $tour)
            <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-slate-50">
                {{-- PHẦN HÌNH ẢNH --}}
                <div class="relative overflow-hidden aspect-[4/3] bg-slate-200">
                    @php 
                        $mainImage = $tour->images->where('is_main', 1)->first() ?? $tour->images->first(); 
                        $displayImage = ($mainImage && $mainImage->image) 
                            ? asset('storage/' . $mainImage->image) 
                            : 'https://images.unsplash.com/photo-1503220317375-aaad61436b1b?q=80&w=800';
                    @endphp
                    
                    <img src="{{ $displayImage }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" 
                         onerror="this.src='https://images.unsplash.com/photo-1469474968028-56623f02e42e?q=80&w=800'"
                         alt="{{ $tour->name }}">
                    
                    <div class="absolute top-5 left-5 bg-white/90 backdrop-blur-sm text-blue-600 px-4 py-1 rounded-full text-xs font-black shadow-sm">
                         {{ $tour->duration ?? '2 ngày 1 đêm' }}
                    </div>
                </div>

                {{-- NỘI DUNG TOUR --}}
                <div class="p-8">
                    {{-- CHỖ NÀY ĐÃ FIX ĐỂ HIỂN THỊ ĐỊA DANH KHÁC NHAU --}}
                    <div class="flex items-center gap-2 text-orange-500 text-xs font-bold uppercase mb-3">
                        <i class="fas fa-map-marker-alt"></i> 
                        {{-- Nếu có danh mục (ví dụ Du lịch Đà Lạt) thì hiện, không thì hiện 'Du lịch Việt Nam' --}}
                        {{ $tour->category->name ?? 'Du lịch Việt Nam' }}
                    </div>
                    
                    <h3 class="text-xl font-extrabold text-slate-800 mb-4 group-hover:text-blue-600 transition-colors line-clamp-2 min-h-[3.5rem]">
                        <a href="{{ route('booking.form', ['id' => $tour->id]) }}">{{ $tour->name }}</a>
                    </h3>
                    
                    <div class="flex justify-between items-center pt-6 border-t border-slate-50">
                        <div>
                            <span class="text-slate-400 text-xs block mb-1">Giá từ</span>
                            <p class="text-2xl font-black text-blue-600">{{ number_format($tour->price, 0, ',', '.') }}<span class="text-sm ml-0.5">đ</span></p>
                        </div>
                        <a href="{{ route('booking.form', ['id' => $tour->id]) }}" class="bg-slate-900 text-white w-12 h-12 rounded-2xl flex items-center justify-center hover:bg-blue-600 transition-all duration-300 shadow-lg shadow-slate-200">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-24 bg-slate-50 rounded-[3rem] border-4 border-dashed border-slate-200">
                <p class="text-slate-400 text-xl font-medium italic">Hệ thống đang cập nhật danh sách tour...</p>
            </div>
        @endforelse
    </div>
</section>
@endsection