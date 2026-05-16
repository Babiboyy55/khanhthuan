@extends('layouts.app')

@section('content')
<div class="bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Nội dung chính -->
            <div class="lg:col-span-3">
                <nav class="flex text-gray-500 text-xs mb-6 overflow-hidden whitespace-nowrap" aria-label="Breadcrumb">
                    <a href="/" class="hover:text-[#E27121] flex-shrink-0">Trang chủ</a>
                    <span class="mx-2">»</span>
                    <a href="/thu-vien/{{ $document->category }}" class="hover:text-[#E27121] flex-shrink-0">Thư viện</a>
                    <span class="mx-2">»</span>
                    <span class="text-gray-800 font-medium truncate">{{ $document->title }}</span>
                </nav>

                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
                    <h1 class="text-2xl font-black text-[#003366] mb-4 leading-tight">{{ $document->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-sm text-gray-500 mb-8 border-b border-gray-50 pb-6">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-calendar-days text-[#E27121]"></i>
                            <span>{{ $document->created_at->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-file-export text-[#E27121]"></i>
                            <span class="uppercase font-bold">{{ $document->file_extension }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-weight-hanging text-[#E27121]"></i>
                            <span>{{ $document->file_size }}</span>
                        </div>
                    </div>

                    <!-- Trình xem PDF -->
                    <div class="bg-gray-900 rounded-lg overflow-hidden shadow-inner mb-8" style="height: 800px; position: relative;">
                        @if($document->file_extension == 'pdf')
                            <iframe src="{{ asset('storage/' . $document->file_path) }}#toolbar=0" width="100%" height="100%" style="border: none;"></iframe>
                            
                            <!-- Overlay to prevent right click if needed, but standard iframe is fine -->
                        @else
                            <div class="flex flex-col items-center justify-center h-full p-10 text-center bg-gray-50">
                                <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center shadow-sm mb-6">
                                    @if($document->file_extension == 'xlsx' || $document->file_extension == 'xls' || $document->file_extension == 'xlsm')
                                        <i class="fa-solid fa-file-excel text-4xl text-[#107c41]"></i>
                                    @else
                                        <i class="fa-solid fa-file-word text-4xl text-blue-600"></i>
                                    @endif
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 mb-2">Xem trước không khả dụng</h3>
                                <p class="text-gray-500 max-w-md mx-auto mb-8">Định dạng file <strong>.{{ strtoupper($document->file_extension) }}</strong> không hỗ trợ xem trực tiếp trên trình duyệt.</p>
                                <a href="{{ route('document.download', $document->id) }}" class="inline-flex items-center gap-3 px-8 py-4 bg-[#003366] text-white font-bold rounded-lg hover:bg-[#E27121] transition-all shadow-lg transform hover:-translate-y-1">
                                    <i class="fa-solid fa-download"></i> TẢI XUỐNG ĐỂ XEM
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-wrap items-center justify-between gap-4 bg-gray-50 p-4 rounded-lg">
                        <div class="text-gray-600 text-sm italic">
                            Nếu gặp lỗi không xem được, bạn có thể tải file về máy.
                        </div>
                        <a href="{{ route('document.download', $document->id) }}" class="inline-flex items-center gap-2 px-6 py-3 bg-[#E27121] text-white font-bold rounded-lg hover:bg-[#c9631c] transition-colors shadow">
                            <i class="fa-solid fa-download"></i> TẢI VỀ MÁY
                        </a>
                    </div>
                </div>

                <!-- Tài liệu cùng chuyên mục -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-black text-[#003366] uppercase mb-6 flex items-center gap-3">
                        <span class="w-2 h-6 bg-[#E27121] rounded-full"></span>
                        Tài liệu cùng chuyên mục
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($otherDocuments as $other)
                        <a href="{{ route('documents.show', $other->id) }}" class="group flex items-center gap-4 p-4 rounded-lg border border-transparent hover:border-gray-100 hover:bg-gray-50 transition-all">
                            <div class="w-12 h-12 flex-shrink-0 bg-gray-100 rounded flex items-center justify-center group-hover:bg-white transition-colors">
                                @if($other->file_extension == 'pdf')
                                    <i class="fa-solid fa-file-pdf text-red-600 text-xl"></i>
                                @elseif($other->file_extension == 'xlsx' || $other->file_extension == 'xls')
                                    <i class="fa-solid fa-file-excel text-[#107c41] text-xl"></i>
                                @else
                                    <i class="fa-solid fa-file-word text-blue-600 text-xl"></i>
                                @endif
                            </div>
                            <div class="overflow-hidden">
                                <h4 class="text-sm font-bold text-gray-800 group-hover:text-[#E27121] transition-colors truncate">{{ $other->title }}</h4>
                                <p class="text-xs text-gray-500 mt-1 uppercase">{{ $other->file_extension }} • {{ $other->file_size }}</p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-6 space-y-6">
                    <!-- Dịch vụ -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-[#003366] p-4 text-white font-bold uppercase text-sm tracking-wider">
                            Dịch vụ tiêu biểu
                        </div>
                        <div class="p-2">
                            @php
                                $services = \App\Models\Service::where('status', 'published')->limit(5)->get();
                            @endphp
                            @foreach($services as $sv)
                            <a href="{{ route('services.show', $sv->slug) }}" class="flex items-center gap-3 p-3 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#E27121] transition-all border-b border-gray-50 last:border-0 rounded-md">
                                <i class="fa-solid {{ $sv->icon ?? 'fa-chevron-right' }} text-xs opacity-50"></i>
                                <span class="font-medium">{{ $sv->title }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Bài viết mới -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="bg-[#003366] p-4 text-white font-bold uppercase text-sm tracking-wider">
                            Tin tức mới nhất
                        </div>
                        <div class="p-4 space-y-4">
                            @php
                                $posts = \App\Models\Post::where('status', 'published')->latest()->limit(5)->get();
                            @endphp
                            @foreach($posts as $p)
                            <a href="{{ route('posts.show', $p->slug) }}" class="group block">
                                <h4 class="text-xs font-bold text-gray-800 group-hover:text-[#E27121] transition-colors line-clamp-2 leading-relaxed">{{ $p->title }}</h4>
                                <span class="text-[10px] text-gray-400 mt-1 block">{{ $p->created_at->format('d/m/Y') }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
