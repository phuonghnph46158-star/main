@extends('admin.layout')

@section('page_title', 'Cập nhật người dùng')

@section('content')

<form method="POST" action="{{ route('users.update',$user) }}">
    @csrf 
    @method('PUT')

    <div class="mb-3">
        <label>Tên</label>
        <input type="text" name="name" value="{{ $user->name }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mật khẩu mới (nếu đổi)</label>
        <input type="password" name="password" class="form-control">
    </div>

    <button class="btn btn-primary">Cập nhật</button>
    <a href="{{ route('users.index') }}" class="btn btn-secondary">Quay lại</a>
</form>

@endsection
