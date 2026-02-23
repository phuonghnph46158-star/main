<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Danh sách user
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Form chỉnh sửa user
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Cập nhật user
     */
    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'phone'    => 'nullable|string|max:20',
            'role'     => 'required|in:user,admin',
            'status'   => 'required|in:active,blocked',
            'password' => 'nullable|min:6',
        ]);

        // Nếu có nhập mật khẩu mới → mã hoá
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Xoá user
     */
    public function destroy(User $user)
    {
        // Không cho xoá admin
        if ($user->role === 'admin') {
            return back()->with('error', 'Không thể xoá tài khoản admin');
        }

        // Không cho tự xoá chính mình
        if (auth()->id() === $user->id) {
            return back()->with('error', 'Không thể xoá tài khoản đang đăng nhập');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Xoá người dùng thành công');
    }
}
