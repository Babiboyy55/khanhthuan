@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); max-width: 900px; margin: 0 auto;">
    <div style="border-bottom: 2px solid #f1f5f9; padding-bottom: 15px; margin-bottom: 25px; display: flex; align-items: center; justify-content: space-between;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #1e293b;">
            <i class="fa-solid fa-pen-to-square" style="margin-right: 10px; color: #4f46e5;"></i> Chỉnh sửa tài liệu
        </h2>
        <a href="{{ route('admin.documents.index') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-arrow-left"></i> Quay lại danh sách
        </a>
    </div>

    @if(session('success'))
    <div style="background: #dcfce7; color: #15803d; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('admin.documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" style="font-family: 'Segoe UI', sans-serif;">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Tên tài liệu hiển thị</label>
            <input type="text" name="title" id="title" required value="{{ $document->title }}"
                style="width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 15px; outline: none;">
            @error('title') <p style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Chuyên mục</label>
            <select name="category" id="category" required
                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white;">
                @foreach($categories as $cat)
                    <option value="{{ $cat->slug }}" {{ $document->category == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category') <p style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</p> @enderror
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">File hiện tại</label>
            @if($document->file_path)
            <a href="{{ route('document.download', $document->id) }}" style="color: #2563eb; text-decoration: none; font-size: 13px;">
                {{ basename($document->file_path) }}
            </a>
            <div style="font-size: 12px; color: #94a3b8; margin-top: 3px;">{{ $document->file_size }}</div>
            @else
            <div style="font-size: 13px; color: #94a3b8;">Chưa có file</div>
            @endif
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: block; font-weight: 600; margin-bottom: 8px; color: #475569;">Chọn file mới (nếu muốn thay)</label>
            <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.xlsm"
                style="width: 100%; padding: 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white;">
            @error('file') <p style="color: #ef4444; font-size: 12px; margin-top: 5px;">{{ $message }}</p> @enderror
            <p style="font-size: 11px; color: #94a3b8; margin-top: 5px;">Hỗ trợ: PDF, Word, Excel (Tối đa: 50MB - Riêng HSNL: 100MB)</p>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 10px;">
            <a href="{{ route('admin.documents.index') }}" style="text-align: center; color: #64748b; padding: 10px 18px; text-decoration: none; font-weight: 600; font-size: 14px; border: 1px solid #e2e8f0; border-radius: 8px;">
                Hủy
            </a>
            <button type="submit" style="background: #4f46e5; color: white; padding: 12px 22px; border: none; border-radius: 8px; font-weight: 700; cursor: pointer; transition: 0.3s; font-size: 14px;">
                <i class="fa-solid fa-floppy-disk"></i> Cập nhật
            </button>
        </div>
    </form>
</div>
@endsection
