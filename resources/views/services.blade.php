@extends('layouts.app')

@section('content')
@php
$title = 'Lĩnh vực hoạt động - Công ty Khánh Thuận';

// Danh sách chi tiết 15 dịch vụ kinh doanh từ Giấy phép
$detailedServices = [
    'Tư vấn Thiết kế, Giám sát và Khảo sát địa chất - địa hình.',
    'Đo đạc bản đồ, thăm dò địa chất và nguồn nước.',
    'Kiểm định, đánh giá chất lượng và Thí nghiệm vật liệu xây dựng.',
    'Thí nghiệm xác định các chỉ tiêu cơ lý của Đất, Đá, Nền móng.',
    'Tư vấn Bảo vệ môi trường và Quan trắc các chỉ tiêu môi trường.',
    'Xây dựng nhà các loại (Nhà ở và công trình dân dụng).',
    'Xây dựng công trình Giao thông (Đường sắt, Đường bộ).',
    'Xây dựng công trình Thủy lợi, Thủy điện.',
    'Xây dựng công trình Công nghiệp và Hạ tầng khu công nghiệp.',
    'Xây dựng công trình Điện, Cấp thoát nước và Viễn thông.',
    'Phá dỡ và Chuẩn bị mặt bằng thi công công trình.',
    'Lắp đặt hệ thống Điện, Cấp thoát nước và Điều hòa không khí.',
    'Hoàn thiện công trình và các hoạt động xây dựng chuyên dụng khác.'
];
@endphp

<section class="relative w-full h-[45vh] min-h-[350px] bg-[#003366] overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}" alt="Dịch vụ Công ty Khánh Thuận" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-t from-[#003366] to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-center items-center text-center pt-10">
        <p class="text-[#E27121] font-bold tracking-[0.3em] uppercase mb-4 border-b-2 border-[#E27121] inline-block pb-1">Hệ Sinh Thái Dịch Vụ</p>
        <h1 class="text-4xl md:text-6xl font-black text-white uppercase tracking-wide leading-tight">
            Giải Pháp Toàn Diện <br> Cho Mọi Công Trình
        </h1>
    </div>
</section>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-[#003366] text-3xl md:text-4xl font-black uppercase mb-4">Lĩnh Vực Hoạt Động Cốt Lõi</h2>
            <p class="text-gray-600 max-w-3xl mx-auto text-lg">Công ty Khánh Thuận đóng vai trò là Tổng thầu cung cấp hệ sinh thái khép kín từ khâu cung ứng vật tư, thiết bị, trực tiếp thi công đến kiểm định chất lượng công trình.</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2">
            @forelse ($services as $service)
            <div class="flex flex-col md:flex-row bg-white rounded-xl overflow-hidden shadow-lg border border-gray-100 hover:shadow-2xl hover:border-[#003366]/30 transition duration-500 group cursor-pointer" onclick="window.location.href='{{ route('services.show', $service->slug) }}'">
                <div class="w-full md:w-2/5 h-48 md:h-auto overflow-hidden relative">
                    @php
                        $img = $service->image;
                        if ($img) {
                            if (str_starts_with($img, 'http')) {
                                $imagePath = $img;
                            } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                $imagePath = asset($img);
                            } elseif (str_starts_with($img, 'service-featured/')) {
                                $imagePath = asset('storage/' . $img);
                            } else {
                                $imagePath = asset('images/' . $img);
                            }
                        } else {
                            $imagePath = asset('images/banner.jpg');
                        }
                    @endphp
                    <img src="{{ $imagePath }}" onerror="this.src='{{ asset('images/logo.jpg') }}'" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute inset-0 bg-[#003366]/20 group-hover:bg-transparent transition duration-500"></div>
                </div>
                <div class="w-full md:w-3/5 p-6 md:p-8 flex flex-col justify-center">
                    <div class="w-12 h-12 bg-[#003366]/10 text-[#003366] rounded-lg flex items-center justify-center text-2xl mb-4 group-hover:bg-[#E27121] group-hover:text-white transition-colors">
                        <i class="fa-solid {{ $service->icon ?? 'fa-building-shield' }}"></i>
                    </div>
                    <h3 class="text-xl font-black text-[#003366] uppercase mb-3">{{ $service->title }}</h3>
                    <p class="text-gray-600 leading-relaxed">{{ Str::limit(strip_tags($service->summary ?? $service->description), 120) }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center text-gray-500 py-10">
                Đang cập nhật dịch vụ...
            </div>
            @endforelse
        </div>
    </div>
</section>

<section class="py-20 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center gap-4 mb-10">
            <div class="w-2 h-10 bg-[#E27121]"></div>
            <h2 class="text-[#003366] text-2xl md:text-3xl font-black uppercase tracking-wide">Danh Mục Dịch Vụ Chi Tiết</h2>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-8 gap-y-4">
            @foreach ($detailedServices as $detail)
            <div class="flex items-start gap-3 bg-white p-4 rounded-lg shadow-sm border border-gray-100 hover:border-[#E27121] transition-colors">
                <div class="mt-0.5 text-[#E27121] shrink-0">
                    <i class="fa-solid fa-circle-check"></i>
                </div>
                <p class="text-gray-700 font-medium">{{ $detail }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 bg-[#003366] text-white relative overflow-hidden">
    <div class="absolute left-0 bottom-0 w-[500px] h-[500px] bg-white opacity-5 rounded-full -ml-40 -mb-40 pointer-events-none"></div>
    <div class="max-w-4xl mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl font-black uppercase mb-4">Triển Khai Dự Án Cùng Công ty Khánh Thuận</h2>
        <p class="text-gray-300 mb-8 text-lg">Khảo sát tận nơi - Báo giá minh bạch - Cam kết tiến độ</p>
        <a href="/lien-he" class="inline-flex items-center gap-3 bg-[#E27121] hover:bg-orange-600 text-white font-bold uppercase py-4 px-10 rounded shadow-xl transition transform hover:-translate-y-1">
            <i class="fa-solid fa-phone-volume text-xl"></i> Yêu cầu tư vấn & báo giá
        </a>
    </div>
</section>
@endsection