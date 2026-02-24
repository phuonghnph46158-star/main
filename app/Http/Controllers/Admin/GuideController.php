<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Guide;
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        // SỬA TẠI ĐÂY: Thay latest() bằng orderBy('id', 'desc')
        $guides = Guide::orderBy('id', 'desc')->paginate(10);
        return view('admin.guides.index', compact('guides'));
    }

    public function create()
    {
        return view('admin.guides.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:tour_guides,email', // Sửa email thành bắt buộc theo SQL
            'experience' => 'required|integer|min:0',
            'status' => 'required|in:available,busy,inactive', // Sửa lại cho đúng kiểu ENUM trong SQL
        ]);

        Guide::create($data);

        return redirect()->route('guides.index')->with('success', 'Thêm hướng dẫn viên thành công');
    }

    public function edit(Guide $guide)
    {
        return view('admin.guides.edit', compact('guide'));
    }

    public function update(Request $request, Guide $guide)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|unique:tour_guides,email,' . $guide->id,
            'experience' => 'required|integer|min:0',
            'status' => 'required|in:available,busy,inactive',
        ]);

        $guide->update($data);

        return redirect()->route('guides.index')->with('success', 'Cập nhật thành công');
    }

    public function destroy(Guide $guide)
    {
        $guide->delete();
        return back()->with('success', 'Đã xóa');
    }
}