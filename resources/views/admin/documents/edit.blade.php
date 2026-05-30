@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 900px; margin: 0 auto;">
    <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #1e293b;">
            <i class="fa-solid fa-pen-to-square" style="margin-right: 10px; color: #4f46e5;"></i> Chỉnh sửa tài liệu
        </h2>
        <a href="{{ route('admin.documents.index', ['group' => request('group')]) }}" style="color: #64748b; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    {{-- THÊM BLOCK HIỂN THỊ LỖI --}}
    @if($errors->any())
    <div style="background-color: #fee2e2; border: 1px solid #ef4444; color: #b91c1c; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        <strong style="font-weight: bold;">Không thể cập nhật do các lỗi sau:</strong>
        <ul style="margin-top: 5px; margin-left: 20px; list-style-type: disc; font-size: 14px;">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" style="font-family: 'Segoe UI', sans-serif;">
        @csrf
        @method('PUT')
        
        <input type="hidden" name="group" value="{{ request('group') }}">

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Tên tài liệu hiển thị</label>
            <input type="text" name="title" id="title" value="{{ old('title', $document->title) }}" required
                style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Chuyên mục</label>
            
            {{-- ĐÃ ĐỔI TÊN THÀNH document_category_id VÀ XỬ LÝ LẤY ĐÚNG ID CŨ --}}
            <select name="document_category_id" id="document_category_id" required
                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white;">
                <option value="">-- Chọn chuyên mục --</option>
                
                @if(isset($categories))
                    @foreach($categories as $parent)
                        <optgroup label="{{ $parent->name }}">
                            <option value="{{ $parent->id }}" {{ old('document_category_id', $document->document_category_id) == $parent->id ? 'selected' : '' }}>
                                📁 {{ $parent->name }} (Thư mục gốc)
                            </option>
                            @if($parent->children)
                                @foreach($parent->children as $child)
                                    <option value="{{ $child->id }}" {{ old('document_category_id', $document->document_category_id) == $child->id ? 'selected' : '' }}>
                                        &nbsp;&nbsp;&nbsp;📄 {{ $child->name }}
                                    </option>
                                @endforeach
                            @endif
                        </optgroup>
                    @endforeach
                @endif
            </select>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">File hiện tại</label>
            @if($document->file_path)
                <div style="padding: 10px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 6px; margin-bottom: 10px;">
                    <a href="{{ route('document.download', $document->id) }}" style="color: #2563eb; text-decoration: none; font-size: 14px; font-weight: 500;">
                        <i class="fa-solid fa-file-pdf"></i> {{ basename($document->file_path) }}
                    </a>
                    <span style="color: #64748b; font-size: 12px; margin-left: 10px;">({{ $document->file_size }})</span>
                </div>
            @else
                <p style="color: #ef4444; font-size: 14px;">Chưa có file nào được tải lên.</p>
            @endif
            
            <label style="display: block; font-weight: 600; margin-top: 15px; margin-bottom: 8px; color: #475569;">Chọn file mới (nếu muốn thay)</label>
            {{-- ĐÃ BỎ REQUIRED Ở ĐÂY ĐỂ NGƯỜI DÙNG CÓ THỂ CHỈ SỬA TÊN MÀ KHÔNG CẦN UP LẠI FILE --}}
            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.xlsm"
                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white;">
            <p style="font-size: 11px; color: #94a3b8; margin-top: 5px;">Hỗ trợ: PDF, Word, Excel (Tối đa: 50MB - Riêng HSNL: 100MB). Để trống nếu không muốn thay đổi file.</p>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <a href="{{ route('admin.documents.index', ['group' => request('group')]) }}" style="text-align: center; color: #64748b; padding: 10px 18px; text-decoration: none; font-weight: 600; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 8px;">
                Hủy
            </a>
            <button type="submit" style="background: #4f46e5; color: white; padding: 12px 22px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 14px;">
                <i class="fa-solid fa-floppy-disk"></i> Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection