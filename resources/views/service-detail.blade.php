@extends('layouts.app')

@section('content')
@php
$features = [
    'Khảo sát hiện trường và thu thập dữ liệu',
    'Phân tích và đánh giá kết quả chuyên môn',
    'Báo cáo kỹ thuật rõ ràng, dễ hiểu',
    'Đề xuất giải pháp tối ưu cho công trình',
];
@endphp

<section class="mx-auto w-full max-w-6xl px-5 py-16">
    <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr]">
        <div class="space-y-5">
            <p class="text-sm uppercase tracking-[0.3em] text-black/50">Dịch vụ</p>
            <h1 class="text-4xl md:text-5xl font-display">{{ $service->title }}</h1>
            <p class="text-black/70">{{ $service->summary }}</p>
            <div class="flex flex-wrap gap-4">
                <a href="/lien-he" class="inline-flex items-center justify-center rounded-full bg-brand px-6 py-3 text-white font-semibold">
                    Yêu cầu báo giá
                </a>
                <a href="/dich-vu" class="inline-flex items-center justify-center rounded-full border border-black/20 px-6 py-3 font-semibold">
                    Quay lại dịch vụ
                </a>
            </div>
        </div>
        
        <div class="rounded-[32px] bg-stone p-6 shadow-soft">
            {{-- ĐỔI TÊN BIẾN TỪ featured_image THÀNH image --}}
            @if ($service->image)
                @php
                    $img = $service->image;
                    if (str_starts_with($img, 'http')) {
                        $path = $img;
                    } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                        $path = asset($img);
                    } elseif (str_starts_with($img, 'service-featured/')) {
                        $path = asset('storage/' . $img);
                    } else {
                        $path = asset('images/' . $img);
                    }
                @endphp
                <div class="aspect-[4/3] rounded-3xl overflow-hidden">
                    <img src="{{ $path }}" onerror="this.src='{{ asset('images/logo.jpg') }}'" alt="{{ $service->title }}" class="h-full w-full object-cover">
                </div>
            @else
                <div class="aspect-[4/3] rounded-3xl bg-[linear-gradient(135deg,_#f3d3bf,_#f9f2e7)] grid place-items-center">
                    <div class="text-center space-y-2">
                        <p class="font-display text-2xl">Mô tả dự án</p>
                        <p class="text-sm text-black/60">Hình ảnh minh họa dịch vụ</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @if ($service->description)
    <div class="mt-10 rounded-3xl border border-black/10 bg-white p-6 text-black/70 prose max-w-none" style="white-space: pre-wrap; overflow-wrap: anywhere; word-break: break-word;">
        {!! $service->description !!}
    </div>
    @endif

    <div class="mt-12 grid gap-6 md:grid-cols-2">
        @foreach ($features as $feature)
        <div class="rounded-3xl border border-black/10 bg-white p-6 transition hover:shadow-md">
            <h3 class="font-display text-xl">{{ $feature }}</h3>
            <p class="mt-2 text-sm text-black/60">Thông tin chi tiết về phạm vi công việc và tài liệu liên quan.</p>
        </div>
        @endforeach
    </div>
</section>
@endsection