@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    <div
        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #2d3748; display: flex; align-items: center;">
            <i class='fa-solid fa-helmet-safety' style='margin-right: 12px; color: #4f46e5;'></i> Quản lý dự án tiêu biểu
        </h2>
        <div style="display: flex; gap: 16px; align-items: center;">
            <form method="GET" action="" style="display: flex; gap: 8px; align-items: center;">
                <select name="category" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;">
                    <option value="">-- Phân loại --</option>
                    @foreach($categories as $key => $label)
                    <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <select name="sort" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;">
                    <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
                <button type="submit" style="background: #4f46e5; color: white; border: none; border-radius: 6px; padding: 7px 16px; font-weight: 600;">Lọc</button>
            </form>
            <a href="{{ route('admin.projects.create') }}"
                style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px;">
                <i class="fa-solid fa-plus"></i> Thêm dự án mới
            </a>
        </div>
    </div>

    <form id="bulk-action-form" action="{{ route('admin.projects.bulk-destroy') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa các dự án đã chọn?')">
        @csrf
        @method('DELETE')

        <div id="bulk-actions" style="display: none; background: #fff1f2; padding: 12px 20px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #fecdd3; align-items: center; justify-content: space-between;">
            <div style="color: #be123c; font-size: 13px; font-weight: 600;">
                <i class="fa-solid fa-circle-info"></i> Đang chọn <span id="selected-count">0</span> dự án
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
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px;">HÌNH ẢNH</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px;">TÊN DỰ ÁN</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px;">PHÂN LOẠI</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px;">MÔ TẢ</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px;">ĐỊA ĐIỂM / NĂM</th>
                    <th style="padding: 15px; text-align: center; color: #64748b; font-size: 13px;">THAO TÁC</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px; text-align: center;">
                        <input type="checkbox" name="ids[]" value="{{ $project->id }}" class="doc-checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                    </td>
                    <td style="padding: 15px;">
                        @php
                            $img = $project->image;
                            if ($img) {
                                if (str_starts_with($img, 'http')) {
                                    $src = $img;
                                } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                    $src = asset($img);
                                } elseif (str_starts_with($img, 'project-featured/')) {
                                    $src = asset('storage/' . $img);
                                } else {
                                    $src = asset('images/' . $img);
                                }
                            } else {
                                $src = asset('images/logo.jpg');
                            }
                        @endphp
                        <img src="{{ $src }}"
                            onerror="this.onerror=null;this.src='{{ asset('images/logo.jpg') }}';"
                            style="width: 80px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid #eee;">
                    </td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #1e293b;">{{ $project->title }}</div>
                        <div style="font-size: 11px; color: #94a3b8;">SLUG: {{ $project->slug }}</div>
                    </td>
                    <td style="padding: 15px;">
                        @php
                        $types = [
                        'bridge' => ['Cầu / Đường', '#dbeafe', '#1e40af'],
                        'factory' => ['Nhà máy', '#dcfce7', '#166534'],
                        'urban' => ['Đô thị', '#ffedd5', '#9a3412']
                        ];
                        $catKey = strtolower($project->category);
                        $type = $types[$catKey] ?? ['Không xác định', '#f1f5f9', '#64748b'];
                        @endphp
                        <span
                            style="background: {{ $type[1] }}; color: {{ $type[2] }}; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 600;">
                            {{ $type[0] }}
                        </span>
                    </td>
                    <td style="padding: 15px; color: #64748b; font-size: 14px; max-width: 300px;">
                        {{ Str::limit($project->summary ?? $project->description, 100) }}
                    </td>
                    <td style="padding: 15px; color: #64748b; font-size: 14px;">
                        {{ $project->location }} <br> <span style="font-size: 12px; color: #94a3b8;">Năm:
                            {{ $project->year }}</span>
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 12px;">
                            <a href="{{ route('admin.projects.edit', $project->id) }}" style="color: #3b82f6;"
                                title="Sửa"><i class="fa-solid fa-pen"></i></a>
                            <button type="button" onclick="deleteProject({{ $project->id }})"
                                style="background:none; border:none; color: #ef4444; cursor: pointer; padding: 0;" title="Xóa">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="padding: 40px; text-align: center; color: #94a3b8;">Chưa có dự án nào.</td>
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

        window.deleteProject = function(id) {
            if (!confirm('Bạn có chắc chắn muốn xóa dự án này?')) return;
            const form = document.getElementById('delete-single-form');
            form.action = '/admin/projects/' + id;
            form.submit();
        };
    </script>
</div>
@endsection
