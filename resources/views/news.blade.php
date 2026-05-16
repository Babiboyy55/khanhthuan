@extends('layouts.app')

@section('content')
@php
$title = 'Tin tức & Sự kiện - Công ty Khánh Thuận';

// 3 Chuyên mục tin tức chính của Công ty Khánh Thuận
$topics = [
[
'title' => 'Tiến Độ Dự Án',
'desc' => 'Cập nhật hình ảnh thực tế, tiến độ thi công từng ngày tại các công trường trọng điểm.',
'icon' => 'fa-person-digging'
],
[
'title' => 'Tin Tức Nội Bộ',
'desc' => 'Các hoạt động đào tạo an toàn lao động, kiểm định máy móc và sự kiện tập thể của công ty.',
'icon' => 'fa-users-gear'
],
[
'title' => 'Thông Báo & Tuyển Dụng',
'desc' => 'Tin tức trúng thầu mới, thông báo từ ban giám đốc và nhu cầu tuyển dụng kỹ sư, công nhân.',
'icon' => 'fa-bullhorn'
],
];
@endphp

<section class="relative w-full h-[40vh] min-h-[300px] bg-[#003366] overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}" alt="Tin tức Công ty Khánh Thuận" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-t from-[#003366] to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-end pb-12 text-center md:text-left">
        <p class="text-[#E27121] font-bold tracking-[0.3em] uppercase mb-2">Truyền Thông & Sự Kiện</p>
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wide">Tin Tức Hoạt Động</h1>
    </div>
</section>

<section class="py-12 bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 grid gap-6 md:grid-cols-3">
        @foreach ($topics as $topic)
        <div class="flex items-start gap-4 p-6 rounded-xl border border-gray-100 bg-gray-50 hover:bg-[#003366] hover:text-white transition-colors duration-300 group shadow-sm">
            <div class="w-14 h-14 shrink-0 bg-white text-[#003366] rounded-full flex items-center justify-center text-2xl shadow-sm group-hover:text-[#E27121]">
                <i class="fa-solid {{ $topic['icon'] }}"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg mb-2 uppercase group-hover:text-[#E27121]">{{ $topic['title'] }}</h3>
                <p class="text-gray-500 text-sm group-hover:text-gray-300 leading-relaxed">{{ $topic['desc'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex items-center justify-between mb-10 border-b-2 border-gray-200 pb-4">
            <h2 class="text-[#003366] text-2xl md:text-3xl font-black uppercase border-b-4 border-[#E27121] inline-block -mb-[18px] pb-3">
                Bài Viết Mới Nhất
            </h2>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse ($posts ?? [] as $post)
            <article class="bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-2xl transition duration-500 group border border-gray-100 flex flex-col">

                {{-- Khu vực Ảnh Thumbnail --}}
                <a href="{{ route('posts.show', $post->slug) }}" class="relative h-56 overflow-hidden block">
                    @if ($post->featured_image)
                    @php
                    $img = $post->featured_image;
                    if (str_starts_with($img, 'http')) {
                        $imagePath = $img;
                    } elseif (str_contains($img, 'storage/') || str_contains($img, 'images/')) {
                        $imagePath = asset($img);
                    } elseif (str_starts_with($img, 'post-featured/')) {
                        $imagePath = asset('storage/' . $img);
                    } else {
                        $imagePath = asset('images/' . $img);
                    }
                    @endphp
                    <img src="{{ $imagePath }}"
                        alt="{{ $post->title }}"
                        class="w-full h-full object-cover group-hover:scale-110 transition duration-700"
                        onerror="this.onerror=null;this.src='{{ asset('images/banner.jpg') }}';">
                    @else
                    <img src="{{ asset('images/banner.jpg') }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700 opacity-80">
                    @endif

                    <div class="absolute inset-0 bg-[#003366]/10 group-hover:bg-transparent transition duration-500"></div>

                    {{-- Badge Ngày tháng nổi lên góc trái ảnh --}}
                    <div class="absolute top-4 left-4 bg-[#E27121] text-white text-center rounded shadow-md overflow-hidden flex flex-col w-14">
                        <span class="text-xs font-bold bg-[#003366] py-1 uppercase">Th.{{ $post->created_at->format('m') }}</span>
                        <span class="text-xl font-black py-1">{{ $post->created_at->format('d') }}</span>
                    </div>
                </a>

                {{-- Khu vực Text --}}
                <div class="p-6 flex-1 flex flex-col">
                    <div class="flex items-center gap-4 text-xs text-gray-400 font-bold uppercase mb-3">
                        <span><i class="fa-solid fa-user-pen mr-1"></i> Admin</span>
                        <span><i class="fa-regular fa-folder-open mr-1"></i> Tin Tức</span>
                    </div>

                    <a href="{{ route('posts.show', $post->slug) }}">
                        <h3 class="font-black text-xl text-[#003366] mb-3 group-hover:text-[#E27121] transition-colors line-clamp-2 leading-snug">
                            {{ $post->title }}
                        </h3>
                    </a>

                    <p class="text-gray-500 text-sm leading-relaxed mb-6 flex-1 line-clamp-3">
                        {{ \Illuminate\Support\Str::limit(strip_tags($post->excerpt ?: $post->content), 150) }}
                    </p>

                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-[#E27121] font-bold text-sm hover:text-[#003366] transition-colors flex items-center gap-2 uppercase">
                            Xem chi tiết <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-2"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty

            {{-- Giao diện khi chưa có bài viết nào trong Database --}}
            <div class="col-span-full py-20 text-center bg-white rounded-xl border border-dashed border-gray-300">
                <div class="w-20 h-20 bg-gray-50 text-gray-300 rounded-full flex items-center justify-center text-4xl mx-auto mb-4">
                    <i class="fa-regular fa-newspaper"></i>
                </div>
                <h3 class="text-xl font-bold text-[#003366] mb-2">Chưa có bài viết nào</h3>
                <p class="text-gray-500">Tin tức và hoạt động của Công ty Khánh Thuận sẽ sớm được cập nhật tại đây.</p>
            </div>
            @endforelse
        </div>

        {{-- Phân trang (Nếu có cấu hình trong Controller) --}}
        @if(isset($posts) && method_exists($posts, 'hasPages') && $posts->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $posts->links() }}
        </div>
        @endif

    </div>
</section>
@endsection