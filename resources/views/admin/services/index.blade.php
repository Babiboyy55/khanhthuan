@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #2d3748; display: flex; align-items: center;">
            <i class="fa-solid fa-gears" style="margin-right: 12px; color: #4f46e5;"></i> Quản lý dịch vụ
        </h2>
        <div style="display: flex; gap: 16px; align-items: center;">
            <form method="GET" action="" style="display: flex; gap: 8px; align-items: center;">
                <select name="sort" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;">
                    <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
                <button type="submit" style="background: #4f46e5; color: white; border: none; border-radius: 6px; padding: 7px 16px; font-weight: 600;">Lọc</button>
            </form>
            <a href="{{ route('admin.services.create') }}"
                style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s;">
                <i class="fa-solid fa-plus"></i> Thêm dịch vụ mới
            </a>
        </div>
    </div>

    <form id="bulk-action-form" action="{{ route('admin.services.bulk-destroy') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa các dịch vụ đã chọn?')">
        @csrf
        @method('DELETE')

        <div id="bulk-actions" style="display: none; background: #fff1f2; padding: 12px 20px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #fecdd3; align-items: center; justify-content: space-between;">
            <div style="color: #be123c; font-size: 13px; font-weight: 600;">
                <i class="fa-solid fa-circle-info"></i> Đang chọn <span id="selected-count">0</span> dịch vụ
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
                    <th
                        style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">
                        Hình ảnh</th>
                    <th
                        style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">
                        Tên dịch vụ</th>
                    <th
                        style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">
                        Mô tả ngắn</th>
                    <th
                        style="padding: 15px; text-align: center; color: #64748b; font-size: 13px; text-transform: uppercase;">
                        Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($services as $service)
                <tr style="border-bottom: 1px solid #f1f5f9; transition: 0.2s;"
                    onmouseover="this.style.backgroundColor='#f8fafc'"
                    onmouseout="this.style.backgroundColor='transparent'">
                    <td style="padding: 15px; text-align: center;">
                        <input type="checkbox" name="ids[]" value="{{ $service->id }}" class="doc-checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                    </td>
                    <td style="padding: 15px; width: 100px;">
                        @if($service->image)
                        @php
                            $img = $service->image;
                            if (str_starts_with($img, 'http')) {
                                $src = $img;
                            } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                $src = asset($img);
                            } elseif (str_starts_with($img, 'service-featured/')) {
                                $src = asset('storage/' . $img);
                            } else {
                                $src = asset('images/' . $img);
                            }
                        @endphp
                        <img src="{{ $src }}"
                            onerror="this.src='{{ asset('images/logo.jpg') }}'"
                            style="width: 80px; height: 50px; object-fit: cover; border-radius: 6px; border: 1px solid #e2e8f0;">
                        @else
                        <div
                            style="width: 80px; height: 50px; background: #f1f5f9; border-radius: 6px; display: flex; align-items: center; justify-content: center; color: #cbd5e1; font-size: 10px;">
                            No Image
                        </div>
                        @endif
                    </td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #1e293b; font-size: 15px;">{{ $service->title }}</div>
                        <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">SLUG: {{ $service->slug }}</div>
                    </td>

                    <td style="padding: 15px; color: #64748b; font-size: 14px; max-width: 400px;">
                        {{ Str::limit($service->summary, 100) }}
                    </td>

                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 15px;">
                            <a href="{{ route('admin.services.edit', $service->id) }}"
                                style="color: #3b82f6; font-size: 18px;" title="Sửa">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <button type="button" onclick="deleteService({{ $service->id }})"
                                style="background:none; border:none; color: #ef4444; cursor: pointer; font-size: 18px; padding: 0;" title="Xóa">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                        Chưa có dữ liệu dịch vụ. Hãy thêm mới ngay!
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    {{-- Form xóa từng mục (đặt ngoài bulk form để tránh lồng form) --}}
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

        // Hàm xóa từng mục (dùng form bên ngoài để tránh lồng form)
        window.deleteService = function(id) {
            if (!confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')) return;
            const form = document.getElementById('delete-single-form');
            form.action = '/admin/services/' + id;
            form.submit();
        };
    </script>
</div>
@endsection
