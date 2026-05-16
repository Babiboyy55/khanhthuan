<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel - Công ty Khánh Thuận</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpg') }}">
    <script>
        window.KHANHTHUAN_CKEDITOR = {
            csrfToken: '{{ csrf_token() }}',
            uploadUrl: '{{ route('admin.posts.upload') }}'
        };
    </script>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=be-vietnam-pro:300,400,500,600,700,800" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --brand-blue: #003366;
            --brand-blue-dark: #001f4d;
            --brand-orange: #e27121;
            --text-dark: #0f1f3a;
            --text-muted: #6b7280;
            --surface: #ffffff;
            --surface-alt: #f5f7fb;
            --border-soft: #e5e7eb;
        }

        body {
            margin: 0;
            font-family: 'Be Vietnam Pro', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--surface-alt);
            display: flex;
            color: var(--text-dark);
        }

        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, var(--brand-blue) 0%, #012c57 60%, var(--brand-blue-dark) 100%);
            min-height: 100vh;
            color: white;
            position: fixed;
            box-shadow: 0 12px 30px rgba(0, 51, 102, 0.25);
        }

        .sidebar-header {
            padding: 22px 20px;
            text-align: center;
            font-size: 18px;
            font-weight: 800;
            letter-spacing: 0.25em;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            text-transform: uppercase;
        }

        .nav-item {
            padding: 14px 24px;
            display: block;
            color: rgba(255, 255, 255, 0.75);
            text-decoration: none;
            transition: 0.2s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.08);
            color: white;
        }

        .nav-item.active {
            background: linear-gradient(90deg, rgba(226, 113, 33, 0.18), rgba(226, 113, 33, 0.05));
            border-left: 4px solid var(--brand-orange);
            color: white;
        }

        .main-content {
            margin-left: 260px;
            flex: 1;
        }

        .header {
            background: var(--surface);
            padding: 18px 30px;
            box-shadow: 0 2px 16px rgba(0, 51, 102, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid var(--border-soft);
        }

        .container {
            padding: 30px;
        }

        .card-grid {
            display: grid;
            grid-template-cols: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .card {
            background: var(--surface);
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-decoration: none;
            color: var(--text-dark);
            border-top: 4px solid var(--brand-blue);
            transition: 0.2s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .logout-btn {
            background: none;
            border: none;
            color: var(--brand-orange);
            cursor: pointer;
            font-size: 16px;
            padding: 15px 25px;
            width: 100%;
            text-align: left;
        }

        .ck-content {
            white-space: pre-wrap;
            overflow-wrap: anywhere;
            word-break: break-word;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-header">KHÁNH THUẬN ADMIN</div>
        <a href="{{ route('admin.dashboard') }}" class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="fa fa-home" style="width: 25px;"></i> Bảng điều khiển
        </a>
        <a href="{{ route('admin.posts.index') }}" class="nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
            <i class="fa fa-newspaper" style="width: 25px;"></i> Bài viết
        </a>
        <a href="{{ route('admin.services.index') }}" class="nav-item {{ request()->routeIs('admin.services.*') ? 'active' : '' }}">
            <i class="fa fa-cogs" style="width: 25px;"></i> Dịch vụ
        </a>
        <a href="{{ route('admin.projects.index') }}" class="nav-item {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
            <i class="fa fa-briefcase" style="width: 25px;"></i> Dự án
        </a>

        <a href="{{ route('admin.documents.index', ['group' => 'library']) }}" class="nav-item {{ request()->query('group') == 'library' ? 'active' : '' }}">
            <i class="fa fa-book" style="width: 25px;"></i> Thư viện
        </a>

        <a href="{{ route('admin.documents.index', ['group' => 'competency']) }}" class="nav-item {{ request()->query('group') == 'competency' ? 'active' : '' }}">
            <i class="fa fa-id-card" style="width: 25px;"></i> Công bố năng lực
        </a>

        <a href="{{ route('admin.document-categories.index') }}" class="nav-item {{ request()->routeIs('admin.document-categories.*') ? 'active' : '' }}">
            <i class="fa fa-folder-open" style="width: 25px;"></i> Quản lý Thư mục
        </a>

        {{-- USER MANAGEMENT (CHỈ DÀNH CHO ADMIN) --}}
        @role('admin')
        <a href="{{ route('admin.users.index') }}" class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
            <i class="fa fa-users" style="width: 25px;"></i> Người dùng
        </a>
        @endrole

        {{-- THÊM MỤC LIÊN HỆ TẠI ĐÂY --}}
        <a href="{{ route('admin.contacts.index') }}" class="nav-item {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}" style="display: flex; align-items: center; justify-content: space-between;">
            <div>
                <i class="fa fa-envelope" style="width: 25px;"></i> Liên hệ
            </div>
            @php $newContacts = \App\Models\Contact::where('status', 'new')->count(); @endphp
            @if($newContacts > 0)
            <span style="background: #e74c3c; color: white; border-radius: 10px; padding: 2px 8px; font-size: 11px; font-weight: bold;">
                {{ $newContacts }}
            </span>
            @endif
        </a>

        <form method="POST" action="{{ route('logout') }}" style="margin-top: 50px;">
            @csrf
            <button type="submit" class="logout-btn"><i class="fa fa-sign-out-alt" style="width: 25px;"></i> Đăng xuất</button>
        </form>
    </div>

    <div class="main-content">
        <div class="header">
            <h2 style="margin:0;">Hệ thống quản trị</h2>
            <div>Xin chào, <strong>{{ Auth::user()->name }}</strong></div>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </div>

    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
</body>

</html>