@extends('layouts.app')

@section('content')
@php
$title = $title ?? 'Danh mục';
@endphp

<section class="mx-auto w-full max-w-6xl px-5 py-16">
    <div class="space-y-4">
        <p class="text-sm uppercase tracking-[0.3em] text-black/50">Danh mục</p>
        <h1 class="text-4xl md:text-5xl font-display">{{ $title }}</h1>
        <p class="text-black/70">Danh sách bài viết và tài liệu liên quan sẽ được cập nhật tại đây.</p>
    </div>
    <div class="mt-10 grid gap-6 md:grid-cols-2">
        @foreach (range(1, 4) as $item)
        <div class="rounded-3xl border border-black/10 bg-white overflow-hidden shadow-soft">
            <div class="aspect-[4/3] bg-[linear-gradient(120deg,_#f3d3bf,_#f9f2e7)]"></div>
            <div class="p-6">
                <p class="text-xs uppercase tracking-[0.3em] text-black/50">Danh mục</p>
                <h3 class="mt-2 font-display text-2xl">Bài viết mẫu {{ $item }}</h3>
                <p class="mt-2 text-sm text-black/60">Tóm tắt nội dung cho danh mục {{ $title }}.</p>
            </div>
        </div>
        @endforeach
    </div>
</section>
@endsection