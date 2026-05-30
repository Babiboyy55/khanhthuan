@extends('layouts.admin')

@section('content')
<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 style="margin: 0; font-weight: 800; color: #003366;">Quản lý Thư mục Tài liệu</h1>
    <a href="{{ route('admin.document-categories.create') }}" 
       style="background: #e27121; color: white; padding: 10px 20px; border-radius: 6px; text-decoration: none; font-weight: bold; font-size: 14px; transition: 0.3s; box-shadow: 0 4px 10px rgba(226, 113, 33, 0.2);">
        <i class="fa fa-plus-circle"></i> Thêm thư mục mới
    </a>
</div>

@if(session('success'))
<div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px; border-left: 5px solid #28a745;">
    <i class="fa fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div style="background: white; border-radius: 12px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); overflow: hidden; border: 1px solid #eee;">
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead style="background: #f8fafc; border-bottom: 2px solid #edf2f7;">
            <tr>
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">ID</th>
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Icon & Màu sắc</th>
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Tên thư mục</th>
                {{-- THÊM CỘT NHÓM QUẢN LÝ VÀO BẢNG --}}
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Nhóm quản lý</th>
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700;">Đường dẫn (Slug)</th>
                <th style="padding: 18px 20px; font-size: 12px; color: #64748b; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 700; text-align: right;">Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
            <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;" onmouseover="this.style.backgroundColor='#f8fafc'" onmouseout="this.style.backgroundColor='transparent'">
                <td style="padding: 18px 20px; font-weight: bold; color: #94a3b8;">#{{ $category->id }}</td>
                <td style="padding: 18px 20px;">
                    <div style="width: 42px; height: 42px; border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; background-color: {{ $category->color }}; box-shadow: 0 4px 8px {{ $category->color }}40;">
                        <i class="fa {{ $category->icon }}" style="font-size: 18px;"></i>
                    </div>
                </td>
                <td style="padding: 18px 20px; font-weight: 700; color: #1e293b; font-size: 15px;">{{ $category->name }}</td>
                
                {{-- HIỂN THỊ BADGE CHO NHÓM QUẢN LÝ --}}
                <td style="padding: 18px 20px;">
                    @if($category->type == 'library')
                        <span style="background: #e0e7ff; color: #4338ca; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                            <i class="fa-solid fa-book"></i> Thư viện
                        </span>
                    @elseif($category->type == 'competency')
                        <span style="background: #ffedd5; color: #c2410c; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                            <i class="fa-solid fa-id-card"></i> Công bố NL
                        </span>
                    @else
                        <span style="background: #f1f5f9; color: #dc2626; padding: 5px 10px; border-radius: 6px; font-size: 12px; font-weight: bold;">
                            Chưa phân loại <i class="fa-solid fa-circle-exclamation"></i>
                        </span>
                    @endif
                </td>

                <td style="padding: 18px 20px; color: #64748b; font-family: 'Consolas', monospace; font-size: 13px;">
                    <span style="background: #f1f5f9; padding: 4px 8px; border-radius: 4px;">{{ $category->slug }}</span>
                </td>
                <td style="padding: 18px 20px; text-align: right;">
                    <div style="display: flex; justify-content: flex-end; gap: 10px;">
                        <a href="{{ route('admin.document-categories.edit', $category->id) }}" 
                           style="background: #3498db; color: white; width: 34px; height: 34px; border-radius: 6px; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: 0.3s;" title="Sửa">
                            <i class="fa fa-edit"></i>
                        </a>
                        <form action="{{ route('admin.document-categories.destroy', $category->id) }}" method="POST" style="display: inline-block;" onsubmit="return confirm('Bạn có chắc chắn muốn xóa thư mục này? Dữ liệu bên trong có thể bị ảnh hưởng.');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: #e74c3c; color: white; width: 34px; height: 34px; border-radius: 6px; display: flex; align-items: center; justify-content: center; border: none; cursor: pointer; transition: 0.3s;" title="Xóa">
                                <i class="fa fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@if($categories->hasPages())
<div style="margin-top: 30px; display: flex; justify-content: center;">
    {{ $categories->links() }}
</div>
@endif
@endsection