<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use App\Models\Tour; // Đừng quên import Model Tour
use Illuminate\Http\Request;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Lấy 6 tour mới nhất, kèm ảnh và danh mục
        $tours = Tour::with(['images', 'category'])
            // Lọc các tour đang hoạt động (dùng whereIn để khớp cả 1 hoặc 'active')
            ->whereIn('status', ['active', '1']) 
            ->latest()
            ->take(6)
            ->get();

        return view('clients.home', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
