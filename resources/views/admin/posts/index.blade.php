@extends('layouts.admin')

@section('content')
<div style="background: white; padding: 25px; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
    {{-- Thông báo thành công sau khi xóa/thêm --}}
    @if(session('success'))
    <div style="background: #dcfce7; color: #15803d; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-weight: 500;">
        <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
    </div>
    @endif

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; border-bottom: 1px solid #eee; padding-bottom: 15px;">
        <h2 style="margin: 0; font-family: 'Segoe UI', sans-serif; color: #2d3748; display: flex; align-items: center;">
            <i class="fa-solid fa-newspaper" style="margin-right: 12px; color: #4f46e5;"></i> Quản lý bài viết
        </h2>
        <div style="display: flex; gap: 16px; align-items: center;">
            <form method="GET" action="" style="display: flex; gap: 8px; align-items: center;">
                <select name="category_id" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;">
                    <option value="">-- Danh mục --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <select name="sort" style="padding: 6px 12px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;">
                    <option value="desc" {{ request('sort', 'desc') == 'desc' ? 'selected' : '' }}>Mới nhất</option>
                    <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Cũ nhất</option>
                </select>
                <button type="submit" style="background: #4f46e5; color: white; border: none; border-radius: 6px; padding: 7px 16px; font-weight: 600;">Lọc</button>
            </form>
            <a href="{{ route('admin.posts.create') }}" style="background: #4f46e5; color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: 600; font-size: 14px; transition: 0.3s;">
                <i class="fa-solid fa-plus"></i> Thêm bài viết mới
            </a>
        </div>
    </div>

    <form id="bulk-action-form" action="{{ route('admin.posts.bulk-destroy') }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa các bài viết đã chọn?')">
        @csrf
        @method('DELETE')

        <div id="bulk-actions" style="display: none; background: #fff1f2; padding: 12px 20px; border-radius: 8px; margin-bottom: 15px; border: 1px solid #fecdd3; align-items: center; justify-content: space-between;">
            <div style="color: #be123c; font-size: 13px; font-weight: 600;">
                <i class="fa-solid fa-circle-info"></i> Đang chọn <span id="selected-count">0</span> bài viết
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
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Ảnh</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Nội dung bài viết</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Danh mục</th>
                    <th style="padding: 15px; text-align: left; color: #64748b; font-size: 13px; text-transform: uppercase;">Trạng thái</th>
                    <th style="padding: 15px; text-align: center; color: #64748b; font-size: 13px; text-transform: uppercase;">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($posts as $post)
                <tr style="border-bottom: 1px solid #f1f5f9;">
                    <td style="padding: 15px; text-align: center;">
                        <input type="checkbox" name="ids[]" value="{{ $post->id }}" class="doc-checkbox" style="width: 16px; height: 16px; cursor: pointer;">
                    </td>
                    <td style="padding: 15px;">
                        <div style="width: 70px; height: 50px; overflow: hidden; border-radius: 8px; border: 1px solid #e2e8f0; background: #f1f5f9;">
                            @php
                            $imgName = $post->featured_image;
                            if (str_starts_with($imgName, 'http')) {
                                $src = $imgName;
                            } elseif (str_contains($imgName, 'storage/') || str_contains($imgName, 'images/')) {
                                $src = asset($imgName);
                            } elseif (str_starts_with($imgName, 'post-featured/')) {
                                $src = asset('storage/' . $imgName);
                            } else {
                                $src = asset('images/' . $imgName);
                            }
                            @endphp
                            <img src="{{ $src }}"
                                style="width: 100%; height: 100%; object-fit: cover;"
                                onerror="this.src='{{ asset('images/logo.jpg') }}'">
                        </div>
                    </td>
                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #1e293b; font-size: 14px;">{{ $post->title }}</div>
                        <div style="font-size: 11px; color: #94a3b8; margin-top: 2px;">
                            <i class="fa-regular fa-calendar"></i> {{ $post->created_at->format('d/m/Y') }}
                        </div>
                    </td>
                    <td style="padding: 15px;">
                        <span style="color: #475569; background: #f1f5f9; padding: 3px 10px; border-radius: 6px; font-size: 12px;">
                            {{ $post->category->name ?? 'Chưa phân loại' }}
                        </span>
                    </td>
                    <td style="padding: 15px;">
                        @if($post->status == 'published')
                        <span style="color: #15803d; font-size: 12px; font-weight: 600;">● Đã đăng</span>
                        @else
                        <span style="color: #a16207; font-size: 12px; font-weight: 600;">● Bản nháp</span>
                        @endif
                    </td>
                    <td style="padding: 15px; text-align: center;">
                        <div style="display: flex; justify-content: center; gap: 12px;">
                            <a href="{{ route('admin.posts.edit', $post->id) }}" style="color: #3b82f6;" title="Sửa">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <button type="button" onclick="deletePost({{ $post->id }})"
                                style="background:none; border:none; color: #ef4444; cursor: pointer; padding: 0;" title="Xóa">
                                <i class="fa-solid fa-trash-can"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: #94a3b8;">Chưa có bài viết nào được tạo.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </form>

    {{-- Form xóa từng mục (đặt ngoài bulk form) --}}
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

        window.deletePost = function(id) {
            if (!confirm('Bạn có chắc chắn muốn xóa bài viết này?')) return;
            const form = document.getElementById('delete-single-form');
            form.action = '/admin/posts/' + id;
            form.submit();
        };
    </script>

    {{-- Phân trang --}}
    <div style="margin-top: 20px;">
        {{ $posts->appends(request()->all())->links() }}
    </div>
</div>
@endsection
