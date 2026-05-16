@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 800px; margin: 0 auto;">
    <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="margin: 0; color: #1e293b;">
            <i class="fa-solid fa-user-pen" style="margin-right: 10px; color: #f39c12;"></i> Cập nhật tài khoản
        </h2>
        <a href="{{ route('admin.users.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Tên người dùng</label>
            <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
            @error('name')
            <div style="color: #e74c3c; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Email đăng nhập</label>
            <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
            @error('email')
            <div style="color: #e74c3c; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="background: #fffbeb; border: 1px solid #fde68a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
            <p style="margin: 0 0 15px 0; color: #d97706; font-size: 14px;"><i class="fa fa-info-circle"></i> Chỉ nhập mật khẩu mới nếu bạn muốn thay đổi mật khẩu cũ. Để trống nếu muốn giữ nguyên.</p>

            <div style="margin-bottom: 15px;">
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Mật khẩu mới (Tùy chọn)</label>
                <input type="password" name="password" placeholder="Tối thiểu 6 ký tự..."
                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
                @error('password')
                <div style="color: #e74c3c; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Nhập lại mật khẩu mới</label>
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu..."
                    style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
            </div>
        </div>

        <div style="margin-bottom: 25px;">
            <label style="display: block; font-weight: 600; margin-bottom: 12px; color: #475569;">Phân quyền</label>
            <div style="display: flex; gap: 20px;">
                @foreach($roles as $role)
                <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" name="roles[]" value="{{ $role->name }}"
                        {{ in_array($role->name, old('roles', $userRoles)) ? 'checked' : '' }}
                        style="width: 18px; height: 18px;">
                    <span style="font-weight: 600; color: #2c3e50;">{{ strtoupper($role->name) }}</span>
                </label>
                @endforeach
            </div>
            @error('roles')
            <div style="color: #e74c3c; font-size: 13px; margin-top: 5px;">{{ $message }}</div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px;">
            <button type="submit" style="background: #f39c12; color: white; padding: 12px 25px; border: none; border-radius: 8px; font-weight: bold; cursor: pointer;">
                <i class="fa-solid fa-save"></i> CẬP NHẬT
            </button>
            <a href="{{ route('admin.users.index') }}" style="background: #f1f5f9; color: #64748b; padding: 12px 25px; border-radius: 8px; text-decoration: none; font-weight: bold;">
                Hủy bỏ
            </a>
        </div>
    </form>
</div>
@endsection
