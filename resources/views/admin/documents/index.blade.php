@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    @if(session('success'))
    <div style="background: #dcfce7; color: #15803d; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #2d3748; display: flex; align-items: center;">
            @if(($group ?? '') == 'competency')
                <i class="fa-solid fa-id-card" style="margin-right: 12px; color: #e27121;"></i> Quản lý Công bố năng lực
            @else
                <i class="fa-solid fa-book" style="margin-right: 12px; color: #4f46e5;"></i> Quản lý Thư viện
            @endif
        </h2>
        <a href="{{ route('admin.documents.create', ['group' => $group ?? '']) }}" style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s;">
            <i class="fa-solid fa-plus"></i> Thêm tài liệu
        </a>
    </div>

    {{-- BỘ LỌC ĐÃ ĐƯỢC CẬP NHẬT ĐỂ TỰ ĐỘNG LẤY DANH SÁCH THƯ MỤC TỪ DATABASE --}}
    <form method="GET" action="{{ route('admin.documents.index') }}" style="display: flex; gap: 12px; align-items: center; margin-bottom: 20px; font-family: 'Segoe UI', sans-serif; flex-wrap: wrap;">
        <input type="hidden" name="group" value="{{ $group ?? '' }}">
        
        <label for="category" style="font-weight: 600; color: #475569; font-size: 13px;">Chuyên mục</label>
        <select name="category" id="category" style="padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white; font-size: 13px;">
            <option value="">Tất cả chuyên mục</option>
            @if(isset($categoriesDropdown))
                @foreach($categoriesDropdown as $parent)
                    <optgroup label="{{ $parent->name }}">
                        @if($parent->children->count() > 0)
                            @foreach($parent->children as $child)
                                <option value="{{ $child->id }}" {{ request('category') == $child->id ? 'selected' : '' }}>
                                    {{ $child->name }}
                                </option>
                            @endforeach
                        @else
                            <option value="{{ $parent->id }}" {{ request('category') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endif
                    </optgroup>
                @endforeach
            @endif
        </select>

        <label for="sort" style="font-weight: 600; color: #475569; font-size: 13px;">Sắp xếp</label>
        <select name="sort" id="sort" style="padding: 8px 10px; border: 1px solid #cbd5e1; border-radius: 6px; background: white; font-size: 13px;">
            <option value="newest" {{ ($sort ?? 'newest') == 'newest' ? 'selected' : '' }}>Mới nhất</option>
            <option value="oldest" {{ ($sort ?? 'newest') == 'oldest' ? 'selected' : '' }}>Cũ nhất</option>
        </select>
        
        <button type="submit" style="background: #4f46e5; color: white; padding: 8px 14px; border: none; border-radius: 6px; font-weight: 600; font-size: 13px; cursor: pointer;">
            Lọc
        </button>
        
        @if(request()->has('category') || request('sort') === 'oldest')
        <a href="{{ route('admin.documents.index', ['group' => $group ?? '']) }}" style="color: #64748b; text-decoration: none; font-size: 13px;">Xóa lọc</a>
        @endif
    </form>

    <form id="bulk-action-form" action="{{ route('admin.documents.bulk-destroy') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa các tài liệu đã chọn?')">
        @csrf
        @method('DELETE')
        
        <div id="bulk-actions" style="display: none; background: #fff1f2; padding: 12px 20px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #fecdd3; align-items: center; justify-content: space-between;">
            <div style="color: #be123c; font-size: 13px; font-weight: 600;">
                <i class="fa-solid fa-circle-info"></i> Đang chọn <span id="selected-count">0</span> tài liệu
            </div>
            <button type="submit" style="background: #ef4444; color: white; padding: 6px 15px; border: none; border-radius: 6px; font-weight: 600; font-size: 13px; cursor: pointer;">
                <i class="fa-solid fa-trash-can"></i> Xóa các mục đã chọn
            </button>
        </div>

        <table style="width: 100%; border-collapse: collapse; font-family: 'Segoe UI', sans-serif;">
            <thead>
                <tr style="background: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px; text-align: center; width: 40px;">
                        <input type="checkbox" id="select-all" style="width: 16px; height: 16px; cursor: pointer;">
                    </th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Tên tài liệu</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Chuyên mục</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Dung lượng</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">File</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Ngày tạo</th>
                    <th style="padding: 15px; text-align: center; color: #64748b; font-size: 13px; text-transform: uppercase;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($documents as $document)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px; text-align: center;">
                        <input type="checkbox" name="ids[]" value="{{ $document->id }}" class="doc-checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                    </td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $document->title }}</div>
                    </td>
                    <td style="padding: 15px;">
                        <span style="color: #475569; background: #f1f5f9; padding: 3px 10px; border-radius: 6px; font-size: 12px;">
                            {{-- ĐÃ SỬA: Hiển thị đúng tên thư mục --}}
                            {{ $document->category->name ?? 'Không xác định' }}
                        </span>
                    </td>
                    <td style="padding: 15px; color: #475569; font-size: 13px;">
                        {{ $document->file_size ?? 'N/A' }}
                    </td>
                    <td style="padding: 15px;">
                        @if($document->file_path)
                        <a href="{{ route('document.download', $document->id) }}" style="color: #2563eb; text-decoration: none; font-size: 13px;">
                            {{ basename($document->file_path) }}
                        </a>
                        @else
                        <span style="color: #94a3b8; font-size: 12px;">Chưa có</span>
                        @endif
                    </td>
                    <td style="padding: 15px; color: #475569; font-size: 13px;">
                        {{ $document->created_at ? $document->created_at->format('d/m/Y') : 'N/A' }}
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 12px;">
                            <a href="{{ route('admin.documents.edit', $document->id) }}" style="color: #3b82f6;" title="Sửa">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: #94a3b8;">Chưa có tài liệu nào được tạo trong mục này.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    {{-- Form xóa từng mục --}}
    <form id="delete-single-form" method="POST" style="display:none;">
        @csrf
        @method('DELETE')
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAll = document.getElementById('select-all');
            const checkboxes = document.querySelectorAll('.doc-checkbox');
            const bulkActions = document.getElementById('bulk-actions');
            const selectedCount = document.getElementById('selected-count');

            function updateBulkActions() {
                const checkedCount = document.querySelectorAll('.doc-checkbox:checked').length;
                if (checkedCount > 0) {
                    bulkActions.style.display = 'flex';
                    selectedCount.textContent = checkedCount;
                } else {
                    bulkActions.style.display = 'none';
                }
            }

            if (selectAll) {
                selectAll.addEventListener('change', function() {
                    checkboxes.forEach(cb => {
                        cb.checked = selectAll.checked;
                    });
                    updateBulkActions();
                });
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    const allChecked = document.querySelectorAll('.doc-checkbox:checked').length === checkboxes.length;
                    selectAll.checked = allChecked;
                    updateBulkActions();
                });
            });
        });

        window.deleteDocument = function(id) {
            if (!confirm('Bạn có chắc chắn muốn xóa tài liệu này?')) return;
            const form = document.getElementById('delete-single-form');
            form.action = '/admin/documents/' + id;
            form.submit();
        };
    </script>

    @if($documents->hasPages())
    <div style="margin-top: 20px; display: flex; align-items: center; justify-content: space-between; font-family: 'Segoe UI', sans-serif;">
        <div style="color: #64748b; font-size: 13px;">
            Hiển thị {{ $documents->firstItem() }}-{{ $documents->lastItem() }} / {{ $documents->total() }}
        </div>
        <div style="display: flex; gap: 8px;">
            @if($documents->onFirstPage())
            <span style="padding: 8px 12px; border-radius: 6px; border: 1px solid #e2e8f0; color: #cbd5e1; font-size: 13px;">Trước</span>
            @else
            <a href="{{ $documents->previousPageUrl() }}" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #e2e8f0; color: #475569; text-decoration: none; font-size: 13px;">Trước</a>
            @endif

            @if($documents->hasMorePages())
            <a href="{{ $documents->nextPageUrl() }}" style="padding: 8px 12px; border-radius: 6px; border: 1px solid #e2e8f0; color: #475569; text-decoration: none; font-size: 13px;">Sau</a>
            @else
            <span style="padding: 8px 12px; border-radius: 6px; border: 1px solid #e2e8f0; color: #cbd5e1; font-size: 13px;">Sau</span>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection