<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TourGuide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    /**
     * Danh sách hướng dẫn viên
     */
    public function index()
    {
        // ❌ KHÔNG dùng latest() vì bảng không có created_at
        $guides = TourGuide::orderBy('id', 'desc')->paginate(10);

        return view('admin.guides.index', compact('guides'));
    }

    /**
     * Form thêm mới
     */
    public function create()
    {
        return view('admin.guides.create');
    }

    /**
     * Lưu hướng dẫn viên mới
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'required|email|unique:tour_guides,email',
            'experience' => 'required|integer|min:0',
            'status'     => 'required|in:available,busy,inactive',
        ]);

        TourGuide::create($data);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Thêm hướng dẫn viên thành công');
    }

    /**
     * Form chỉnh sửa
     */
    public function edit(TourGuide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    /**
     * Cập nhật hướng dẫn viên
     */
    public function update(Request $request, TourGuide $guide)
    {
        $data = $request->validate([
            'name'       => 'required|string|max:255',
            'phone'      => 'required|string|max:20',
            'email'      => 'required|email|unique:tour_guides,email,' . $guide->id,
            'experience' => 'required|integer|min:0',
            'status'     => 'required|in:available,busy,inactive',
        ]);

        $guide->update($data);

        return redirect()
            ->route('admin.guides.index')
            ->with('success', 'Cập nhật hướng dẫn viên thành công');
    }

    /**
     * Xoá hướng dẫn viên
     */
    public function destroy(TourGuide $guide)
    {
        // Nếu đang được phân công tour thì không cho xoá
        if ($guide->assignments()->exists()) {
            return back()->with('error', 'Không thể xoá hướng dẫn viên đang được phân công');
        }

        $guide->delete();

        return back()->with('success', 'Xoá hướng dẫn viên thành công');
    }
}
