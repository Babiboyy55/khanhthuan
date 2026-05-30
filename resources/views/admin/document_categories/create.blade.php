@extends('layouts.admin')

@section('content')
<div style="margin-bottom: 30px; display: flex; align-items: center; gap: 15px;">
    <a href="{{ route('admin.document-categories.index') }}" style="background: white; color: #64748b; width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 2px 5px rgba(0,0,0,0.1); transition: 0.3s;">
        <i class="fa fa-arrow-left"></i>
    </a>
    <h1 style="margin: 0; font-weight: 800; color: #003366;">Thêm Thư mục mới</h1>
</div>

<div style="background: white; border-radius: 12px; box-shadow: 0 5px 25px rgba(0,0,0,0.05); padding: 40px; border: 1px solid #eee; max-width: 800px;">
    <form action="{{ route('admin.document-categories.store') }}" method="POST">
        @csrf
        
        <div style="display: grid; grid-template-cols: 1fr 1fr; gap: 25px; margin-bottom: 25px;">
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #475569; font-size: 14px;">Tên thư mục <span style="color: #e74c3c;">*</span></label>
                <input type="text" name="name" id="name" required placeholder="VD: Hồ Sơ Năng Lực"
                    style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; transition: 0.3s;"
                    onfocus="this.style.borderColor='#3498db'; this.style.boxShadow='0 0 0 3px rgba(52, 152, 219, 0.1)'"
                    onblur="this.style.borderColor='#cbd5e1'; this.style.boxShadow='none'">
            </div>

            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #475569; font-size: 14px;">Đường dẫn (Slug) <span style="color: #e74c3c;">*</span></label>
                <input type="text" name="slug" id="slug" required placeholder="VD: ho-so-nang-luc"
                    style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; font-family: monospace;"
                    onfocus="this.style.borderColor='#3498db'"
                    onblur="this.style.borderColor='#cbd5e1'">
                <p style="font-size: 12px; color: #94a3b8; margin-top: 8px;"><i class="fa fa-info-circle"></i> Chỉ dùng chữ cái thường, số và dấu gạch ngang.</p>
            </div>

            {{-- ĐOẠN CODE THÊM MỚI: CHỌN NHÓM QUẢN LÝ --}}
            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #475569; font-size: 14px;">Thuộc nhóm <span style="color: #e74c3c;">*</span></label>
                <select name="type" required style="width: 100%; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none; background: white; transition: 0.3s;"
                    onfocus="this.style.borderColor='#3498db'"
                    onblur="this.style.borderColor='#cbd5e1'">
                    <option value="">-- Chọn nhóm quản lý --</option>
                    <option value="library" {{ old('type') == 'library' ? 'selected' : '' }}>Thư viện tài liệu</option>
                    <option value="competency" {{ old('type') == 'competency' ? 'selected' : '' }}>Công bố năng lực</option>
                </select>
            </div>

            <input type="hidden" name="icon" value="fa-folder">

            <div style="grid-column: span 2;">
                <label style="display: block; font-weight: 700; margin-bottom: 10px; color: #475569; font-size: 14px;">Mã màu (Hex) <span style="color: #e74c3c;">*</span></label>
                <div style="display: flex; gap: 10px; align-items: center;">
                    <input type="color" name="color" id="color" required value="#003366"
                        style="width: 60px; height: 46px; border: 1px solid #cbd5e1; border-radius: 8px; cursor: pointer; padding: 2px;">
                    <input type="text" id="color_text" placeholder="#003366" value="#003366"
                        style="flex: 1; padding: 12px 15px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;"
                        oninput="document.getElementById('color').value = this.value">
                </div>
            </div>
        </div>

        <div style="margin-top: 40px; padding-top: 25px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end; gap: 15px;">
            <a href="{{ route('admin.document-categories.index') }}" style="padding: 12px 25px; border-radius: 8px; border: 1px solid #cbd5e1; color: #64748b; text-decoration: none; font-weight: 700; font-size: 14px; transition: 0.3s;" onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='transparent'">Hủy bỏ</a>
            <button type="submit" style="background: #003366; color: white; padding: 12px 35px; border: none; border-radius: 8px; font-weight: 700; font-size: 14px; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(0, 51, 102, 0.2);" onmouseover="this.style.background='#012c57'" onmouseout="this.style.background='#003366'">
                <i class="fa fa-save"></i> Lưu thư mục
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('name').addEventListener('input', function() {
        let slug = this.value.toLowerCase()
            .replace(/[àáạảãâầấậẩẫăằắặẳẵ]/g, "a")
            .replace(/[èéẹẻẽêềếệểễ]/g, "e")
            .replace(/[ìíịỉĩ]/g, "i")
            .replace(/[òóọỏõôồốộổỗơờớợởỡ]/g, "o")
            .replace(/[ùúụủũưừứựửữ]/g, "u")
            .replace(/[ỳýỵỷỹ]/g, "y")
            .replace(/đ/g, "d")
            .replace(/([^0-9a-z-\s])/g, '')
            .replace(/(\s+)/g, '-')
            .replace(/-+/g, '-')
            .replace(/^-+|-+$/g, '');
        document.getElementById('slug').value = slug;
    });

    document.getElementById('color').addEventListener('input', function() {
        document.getElementById('color_text').value = this.value;
    });
</script>
@endsection