<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Công ty Khánh Thuận' }}</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo.jpg') }}">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=be-vietnam-pro:300,400,500,600,700,800&family=fraunces:400,500,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.querySelector('[data-menu-toggle]');
        const menu = document.querySelector('[data-menu-target]');

        if (toggle && menu) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }
    });
</script>

<body class="bg-gray-50 text-gray-800 font-['Be_Vietnam_Pro']">
    <a href="#main-content" class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:bg-white focus:px-4 focus:py-2 focus:rounded-full">
        Bỏ qua nội dung điều hướng
    </a>

        <!-- Top Bar -->
        <div class="bg-[#003366] text-white py-2 hidden md:block border-b border-white/10">
            <div class="mx-auto max-w-7xl px-4 flex justify-end items-center gap-8 text-[11px] font-bold uppercase tracking-[0.15em]">
                <span class="flex items-center gap-2 opacity-90">
                    <i class="fa-solid fa-location-dot text-[#E27121]"></i>
                    Bảo An, Khánh Hòa
                </span>
                <a href="mailto:khanhthuan.ltd@gmail.com" class="flex items-center gap-2 hover:text-[#E27121] transition-colors opacity-90 hover:opacity-100">
                    <i class="fa-solid fa-envelope text-[#E27121]"></i>
                    khanhthuan.ltd@gmail.com
                </a>
                <a href="tel:0823223737" class="flex items-center gap-2 hover:text-[#E27121] transition-colors bg-white/10 px-3 py-1 rounded-full">
                    <i class="fa-solid fa-phone-volume text-[#E27121]"></i>
                    0823.223.737
                </a>
            </div>
        </div>

        <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-sm shadow-lg border-b border-gray-100">
            <div class="mx-auto w-full max-w-7xl px-4 flex items-center justify-between py-3 md:py-4">

                <!-- Logo & Branding -->
                <a href="/" class="flex items-center gap-4 md:gap-6 group">
                    <div class="relative">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Công ty Khánh Thuận" class="h-14 md:h-20 w-auto object-contain transition-all duration-500 group-hover:drop-shadow-xl">
                        <div class="absolute -inset-2 bg-[#E27121]/5 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    </div>
                    
                    <div class="flex flex-col items-start justify-center border-l-[3px] border-[#E27121] pl-4 md:pl-5 group-hover:border-[#003366] transition-colors duration-500">
                        <span class="text-[9px] md:text-[10px] font-bold text-[#003366]/60 uppercase tracking-[0.4em] mb-1">CÔNG TY CỔ PHẦN</span>
                        <h1 class="flex flex-col text-[15px] md:text-[21px] font-black uppercase leading-[1.1] tracking-tight text-[#003366] group-hover:drop-shadow-md transition-all duration-500">
                            <span>PHÁT TRIỂN HẠ TẦNG</span>
                            <span>KHÁNH THUẬN</span>
                        </h1>
                    </div>
                </a>

                <!-- Desktop Navigation -->
                <nav class="hidden lg:flex items-center gap-6 text-[14px] font-black uppercase tracking-tight text-[#003366]">
                    <a href="/" class="relative group py-2">
                        Trang chủ
                        <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                    </a>
                        
                        <!-- Menu Giới thiệu đa cấp -->
                        <!-- Menu Giới thiệu -->
                        <a href="/gioi-thieu" class="relative group py-2">
                            Giới thiệu
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>

                        <!-- Menu Công bố thông tin năng lực -->
                        <div class="relative group py-4">
                            <button class="flex items-center gap-1 hover:text-[#E27121] transition-colors duration-200 uppercase outline-none font-bold">
                                Công bố năng lực
                                <svg class="w-2.5 h-2.5 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div class="absolute top-full left-0 mt-0 invisible opacity-0 group-hover:visible group-hover:opacity-100 bg-white shadow-2xl border-t-2 border-[#E27121] rounded-b-lg py-2 min-w-[320px] z-50 transition-all duration-300">
                                <a href="/thu-vien/giay-phep-kinh-doanh" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] border-b border-gray-50 transition-colors font-semibold normal-case">
                                    Giấy đăng ký kinh doanh
                                </a>
                                <a href="/thu-vien/cong-bo-nang-luc" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] border-b border-gray-50 transition-colors font-semibold normal-case">
                                    Bản công bố thông tin năng lực hoạt động
                                </a>
                                <a href="/thu-vien/chung-nhan-du-dieu-kien" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] border-b border-gray-50 transition-colors font-semibold normal-case">
                                    Giấy chứng nhận đủ điều kiện hoạt động
                                </a>
                                <a href="/thu-vien/hieu-chuan-thiet-bi" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] border-b border-gray-50 transition-colors font-semibold normal-case">
                                    Giấy chứng nhận hiệu chuẩn thiết bị
                                </a>
                                <a href="/thu-vien/danh-muc-thiet-bi" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] border-b border-gray-50 transition-colors font-semibold normal-case">
                                    Danh mục máy móc, thiết bị
                                </a>
                                <a href="/thu-vien/danh-sach-can-bo" class="block px-6 py-3 text-[#003366] hover:bg-gray-50 hover:text-[#E27121] transition-colors font-semibold normal-case">
                                    Danh sách cán bộ
                                </a>
                            </div>
                        </div>

                        <a href="/dich-vu" class="relative group py-2">
                            Dịch vụ
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/du-an" class="relative group py-2">
                            Dự án
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/tin-tuc" class="relative group py-2">
                            Tin tức
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>

                        <a href="/thu-vien" class="relative group py-2">
                            Thư viện
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                        <a href="/lien-he" class="relative group py-2">
                            Liên hệ
                            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#E27121] transition-all duration-300 group-hover:w-full"></span>
                        </a>
                    </nav>

                    <button class="lg:hidden p-2 text-[#003366]" data-menu-toggle>
                        <i class="fa-solid fa-bars text-2xl"></i>
                    </button>
                </div>

            <!-- Mobile Navigation -->
            <div id="mobile-nav" class="lg:hidden hidden border-t border-gray-100 bg-white shadow-inner" data-menu-target>
                <div class="px-5 py-4 flex flex-col gap-4 text-sm font-bold uppercase tracking-wider text-[#003366]">
                    <a href="/" class="hover:text-[#E27121]">Trang chủ</a>
                    <a href="/gioi-thieu" class="hover:text-[#E27121]">Giới thiệu</a>
                    <div class="flex flex-col gap-3">
                        <span class="text-[#E27121] border-b border-gray-100 pb-1">Công bố năng lực</span>
                        <div class="flex flex-col gap-3 pl-4 text-xs">
                            <a href="/thu-vien/giay-phep-kinh-doanh" class="hover:text-[#E27121]">Giấy đăng ký kinh doanh</a>
                            <a href="/thu-vien/cong-bo-nang-luc" class="hover:text-[#E27121]">Bản công bố thông tin năng lực</a>
                            <a href="/thu-vien/chung-nhan-du-dieu-kien" class="hover:text-[#E27121]">Giấy chứng nhận đủ điều kiện</a>
                            <a href="/thu-vien/hieu-chuan-thiet-bi" class="hover:text-[#E27121]">Giấy chứng nhận hiệu chuẩn</a>
                            <a href="/thu-vien/danh-muc-thiet-bi" class="hover:text-[#E27121]">Danh mục thiết bị</a>
                            <a href="/thu-vien/danh-sach-can-bo" class="hover:text-[#E27121]">Danh sách cán bộ</a>
                        </div>
                    </div>
                    <a href="/dich-vu" class="hover:text-[#E27121]">Dịch vụ</a>
                    <a href="/du-an" class="hover:text-[#E27121]">Dự án</a>
                    <a href="/tin-tuc" class="hover:text-[#E27121]">Tin tức</a>
                    <a href="/thu-vien" class="hover:text-[#E27121]">Thư viện</a>
                    <a href="/lien-he" class="hover:text-[#E27121]">Liên hệ</a>
                    <div class="pt-4 border-t border-gray-100 flex items-center gap-3 text-[#E27121]">
                        <i class="fa-solid fa-phone-volume"></i>
                        0823.223.737
                    </div>
                </div>
            </div>
        </header>

        <main id="main-content" class="flex-1">
            @yield('content')
        </main>

        <footer class="bg-[#002244] text-white pt-16 pb-8 relative overflow-hidden font-['Be_Vietnam_Pro']">
            <!-- Họa tiết trang trí -->
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                <i class="fa-solid fa-building-shield text-[300px]"></i>
            </div>

            <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12 relative z-10">
                <!-- Cột 1: Giới thiệu & Logo -->
                <div class="space-y-6">
                    <div class="bg-white p-3 inline-block rounded-lg shadow-xl">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Công ty Khánh Thuận" class="h-16 w-auto object-contain">
                    </div>
                    <p class="text-gray-400 text-sm leading-relaxed max-w-sm italic">
                        "Uy tín – Chất lượng – Hiệu quả. Công ty Khánh Thuận đồng hành cùng sự phát triển bền vững của Quý khách hàng."
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#E27121] transition-all duration-300">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#E27121] transition-all duration-300">
                            <i class="fa-brands fa-youtube"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-full bg-white/5 flex items-center justify-center hover:bg-[#E27121] transition-all duration-300">
                            <i class="fa-solid fa-envelope"></i>
                        </a>
                    </div>
                </div>

                <!-- Cột 2: Thông tin liên hệ -->
                <div class="space-y-6">
                    <h4 class="text-lg font-black uppercase tracking-widest border-l-4 border-[#E27121] pl-4">Thông tin liên hệ</h4>
                    <div class="space-y-5">
                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 shrink-0 rounded-lg bg-[#E27121]/20 flex items-center justify-center text-[#E27121] group-hover:bg-[#E27121] group-hover:text-white transition-all">
                                <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Địa chỉ trụ sở</p>
                                <p class="text-[13px] leading-relaxed text-gray-300">
                                    Lô B13 đường Phan Hữu Ích, Phường Bảo An, Tỉnh Khánh Hòa, Việt Nam
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 shrink-0 rounded-lg bg-[#E27121]/20 flex items-center justify-center text-[#E27121] group-hover:bg-[#E27121] group-hover:text-white transition-all">
                                <i class="fa-solid fa-phone-volume"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Hotline tư vấn</p>
                                <p class="text-sm text-gray-300 font-black tracking-widest">0823.223.737</p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 shrink-0 rounded-lg bg-[#E27121]/20 flex items-center justify-center text-[#E27121] group-hover:bg-[#E27121] group-hover:text-white transition-all">
                                <i class="fa-solid fa-id-card"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Mã số doanh nghiệp</p>
                                <p class="text-[13px] text-gray-300">
                                    4500685013
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-4 group">
                            <div class="w-10 h-10 shrink-0 rounded-lg bg-[#E27121]/20 flex items-center justify-center text-[#E27121] group-hover:bg-[#E27121] group-hover:text-white transition-all">
                                <i class="fa-solid fa-credit-card"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 uppercase font-bold mb-1">Tài khoản ngân hàng</p>
                                <p class="text-[13px] text-gray-300">
                                    Số TK: <span class="text-white font-bold">111624678668</span> <br>
                                    VietinBank - CN Kiến An
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cột 3: Bản đồ Google Maps -->
                <div class="space-y-6">
                    <h4 class="text-lg font-black uppercase tracking-widest border-l-4 border-[#E27121] pl-4">Vị trí trên bản đồ</h4>
                    <div class="rounded-xl overflow-hidden shadow-2xl border-2 border-white/5 h-[220px]">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14902.964177573022!2d106.63412035!3d20.8037048!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x314a70ed6a7e0a2b%3A0xc6226ec4917a4192!2zUGjDuSBMaeG7hW4sIEtp4bq_biBBbiwgSOG6o2kgUGjDsm5nLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1714230000000!5m2!1svi!2s" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>

            <!-- Bản quyền -->
            <div class="max-w-7xl mx-auto px-4 mt-16 pt-8 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-4 text-xs text-gray-500">
                <p>&copy; 2026 Công ty Khánh Thuận. All rights reserved.</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-white transition">Chính sách bảo mật</a>
                    <a href="#" class="hover:text-white transition">Điều khoản sử dụng</a>
                </div>
            </div>
        </footer>
        <!-- Nút liên hệ nổi -->
        <div class="fixed bottom-6 right-6 z-50 flex flex-col gap-3">
            <!-- Messenger -->
            <a href="https://m.me/yourpageid" target="_blank" 
               class="w-11 h-11 md:w-12 md:h-12 bg-[#0084FF] rounded-full flex items-center justify-center text-white shadow-2xl hover:scale-110 transition-all duration-300 group relative">
                <i class="fa-brands fa-facebook-messenger text-xl md:text-2xl"></i>
                <span class="absolute right-full mr-4 bg-white text-[#0084FF] text-[10px] font-black uppercase px-3 py-2 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none border border-gray-100">
                    Chat Messenger
                </span>
            </a>

            <!-- Zalo -->
            <a href="https://zalo.me/0823223737" target="_blank" 
               class="w-11 h-11 md:w-12 md:h-12 bg-[#0068FF] rounded-full flex items-center justify-center text-white shadow-2xl hover:scale-110 transition-all duration-300 group relative overflow-hidden">
                <img src="{{ asset('images/zalooo.jpg') }}" class="w-full h-full object-cover" alt="Zalo">
                <span class="absolute right-full mr-4 bg-white text-[#0068FF] text-[10px] font-black uppercase px-3 py-2 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none border border-gray-100">
                    Chat Zalo
                </span>
            </a>

            <!-- Điện thoại -->
            <a href="tel:0823223737" 
               class="w-11 h-11 md:w-12 md:h-12 bg-[#E27121] rounded-full flex items-center justify-center text-white shadow-2xl hover:scale-110 transition-all duration-300 group relative ring-4 ring-[#E27121]/20 animate-pulse">
                <i class="fa-solid fa-phone text-lg md:text-xl"></i>
                <span class="absolute right-full mr-4 bg-white text-[#E27121] text-[10px] font-black uppercase px-3 py-2 rounded-lg shadow-xl opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none border border-gray-100">
                    0823.223.737
                </span>
            </a>
        </div>
    </div>
</body>

</html>