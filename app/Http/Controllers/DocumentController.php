<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function mainIndex()
    {
        $categories = \App\Models\DocumentCategory::all();

        return view('library.main', compact('categories'));
    }

    public function index($categorySlug)
    {
        // Lấy danh sách tài liệu theo category
        $documents = Document::where('category', $categorySlug)->latest()->get();

        // Lấy thông tin category từ database
        $category = \App\Models\DocumentCategory::where('slug', $categorySlug)->first();
        $title = $category ? $category->name : 'Thư viện Tài liệu';

        return view('library.index', compact('documents', 'title'));
    }

    public function show($id)
    {
        $document = Document::findOrFail($id);
        
        // Lấy các tài liệu khác cùng chuyên mục để hiển thị ở dưới
        $otherDocuments = Document::where('category', $document->category)
            ->where('id', '!=', $id)
            ->latest()
            ->limit(10)
            ->get();

        return view('library.show', compact('document', 'otherDocuments'));
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);
        $filePath = 'public/' . $document->file_path; // File lưu trong thư mục storage/app/public

        if (Storage::exists($filePath)) {
            return Storage::download($filePath, $document->title . '.' . $document->file_extension);
        }

        return back()->with('error', 'File không tồn tại trên hệ thống!');
    }
    public function create()
    {
        $categories = \App\Models\DocumentCategory::all();
        return view('admin.documents.create', compact('categories'));
    }

    public function adminIndex(Request $request)
    {
        $category = $request->query('category');
        $group = $request->query('group');
        $sort = $request->query('sort', 'newest');

        $libraryCategories = ['tieu-chuan-thi-cong', 'tieu-chuan-thi-nghiem', 'excel-ung-dung'];
        $competencyCategories = [
            'ho-so-nang-luc', 
            'giay-phep-kinh-doanh', 
            'cong-bo-nang-luc', 
            'chung-nhan-du-dieu-kien', 
            'hieu-chuan-thiet-bi', 
            'danh-muc-thiet-bi', 
            'danh-sach-can-bo'
        ];

        $documents = Document::query()
            ->when($group === 'library', function ($query) use ($libraryCategories) {
                return $query->whereIn('category', $libraryCategories);
            })
            ->when($group === 'competency', function ($query) use ($competencyCategories) {
                return $query->whereIn('category', $competencyCategories);
            })
            ->when($category, function ($query, $categoryValue) {
                return $query->where('category', $categoryValue);
            })
            ->when($sort === 'oldest', function ($query) {
                return $query->orderBy('created_at', 'asc');
            }, function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->paginate(15)
            ->withQueryString();

        return view('admin.documents.index', compact('documents', 'category', 'sort', 'group'));
    }

    public function edit(Document $document)
    {
        $categories = \App\Models\DocumentCategory::all();
        return view('admin.documents.edit', compact('document', 'categories'));
    }

    // Hàm: Nhận file, lưu vào thư mục và ghi vào Database
    public function store(Request $request)
    {
        // 1. Kiểm tra dữ liệu nhập vào (Validate)
        $maxSize = $request->category == 'ho-so-nang-luc' ? 102400 : 51200; // 100MB hoặc 50MB

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => "required|mimes:pdf,doc,docx,xls,xlsx,xlsm|max:$maxSize",
        ], [
            'file.mimes' => 'Chỉ hỗ trợ file PDF, Word, Excel.',
            'file.max' => 'Dung lượng file vượt quá giới hạn cho phép (' . ($maxSize/1024) . 'MB).',
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Lấy thông tin file
            $extension = $file->getClientOriginalExtension();
            $sizeInBytes = $file->getSize();

            // Đổi Byte sang MB hoặc KB cho đẹp
            $size = $sizeInBytes > 1048576
                ? round($sizeInBytes / 1048576, 2) . ' MB'
                : round($sizeInBytes / 1024, 2) . ' KB';

            // Lưu file vào thư mục storage/app/public/documents
            // Laravel sẽ tự động tạo tên file ngẫu nhiên để không bị trùng
            $path = $file->store('documents', 'public');

            // Lưu thông tin vào Database
            Document::create([
                'title' => $request->title,
                'category' => $request->category,
                'file_path' => $path,
                'file_extension' => $extension,
                'file_size' => $size,
            ]);

            return back()->with('success', 'Đã tải tài liệu lên thành công!');
        }

        return back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
    }

    public function update(Request $request, Document $document)
    {
        $maxSize = $request->category == 'ho-so-nang-luc' ? 102400 : 51200;

        $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'file' => "nullable|mimes:pdf,doc,docx,xls,xlsx,xlsm|max:$maxSize",
        ], [
            'file.mimes' => 'Chỉ hỗ trợ file PDF, Word, Excel.',
            'file.max' => 'Dung lượng file vượt quá giới hạn cho phép (' . ($maxSize/1024) . 'MB).',
        ]);

        $data = $request->only(['title', 'category']);

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            if ($document->file_path && Storage::exists('public/' . $document->file_path)) {
                Storage::delete('public/' . $document->file_path);
            }

            $extension = $file->getClientOriginalExtension();
            $sizeInBytes = $file->getSize();
            $size = $sizeInBytes > 1048576
                ? round($sizeInBytes / 1048576, 2) . ' MB'
                : round($sizeInBytes / 1024, 2) . ' KB';

            $path = $file->store('documents', 'public');

            $data['file_path'] = $path;
            $data['file_extension'] = $extension;
            $data['file_size'] = $size;
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('success', 'Cập nhật tài liệu thành công!');
    }

    public function destroy(Document $document)
    {
        if ($document->file_path && Storage::exists('public/' . $document->file_path)) {
            Storage::delete('public/' . $document->file_path);
        }

        $document->delete();

        return back()->with('success', 'Đã xóa tài liệu.');
    }

    public function bulkDestroy(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Vui lòng chọn ít nhất một tài liệu để xóa.');
        }

        $documents = Document::whereIn('id', $ids)->get();
        foreach ($documents as $document) {
            if ($document->file_path && Storage::exists('public/' . $document->file_path)) {
                Storage::delete('public/' . $document->file_path);
            }
            $document->delete();
        }

        return back()->with('success', 'Đã xóa ' . count($ids) . ' tài liệu thành công.');
    }
}
