<h1>{{ $tour->name }}</h1>
<img src="{{ $tour->image }}" alt="{{ $tour->name }}">
<p><strong>Giá:</strong> {{ number_format($tour->price) }}đ</p>
<div class="description">
    {!! $tour->description !!} </div>

<a href="{{ route('booking.create', $tour->id) }}" class="btn btn-primary">
    Đặt Tour Ngay
</a>