@extends('layouts.app')

@section('content')
<style>
    /* Gradient cho phần ảnh bên trái */
    .bg-gradient-khanhthuan {
        background: linear-gradient(135deg, rgba(0, 51, 102, 0.9) 0%, rgba(226, 113, 33, 0.6) 100%);
    }
</style>

<section class="relative min-h-screen bg-white flex items-center justify-center overflow-hidden">

    <div class="absolute inset-0 bg-white opacity-90 pointer-events-none"></div>
    <div class="absolute top-1/4 left-10 w-96 h-96 bg-[#003366] opacity-5 rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 right-10 w-80 h-80 bg-[#E27121] opacity-5 rounded-full blur-3xl"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-4 lg:px-6 my-10">
        <div class="bg-white rounded-2xl shadow-2xl border border-gray-100 overflow-hidden flex flex-col md:flex-row">

            <div class="w-full md:w-[55%] relative group overflow-hidden">
                <img src="{{ asset('images/banner.png') }}" onerror="this.src='{{ asset('images/banner.jpg') }}'" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-1000">
                <div class="absolute inset-0 bg-gradient-khanhthuan text-white flex flex-col justify-end p-8 lg:p-12">
                    <div class="w-20 h-2 bg-[#E27121] mb-6"></div>
                    <h2 class="text-3xl lg:text-5xl font-black uppercase mb-4 leading-tight tracking-wide">
                        KHÁNH THUẬN <br> MANAGEMENT SYSTEM
                    </h2>
                    <p class="text-lg text-gray-100 leading-relaxed max-w-2xl">
                        Hệ thống quản lý nội bộ dành cho Ban giám đốc, Cán bộ kỹ thuật và Nhân viên của Công ty Cổ phần Phát triển Hạ tầng Khánh Thuận.
                    </p>
                </div>
            </div>

            <div class="w-full md:w-[45%] flex items-center justify-center bg-white p-8 sm:p-10 lg:p-16">

                <div class="w-full max-w-md">
                    <div class="text-center mb-10">
                        <img src="{{ asset('images/logo.png') }}" onerror="this.src='{{ asset('images/banner.jpg') }}'; this.style.opacity=0.3;" class="h-16 mx-auto mb-6" alt="Công ty Khánh Thuận Logo">
                        <h1 class="text-[#003366] text-3xl font-black uppercase tracking-wider mb-2">Đăng Nhập</h1>
                        <p class="text-gray-500 font-medium">Chào mừng bạn trở lại hệ thống!</p>
                    </div>

                    <form action="{{ route('login') }}" method="POST" class="grid gap-6">
                        @csrf

                        <div class="space-y-2">
                            <label class="text-sm font-bold text-[#003366] uppercase tracking-wide">Tài khoản Email *</label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-envelope"></i>
                                </span>
                                <input name="email" class="w-full rounded-xl border-2 border-gray-100 bg-gray-50 px-4 pl-12 py-3.5 text-gray-700 font-medium focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all"
                                    placeholder="your-email@khanhthuan.com" type="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                            @error('email')
                            <span class="text-xs text-red-600 font-semibold" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="text-sm font-bold text-[#003366] uppercase tracking-wide">Mật khẩu *</label>
                                @if (Route::has('password.request'))
                                <a class="text-xs font-bold text-[#E27121] hover:text-[#003366] transition-colors" href="{{ route('password.request') }}">
                                    Quên mật khẩu?
                                </a>
                                @endif
                            </div>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-lock"></i>
                                </span>
                                <input name="password" id="password" class="w-full rounded-xl border-2 border-gray-100 bg-gray-50 px-4 pl-12 py-3.5 text-gray-700 font-medium focus:border-[#E27121] focus:bg-white focus:outline-none focus:ring-2 focus:ring-[#E27121]/20 transition-all"
                                    placeholder="••••••••••••" type="password" required autocomplete="current-password">
                            </div>
                            @error('password')
                            <span class="text-xs text-red-600 font-semibold" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="flex items-center gap-2 mt-1">
                            <input class="w-5 h-5 rounded border-2 border-gray-100 text-[#003366] focus:ring-[#003366] transition cursor-pointer" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="text-sm font-semibold text-gray-600 cursor-pointer" for="remember">Ghi nhớ đăng nhập</label>
                        </div>

                        <button type="submit" class="mt-4 w-full md:w-auto inline-flex items-center justify-center gap-3 rounded-lg bg-[#003366] hover:bg-[#E27121] px-8 py-4 text-white font-black uppercase tracking-wider transition-all duration-300 shadow-md hover:shadow-xl transform hover:-translate-y-1">
                            <i class="fa-solid fa-right-to-bracket"></i> Gửi Yêu Cầu Đăng Nhập
                        </button>
                    </form>

                    <div class="mt-12 text-center text-xs text-gray-400 font-medium pt-6 border-t border-gray-100">
                        &copy; {{ date('Y') }} Công ty Cổ phần Phát triển Hạ tầng Khánh Thuận. All rights reserved. <br>
                        Developed by <a href="#" class="font-bold text-[#003366] hover:text-[#E27121]">Khánh Thuận IT Team</a>.
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection