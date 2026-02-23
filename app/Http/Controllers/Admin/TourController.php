<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TourController extends Controller
{
    /**
     * Danh sách tour
     */
    public function index()
    {
        // ❌ Không dùng latest() nếu bảng không có created_at
        $tours = Tour::with(['category', 'mainImage'])
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.tours.index', compact('tours'));
    }

    /**
     * Form tạo tour
     */
    public function create()
    {
        $categories = TourCategory::orderBy('name')->get();

        return view('admin.tours.create', compact('categories'));
    }

    /**
     * Lưu tour mới + ảnh
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:tour_categories,id',
            'price'        => 'required|numeric|min:0',
            'child_price'  => 'nullable|numeric|min:0',
            'max_people'   => 'required|integer|min:1',
            'duration'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'nullable|in:active,inactive',

            // ảnh
            'images.*'     => 'nullable|image|max:2048',
        ]);

        $tour = Tour::create([
            'name'         => $data['title'],
            'slug'         => Str::slug($data['title']),
            'category_id'  => $data['category_id'],
            'price'        => $data['price'],
            'child_price'  => $data['child_price'] ?? null,
            'max_people'   => $data['max_people'],
            'duration'     => $data['duration'],
            'description'  => $data['description'] ?? null,
            'status'       => $data['status'] ?? 'active',
        ]);

        /* ===== LƯU ẢNH ===== */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('tours', 'public');

                TourImage::create([
                    'tour_id' => $tour->id,
                    'image'   => $path,
                    'is_main' => $index === 0 ? 1 : 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Thêm tour thành công');
    }

    /**
     * Form sửa tour
     */
    public function edit(Tour $tour)
    {
        $categories = TourCategory::orderBy('name')->get();

        // load ảnh
        $tour->load('images');

        return view('admin.tours.edit', compact('tour', 'categories'));
    }

    /**
     * Cập nhật tour + thêm ảnh mới
     */
    public function update(Request $request, Tour $tour)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'category_id'  => 'required|exists:tour_categories,id',
            'price'        => 'required|numeric|min:0',
            'child_price'  => 'nullable|numeric|min:0',
            'max_people'   => 'required|integer|min:1',
            'duration'     => 'required|string|max:255',
            'description'  => 'nullable|string',
            'status'       => 'nullable|in:active,inactive',

            // ảnh mới
            'images.*'     => 'nullable|image|max:2048',
        ]);

        $tour->update([
            'name'         => $data['title'],
            'slug'         => Str::slug($data['title']),
            'category_id'  => $data['category_id'],
            'price'        => $data['price'],
            'child_price'  => $data['child_price'] ?? null,
            'max_people'   => $data['max_people'],
            'duration'     => $data['duration'],
            'description'  => $data['description'] ?? null,
            'status'       => $data['status'] ?? $tour->status,
        ]);

        /* ===== THÊM ẢNH MỚI ===== */
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('tours', 'public');

                TourImage::create([
                    'tour_id' => $tour->id,
                    'image'   => $path,
                    'is_main' => 0,
                ]);
            }
        }

        return redirect()
            ->route('admin.tours.edit', $tour)
            ->with('success', 'Cập nhật tour thành công');
    }

    /**
     * Xoá ảnh tour (AJAX hoặc form)
     */
    public function deleteImage(TourImage $image)
    {
        // xoá file
        if (Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'Đã xoá ảnh');
    }

    /**
     * Xóa tour + toàn bộ ảnh
     */
    public function destroy(Tour $tour)
    {
        foreach ($tour->images as $img) {
            if (Storage::disk('public')->exists($img->image)) {
                Storage::disk('public')->delete($img->image);
            }
        }

        $tour->images()->delete();
        $tour->delete();

        return redirect()
            ->route('admin.tours.index')
            ->with('success', 'Xóa tour thành công');
    }
}
