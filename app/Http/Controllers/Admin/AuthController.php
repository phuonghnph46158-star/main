<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Hiển thị form đăng nhập admin
     */
    public function showLogin()
    {
        return view('admin.login');
    }

    /**
     * Xử lý đăng nhập admin
     */
    public function login(Request $request)
    {
        // 1️⃣ Validate dữ liệu
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // 2️⃣ Thêm điều kiện role & status
        $credentials['role']   = 'admin';
        $credentials['status'] = 'active';

        // 3️⃣ Thử đăng nhập
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('admin.dashboard');
            // hoặc: return redirect('/admin');
        }

        // 4️⃣ Sai thông tin
        return back()->withErrors([
            'email' => 'Email, mật khẩu hoặc quyền truy cập không hợp lệ',
        ])->onlyInput('email');
    }

    /**
     * Đăng xuất admin
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
        // hoặc: return redirect('/admin/login');
    }
}
