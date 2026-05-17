@extends('layouts.app')

@section('content')
@php
// DATA DỊCH VỤ
$services = [
    [
        'title' => 'THI CÔNG CÔNG TRÌNH',
        'desc' => 'Thi công chuyên nghiệp các dự án giao thông, hạ tầng kỹ thuật, dân dụng và công nghiệp với cam kết chất lượng vượt trội.',
        'icon' => 'fa-helmet-safety',
    ],
    [
        'title' => 'TƯ VẤN THIẾT KẾ VÀ THẨM TRA',
        'desc' => 'Cung cấp giải pháp thiết kế tối ưu, lập dự toán và thẩm tra kỹ thuật đảm bảo tính khả thi và an toàn cho mọi dự án.',
        'icon' => 'fa-pen-ruler',
    ],
    [
        'title' => 'TƯ VẤN QUẢN LÝ DỰ ÁN VÀ TƯ VẤN GIÁM SÁT',
        'desc' => 'Kiểm soát chặt chẽ quá trình triển khai thi công, đảm bảo dự án đúng tiến độ, tối ưu chi phí và đạt tiêu chuẩn chất lượng cao nhất.',
        'icon' => 'fa-clipboard-check',
    ],
];
@endphp

<style>
    .custom-scrollbar::-webkit-scrollbar {
        height: 6px;
    }

    .custom-scrollbar::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb {
        background: #003366;
        border-radius: 10px;
        cursor: pointer;
    }

    .custom-scrollbar::-webkit-scrollbar-thumb:hover {
        background: #E27121;
    }

    html {
        scroll-behavior: smooth;
    }

    /* Hỗ trợ cuộn mượt khi bấm menu */
</style>

