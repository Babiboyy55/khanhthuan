@extends('layouts.app')

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4 border-b border-gray-200">
        <div class="mx-auto w-full max-w-7xl px-4 flex items-center gap-2 text-sm">
            <a href="/" class="text-gray-500 hover:text-[#003366]">Trang chủ</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
            <a href="/tin-tuc" class="text-gray-500 hover:text-[#003366]">Tin tức</a>
            <i class="fa-solid fa-chevron-right text-[10px] text-gray-400"></i>
            <span class="text-[#003366] font-bold truncate">{{ $post->title }}</span>
        </div>
    </div>

    <section class="mx-auto w-full max-w-7xl px-4 py-12 md:py-16">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            
            <!-- Cột Trái: Nội dung bài viết -->
            <div class="lg:col-span-8">
                <div class="space-y-6">
                    <h1 class="text-3xl md:text-4xl font-black text-[#003366] leading-tight">{{ $post->title }}</h1>
                    
                    <div class="flex items-center gap-6 text-sm text-gray-500 pb-6 border-b border-gray-100">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-calendar-days text-[#E27121]"></i>
                            {{ optional($post->updated_at)->format('d/m/Y') ?? '16/03/2026' }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-eye text-[#E27121]"></i>
                            {{ $post->views }} lượt xem
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-folder-open text-[#E27121]"></i>
                            Tin tức hoạt động
                        </div>
                    </div>

                    @if ($post->featured_image)
                        @php
                            $img = $post->featured_image;
                            if (str_starts_with($img, 'http')) {
                                $src = $img;
                            } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                                $src = asset($img);
                            } elseif (str_starts_with($img, 'post-featured/')) {
                                $src = asset('storage/' . $img);
                            } else {
                                $src = asset('images/' . $img);
                            }
                        @endphp
                        <img src="{{ $src }}" alt="{{ $post->title }}" class="w-full rounded-xl object-cover shadow-md"
                            onerror="this.onerror=null;this.src='{{ asset('images/logo.jpg') }}';">
                    @endif

                    <div class="prose max-w-none mt-10 text-gray-700 leading-relaxed text-justify">
                        @if ($post->excerpt)
                            <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-[#E27121] mb-8 italic text-lg text-gray-800">
                                {{ $post->excerpt }}
                            </div>
                        @endif

                        <div class="content-body text-lg" style="white-space: pre-wrap; overflow-wrap: anywhere; word-break: break-word;">
                            {!! $post->content !!}
                        </div>
                    </div>

                    <div class="mt-12 pt-8 border-t border-gray-100 flex justify-between items-center">
                        <a href="{{ url('/tin-tuc') }}" class="inline-flex items-center gap-2 text-[#003366] font-bold hover:text-[#E27121] transition">
                            <i class="fa-solid fa-arrow-left-long"></i> Quay lại góc tin tức
                        </a>
                        
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-bold text-gray-400">Chia sẻ:</span>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#0084FF] hover:text-white transition"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500 hover:bg-[#00acee] hover:text-white transition"><i class="fa-brands fa-twitter"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột Phải: Sidebar -->
            <div class="lg:col-span-4 space-y-10">
                
                <!-- Mục 1: Dịch vụ nổi bật -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-[#003366] px-5 py-4">
                        <h3 class="text-white font-black uppercase text-sm tracking-widest flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-[#E27121]"></span>
                            Dịch vụ nổi bật
                        </h3>
                    </div>
                    <div class="p-4 space-y-4">
                        @php
                            $services = [
                                ['title' => 'Thí nghiệm chuyên ngành xây dựng', 'link' => '/dich-vu'],
                                ['title' => 'Kiểm định chất lượng công trình', 'link' => '/dich-vu'],
                                ['title' => 'Tư vấn giám sát thi công', 'link' => '/dich-vu'],
                                ['title' => 'Khảo sát địa chất công trình', 'link' => '/dich-vu'],
                            ];
                        @endphp
                        @foreach($services as $sv)
                        <a href="{{ $sv['link'] }}" class="flex items-center gap-3 text-sm font-bold text-gray-700 hover:text-[#E27121] transition py-2 border-b border-gray-50 last:border-0 group">
                            <i class="fa-solid fa-chevron-right text-[10px] text-gray-300 group-hover:translate-x-1 transition-transform"></i>
                            {{ $sv['title'] }}
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Mục 2: Tài liệu mới nhất -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-[#003366] px-5 py-4">
                        <h3 class="text-white font-black uppercase text-sm tracking-widest flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-[#E27121]"></span>
                            Tài liệu mới nhất
                        </h3>
                    </div>
                    <div class="p-4 space-y-5">
                        @php
                            $latestDocs = \App\Models\Document::latest()->take(4)->get();
                        @endphp
                        @foreach($latestDocs as $doc)
                        <a href="{{ route('documents.show', $doc->id) }}" class="flex gap-4 group">
                            <div class="w-10 h-10 shrink-0 bg-red-50 text-red-500 rounded flex items-center justify-center group-hover:bg-red-500 group-hover:text-white transition-colors">
                                <i class="fa-solid fa-file-pdf text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-xs font-bold text-gray-800 line-clamp-2 leading-snug group-hover:text-[#003366]">{{ $doc->title }}</h4>
                                <p class="text-[10px] text-gray-400 mt-1 uppercase">{{ $doc->category }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

                <!-- Mục 3: Tin tức mới nhất -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="bg-[#003366] px-5 py-4">
                        <h3 class="text-white font-black uppercase text-sm tracking-widest flex items-center gap-3">
                            <span class="w-1.5 h-4 bg-[#E27121]"></span>
                            Tin tức mới nhất
                        </h3>
                    </div>
                    <div class="p-4 space-y-6">
                        @php
                            $latestPosts = \App\Models\Post::where('id', '!=', $post->id)->latest()->take(4)->get();
                        @endphp
                        @foreach($latestPosts as $lp)
                        <a href="{{ route('posts.show', $lp->id) }}" class="flex gap-4 group">
                            <div class="w-20 h-16 shrink-0 overflow-hidden rounded-lg">
                                <img src="{{ asset($lp->featured_image ? (str_contains($lp->featured_image, 'storage') ? $lp->featured_image : 'images/'.$lp->featured_image) : 'images/logo.jpg') }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition duration-500" 
                                     onerror="this.src='{{ asset('images/logo.jpg') }}'">
                            </div>
                            <div class="flex-1">
                                <h4 class="text-[13px] font-bold text-gray-800 line-clamp-2 leading-snug group-hover:text-[#E27121] transition">{{ $lp->title }}</h4>
                                <p class="text-[10px] text-gray-400 mt-1">{{ optional($lp->updated_at)->format('d/m/Y') }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection