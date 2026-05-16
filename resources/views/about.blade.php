@extends('layouts.app')

@section('content')
@php
    $title = 'Về chúng tôi - Công ty Khánh Thuận';
    
    // Lấy file mới nhất trong chuyên mục "Hồ sơ năng lực"
    $latestProfile = \App\Models\Document::where('category', 'ho-so-nang-luc')->latest()->first();
    $profileUrl = $latestProfile ? route('documents.show', $latestProfile->id) : url('/thu-vien/ho-so-nang-luc');
@endphp

<section class="relative w-full h-[40vh] min-h-[300px] bg-[#003366] overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}" alt="Về Công ty Khánh Thuận" class="absolute inset-0 w-full h-full object-cover opacity-40">
    <div class="absolute inset-0 bg-gradient-to-t from-[#003366] to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-end pb-12">
        <p class="text-[#E27121] font-bold tracking-[0.3em] uppercase mb-2">Hồ Sơ Năng Lực</p>
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wide">Về Chúng Tôi</h1>
    </div>
</section>

<section class="py-16 md:py-24 bg-white font-['Be_Vietnam_Pro']">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <!-- Cột trái: Thông tin chi tiết -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <h4 class="text-[#0088cc] font-bold uppercase tracking-[0.2em] text-sm mb-3">Về chúng tôi</h4>
                    <h2 class="text-[#1e293b] text-3xl md:text-4xl font-black uppercase leading-tight mb-6">
                        CÔNG TY CỔ PHẦN PHÁT TRIỂN HẠ TẦNG KHÁNH THUẬN
                    </h2>
                    
                    <div class="space-y-6 text-gray-600 text-justify leading-relaxed">
                        <p>
                            <strong>Công ty Cổ phần Phát triển Hạ tầng Khánh Thuận</strong> tự hào là một trong những đơn vị tiên phong trong lĩnh vực đầu tư, xây dựng và phát triển kết cấu hạ tầng. Chúng tôi mang sứ mệnh kiến tạo những dự án chất lượng cao, đóng góp vào sự phát triển bền vững của cộng đồng.
                        </p>
                        <p>
                            Công ty có trụ sở chính tại <strong>Lô B13 đường Phan Hữu Ích, Phường Bảo An, Tỉnh Khánh Hòa, Việt Nam</strong>. Với vốn điều lệ <strong>8.000.000.000 VNĐ</strong> (Tám tỷ đồng chẵn), chúng tôi sở hữu nguồn lực tài chính vững mạnh để không ngừng mở rộng quy mô hoạt động và đầu tư vào công nghệ thi công tiên tiến.
                        </p>
                        <p>
                            Với đội ngũ chuyên gia, kỹ sư giàu kinh nghiệm cùng hệ thống trang thiết bị cơ giới hiện đại, Khánh Thuận luôn cam kết đáp ứng các tiêu chuẩn kỹ thuật khắt khe nhất, mang lại sự an tâm tuyệt đối cho các Chủ đầu tư và Đối tác.
                        </p>
                    </div>
                </div>

                <!-- Box Lĩnh vực hoạt động -->
                <div class="bg-[#f0f9ff] p-6 md:p-8 rounded-xl border border-[#e0f2fe] relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-[#0088cc]"></div>
                    <h3 class="text-[#003366] font-black uppercase text-sm md:text-base mb-6 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-[#0088cc]"></span>
                        Lĩnh vực hoạt động trọng tâm
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        <div class="flex items-center gap-3 text-gray-700 font-medium">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Thi công công trình giao thông</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Xây dựng dân dụng & công nghiệp</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Phát triển hạ tầng đô thị</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Tư vấn & Quản lý dự án</span>
                        </div>
                    </div>
                </div>

                <a href="{{ $profileUrl }}" class="inline-flex items-center gap-3 bg-[#0088cc] hover:bg-[#003366] text-white font-bold uppercase py-4 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    Chi tiết Hồ sơ Năng lực <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <!-- Cột phải: Các thẻ tính năng -->
            <div class="lg:col-span-5 space-y-6">
                <!-- Thẻ 1 -->
                <div class="bg-gray-50 p-8 rounded-lg border-l-4 border-[#0088cc] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Năng lực thi công</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Sở hữu hệ thống máy móc, thiết bị cơ giới hiện đại cùng công nghệ thi công tiên tiến, đảm bảo đáp ứng tiến độ và chất lượng cho những dự án quy mô lớn.
                    </p>
                </div>

                <!-- Thẻ 2 -->
                <div class="bg-gray-50 p-8 rounded-lg border-l-4 border-[#E27121] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Đội ngũ chuyên môn</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Quy tụ đội ngũ kỹ sư, kiến trúc sư và công nhân kỹ thuật lành nghề, am hiểu sâu sắc các quy chuẩn xây dựng và luôn tận tâm với từng chi tiết của công trình.
                    </p>
                </div>

                <!-- Thẻ 3 -->
                <div class="bg-gray-50 p-8 rounded-lg border-l-4 border-[#334155] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Uy tín & Pháp lý</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Hệ thống quản lý chất lượng đạt chuẩn, minh bạch trong mọi hồ sơ pháp lý và quy trình triển khai, mang lại sự an tâm tuyệt đối cho các Chủ đầu tư và Đối tác.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="py-20 md:py-32 bg-[#003366] text-white overflow-hidden relative">
    <!-- Abstract Background -->
    <div class="absolute right-0 top-0 w-full lg:w-1/2 h-full bg-gradient-to-l from-[#002244] to-transparent opacity-80 z-0"></div>

    <div class="max-w-7xl mx-auto px-4 relative z-10 grid lg:grid-cols-2 gap-16 items-center">
        <!-- Cột trái: Nội dung Text -->
        <div>
            <h4 class="text-[#E27121] font-bold uppercase tracking-widest text-sm mb-3 flex items-center gap-2">
                <span class="w-6 h-px bg-[#E27121]"></span> Tiềm Lực Nội Tại
            </h4>
            <h2 class="text-3xl md:text-5xl font-black uppercase mb-10 leading-tight">
                Năng Lực Nhân Sự <br> & Trang Thiết Bị
            </h2>
            
            <div class="space-y-8">
                <!-- Điểm 1 -->
                <div class="flex gap-5 items-start group">
                    <div class="w-14 h-14 bg-white/5 backdrop-blur-md rounded-xl shrink-0 flex items-center justify-center text-2xl text-[#E27121] shadow-lg border border-white/10 group-hover:bg-[#E27121] group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1 group-hover:shadow-[#E27121]/30 group-hover:shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <i class="fa-solid fa-user-tie relative z-10"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3 text-white group-hover:text-[#E27121] transition-colors">Nhân sự chuyên môn cao</h3>
                        <p class="text-gray-300 leading-relaxed text-sm md:text-base">Đội ngũ kỹ sư khảo sát, kiểm định và thí nghiệm viên dày dặn kinh nghiệm, được đào tạo chuyên sâu và có đầy đủ chứng chỉ hành nghề, đảm bảo tính chính xác và trung thực trong từng số liệu kỹ thuật.</p>
                    </div>
                </div>
                
                <!-- Điểm 2 -->
                <div class="flex gap-5 items-start group">
                    <div class="w-14 h-14 bg-white/5 backdrop-blur-md rounded-xl shrink-0 flex items-center justify-center text-2xl text-[#E27121] shadow-lg border border-white/10 group-hover:bg-[#E27121] group-hover:text-white transition-all duration-300 transform group-hover:-translate-y-1 group-hover:shadow-[#E27121]/30 group-hover:shadow-xl relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <i class="fa-solid fa-microscope relative z-10"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold mb-3 text-white group-hover:text-[#E27121] transition-colors">Trang thiết bị hiện đại</h3>
                        <p class="text-gray-300 leading-relaxed text-sm md:text-base">Sở hữu hệ thống máy thí nghiệm chuyên ngành xây dựng (LAS-XD), thiết bị khảo sát địa chất, máy toàn đạc điện tử, GPS RTK và các thiết bị đo lường hiện trường được hiệu chuẩn định kỳ.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột phải: Khối Đồ Họa Abstract Glassmorphism UI thay thế cho ảnh -->
        <div class="relative w-full h-[400px] lg:h-[500px] flex items-center justify-center mt-8 lg:mt-0">
            <!-- Glow background -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[300px] h-[300px] bg-[#E27121] rounded-full blur-[100px] opacity-20 animate-pulse"></div>
            <div class="absolute top-1/4 right-1/4 w-[250px] h-[250px] bg-[#0088cc] rounded-full blur-[90px] opacity-20"></div>

            <!-- Vòng tròn Radar quay -->
            <div class="relative z-10 w-64 h-64 md:w-80 md:h-80 rounded-full border border-white/10 flex items-center justify-center">
                <div class="absolute inset-0 border-[2px] border-dashed border-[#E27121]/40 rounded-full animate-[spin_25s_linear_infinite]"></div>
                <div class="absolute inset-6 border border-[#0088cc]/50 rounded-full animate-[spin_15s_linear_infinite_reverse]"></div>
                
                <!-- Core Center Element -->
                <div class="w-32 h-32 md:w-40 md:h-40 bg-gradient-to-br from-[#003366] to-[#001122] rounded-full shadow-[0_0_50px_rgba(226,113,33,0.2)] border border-[#E27121]/50 flex items-center justify-center flex-col z-20 relative overflow-hidden group">
                    <div class="absolute inset-0 bg-[#E27121]/10 transform translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    <i class="fa-solid fa-shield-halved text-4xl md:text-5xl text-[#E27121] mb-2 relative z-10 drop-shadow-[0_0_10px_rgba(226,113,33,0.5)]"></i>
                    <span class="text-[10px] md:text-xs font-black uppercase tracking-[0.2em] text-gray-300 relative z-10">Cam kết</span>
                </div>

                <!-- Floating Badge 1: LAS-XD -->
                <div class="absolute -top-4 -right-4 md:-right-8 bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-xl shadow-2xl animate-[bounce_4s_infinite]">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-500/20 rounded-full flex items-center justify-center text-green-400 ring-1 ring-green-500/50">
                            <i class="fa-solid fa-check-double"></i>
                        </div>
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase mb-0.5 tracking-wider">Đạt chuẩn</p>
                            <p class="text-white font-black tracking-widest text-lg">LAS-XD</p>
                        </div>
                    </div>
                </div>

                <!-- Floating Badge 2: Accuracy -->
                <div class="absolute bottom-4 -left-8 md:-left-16 bg-white/10 backdrop-blur-xl border border-white/20 p-4 lg:p-5 rounded-xl shadow-2xl animate-[bounce_5s_infinite_1s]">
                    <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">Độ chính xác</p>
                    <div class="flex items-end gap-1 mb-2">
                        <span class="text-4xl font-black text-[#E27121] leading-none">99.9</span>
                        <span class="text-xl font-bold text-[#E27121] leading-none">%</span>
                    </div>
                    <div class="w-full h-1.5 bg-gray-700/50 rounded-full overflow-hidden">
                        <div class="w-[99%] h-full bg-gradient-to-r from-[#E27121] to-yellow-400 rounded-full shadow-[0_0_10px_#E27121]"></div>
                    </div>
                </div>

                <!-- Floating Badge 3: TCVN/ISO -->
                <div class="absolute -bottom-8 -right-4 md:right-4 bg-white/10 backdrop-blur-xl border border-white/20 p-4 rounded-xl shadow-2xl animate-[bounce_6s_infinite_0.5s]">
                    <div class="flex items-center gap-5">
                        <div class="text-center">
                            <span class="block text-2xl font-black text-white drop-shadow-md">TCVN</span>
                            <span class="block text-[9px] text-gray-400 uppercase tracking-widest mt-1">Tiêu chuẩn VN</span>
                        </div>
                        <div class="w-px h-10 bg-white/20"></div>
                        <div class="text-center">
                            <span class="block text-2xl font-black text-[#0088cc] drop-shadow-[0_0_8px_#0088cc]">ISO</span>
                            <span class="block text-[9px] text-gray-400 uppercase tracking-widest mt-1">Quốc tế</span>
                        </div>
                    </div>
                </div>

                <!-- Floating Particles -->
                <div class="absolute top-1/4 left-4 w-2 h-2 bg-[#E27121] rounded-full shadow-[0_0_10px_#E27121] animate-ping"></div>
                <div class="absolute bottom-1/4 right-8 w-3 h-3 bg-[#0088cc] rounded-full shadow-[0_0_12px_#0088cc] animate-pulse"></div>
            </div>
        </div>
    </div>
</section>



<section class="py-16 md:py-20 bg-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h4 class="text-[#E27121] font-bold uppercase tracking-widest text-sm mb-2">Hồ sơ pháp lý</h4>
        <h2 class="text-[#003366] text-3xl font-black uppercase mb-6">Chứng Chỉ Năng Lực Xây Dựng</h2>
        <p class="text-gray-600 mb-8 max-w-2xl mx-auto leading-relaxed">
            Công ty Khánh Thuận tự hào đáp ứng đầy đủ các tiêu chuẩn khắt khe nhất của Nhà nước về điều kiện năng lực hoạt động xây dựng trong các lĩnh vực giao thông, thủy lợi và dân dụng.
        </p>

        <a href="{{ $profileUrl }}" class="inline-flex items-center gap-3 bg-[#003366] hover:bg-[#E27121] text-white font-bold uppercase py-4 px-10 rounded shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <i class="fa-solid fa-file-pdf text-2xl"></i> Xem & Tải Hồ Sơ Năng Lực (PDF)
        </a>
    </div>
</section>
@endsection