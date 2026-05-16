@extends('layouts.app')

@section('content')
@php
$title = 'Chính sách bảo mật';
@endphp

<section class="mx-auto w-full max-w-4xl px-5 py-16">
    <div class="space-y-4">
        <p class="text-sm uppercase tracking-[0.3em] text-black/50">Thông tin</p>
        <h1 class="text-4xl md:text-5xl font-display">Chính sách bảo mật</h1>
        <p class="text-black/70">Nội dung chính sách bảo mật mẫu, có thể cập nhật theo quy định thực tế.</p>
    </div>
    <div class="prose max-w-none mt-10 text-black/70">
        <h2>Thu thập dữ liệu</h2>
        <p>Chúng tôi thu thập thông tin cần thiết để hỗ trợ dịch vụ và liên hệ khách hàng.</p>
        <h2>Sử dụng thông tin</h2>
        <p>Thông tin chỉ được sử dụng cho mục đích tư vấn, báo giá và chăm sóc khách hàng.</p>
        <h2>Bảo mật</h2>
        <p>Chúng tôi cam kết bảo mật thông tin và không chia sẻ cho bên thứ ba.</p>
    </div>
</section>
@endsection