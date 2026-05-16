@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2 style="margin: 0; color: #2c3e50;"><i class="fa-solid fa-users" style="color: #3498db; margin-right: 10px;"></i> Quản lý người dùng</h2>
        <a href="{{ route('admin.users.create') }}" style="background: #2ecc71; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none; font-weight: bold; transition: 0.3s;">
            <i class="fa fa-plus"></i> Thêm tài khoản mới
        </a>
    </div>

    @if(session('success'))
    <div style="background: #2ecc71; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <i class="fa fa-check-circle"></i> {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background: #e74c3c; color: white; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
        <i class="fa fa-exclamation-triangle"></i> {{ session('error') }}
    </div>
    @endif

    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr style="background: #f8f9fa; border-bottom: 2px solid #dee2e6;">
                <th style="padding: 15px; border-bottom: 1px solid #ddd; width: 50px;">ID</th>
                <th style="padding: 15px; border-bottom: 1px solid #ddd;">Tên người dùng</th>
                <th style="padding: 15px; border-bottom: 1px solid #ddd;">Email đăng nhập</th>
                <th style="padding: 15px; border-bottom: 1px solid #ddd;">Phân quyền</th>
                <th style="padding: 15px; border-bottom: 1px solid #ddd; text-align: center; width: 120px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr style="border-bottom: 1px solid #eee; transition: background 0.2s;" onmouseover="this.style.background='#fbfbfb'" onmouseout="this.style.background='transparent'">
                <td style="padding: 15px;">{{ $user->id }}</td>
                <td style="padding: 15px; font-weight: bold; color: #2c3e50;">{{ $user->name }}</td>
                <td style="padding: 15px; color: #7f8c8d;">{{ $user->email }}</td>
                <td style="padding: 15px;">
                    @foreach($user->roles as $role)
                    <span style="background: {{ $role->name == 'admin' ? '#e74c3c' : '#3498db' }}; color: white; padding: 4px 10px; border-radius: 12px; font-size: 12px; font-weight: bold; margin-right: 5px;">
                        {{ strtoupper($role->name) }}
                    </span>
                    @endforeach
                </td>
                <td style="padding: 15px; text-align: center;">
                    <a href="{{ route('admin.users.edit', $user->id) }}" style="color: #f39c12; margin-right: 15px; font-size: 18px;" title="Sửa">
                        <i class="fa fa-pen-to-square"></i>
                    </a>

                    @if($user->id !== auth()->id())
                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #e74c3c; cursor: pointer; font-size: 18px; padding: 0;" title="Xóa">
                            <i class="fa fa-trash"></i>
                        </button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="margin-top: 25px;">
        {{ $users->links() }}
    </div>
</div>
@endsection
