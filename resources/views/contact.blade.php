@extends('layouts.app')

@section('content')
@php
$title = 'Liên hệ - Công ty Khánh Thuận';
@endphp

<section class="relative w-full h-[40vh] min-h-[300px] bg-[#003366] overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}" alt="Liên hệ Công ty Khánh Thuận" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-t from-[#003366] to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-end pb-12">
        <p class="text-[#E27121] font-bold tracking-[0.3em] uppercase mb-2">Kết nối với chúng tôi</p>
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wide">Liên Hệ & Báo Giá</h1>
    </div>
</section>

<section class="py-16 md:py-24 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 grid gap-12 lg:grid-cols-[1.2fr_1fr] items-start">

        <div class="bg-white p-8 md:p-10 rounded-2xl shadow-lg border border-gray-100">
            <h2 class="text-[#003366] text-3xl font-black uppercase mb-3">Gửi Yêu Cầu Tư Vấn</h2>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Đội ngũ kỹ sư của Công ty Khánh Thuận luôn sẵn sàng tiếp nhận yêu cầu khảo sát, lập biện pháp thi công và báo giá chi tiết cho dự án của bạn. Chúng tôi sẽ phản hồi trong vòng 24 giờ.
            </p>

            <form action="{{ route('contact.store') }}" method="POST" class="grid gap-6">
                @csrf

                {{-- Thông báo thành công --}}
                @if(session('success'))
                <div class="rounded-lg bg-green-50 border border-green-200 p-4 text-green-700 font-bold flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    {{ session('success') }}
                </div>
                @endif

                <div class="grid gap-6 md:grid-cols-2">
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-[#003366] uppercase">Họ và tên *</label>
                        <input name="name" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-700 focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all"
                            placeholder="Nhập họ tên của bạn" type="text" required>
                    </div>
                    <div class="space-y-2">
                        <label class="text-sm font-bold text-[#003366] uppercase">Số điện thoại *</label>
                        <input name="phone" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-700 focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all"
                            placeholder="Nhập số điện thoại" type="tel" required>
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#003366] uppercase">Email liên hệ</label>
                    <input name="email" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-700 focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all"
                        placeholder="Nhập địa chỉ email (không bắt buộc)" type="email">
                </div>

                <div class="space-y-2">
                    <label class="text-sm font-bold text-[#003366] uppercase">Nội dung dự án / Yêu cầu *</label>
                    <textarea name="message" rows="5" class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-gray-700 focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all resize-none"
                        placeholder="Mô tả ngắn gọn về dự án, hạng mục cần thi công hoặc yêu cầu báo giá..." required></textarea>
                </div>

                <button type="submit" class="mt-4 w-full md:w-auto inline-flex items-center justify-center gap-3 rounded-lg bg-[#003366] hover:bg-[#E27121] px-8 py-4 text-white font-black uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                    <i class="fa-solid fa-paper-plane"></i> Gửi Yêu Cầu Ngay
                </button>
            </form>
        </div>

        <div class="space-y-8">

            <div class="bg-[#003366] rounded-2xl p-8 text-white shadow-lg relative overflow-hidden">
                <div class="absolute right-0 top-0 w-32 h-32 bg-white opacity-5 rounded-full -mr-10 -mt-10"></div>

                <h3 class="text-2xl font-black uppercase mb-6 border-b border-white/20 pb-4">Thông Tin Liên Hệ</h3>

                <ul class="space-y-6">
                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E27121] flex items-center justify-center shrink-0 text-lg shadow-md">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-bold uppercase mb-1">Trụ sở chính</p>
                            <p class="font-medium leading-relaxed">Lô B13 đường Phan Hữu Ích, Phường Bảo An, Tỉnh Khánh Hòa thành Lô B13 đường Phan Huy Ích, Phường Bảo An, Tỉnh Khánh Hòa</p>
                        </div>
                    </li>

                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E27121] flex items-center justify-center shrink-0 text-lg shadow-md">
                            <i class="fa-solid fa-phone-volume"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-bold uppercase mb-1">Hotline Ban Giám Đốc</p>
                            <p class="font-black text-xl tracking-wider">0823.223.737</p>
                            <p class="text-[12px] text-gray-400 mt-1 uppercase">Giám đốc: NGUYỄN TĂNG TƯƠI</p>
                        </div>
                    </li>

                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E27121] flex items-center justify-center shrink-0 text-lg shadow-md">
                            <i class="fa-solid fa-id-card"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-bold uppercase mb-1">Mã số doanh nghiệp</p>
                            <p class="font-medium tracking-wider text-xl font-black">4500685013</p>
                        </div>
                    </li>

                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E27121] flex items-center justify-center shrink-0 text-lg shadow-md">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-bold uppercase mb-1">Thông tin thanh toán</p>
                            <p class="font-medium">Số TK: <span class="font-bold text-white">07985686868</span></p>
                            <p class="text-sm">Ngân hàng MB Bank</p>
                            <p class="text-[10px] text-gray-400 mt-1 uppercase">CTK: CONG TY CO PHAN PHAT TRIEN HA TANG KHANH THUAN</p>
                        </div>
                    </li>

                    <li class="flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-[#E27121] flex items-center justify-center shrink-0 text-lg shadow-md">
                            <i class="fa-solid fa-envelope-open-text"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-300 font-bold uppercase mb-1">Email Tiếp Nhận</p>
                            <p class="font-medium">khanhthuan.ltd@gmail.com</p>
                        </div>
                    </li>
                </ul>
            </div>

            <div class="bg-white rounded-2xl p-4 shadow-lg border border-gray-100">
                <p class="text-sm font-bold text-[#003366] uppercase tracking-widest mb-3 ml-2"><i class="fa-solid fa-map-location-dot mr-2"></i> Bản đồ chỉ đường</p>
                <div class="overflow-hidden rounded-xl border border-gray-200">
                    <iframe title="Bản đồ văn phòng Công ty Khánh Thuận" class="h-[300px] w-full"
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14902.964177573022!2d106.63412035!3d20.8037048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a70ed6a7e0a2b%3A0xc6226ec4917a4192!2zUGjDuSBMaeG7hW4sIEtp4bq_biBBbiwgSOG6o2kgUGjDsm5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1714230000000!5m2!1svi!2s"
                        style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection