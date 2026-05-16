@extends('layouts.app')

@section('content')
@php
$title = 'Đối tác - Khách hàng';
$partners = [
'Fuji Bắc Giang',
'Coma18',
'Vinaco',
'An Phát',
'Up Shine Lighting',
'BOVIET',
'CDC LEASING',
'Nhiều nhà thầu và chủ đầu tư khác',
];
@endphp

<section class="mx-auto w-full max-w-6xl px-5 py-16">
    <div class="space-y-4">
        <p class="text-sm uppercase tracking-[0.3em] text-black/50">Mạng lưới hợp tác</p>
        <h1 class="text-4xl md:text-5xl font-display">Đối tác - Khách hàng</h1>
        <p class="text-black/70 max-w-3xl">
            Công ty Khánh Thuận đồng hành cùng các chủ đầu tư, nhà thầu xây dựng và đơn vị sản xuất trong các dự án hạ tầng,
            công nghiệp và dân dụng. Chúng tôi cam kết cung cấp dữ liệu khảo sát, thí nghiệm và kiểm định chính xác để hỗ trợ
            ra quyết định kỹ thuật an toàn, hiệu quả.
        </p>
    </div>

    <div class="mt-10 grid gap-5 md:grid-cols-2 lg:grid-cols-4">
        @foreach ($partners as $partner)
        <div class="rounded-2xl border border-black/10 bg-white p-5 text-center shadow-soft">
            <p class="font-semibold">{{ $partner }}</p>
        </div>
        @endforeach
    </div>

    <div class="mt-12 rounded-3xl border border-black/10 bg-stone p-6">
        <h2 class="text-2xl font-display">Bạn cần xác minh năng lực trước khi hợp tác?</h2>
        <p class="mt-3 text-black/70">
            Chúng tôi sẵn sàng cung cấp hồ sơ năng lực, phạm vi chứng chỉ LAS-XD 1109, thiết bị hiện có và danh mục dự án
            tương đồng theo yêu cầu của gói thầu.
        </p>
        <a href="/lien-he" class="mt-5 inline-flex items-center justify-center rounded-full bg-brand px-6 py-3 text-white font-semibold">
            Liên hệ nhận hồ sơ năng lực
        </a>
    </div>
</section>
@endsection