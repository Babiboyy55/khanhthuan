@extends('layouts.admin')

@section('content')
<h1 style="margin-bottom: 30px;">Bảng điều khiển</h1>

<div class="card-grid">
    {{-- Thẻ Bài viết --}}
    <a href="{{ route('admin.posts.index') }}" class="card">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #7f8c8d; font-size: 12px; font-weight: bold; text-transform: uppercase;">Bài viết</div>
                <div style="font-size: 30px; font-weight: bold; margin-top: 5px;">{{ \App\Models\Post::count() }}</div>
            </div>
            <i class="fa fa-newspaper" style="font-size: 40px; color: #3498db; opacity: 0.3;"></i>
        </div>
        <div style="margin-top: 15px; color: #3498db; font-size: 13px;">Xem chi tiết →</div>
    </a>

    {{-- Thẻ Dịch vụ --}}
    <a href="{{ route('admin.services.index') }}" class="card" style="border-top-color: #2ecc71;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #7f8c8d; font-size: 12px; font-weight: bold; text-transform: uppercase;">Dịch vụ</div>
                <div style="font-size: 30px; font-weight: bold; margin-top: 5px;">{{ \App\Models\Service::count() }}</div>
            </div>
            <i class="fa fa-cogs" style="font-size: 40px; color: #2ecc71; opacity: 0.3;"></i>
        </div>
        <div style="margin-top: 15px; color: #2ecc71; font-size: 13px;">Xem chi tiết →</div>
    </a>

    {{-- Thẻ Dự án --}}
    <a href="{{ route('admin.projects.index') }}" class="card" style="border-top-color: #f1c40f;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #7f8c8d; font-size: 12px; font-weight: bold; text-transform: uppercase;">Dự án</div>
                <div style="font-size: 30px; font-weight: bold; margin-top: 5px;">{{ \App\Models\Project::count() }}</div>
            </div>
            <i class="fa fa-briefcase" style="font-size: 40px; color: #f1c40f; opacity: 0.3;"></i>
        </div>
        <div style="margin-top: 15px; color: #f1c40f; font-size: 13px;">Xem chi tiết →</div>
    </a>

    {{-- Thẻ Liên hệ --}}
    <a href="{{ route('admin.contacts.index') }}" class="card" style="border-top-color: #e74c3c;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #7f8c8d; font-size: 12px; font-weight: bold; text-transform: uppercase;">Liên hệ mới</div>
                <div style="font-size: 30px; font-weight: bold; margin-top: 5px;">{{ \App\Models\Contact::count() }}</div>
            </div>
            <i class="fa fa-envelope" style="font-size: 40px; color: #e74c3c; opacity: 0.3;"></i>
        </div>
        <div style="margin-top: 15px; color: #e74c3c; font-size: 13px;">Xem tất cả yêu cầu →</div>
    </a>

    {{-- Thẻ Thư mục Tài liệu --}}
    <a href="{{ route('admin.document-categories.index') }}" class="card" style="border-top-color: #8e44ad;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div>
                <div style="color: #7f8c8d; font-size: 12px; font-weight: bold; text-transform: uppercase;">Thư mục tài liệu</div>
                <div style="font-size: 30px; font-weight: bold; margin-top: 5px;">{{ \App\Models\DocumentCategory::count() }}</div>
            </div>
            <i class="fa fa-folder-tree" style="font-size: 40px; color: #8e44ad; opacity: 0.3;"></i>
        </div>
        <div style="margin-top: 15px; color: #8e44ad; font-size: 13px;">Quản lý thư mục →</div>
    </a>
</div>
@endsection
