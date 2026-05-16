@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4 border-b border-gray-200">
        <div class="mx-auto w-full max-w-7xl px-4 flex items-center gap-2 text-sm">
            <a href="/" class="text-gray-500 hover:text-[#003366]">Trang chủ</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
            <a href="/du-an" class="text-gray-500 hover:text-[#003366]">Dự án</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
            <span class="text-[#003366] font-bold truncate">{{ $project->title }}</span>
        </div>
    </div>

    <section class="mx-auto w-full max-w-7xl px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Cột Trái: Nội dung dự án -->
            <div class="lg:col-span-8">
                <div class="space-y-6">
                    <h1 class="text-3xl md:text-4xl font-black text-[#003366] leading-tight uppercase">{{ $project->title }}</h1>
                    
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 pb-6 border-b border-gray-100 text-sm">
                        <div class="space-y-1">
                            <p class="text-gray-400 uppercase font-bold text-[10px]">Lĩnh vực</p>
                            <p class="font-bold text-[#003366]">
                                @php
                                    $catNames = [
                                        'bridge' => 'Cầu đường',
                                        'factory' => 'Công Nghiệp',
                                        'urban' => 'Hạ Tầng / Đô thị',
                                    ];
                                @endphp
                                {{ $catNames[$project->category] ?? ($project->category ?? 'Xây dựng') }}
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-400 uppercase font-bold text-[10px]">Năm thực hiện</p>
                            <p class="font-bold text-[#003366]">{{ $project->year ?? '2024' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-400 uppercase font-bold text-[10px]">Địa điểm</p>
                            <p class="font-bold text-[#003366]">{{ $project->location ?? 'Việt Nam' }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-gray-400 uppercase font-bold text-[10px]">Trạng thái</p>
                            <p class="font-bold text-green-600">Hoàn thành</p>
                        </div>
                    </div>

                    @php
                        $img = $project->featured_image;
                        if ($img) {
                            if (str_starts_with($img, 'http')) {
                                $src = $img;
                            } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                $src = asset($img);
                            } elseif (str_starts_with($img, 'project-featured/')) {
                                $src = asset('storage/' . $img);
                            } else {
                                $src = asset('images/' . $img);
                            }
                        } else {
                            $src = asset('images/logo.jpg');
                        }
                    @endphp
                    <img src="{{ $src }}" alt="{{ $project->title }}" class="w-full rounded-xl object-cover shadow-md"
                        onerror="this.onerror=null;this.src='{{ asset('images/logo.jpg') }}';">

                    <div class="prose max-w-none mt-10 text-gray-700 leading-relaxed text-justify">
                        <h3 class="text-xl font-bold text-[#003366] mb-4">Chi tiết dự án</h3>
                        <div class="content-body text-lg" style="white-space: pre-wrap; overflow-wrap: anywhere; word-break: break-word;">
                            {!! $project->description !!}
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100">
                        <a href="{{ url('/du-an') }}" class="inline-flex items-center gap-2 text-[#003366] font-bold hover:text-[#E27121] transition">
                            <i class="fa-solid fa-arrow-left-long"></i> Xem tất cả dự án
                        </a>
                    </div>
                </div>
            </div>

            <!-- Cột Phải: Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                
                <!-- Mục 1: Dự án khác -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-[#003366] px-5 py-4">
                        <h3 class="text-white font-black uppercase text-sm tracking-widest flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-[#E27121]"></span>
                            Dự án liên quan
                        </h3>
                    </div>
                    <div class="p-4 space-y-6">
                        @foreach($relatedProjects as $rp)
                        <a href="{{ route('projects.show', $rp->id) }}" class="flex gap-4 group">
                            <div class="w-20 h-16 shrink-0 overflow-hidden rounded-lg">
                                <img src="{{ asset($rp->featured_image ? (str_contains($rp->featured_image, 'storage') ? $rp->featured_image : 'images/'.$rp->featured_image) : 'images/logo.jpg') }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                                     onerror="this.src='{{ asset('images/logo.jpg') }}'">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[13px] font-bold text-gray-800 line-clamp-2 leading-snug group-hover:text-[#E27121] transition">{{ $rp->title }}</h4>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase">{{ $rp->category }} - {{ $rp->year }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Mục 2: Liên hệ tư vấn -->
                <div class="bg-gradient-to-br from-[#003366] to-[#002244] p-8 rounded-2xl text-white relative overflow-hidden group">
                    <div class="absolute top-0 right-0 opacity-10 -rotate-12 translate-x-4 -translate-y-4 group-hover:rotate-0 transition-transform duration-700">
                        <i class="fa-solid fa-helmet-safety text-8xl"></i>
                    </div>
                    <h3 class="text-xl font-black mb-4 relative z-10">Bạn cần tư vấn giải pháp xây dựng?</h3>
                    <p class="text-gray-300 text-sm mb-6 relative z-10 leading-relaxed">Công ty Khánh Thuận sẵn sàng hỗ trợ bạn với các giải pháp kiểm định và thí nghiệm chuyên nghiệp nhất.</p>
                    <a href="/lien-he" class="inline-block bg-[#E27121] text-white px-6 py-3 rounded-lg font-bold uppercase text-xs tracking-widest hover:bg-white hover:text-[#003366] transition-all relative z-10 shadow-lg">Liên hệ ngay</a>
                </div>

            </div>
        </div>
    </section>
@endsection