<section class="relative w-full h-[85vh] min-h-[600px] bg-gradient-to-br from-[#003366] via-[#004a99] to-[#002244] overflow-hidden group/banner">
    <!-- Abstract light effects for a modern look without an image -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-[20%] -right-[10%] w-[70%] h-[70%] bg-white/5 rounded-full blur-[120px] animate-pulse"></div>
        <div class="absolute -bottom-[20%] -left-[10%] w-[50%] h-[50%] bg-[#E27121]/10 rounded-full blur-[100px]"></div>
        
        <!-- Animated geometric lines -->
        <svg class="absolute inset-0 w-full h-full opacity-10" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 L100 0" stroke="white" stroke-width="0.1" fill="none" />
            <path d="M0 80 L80 0" stroke="white" stroke-width="0.1" fill="none" />
            <path d="M20 100 L100 20" stroke="white" stroke-width="0.1" fill="none" />
        </svg>
    </div>
    
    <!-- Technical pattern overlay -->
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-20"></div>

    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-center">
        <!-- Top Accent Decoration -->
        <div class="w-20 h-1.5 bg-[#E27121] mb-10 rounded-full shadow-[0_0_25px_rgba(226,113,33,0.8)]"></div>

        <div class="max-w-4xl space-y-6 drop-shadow-2xl">
            <h4 class="text-white font-black uppercase tracking-[0.4em] text-xs md:text-sm mb-2 block bg-[#E27121] inline-block px-3 py-1 rounded-sm shadow-lg">
                Infrastructure Development & Engineering
            </h4>
            
            <h1 class="text-5xl md:text-[100px] font-black text-white uppercase leading-tight tracking-tight drop-shadow-[0_5px_15px_rgba(0,0,0,0.3)]">
                UY TÍN <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#E27121] to-[#ffb88c] drop-shadow-none">CHẤT LƯỢNG</span> <br>
                <span class="flex items-center gap-6">
                    HIỆU QUẢ
                    <span class="hidden lg:block h-[2px] flex-1 bg-white/40"></span>
                </span>
            </h1>

            <p class="text-lg md:text-2xl text-gray-300 max-w-2xl leading-relaxed font-light italic border-l-4 border-[#E27121] pl-6 py-2">
                "Kiến tạo hạ tầng vững chắc, xây đắp niềm tin bền vững qua mỗi công trình."
            </p>

            <div class="flex flex-wrap gap-6 pt-8">
                <a href="#phan-du-an" class="group relative px-10 py-4 bg-[#E27121] text-white font-black uppercase tracking-widest rounded shadow-[0_10px_30px_rgba(226,113,33,0.3)] hover:shadow-[0_15px_45px_rgba(226,113,33,0.5)] hover:-translate-y-1 transition-all duration-500 overflow-hidden">
                    <span class="relative z-10">Dự án tiêu biểu</span>
                    <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-20 transition-opacity"></div>
                </a>
                <a href="/lien-he" class="px-10 py-4 bg-white/5 backdrop-blur-md border border-white/20 text-white font-black uppercase tracking-widest rounded hover:bg-white hover:text-[#001830] transition-all duration-500 hover:-translate-y-1">
                    Hợp tác ngay
                </a>
            </div>
        </div>
    </div>

    <!-- Floating Capacity Badge -->
    <div class="absolute bottom-12 right-4 md:right-12 hidden md:flex items-center gap-6 bg-white/5 backdrop-blur-2xl p-6 rounded-2xl border border-white/10 shadow-2xl">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-[#E27121]/20 flex items-center justify-center text-[#E27121]">
                <i class="fa-solid fa-award text-2xl"></i>
            </div>
            <div>
                <p class="text-white font-black text-sm uppercase leading-none">Chuyên nghiệp</p>
                <p class="text-gray-400 text-[10px] uppercase tracking-widest mt-1">Đạt chuẩn TCVN</p>
            </div>
        </div>
        <div class="h-10 w-px bg-white/10"></div>
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-[#0088cc]/20 flex items-center justify-center text-[#0088cc]">
                <i class="fa-solid fa-microscope text-2xl"></i>
            </div>
            <div>
                <p class="text-white font-black text-sm uppercase leading-none">Hiện đại</p>
                <p class="text-gray-400 text-[10px] uppercase tracking-widest mt-1">Công nghệ hàng đầu</p>
            </div>
        </div>
    </div>
</section>



@php
    // Lấy file mới nhất trong chuyên mục "Hồ sơ năng lực" cho nút bấm
    $latestProfile = \App\Models\Document::where('category', 'ho-so-nang-luc')->latest()->first();
    $profileUrl = $latestProfile ? route('documents.show', $latestProfile->id) : url('/thu-vien/ho-so-nang-luc');
@endphp

<section id="phan-gioi-thieu" class="py-20 bg-white font-['Be_Vietnam_Pro']">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-start">
            
            <!-- Cột trái: Nội dung chính -->
            <div class="lg:col-span-7 space-y-8">
                <div>
                    <h4 class="text-[#0088cc] font-bold uppercase tracking-[0.2em] text-sm mb-3">Về Công ty Khánh Thuận</h4>
                    <h2 class="text-[#1e293b] text-3xl md:text-4xl font-black uppercase leading-tight mb-6">
                        Nền tảng vững chắc cho mọi công trình
                    </h2>
                    
                    <div class="space-y-6 text-gray-600 text-justify leading-relaxed">
                        <p>
                            Được thành lập từ năm 2026, <strong>Công ty Cổ phần Phát triển Hạ tầng Khánh Thuận</strong> tự hào là đơn vị tiên phong trong lĩnh vực đầu tư, thi công và phát triển hạ tầng đô thị, giao thông và công nghiệp. Chúng tôi mang đến các giải pháp thi công toàn diện, đáp ứng những tiêu chuẩn khắt khe nhất về kỹ thuật và chất lượng.
                        </p>
                        <p>
                            Với tiềm lực tài chính vững mạnh cùng đội ngũ kỹ sư, chuyên gia giàu kinh nghiệm, Khánh Thuận cam kết kiến tạo nên những công trình vượt thời gian, đảm bảo an toàn tuyệt đối, đúng tiến độ và đóng góp thiết thực vào sự phát triển bền vững của xã hội.
                        </p>
                    </div>
                </div>

                <!-- Box Năng lực trọng tâm -->
                <div class="bg-[#f0f9ff] p-6 md:p-8 rounded-xl border border-[#e0f2fe] relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1.5 h-full bg-[#0088cc]"></div>
                    <h3 class="text-[#003366] font-black uppercase text-sm md:text-base mb-6 flex items-center gap-3">
                        <span class="w-8 h-[2px] bg-[#0088cc]"></span>
                        Lĩnh vực hoạt động trọng tâm
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8">
                        <div class="flex items-center gap-3 text-gray-700 font-medium text-sm md:text-base">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Thi công công trình giao thông</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium text-sm md:text-base">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Xây dựng dân dụng & công nghiệp</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium text-sm md:text-base">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Phát triển hạ tầng đô thị</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-700 font-medium text-sm md:text-base">
                            <i class="fa-solid fa-circle-check text-[#0088cc]"></i>
                            <span>Tư vấn & Quản lý dự án</span>
                        </div>
                    </div>
                </div>

                <a href="{{ $profileUrl }}" class="inline-flex items-center gap-3 bg-[#0088cc] hover:bg-[#003366] text-white font-bold uppercase py-3.5 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-sm md:text-base">
                    Chi tiết Hồ sơ Năng lực <i class="fa-solid fa-arrow-right-long"></i>
                </a>
            </div>

            <!-- Cột phải: Các thẻ tiêu chí -->
            <div class="lg:col-span-5 space-y-6">
                <div class="bg-gray-50 p-7 md:p-8 rounded-lg border-l-4 border-[#0088cc] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Năng lực thi công</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Sở hữu hệ thống máy móc, thiết bị cơ giới hiện đại cùng công nghệ thi công tiên tiến, đảm bảo đáp ứng tiến độ và chất lượng cho những dự án quy mô lớn.
                    </p>
                </div>

                <div class="bg-gray-50 p-7 md:p-8 rounded-lg border-l-4 border-[#E27121] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Đội ngũ chuyên môn</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Quy tụ đội ngũ kỹ sư, kiến trúc sư và công nhân kỹ thuật lành nghề, am hiểu sâu sắc các quy chuẩn xây dựng và luôn tận tâm với từng chi tiết của công trình.
                    </p>
                </div>

                <div class="bg-gray-50 p-7 md:p-8 rounded-lg border-l-4 border-[#334155] shadow-sm hover:shadow-md transition-shadow">
                    <h3 class="text-[#1e293b] font-black uppercase text-base mb-3">Uy tín & Pháp lý</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Hệ thống quản lý chất lượng đạt chuẩn, minh bạch trong mọi hồ sơ pháp lý và quy trình triển khai, mang lại sự an tâm tuyệt đối cho các Chủ đầu tư và Đối tác.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="phan-dich-vu" class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h4 class="text-[#E27121] font-bold uppercase tracking-widest text-sm mb-2">Dịch Vụ Cốt Lõi</h4>
            <h2 class="text-[#003366] text-3xl md:text-4xl font-black uppercase">LĨNH VỰC HOẠT ĐỘNG</h2>
            <div class="w-24 h-1 bg-[#E27121] mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach ($services as $service)
            <div class="bg-white p-10 text-center border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-2 transition duration-300 group">
                <div class="w-20 h-20 mx-auto bg-[#003366] text-white rounded-full flex items-center justify-center text-3xl mb-6 group-hover:bg-[#E27121] transition-colors">
                    <i class="fa-solid {{ $service['icon'] }}"></i>
                </div>
                <h3 class="text-xl font-black text-[#003366] uppercase mb-4 tracking-wide">{{ $service['title'] }}</h3>
                <p class="text-gray-600">{{ $service['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-20 bg-white overflow-hidden">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Thông tin văn phòng -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-[#0088cc] text-2xl md:text-3xl font-black uppercase tracking-tight mb-4">
                        VĂN PHÒNG TẠI KHÁNH HÒA
                    </h2>
                    <div class="w-16 h-1 bg-[#0088cc]"></div>
                </div>
                
                <div class="space-y-8">
                    <!-- Địa chỉ -->
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-white shadow-md flex items-center justify-center text-[#0088cc]">
                            <i class="fa-solid fa-map-location-dot text-xl"></i>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-black text-[#1e293b] text-sm uppercase mb-1">Địa chỉ</h4>
                            <p class="text-gray-500 text-sm leading-relaxed max-w-sm">
                                Lô B13 đường Phan Hữu Ích, Phường Bảo An, Tỉnh Khánh Hòa
                            </p>
                        </div>
                    </div>

                    <!-- Số điện thoại -->
                    <div class="flex items-start gap-5">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-white shadow-md flex items-center justify-center text-[#0088cc]">
                            <i class="fa-solid fa-phone-volume text-xl"></i>
                        </div>
                        <div class="pt-1">
                            <h4 class="font-black text-[#1e293b] text-sm uppercase mb-1">Số điện thoại</h4>
                            <p class="text-gray-500 text-sm font-bold">0823.223.737</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hình ảnh bản đồ -->
            <div class="relative flex justify-center md:justify-end">
                <img src="{{ asset('images/Group-635707.png') }}" 
                     alt="Văn phòng Khánh Hòa" 
                     class="w-full max-w-[550px] h-auto object-contain transform hover:scale-105 transition-transform duration-700">
            </div>
        </div>
    </div>
</section>

<section id="phan-du-an" class="py-20 bg-white border-t border-gray-100">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex flex-wrap items-end justify-between mb-12 gap-4">
            <div>
                <h4 class="text-[#E27121] font-bold uppercase tracking-widest text-sm mb-2">Hồ Sơ Năng Lực</h4>
                <h2 class="text-[#003366] text-3xl md:text-4xl font-black uppercase">DỰ ÁN TIÊU BIỂU</h2>
            </div>
            <a href="/du-an" class="text-[#003366] font-bold hover:text-[#E27121] flex items-center gap-2 transition">
                Xem toàn bộ dự án <i class="fa-solid fa-arrow-right-long"></i>
            </a>
        </div>

        <div class="relative group" data-carousel>
            <button type="button" class="absolute -left-5 top-1/2 -translate-y-1/2 z-10 h-12 w-12 rounded-full bg-[#003366] text-white shadow-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-[#E27121]" data-carousel-prev>
                <i class="fa-solid fa-chevron-left"></i>
            </button>

            <button type="button" class="absolute -right-5 top-1/2 -translate-y-1/2 z-10 h-12 w-12 rounded-full bg-[#003366] text-white shadow-xl flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 hover:bg-[#E27121]" data-carousel-next>
                <i class="fa-solid fa-chevron-right"></i>
            </button>

            <div class="flex flex-nowrap gap-6 overflow-x-auto snap-x snap-mandatory custom-scrollbar cursor-grab scroll-smooth pb-6" data-carousel-track>
                @foreach ($projectsHome as $project)
                <div class="flex-none w-[85%] md:w-[400px] snap-start group/item cursor-pointer" onclick="window.location='{{ route('projects.show', $project->id) }}'">
                    <div class="relative overflow-hidden rounded-t-lg">
                        @php
                            $img = $project->image;
                            if ($img) {
                                if (str_starts_with($img, 'http')) {
                                    $imagePath = $img;
                                } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                    $imagePath = asset($img);
                                } elseif (str_starts_with($img, 'project-featured/')) {
                                    $imagePath = asset('storage/' . $img);
                                } else {
                                    $imagePath = asset('images/' . $img);
                                }
                            } else {
                                $imagePath = asset('images/Picture5.png');
                            }
                        @endphp
                        <img src="{{ $imagePath }}"
                            alt="{{ $project->title }}"
                            class="w-full h-[250px] object-cover group-hover/item:scale-110 transition duration-700 pointer-events-none">
                        <div class="absolute top-4 left-4 bg-[#E27121] text-white text-xs font-bold px-3 py-1 uppercase rounded-sm shadow">
                            @php
                            $catNames = [
                            'bridge' => 'Cầu đường',
                            'factory' => 'Công Nghiệp',
                            'urban' => 'Hạ Tầng / Đô thị',
                            ];
                            @endphp
                            {{ $catNames[$project->category] ?? ($project->category ?? 'Dự án') }}
                        </div>
                    </div>
                    <div class="bg-[#003366] text-white p-5 rounded-b-lg border-t-4 border-[#E27121]">
                        <h3 class="font-bold text-lg uppercase truncate" title="{{ $project->title }}">{{ $project->title }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section id="phan-tin-tuc" class="py-20 bg-gray-50 border-t border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-16">
            <h4 class="text-[#E27121] font-bold uppercase tracking-widest text-sm mb-2">Cập nhật mới nhất</h4>
            <h2 class="text-[#003366] text-3xl md:text-4xl font-black uppercase">TIN TỨC HOẠT ĐỘNG</h2>
            <div class="w-24 h-1 bg-[#E27121] mx-auto mt-6"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @if(isset($latestPosts) && $latestPosts->count() > 0)
            {{-- Tin nổi bật (Tin đầu tiên) --}}
            <div class="bg-white shadow-sm border border-gray-100 group overflow-hidden cursor-pointer" onclick="window.location.href='{{ route('posts.show', $latestPosts[0]->slug) }}'">
                <div class="overflow-hidden">
                    @php
                        $img = $latestPosts[0]->featured_image;
                        if ($img) {
                            if (str_starts_with($img, 'http')) {
                                $imagePath = $img;
                            } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                $imagePath = asset($img);
                            } elseif (str_starts_with($img, 'post-featured/')) {
                                $imagePath = asset('storage/' . $img);
                            } else {
                                $imagePath = asset('images/' . $img);
                            }
                        } else {
                            $imagePath = asset('images/Picture7.png');
                        }
                    @endphp
                    <img src="{{ $imagePath }}" class="w-full h-[300px] object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6 md:p-8">
                    <div class="text-[#E27121] text-sm font-bold mb-3"><i class="fa-regular fa-calendar-days mr-2"></i> {{ $latestPosts[0]->created_at->format('d/m/Y') }}</div>
                    <h3 class="text-2xl font-bold text-[#003366] mb-4 hover:text-[#E27121] transition">{{ $latestPosts[0]->title }}</h3>
                    <p class="text-gray-600 line-clamp-3">{{ $latestPosts[0]->excerpt ?? Str::limit(strip_tags($latestPosts[0]->content), 150) }}</p>
                </div>
            </div>

            {{-- Các tin tiếp theo --}}
            <div class="flex flex-col gap-8">
                @foreach($latestPosts->skip(1)->take(2) as $post)
                <div class="flex bg-white shadow-sm border border-gray-100 group overflow-hidden cursor-pointer h-full" onclick="window.location.href='{{ route('posts.show', $post->slug) }}'">
                    <div class="w-2/5 overflow-hidden">
                        @php
                            $img = $post->featured_image;
                            if ($img) {
                                if (str_starts_with($img, 'http')) {
                                    $imagePath = $img;
                                } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                    $imagePath = asset($img);
                                } elseif (str_starts_with($img, 'post-featured/')) {
                                    $imagePath = asset('storage/' . $img);
                                } else {
                                    $imagePath = asset('images/' . $img);
                                }
                            } else {
                                $imagePath = asset('images/Picture5.png');
                            }
                        @endphp
                        <img src="{{ $imagePath }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="w-3/5 p-5 flex flex-col justify-center">
                        <div class="text-[#E27121] text-xs font-bold mb-2"><i class="fa-regular fa-calendar-days mr-2"></i> {{ $post->created_at->format('d/m/Y') }}</div>
                        <h3 class="text-lg font-bold text-[#003366] mb-2 hover:text-[#E27121] transition line-clamp-2">{{ $post->title }}</h3>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="col-span-1 md:col-span-2 text-center py-10 text-gray-500">
                Chưa có tin tức nào.
            </div>
            @endif
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousels = document.querySelectorAll('[data-carousel]');

        carousels.forEach(carousel => {
            const track = carousel.querySelector('[data-carousel-track]');
            const btnPrev = carousel.querySelector('[data-carousel-prev]');
            const btnNext = carousel.querySelector('[data-carousel-next]');

            if (!track) return;

            const updateButtons = () => {
                if (!btnPrev || !btnNext) return;
                const maxScrollLeft = track.scrollWidth - track.clientWidth;

                if (track.scrollLeft <= 5) {
                    btnPrev.classList.add('hidden');
                } else {
                    btnPrev.classList.remove('hidden');
                }

                if (Math.ceil(track.scrollLeft) >= maxScrollLeft - 5) {
                    btnNext.classList.add('hidden');
                } else {
                    btnNext.classList.remove('hidden');
                }
            };

            if (btnPrev) {
                btnPrev.addEventListener('click', () => {
                    track.scrollBy({
                        left: -(track.clientWidth * 0.8),
                        behavior: 'smooth'
                    });
                });
            }

            if (btnNext) {
                btnNext.addEventListener('click', () => {
                    track.scrollBy({
                        left: track.clientWidth * 0.8,
                        behavior: 'smooth'
                    });
                });
            }

            let isDown = false;
            let startX;
            let scrollLeft;

            track.addEventListener('mousedown', (e) => {
                isDown = true;
                track.classList.add('cursor-grabbing');
                track.classList.remove('cursor-grab');
                track.style.scrollBehavior = 'auto';
                startX = e.pageX - track.offsetLeft;
                scrollLeft = track.scrollLeft;
            });

            track.addEventListener('mouseleave', () => {
                isDown = false;
                track.classList.remove('cursor-grabbing');
                track.classList.add('cursor-grab');
                track.style.scrollBehavior = 'smooth';
            });

            track.addEventListener('mouseup', () => {
                isDown = false;
                track.classList.remove('cursor-grabbing');
                track.classList.add('cursor-grab');
                track.style.scrollBehavior = 'smooth';
            });

            track.addEventListener('mousemove', (e) => {
                if (!isDown) return;
                e.preventDefault();
                const x = e.pageX - track.offsetLeft;
                const walk = (x - startX) * 2;
                track.scrollLeft = scrollLeft - walk;
            });

            track.addEventListener('scroll', updateButtons);
            window.addEventListener('resize', updateButtons);
            updateButtons();
        });
    });
</script>
@endsection