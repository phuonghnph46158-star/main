<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB; 

class TourController extends Controller
{
    // ... (Các hàm index, create giữ nguyên)

    public function index()
{
    $tours = Tour::with('category')->latest()->paginate(10);

    return view('admin.tours.index', compact('tours'));
}

public function create()
{
    $categories = Category::all();

    return view('admin.tours.create', compact('categories'));
}

    /**
     * Xử lý tìm kiếm Tour cho khách hàng
     */
    public function clientSearch(Request $request)
    {
        $query = Tour::query()->where('status', 'active');

        // 1. Tìm theo từ khóa (Tên tour hoặc mô tả)
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function($q) use ($keyword) {
                $q->where('name', 'LIKE', "%{$keyword}%")
                  ->orWhere('description', 'LIKE', "%{$keyword}%");
            });
        }

        // 2. Lọc theo danh mục
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // 3. Lọc theo ngày khởi hành (Dựa trên quan hệ trips() trong Model Tour)
        if ($request->filled('departure_date')) {
            $date = $request->departure_date;
            $query->whereHas('trips', function($q) use ($date) {
                $q->whereDate('start_date', '>=', $date);
            });
        }

        // Lấy kèm ảnh chính và phân trang
        $tours = $query->with(['images' => function($q) {
            $q->where('is_main', 1);
        }, 'category'])->latest()->paginate(9);

        // SỬA LỖI: Thêm chữ 's' vào 'clients' để khớp với thư mục resources/views/clients
        return view('clients.search_results', compact('tours'));
    }

    /**
     * Lưu tour mới vào database
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:tour_categories,id',
            'price' => 'required|numeric',
            'duration' => 'required',
            'max_people' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Sử dụng Transaction để đảm bảo tính toàn vẹn giữa bảng tours và tour_images
        DB::transaction(function () use ($request) {
            $tour = Tour::create([
                'category_id' => $request->category_id,
                'name' => $request->name, 
                'slug' => Str::slug($request->name),
                'price' => $request->price,
                'child_price' => $request->child_price,
                'duration' => $request->duration,
                'max_people' => $request->max_people,
                'description' => $request->description,
                'status' => $request->status ?? 'active'
            ]);

            // Lưu đường dẫn ảnh vào bảng tour_images (Bảng tours không có cột image)
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('tours', 'public');
                $tour->images()->create([
                    'image' => $path,
                    'is_main' => 1 
                ]);
            }
        });

        return redirect()->route('tours.index')->with('success', 'Thêm tour thành công');
    }

    public function show($id)
{
    // Tìm tour theo ID, nếu không thấy sẽ trả về lỗi 404
    $tour = \App\Models\Tour::findOrFail($id);

    // Trả về view chi tiết và truyền biến $tour sang
    return view('clients.tours.show', compact('tour'));
}

public function destroy($id)
{
    $tour = Tour::findOrFail($id);

    // Xóa booking liên quan trước
    $tour->bookings()->delete();

    // Xóa ảnh nếu có
    $tour->images()->delete();

    $tour->delete();

    return redirect()->route('tours.index')
                     ->with('success', 'Xóa tour thành công');
}
}