@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-12">
    <h1 class="text-3xl font-black text-[#003366] uppercase border-l-4 border-[#E27121] pl-4 mb-8">
        {{ $title }}
    </h1>

    <div class="bg-white shadow rounded-lg overflow-hidden border border-gray-100">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-bold text-[#003366] uppercase tracking-wider">Tên tài liệu</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-[#003366] uppercase tracking-wider">Định dạng</th>
                    <th class="px-6 py-3 text-left text-xs font-bold text-[#003366] uppercase tracking-wider">Dung lượng</th>
                    <th class="px-6 py-3 text-right text-xs font-bold text-[#003366] uppercase tracking-wider">Thao tác</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($documents as $doc)
                <tr class="hover:bg-gray-50 transition-colors duration-150">
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center gap-3">
                            @if($doc->file_extension == 'xlsx' || $doc->file_extension == 'xls')
                            <i class="fa-solid fa-file-excel text-2xl text-[#107c41]"></i>
                            @elseif($doc->file_extension == 'pdf')
                            <i class="fa-solid fa-file-pdf text-2xl text-red-600"></i>
                            @else
                            <i class="fa-solid fa-file-word text-2xl text-blue-600"></i>
                            @endif
                            <a href="{{ route('documents.show', $doc->id) }}" class="text-sm font-semibold text-[#003366] hover:text-[#E27121] transition-colors" title="Xem chi tiết">
                                {{ $doc->title }}
                            </a>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 uppercase">{{ $doc->file_extension }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $doc->file_size }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('document.download', $doc->id) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-[#003366] text-white text-xs font-bold uppercase rounded hover:bg-[#E27121] transition-colors shadow">
                            <i class="fa-solid fa-download"></i> Tải về
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">Chưa có tài liệu nào trong danh mục này.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection