@extends('layouts.app')

@section('content')
@php
    $title = 'Thư viện Tài liệu - Công ty Khánh Thuận';
@endphp

<section class="relative w-full h-[35vh] min-h-[250px] bg-[#003366] overflow-hidden">
    <img src="{{ asset('images/banner.jpg') }}" alt="Thư viện tài liệu" class="absolute inset-0 w-full h-full object-cover opacity-30">
    <div class="absolute inset-0 bg-gradient-to-t from-[#003366] to-transparent"></div>
    <div class="relative max-w-7xl mx-auto px-4 h-full flex flex-col justify-center items-center text-center pt-10">
        <p class="text-[#E27121] font-bold tracking-[0.3em] uppercase mb-4 border-b-2 border-[#E27121] inline-block pb-1">Trung Tâm Dữ Liệu</p>
        <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-wide leading-tight">
            Thư Viện Tài Liệu
        </h1>
    </div>
</section>

<section class="py-16 bg-gray-50 min-h-[50vh]">
    <div class="max-w-7xl mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-[#003366] text-3xl font-black uppercase mb-4">Danh Mục Tài Liệu</h2>
            <p class="text-gray-600 max-w-2xl mx-auto">Toàn bộ hồ sơ năng lực, tiêu chuẩn thi công và các tài liệu liên quan đến hoạt động của công ty Khánh Thuận.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($categories as $category)
            <a href="/thu-vien/{{ $category['slug'] }}" class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 flex flex-col items-center justify-center gap-5 hover:shadow-2xl hover:-translate-y-2 border-t-4 hover:border-t-[#E27121] transition-all duration-300 group text-center h-56" style="border-top-color: {{ $category['color'] }}20">
                <div class="w-20 h-20 rounded-full flex items-center justify-center bg-gray-50 group-hover:bg-opacity-20 transition-colors shadow-inner" style="color: {{ $category['color'] }}; background-color: {{ $category['color'] }}10;">
                    <i class="fa-solid {{ $category['icon'] }} text-4xl group-hover:scale-110 transition-transform"></i>
                </div>
                <h3 class="text-[#003366] font-bold text-lg group-hover:text-[#E27121] transition-colors line-clamp-2 px-2 leading-snug">{{ $category['name'] }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
